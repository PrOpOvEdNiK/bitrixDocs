<?

class SibirixKeyrightsBackend_Model_Api {

    private $authData;
    private $currentBatch;

    /**
     * Curl resource
     * @var
     */
    private $_curl;

    /**
     *
     */
    final private function __construct() {
        $this->authData = new Zend_Session_Namespace('authdata');
    }

    /**
     * @return SibirixKeyrightsBackend_Model_Api
     */
    final static public function getInstance() {
        static $_instance;

        if (!$_instance) {
            $_instance = new self();
        }

        return $_instance;
    }

    /**
     * @param $method
     * @param array $params
     * @param string $name
     * @return SibirixKeyrightsBackend_Model_Api|mixed
     * @throws Zend_Exception
     */
    public function callMethod($method, $params = array(), $name = null) {
        if ($this->currentBatch !== null) {
            // Батч-запрос
            if ($name === null) {
                throw new Zend_Exception('using batch-request, but $name is empty');
            }

            $this->currentBatch[$name] = array($method, $params);
            return $this;
        }

        // Одиночный запрос
        if (!is_array($params)) {
            $params = array($params);
        }

        $requestParams = array(
            'auth' => $this->authData->authId
        );

        $queryParams = http_build_query(array_merge($params, $requestParams));


        $url = $this->authData->domain . '/rest/' . $method . '.json';

        $res = $this->_execHttpRequest($url, $queryParams);
        $arRes = json_decode($res, true);


        if (isset($arRes['next'])) {
            // Постраничная загрузка
            $params['start'] = $arRes['next'];
            $nextResult = $this->callMethod($method, $params, $name);
            $arRes['result'] = array_merge($arRes['result'], $nextResult['result']);
        }

        if (isset($arRes['error'])) {
            if ($arRes['error'] == 'expired_token') {
                if ($this->refreshToken()) {
                    return $this->callMethod($method, $params, $name);
                } else {
                    throw new Zend_Exception('fail call b24 api method "' . $method . '" ' . $arRes['error']);
                }
            } else {
                throw new Zend_Exception('fail call b24 api method "' . $method . '" ' . $arRes['error']);
            }
        }

        if (!array_key_exists('result', $arRes)) {
            throw new Zend_Exception('fail call b24 api method "' . $method . '" '.var_export($arRes, true));
        }

        return $arRes;
    }

    /**
     * Обновить токен для авторизации
     * @return bool|void
     * @throws Zend_Exception
     */
    public function refreshToken() {
        if (!$this->authData->refreshId) {
            throw new Zend_Exception('b24 api token expired');
        }

        $config = Zend_Registry::get('config');
        $scope = ['entity', 'user', 'department', 'sonet_group'];
        $requestParams = [
            'client_id'     => $config->bx24config->clientId,
            'grant_type'    => 'refresh_token',
            'client_secret' => $config->bx24config->clientSecret,
            'redirect_uri'  => '', //$this->redirectUrl,
            'refresh_token' => $this->authData->refreshId,
            'scope'         => implode(',', $scope),
        ];

        $url = $this->authData->fullDomain . '/oauth/token/?' . http_build_query($requestParams);

        // Сохраним новый токен
        $this->authData->refreshId = false;

        $res = $this->_execHttpRequest($url);
        $arRes = json_decode($res, true);
        if ($arRes['access_token'] && $arRes['refresh_token']) {
            $this->authData->refreshId = $arRes['refresh_token'];
            $this->authData->authId    = $arRes['access_token'];
            return true;
        }
        return false;
    }

    /**
     * Начать формирование пакета запросов
     * @return SibirixKeyrightsBackend_Model_Api
     */
    public function beginBatch() {
        $this->currentBatch = array();
        return $this;
    }

    /**
     * get instance curl client
     *
     * @return resource
     */
    private function _getHttpClient() {
        if ($this->_curl) { return $this->_curl; }

        $this->_curl = curl_init();
        curl_setopt_array($this->_curl, array(
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_RETURNTRANSFER => true
        ));

        return $this->_curl;
    }

    /**
     * exec http request and return response
     *
     * @param $url
     * @return mixed
     */
    private function _execHttpRequest($url, $postFields = array()) {
        $time = microtime(true);
        $curl = $this->_getHttpClient();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: */*; charset=UTF-8']);

        if (!empty($postFields)) {
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $postFields);
            $result = curl_exec($curl);
            $duration = microtime(true) - $time;
            $this->debugRequest($url . "\n" . $postFields, $result, $duration);
        } else {
            curl_setopt($curl, CURLOPT_HTTPGET, true);
            $result = curl_exec($curl);
            $duration = microtime(true) - $time;
            $this->debugRequest($url, $result, $duration);
        }

        $this->debugRequest($url, $result, (microtime(true) - $time));

        return $result;
    }

    /**
     * @param bool $halt
     * @return array
     * @throws Zend_Exception
     */
    public function callBatch($halt = false) {
        if ($this->currentBatch === null) {
            throw new Zend_Exception('Trying execure not-started batch');
        }

        if (!count($this->currentBatch)) {
            return array();
        }

        $requestParams = array(
            'auth' => $this->authData->authId,
            'halt' => $halt ? 1 : 0
        );

        foreach ($this->currentBatch as $name => $requestData) {
            $method = $requestData[0];
            $params = $requestData[1];
            if (!is_array($requestData[1])) {
                $params = array($requestData[1]);
            }

            $requestParams['cmd[' . $name . ']'] = $method . '?' . http_build_query($params);
        }

        $url = $this->authData->domain . 'rest/batch.json';
        $res = $this->_execHttpRequest($url, http_build_query($requestParams));
        $arRes = json_decode($res, true);

        $arRes = $arRes['result'];
        if (!isset($arRes['result']) || count($arRes['result_error'])) {
            throw new Zend_Exception('fail call b24 api method "batch" ' . implode("\n", $arRes['result_error']));
        }

        $result = array();
        foreach ($this->currentBatch as $name => $requestData) {
            if (isset($arRes['result_total'][$name])) {
                $result[$name] = array(
                    'result' => $arRes['result'][$name],
                    'total'  => $arRes['result_total'][$name]
                );
            } else {
                $result[$name] = $arRes['result'][$name];
            }
        }

        $this->currentBatch = null;

        return $result;
    }

    /**
     * @return array
     */
    public function getUserData() {
        $session = new Zend_Session_Namespace('user');
        $result = [];
        foreach ($session as $key => $value) {
            $result[$key] = $value;
        }
        return $result;
    }

    public static function getCurrentUser() {
        $i = self::getInstance();
        $res = $i->callMethod('user.current');
        $user = array_intersect_key($res['result'], array_flip(['ID', 'ACTIVE', 'EMAIL', 'NAME', 'LAST_NAME', 'SECOND_NAME', 'UF_DEPARTMENT']));
        return $user;
    }

    public static function isAdmin() {
        $i = self::getInstance();
        $res = $i->callMethod('user.admin');
        return $res['result'];
    }

    private function debugRequest($url, $res, $time) {
        if (APPLICATION_ENV == 'development') {
            $flog = fopen($_SERVER['DOCUMENT_ROOT'] . "/flog.log", "a");
            fwrite($flog, "\n\n" . date('Y.m.d H:i:s'));
            fwrite($flog, "\n"   . str_replace('http://scrumban-test.bitrix24.ru/rest/', '', $url));
            fwrite($flog, "\n"   . number_format($time, 4, '.' , '') . 's');
            fwrite($flog, "\n" . print_r($res, 1));
            fclose($flog);
        }
    }
}

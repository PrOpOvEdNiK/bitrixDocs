<?

class SibirixKeyrightsBackend_Model_Api {

    private $authData;
    private $currentBatch;

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
        $model = $this->getModel($method);
        if (!$model || !method_exists($model, 'isMethodAvailable') || !$model->isMethodAvailable($method)) {
            return false;
        }

        $result = $model->callMethod($method, $params);
        return array('result' => $result);
    }



    /**
     * @param $method
     * @return SibirixKeyrightsBackend_Model_Abstract
     */
    public function getModel($method) {
        $method = trim($method);
        if (!$method) return false;
        $methodParts = explode('.', strtolower($method));
        $nameSpace = ucfirst($methodParts[0]);

        if (!$nameSpace) return false;

        if (class_exists('SibirixKeyrightsBackend_Model_' . $nameSpace)) {
            $className = 'SibirixKeyrightsBackend_Model_' . $nameSpace;
            return new $className();
        } else {
            return false;
        }
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
}

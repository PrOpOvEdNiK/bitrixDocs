<?php

/**
 * Class Sibirix_Controller_Action_Helper_Favicon
 */
class Sibirix_Controller_Action_Helper_Favicon extends Zend_Controller_Action_Helper_Json {

    const CACHE_TIME   = 2592000; // 1 month
    const NO_ICON_PATH = '/images/no-icon.ico';

    /**
     * @param $rawUrl
     * @return bool|mixed
     */
    public function sendFavicon($rawUrl) {
        $favUrl = $this->getFaviconUrl($rawUrl);
        if (!$favUrl) $this->sendDefault();

        $cached = $this->getCachedFavicon($favUrl);
//        if ($cached) $this->send($cached);

        $favicon = $this->downloadFavicon($favUrl);
        if ($this->testResponse($favicon)) {
            $this->saveCachedFavicon($favUrl, $favicon);
            $this->send($favicon);
        } else {
            $this->saveCachedFavicon($favUrl, false);
            $this->sendDefault();
        }
    }

    /**
     * @param $data
     */
    private function send($data) {
        while(@ob_end_clean()){};
        header('Content-Description: File Transfer');
        header('Content-Type: image/x-icon');
        header('Content-Transfer-Encoding: binary');
        header('Expires: ' . date('r', time() + self::CACHE_TIME));
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . mb_strlen($data, 'cp1251'));
        echo($data);
        die();
    }

    /**
     *
     */
    public function sendDefault() {
        throw new Zend_Controller_Action_Exception('Favicon not found', 404);
    }

    /**
     * @param $url
     * @return bool|mixed
     */
    public function downloadFavicon($url) {
        $curlObj = curl_init();
        curl_setopt($curlObj, CURLOPT_URL, $url);
        curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curlObj, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($curlObj, CURLOPT_TIMEOUT, 3);
        curl_setopt($curlObj, CURLOPT_FOLLOWLOCATION, true);

        curl_setopt($curlObj, CURLOPT_NOPROGRESS, false);
        curl_setopt($curlObj, CURLOPT_PROGRESSFUNCTION, function($downloadSize, $downloaded, $uploadSize, $uploaded) {
            return ($downloaded > (1024 * 15)) ? 1 : 0;
        });

        $favicon = curl_exec($curlObj);
        $status  = curl_getinfo($curlObj, CURLINFO_HTTP_CODE);
        curl_close($curlObj);

        if ($status != 200) return false;
        return $favicon;
    }

    /**
     * @param $rawUrl
     * @return bool|string
     */
    private function getFaviconUrl($rawUrl) {
        $parts = parse_url($rawUrl);

        if (empty($parts['host'])) {
            return false;
        }

        if (empty($parts['scheme'])) {
            $parts['scheme'] = 'http';
        }
        if (($parts['scheme'] !== 'http') && ($parts['scheme'] !== 'https')) {
            return false;
        }

        return mb_strtolower($parts['scheme'] . '://' . $parts['host'] . '/favicon.ico');
    }

    /**
     * @param $favUrl
     * @return bool|string
     */
    private function getCachedFavicon($favUrl) {
        $fn = $this->prepareFilename($favUrl);
        $fullPath = self::getCacheFolder() . $fn;

        if (!file_exists($fullPath)) {
            return false;
        }

        $stat = filemtime($fullPath);

        if ($stat && ($stat + self::CACHE_TIME > time())) {
            $fh = fopen($fullPath, 'r');
            $data = fread($fh, 1024 * 15);
            return $data;
        }

        return false;
    }

    /**
     * @param $favUrl
     * @return mixed
     */
    private function prepareFilename($favUrl) {
        require_once('idna_convert.class.php');

        $idn    = new idna_convert(array('idn_version' => 2008));
        $favUrl = (stripos($favUrl, 'xn--') !== false) ? $favUrl : $idn->encode($favUrl);

        $favUrl = mb_strtolower($favUrl);
        $favUrl = preg_replace('/\.ico$/i', '', $favUrl);
        $favUrl = preg_replace('/[^a-z0-9]/i', '_', $favUrl);
        return preg_replace('/_+/', '_', $favUrl) . '.ico';
    }

    /**
     *
     */
    private function prepareCacheFolder() {
        if (!file_exists(self::getCacheFolder())) {
            mkdir(self::getCacheFolder(), 0755, true);
        }
    }

    /**
     * @param $favicon
     * @return bool
     */
    private function testResponse($favicon) {
        $text = mb_strtolower($favicon);

        $fn = self::getCacheFolder() . time() . rand(1, 1000000) . '.ico';
        $fh = fopen($fn, 'w');
        fwrite($fh, $favicon);
        fclose($fh);
        $info = getimagesize($fn);
        unlink($fn);

        if (!is_array($info)) {
            return false;
        } elseif (!$info[0] || !$info[1]) {
            return false;
        } else {
            return (mb_strpos($text, '<body') === false) && (mb_strpos($text, ' error') === false) && (mb_strpos($text, '<a href') === false);
        }
    }

    /**
     * @param $favUrl
     * @param $fileData
     */
    private function saveCachedFavicon($favUrl, $fileData) {
        if (mb_strlen($fileData, 'cp1251') > 1024 * 15) {
            // do not cache to big files. 15kb
            return;
        }

        $this->prepareCacheFolder();
        $fn = $this->prepareFilename($favUrl);

        $fullPath = self::getCacheFolder() . $fn;
        $fileHandler = fopen($fullPath, 'w');
        fwrite($fileHandler, $fileData);
        fclose($fileHandler);
    }

    public static function getCacheFolder() {
        $config = Zend_Registry::get('config');
        return $config->options->cache->favicon->cache_dir;
    }
}

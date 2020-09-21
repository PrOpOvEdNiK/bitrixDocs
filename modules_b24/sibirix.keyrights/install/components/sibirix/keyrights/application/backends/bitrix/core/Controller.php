<?php

class SibirixKeyrightsBackend_Core_Controller extends Zend_Controller_Action {

    /**
     * Use it at the controller preDispatch
     */
    public function init() {
        $this->bootstrap = $this->getInvokeArg('bootstrap');
        $this->front = $this->bootstrap->getResource('frontcontroller');
        $this->config = $this->bootstrap->getOptions('config');

        parent::init();
    }

    public function preDispatch() {

        try {
            $body = $this->getRequest()->getRawBody();
            $data = Zend_Json::decode($body);
            if ($data) {
                $this->getRequest()->setParams($data);
            }
        } catch (Exception $e) {}
    }

    protected function _checkCsrfToken() {
        return check_bitrix_sessid('csrf_token');
    }

    /**
     * Translate method (alias)
     * @param $stringKey
     * @return mixed
     */
    protected function t($stringKey) {
        return call_user_func_array(array($this->view, 't'), func_get_args());
    }

    public function getParam($paramName, $default = null) {
        $param = parent::getParam($paramName, $default);

        if (Zend_Registry::get("Zend_Translate")->charsetIsWin1251()) {
            global $APPLICATION;
            if (is_array($param)) {
                $param = $this->recursiveConvertCharset($param);
            } else {
                $param = $APPLICATION->ConvertCharset($param, "UTF-8", "windows-1251");
            }
        }

        return $param;
    }

    public function getAllParams() {
        $params = parent::getAllParams();

        if (Zend_Registry::get("Zend_Translate")->charsetIsWin1251()) {
            global $APPLICATION;
            foreach ($params as $key => $value) {
                if (is_array($value)) {
                    $params[$key] = $this->recursiveConvertCharset($value);
                } else {
                    $params[$key] = $APPLICATION->ConvertCharset($value, "UTF-8", "windows-1251");
                }
            }
        }

        return $params;
    }

    public function getBodyJsonParams() {
        $body = $this->getRequest()->getRawBody();
        $data = Zend_Json::decode($body);
        $params = array();

        if (Zend_Registry::get("Zend_Translate")->charsetIsWin1251()) {
            foreach ($data as $key => $value) {
                $params[$key] = $this->recursiveConvertCharset($value);
            }
        } else {
            $params = $data;
        }

        return $params;
    }

    protected function recursiveConvertCharset($value) {
        global $APPLICATION;
        if (is_array($value)) {
            foreach ($value as $key => $subVal) {
                $value[$key] = $this->recursiveConvertCharset($subVal);
            }
        } else {
            return $APPLICATION->ConvertCharset($value, "UTF-8", "windows-1251");
        }

        return $value;
    }
}

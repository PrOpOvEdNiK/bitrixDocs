<?php

class Backend_Controller_Action_Helper_Json extends Zend_Controller_Action_Helper_Json {

    var $_bitrix;

    public function sendJson($data, $keepLayouts = false, $encodeData = true) {
        global $APPLICATION;
        $APPLICATION->RestartBuffer();
        parent::sendJson($this->_encode($data), $keepLayouts, false);
    }

    protected function _encode($data) {
        if (!Zend_Registry::get("Zend_Translate")->charsetIsWin1251()) {
            return Zend_Json::encode($data);
        }

        global $APPLICATION;
        $this->_bitrix = $APPLICATION;

        $data = $this->_windows1251toUtf8($data);

        return Zend_Json::encode($data);
    }

    protected function _windows1251toUtf8($data) {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $data[$key] = $this->_windows1251toUtf8($value);
            }
            return $data;
        }

        return $this->_bitrix->ConvertCharset($data, "windows-1251", "UTF-8");
    }
}

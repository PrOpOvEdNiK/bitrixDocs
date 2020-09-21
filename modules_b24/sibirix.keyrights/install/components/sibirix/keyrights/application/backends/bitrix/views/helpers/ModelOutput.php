<?php
/**
 *
 */
class SibirixKeyrightsBackend_View_Helper_ModelOutput extends Zend_View_Helper_Abstract
{
    var $_bitrix;
    var $_disableNormalize = false;

    /**
     * @param $data Zend_Db_Table_Rowset_Abstract
     * @param bool $disableNormalize
     * @return mixed|string
     */
    public function modelOutput($data, $disableNormalize = false) {
        $this->_disableNormalize = $disableNormalize;

        return $this->encode($data);
    }

    public function encode($data) {
        if (!Zend_Registry::get("Zend_Translate")->charsetIsWin1251()) {
            return Zend_Json::encode($data);
        }

        global $APPLICATION;
        $this->_bitrix = $APPLICATION;

        $data = $this->windows1251toUtf8($data);

        return Zend_Json::encode($data);
    }

    public function windows1251toUtf8($data) {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                if (!is_int($value)) {
                    $data[$key] = $this->windows1251toUtf8($value);
                }
            }
            return $data;
        }

        return $this->_bitrix->ConvertCharset($data, "windows-1251", "UTF-8");
    }
}

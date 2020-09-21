<?php
/**
 *
 */
class SibirixKeyrightsBackend_View_Helper_ModelOutput extends Zend_View_Helper_Abstract
{
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
        return Zend_Json::encode($data);
    }
}

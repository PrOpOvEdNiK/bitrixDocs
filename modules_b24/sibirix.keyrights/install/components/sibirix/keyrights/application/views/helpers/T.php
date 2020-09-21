<?php

class Zend_View_Helper_T extends Zend_View_Helper_Abstract
{
    private $_translate;

    /**
     * Translate the index
     * @param mixed $messageId
     * @return mixed
     */
    function t($messageId = null) {

        if ($messageId === null) {
            return $this->getTranslate();
        }
        // need for pasting variables inside translating string
        return call_user_func_array(array($this->view, 'translate'), func_get_args());
    }

    function getTranslate() {
        if (!$this->_translate) {
            $this->_translate = Zend_Registry::get('Zend_Translate');
        }

        return $this->_translate;
    }
}

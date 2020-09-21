<?php


class SibirixKeyrightsBackend_Model_Options {

    public static function getServerPassPhrase() {
        $session = new Zend_Session_Namespace('authdata');
        return $session->domainData['key'];
    }
}

<?php


class SibirixKeyrightsBackend_Model_User {

    public static function getCurrentUser() {
        return SibirixKeyrightsBackend_Model_Api::getCurrentUser();
    }

    public static function getUserData($id = false) {
        return SibirixKeyrightsBackend_Model_Api::getInstance()->getUserData($id);
    }

    public static function isAdmin() {
        return SibirixKeyrightsBackend_Model_Api::isAdmin();
    }
}

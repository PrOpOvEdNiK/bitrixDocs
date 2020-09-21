<?php


class SibirixKeyrightsBackend_Model_Options {

    public static function getServerPassPhrase() {
        return COption::GetOptionString(CKeyrights::MODULE_ID, 'serverPassphrase');
    }
}

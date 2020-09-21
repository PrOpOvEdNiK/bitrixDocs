<?php


class Model_Db_Backend_CrmStatus_Lead extends Model_Db_Backend_CrmStatus_Abstract {

    protected function getSettings() {
        return [
            'START_FIELD'           => 'NEW',
            'FINAL_SUCCESS_FIELD'   => 'CONVERTED',
            'FINAL_UNSUCCESS_FIELD' => 'JUNK'
        ];
    }

    protected function getEntity() {
        return 'STATUS';
    }
}

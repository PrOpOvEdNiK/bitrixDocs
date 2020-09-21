<?php


class Model_Db_Backend_CrmStatus_Deal extends Model_Db_Backend_CrmStatus_Abstract {

    protected function getSettings() {
        return [
            'START_FIELD'           => 'NEW',
            'FINAL_SUCCESS_FIELD'   => 'WON',
            'FINAL_UNSUCCESS_FIELD' => 'LOSE'
        ];
    }

    protected function getEntity() {
        return 'DEAL_STAGE';
    }
}

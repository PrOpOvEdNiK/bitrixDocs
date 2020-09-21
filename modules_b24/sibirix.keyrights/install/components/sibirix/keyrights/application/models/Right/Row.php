<?php

/**
 * Class SibirixKeyrights_Model_Right_Row
 */
class SibirixKeyrights_Model_Right_Row extends Core_Db_Table_Row {

    /**
     * @return array
     */
    public function toArray() {
        $result = array();

        $result['blocked'] = ($this->blocked == '1');
        $result['edit']    = ($this->edit    == '1');

        if ($this->group) $result['group'] = (int)$this->group;
        if ($this->user)  $result['user']  = (int)$this->user;

        $timed = strtotime($this->timed);
        $result['timed'] = ($timed > 0 ? $this->timed : null);

        return $result;
    }

}

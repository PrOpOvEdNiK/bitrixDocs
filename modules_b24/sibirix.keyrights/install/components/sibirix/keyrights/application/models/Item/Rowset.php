<?php


class SibirixKeyrights_Model_Item_Rowset extends Core_Db_Table_Rowset {

    public function loadRights() {
        if (!$this->count()) {
            return $this;
        }

        $rowIds = array();
        foreach ($this as $row) {
            $rowIds[] = $row->id;
            $row->setRelatedField('rights', array());
        }

        $rightModel = new SibirixKeyrightsBackend_Model_Right();
        $rightList = $rightModel->fetchAll(array('item_id in (?)' => $rowIds));

        foreach ($rightList as $right) {
            $itemRow = $this->getRowById($right->item_id);
            if ($itemRow) {
                $itemRow->rights = array_merge($itemRow->rights, array($right->toArray()));
            }
        }

        return $this;
    }

    public function getRowBySectionId($sectionId) {
        foreach ($this as $row) {
            if ($row->section_id == $sectionId) {
                return $row;
            }
        }

        return false;
    }
}

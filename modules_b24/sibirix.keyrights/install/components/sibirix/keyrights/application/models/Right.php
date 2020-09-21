<?php

/**
 * Class SibirixKeyrights_Model_Right
 */
abstract class SibirixKeyrights_Model_Right extends Core_Db_Table {

    protected $_name = 'sib_kr_right';

    protected $_rowClass = 'SibirixKeyrights_Model_Right_Row';

    /**
     * @param $sectionId
     * @param $entityId
     * @param $rights
     * @return bool
     * @throws Zend_Db_Table_Row_Exception
     */
    public function saveEntityRights($sectionId, $entityId, $rights) {
        $itemModel = new SibirixKeyrightsBackend_Model_Item();

        $where = array();
        if ($entityId) {
            $where['entity_id = ?'] = $entityId;
        } else {
            $where['section_id = ?'] = $sectionId;
        }

        $item = $itemModel->getRight($where);
        $itemId = $item->id;

        if (!$itemId) return false;

        $existRights = $this->fetchAll(array('item_id = ?' => $itemId));
        foreach ($existRights as $rightRow) {
            $rightRow->delete();
        }

        foreach ($rights as $newRight) {
            $params = array(
                'item_id' => $itemId,
                'edit'    => $newRight['edit'] ? 1 : 0,
                'blocked' => $newRight['blocked'] ? 1 : 0,
                'timed'   => false, //$newRight['timed'] ? 1 : 0, // todo
            );

            if ($newRight['timed']) {
                $params['timed'] = $newRight['timed'];
            }
            if (isset($newRight['group']) && $newRight['group']) $params['group'] = $newRight['group'];
            if (isset($newRight['user']) && $newRight['user'])  $params['user']  = $newRight['user'];
            $row = $this->createRow($params);
            $row->save();
        }

        return true;
    }

    public function deleteAll($elements = array()) {

        $usersId = array();
        $groupsId = array();

        foreach ($elements as $element) {
            if ($element['isGroup']) {
                $groupsId[] = $element['id'];
            } else {
                $usersId[] = $element['id'];
            }
        }

        if (!empty($usersId)) {
            $itemModel = new SibirixKeyrightsBackend_Model_Item();
            $itemModel->changeOwnerToCurrentUser($usersId);
            $this->delete(array('user IN (?)' => $usersId));
        }

        if (!empty($groupsId)) {
            $this->delete(array("`group` IN (?)" => $groupsId));
        }

        return true;
    }

}

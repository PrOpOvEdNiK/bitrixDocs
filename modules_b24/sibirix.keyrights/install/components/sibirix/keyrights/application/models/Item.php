<?php

/**
 * Class SibirixKeyrights_Model_Item
 */
abstract class SibirixKeyrights_Model_Item extends Core_Db_Table {

    const ACCESS_NO        = 0;
    const ACCESS_CAN_READ  = 1;
    const ACCESS_CAN_WRITE = 2;
    const ACCESS_CAN_OWN   = 3;

    protected $_name = 'sib_kr_item';

    protected $_rowsetClass = 'SibirixKeyrights_Model_Item_Rowset';

    /**
     * @param array  $where
     * @param string $order
     * @return SibirixKeyrights_Model_Item_Rowset
     */
    public function getRights($where = array(), $order = 'id ASC') {
        $rowset = $this->fetchAll($where, $order);
        $rowset->loadRights();

        return $rowset;
    }

    /**
     * @param array $where
     * @param string $order
     * @return Zend_Db_Table_Row_Abstract
     */
    public function getRight($where = array(), $order = 'id ASC') {
        $rowset = $this->getRights($where, $order);
        $rowset->rewind();
        return $rowset->current();
    }

    /**
     * @param $sectionId
     * @param $elementId
     * @param $owner
     * @return bool|Zend_Db_Table_Row_Abstract
     */
    public function create($sectionId, $elementId, $owner) {
        $row = $this->createRow(array(
            'section_id' => $elementId ? new Zend_Db_Expr('NULL') : $sectionId,
            'entity_id' => $elementId ? $elementId : new Zend_Db_Expr('NULL'),
            'owner' => $owner,
        ));

        if ($row->save()) {
            return $row;
        }

        return false;
    }

    /**
     * @param int $entityId
     */
    public function deleteItemRights($entityId) {
        $entityId = intval($entityId);
        $rowset = $this->fetchAll(array('entity_id = ?' => $entityId));

        $rightModel = new SibirixKeyrightsBackend_Model_Right();

        foreach ($rowset as $row) {
            $rightModel->delete('item_id = ' . $row->id);
        }

        $this->delete('entity_id = ' . $entityId);
    }

    /**
     * @param int $sectionId
     */
    public function deleteSectionRights($sectionId) {
        $entityModel = new SibirixKeyrightsBackend_Model_Entity();
        $sectionList = $entityModel->getSectionHierarchy();

        $toDelete = array($sectionId => $sectionId);
        do {
            $added = array();
            foreach ($sectionList as $id => $section) {
                if (array_key_exists($id, $toDelete)) {
                    continue;
                }

                if ($section['parent'] && array_key_exists($section['parent'], $toDelete)) {
                    $added[$id] = $id;
                }
            }

            $toDelete += $added;
        } while(!empty($added));

        $toDelete = array_keys($toDelete);


        $rowset = $this->fetchAll(array('section_id IN ('. implode(',', $toDelete) . ')'));

        $rightModel = new SibirixKeyrightsBackend_Model_Right();

        foreach ($rowset as $row) {
            $rightModel->delete('item_id = ' . $row->id);
        }

        $this->delete('section_id IN (' . implode(',', $toDelete) . ')');
    }

    /**
     * @param $passData
     * @return int
     */
    public function checkRightsLevel($passData) {
        $result = $this->checkEntitiesRights($passData);
        return $result && count($result) ? $result[0]['level'] : self::ACCESS_NO;
    }

    /**
     * @param      $passData
     * @param bool $forId
     * @param bool $isGroup
     * @return array
     */
    public function checkEntitiesRights($passData, $forId = false, $isGroup = false) {
        $entityModel = new SibirixKeyrightsBackend_Model_Entity();
        $userModel = new SibirixKeyrightsBackend_Model_User();

        $itemList = $this->getRights();
        $sectionTree = $entityModel->getSectionHierarchy();
        $user = $userModel->getUserData($isGroup ? false : $forId);
        if($forId && $isGroup) {
            $user['ID'] = -1;
            $user['admin'] = false;
            $user['UF_DEPARTMENT'] = array($forId);
        }
        return $this->_doRecursiveCheckEntitiesRights($sectionTree, $itemList, $user, $passData);
    }

    /**
     * Рекурсивная проверка прав на массив паролей
     * @param sectionsTree
     * @param rights
     * @param user
     * @param passData
     * @return array
     */
    public function _doRecursiveCheckEntitiesRights($sectionsTree, $rights, $user, $passData) {
        // hasAccess === self::ACCESS_NO        - нет доступа
        // hasAccess === self::ACCESS_CAN_READ  - только чтение
        // hasAccess === self::ACCESS_CAN_WRITE - редактирование
        // hasAccess === self::ACCESS_CAN_OWN   - владелец
        $filteredData = array();
        if (!$user) return $filteredData;
        $rights = $this->_prepareRights($rights);

        foreach ($passData as $i => $pass) {
            $hasAccess = false;

            if ($user['admin']) {
                $hasAccess = self::ACCESS_CAN_OWN;
            }

            // Проверка прав конкретно на этот пароль
            if (($hasAccess === false) && $rights['item'][$pass['ID']]) {
                $hasAccess = $this->_checkOneRight($rights['item'][$pass['ID']], $user);
            }

            // Рекурсивно на папку
            if ($hasAccess === false) {
                $currentSectionId = $pass['SECTION'];
                while (false !== $currentSectionId) {
                    if ($rights['section'][$currentSectionId]) {
                        $hasAccess = $this->_checkOneRight($rights['section'][$currentSectionId], $user);
                        if ($hasAccess !== false) break;
                    }

                    $currentSectionId = $sectionsTree[$currentSectionId] ? $sectionsTree[$currentSectionId]['parent'] : false;
                }
            }

            $passData[$i]['level'] = $hasAccess;
            if ($hasAccess) {
                if ($hasAccess >= self::ACCESS_CAN_READ ) $passData[$i]['CAN_READ']  = true;
                if ($hasAccess >= self::ACCESS_CAN_WRITE) $passData[$i]['CAN_WRITE'] = true;
                if ($hasAccess >= self::ACCESS_CAN_OWN  ) $passData[$i]['CAN_OWN']   = true;
                $filteredData[] = $passData[$i];
            }
        }

        return $filteredData;
    }

    /**
     * @param $right
     * @param $user
     * @return bool|int
     */
    protected function _checkOneRight($right, $user) {
        if ($right->owner == $user['ID']) return self::ACCESS_CAN_OWN;
        $rights = $right->rights;
        if (empty($rights)) return false;

        // right to user
        foreach ($rights as $oneRight) {
            if (!$oneRight['user']) continue;
            if (!$this->_checkRightTime($oneRight['timed'])) continue;

            if ($oneRight['user'] == $user['ID']) {
                if ($oneRight['blocked']) return self::ACCESS_NO;
                return ($oneRight['edit'] ? self::ACCESS_CAN_WRITE : self::ACCESS_CAN_READ);
            }
        }

        // right to group
        $currentRight = $rightByGroup = false;
        foreach ($rights as $oneRight) {
            if (!$oneRight['group']) {
                continue;
            }

            if (!$this->_checkRightTime($oneRight['timed'])) {
                continue;
            }

            $group = $oneRight['group'];

            // Если разрешено хоть одной группе, в которой состоит пользователь - сзначит разрешено
            if (in_array($group, $user['UF_DEPARTMENT'])) {
                if ($oneRight['blocked']) {
                    $currentRight = self::ACCESS_NO;
                } else {
                    $currentRight = ($oneRight['edit'] ? self::ACCESS_CAN_WRITE : self::ACCESS_CAN_READ);
                }
            }

            if (($rightByGroup === false) || ($currentRight > $rightByGroup)) {
                $rightByGroup = $currentRight;
            }
        }

        return $rightByGroup;
    }

    /**
     * @param $rights
     * @return array
     */
    protected function _prepareRights($rights) {
        $prepared = array(
            'section' => array(),
            'item' => array(),
        );

        if (!$rights) {
            return $prepared;
        }

        $rights->rewind();
        while ($item = $rights->current()) {
            if ($item->entity_id) {
                $prepared['item'][$item->entity_id] = $item;
            } else {
                $prepared['section'][$item->section_id] = $item;
            }
            $rights->next();
        }

        return $prepared;
    }

    /**
     * @param $time
     * @return bool
     */
    protected function _checkRightTime($time) {
        if (!$time) {
            return true;
        }

        return strtotime($time) >= time();
    }

    public function changeOwnerToCurrentUser($usersId = array()) {
        if (!empty($usersId)) {
            $userModel = new SibirixKeyrightsBackend_Model_User();
            $items = $this->fetchAll(array('owner IN (?)' => $usersId));
            $currentUser = $userModel->getCurrentUser();

            foreach ($items as $item) {
                $item->owner = $currentUser['ID'];
                $item->save();
            }

            return true;
        }

        return false;
    }
}

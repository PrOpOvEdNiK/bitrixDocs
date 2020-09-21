<?php

/**
 * Class SibirixKeyrights_Model_History
 */
class SibirixKeyrightsBackend_Model_History {
    const WATCH = "watch";
    const CHANGE = "change";
    const COPY = "copy";

    private $iblockIdItem;
    private $iblockIdHistory;
    private $ibe;
    private $ibs;
    private $userModel;
    private $entityModel;

    public function __construct() {
        $this->iblockIdItem = $this->getIblockIdItem();
        $this->iblockIdHistory = $this->getIblockIdHistory();

        $this->ibe = new CIBlockElement();
        $this->ibs = new CIBlockSection();

        $this->userModel = new SibirixKeyrightsBackend_Model_User();
        $this->entityModel = new SibirixKeyrightsBackend_Model_Entity();
    }

    public function getIblockIdItem() {
        return COption::GetOptionString(CKeyrights::MODULE_ID, 'iblockId', -1);
    }

    public function getIblockIdHistory() {
        return COption::GetOptionString(CKeyrights::MODULE_ID, 'historyIblockId', -1);
    }

    public function addHistory($id, $action) {
        if (!empty($id) && !empty($action)) {
            $userModel = new SibirixKeyrightsBackend_Model_User();

            $data = array(
                'ITEM_ID' => array("VALUE" => $id),
                'ACTION' => array("VALUE" => $action),
            );

            $res = $this->ibe->GetList(array(), array('IBLOCK_ID' => $this->iblockIdItem, 'ID' => $id), false, false, array('NAME'));
            $name = $res->Fetch();
            $name = $name['NAME'];

            $fields = array(
                "IBLOCK_ID" => $this->iblockIdHistory,
                "CREATED_BY" => $userModel->getUserId(),
                "NAME" => $name,
                "PROPERTY_VALUES" => $data,
            );

            $res = $this->ibe->Add($fields);
            return $res;

        }
        return false;
    }

    public function export($data = array()) {
        if (!$this->userModel->isAdmin()) {
            return array(
                'result' => 'error',
                'message' => $this->t('ONLY_ADMIN_CAN'),
            );
        }

        $filter = array(
            'IBLOCK_ID' => $this->iblockIdHistory,
            '>=DATE_CREATE' => ConvertTimeStamp(strtotime($data['dateFrom']), "FULL"),
            '<=DATE_CREATE' => ConvertTimeStamp(strtotime($data['dateUntil']) + 3600 * 24 - 1, "FULL"),
        );
        $res = $this->ibe->GetList(array(), $filter, false, false, array('IBLOCK_ID', 'ID', 'DATE_CREATE', 'CREATED_BY', 'PROPERTY_ACTION', 'PROPERTY_ITEM_ID'));

        $users = array();
        $items = array();
        $result = array();
        while ($element = $res->Fetch()) {
            $result[] = array(
                'date' => $element['DATE_CREATE'],
                'user' => $element['CREATED_BY'],
                'name' => $element['PROPERTY_ITEM_ID_VALUE'],
                'action' => $element['PROPERTY_ACTION_VALUE'],
            );
            $users[$element['CREATED_BY']] = true;
            $items[$element['PROPERTY_ITEM_ID_VALUE']] = true;
        }

        if (empty($users)) {
            return $result;
        }

        $userList = SibirixKeyrightsBackend_Model_User::getUserListById(array_keys($users));
        $userNameList = array();
        foreach ($userList as $user) {
            $userNameList[$user['ID']] = '[' . $user['ID'] . '] ' . $user['NAME'] . ' ' . $user['LAST_NAME'];
        }

        $filter = array(
            'IBLOCK_ID' => $this->iblockIdItem,
            'ID' => array_keys($items)
        );

        $itemRes = $this->ibe->GetList(array(), $filter, false, false, array('IBLOCK_ID', 'ID', 'NAME', 'PROPERTY_CRYPTED'));
        $itemProps = array();
        while ($entity = $itemRes->Fetch()) {
            $itemProps[$entity['ID']] = '[' . $entity['ID'] . '] ' . $entity['NAME'];
        }

        foreach ($result as $key => $row) {
            if (isset($userNameList[$row['user']])) {
                $row['user'] = $userNameList[$row['user']];
            } else {
                $row['user'] = '';
            }

            if (isset($itemProps[$row['name']])) {
                $row['name'] = $itemProps[$row['name']];
            } else {
                $row['name'] = '';
            }
            $result[$key] = $row;
        }

        return $result;
    }

}

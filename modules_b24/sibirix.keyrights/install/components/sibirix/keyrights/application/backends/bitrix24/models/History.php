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
        $this->config = Zend_Registry::get('config');
        $this->config = $this->config->bx24config;
        $this->restModel = SibirixKeyrightsBackend_Model_Api::getInstance();

        $this->userModel = new SibirixKeyrightsBackend_Model_User();
        $this->entityModel = new SibirixKeyrightsBackend_Model_Entity();
    }

    public function addHistory($id, $action) {
        if (!empty($id) && !empty($action)) {
            $data = array(
                'ITEM_ID' => $id,
                'ACTION' => $action,
            );

            $res = $this->restModel->callMethod('entity.item.get', [
                'ENTITY' => $this->config->entity,
                'FILTER' => ['ID' => $id],
            ]);
            $name = reset($res['result']);
            $name = $name['NAME'];

            $fields = array(
                "ENTITY"            => $this->config->historyEntity,
                "NAME"              => $name,
                "PROPERTY_VALUES"   => $data,
            );

            $res = $this->restModel->callMethod('entity.item.add', $fields);
            return $res['result'];
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
            '>=DATE_CREATE' => date('c', strtotime($data['dateFrom'])),
            '<=DATE_CREATE' => date('c', strtotime($data['dateUntil']) + 3600 * 24 - 1),
        );
        $res = $this->restModel->callMethod('entity.item.get', ['ENTITY' => $this->config->historyEntity, 'FILTER' => $filter]);
        $res = $res['result'];

        if (empty($res)) {
            return [];
        }

        $users = array();
        $items = array();
        $result = array();
        foreach ($res as $element) {
            $result[] = array(
                'date' => date('Y-m-d H:i:s', strtotime($element['DATE_CREATE'])),
                'user' => $element['CREATED_BY'],
                'name' => $element['PROPERTY_VALUES']['ITEM_ID'],
                'action' => $element['PROPERTY_VALUES']['ACTION'],
            );
            $users[$element['CREATED_BY']] = true;
            $items[$element['PROPERTY_VALUES']['ITEM_ID']] = true;
        }

        if (empty($users)) {
            return $result;
        }

        $userList = $this->restModel->callMethod('user.get', ['FILTER' => ['ID' => $users]]);
        $userList = $userList['result'];
        $userNameList = array();
        foreach ($userList as $user) {
            $userNameList[$user['ID']] = '[' . $user['ID'] . '] ' . $user['NAME'] . ' ' . $user['LAST_NAME'];
        }

        $res = $this->restModel->callMethod('entity.item.get', [
            'ENTITY' => $this->config->entity,
            'FILTER' => ['ID' => array_keys($items)],
        ]);

        $entityList = $res['result'];

        $itemProps = array();
        foreach ($entityList as $entity) {
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

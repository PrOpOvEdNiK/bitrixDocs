<?php

/**
 * Class CryptController
 */
class CryptController extends SibirixKeyrightsBackend_Core_Controller {

    public function preDispatch() {
        parent::preDispatch();

        if (!$this->_checkCsrfToken()) {
            $this->_helper->json(array(
                'result' => 'error',
                'error' => 'Неправильный CSRF токен',
            ));
            return;
        }
    }

    /**
     *
     */
    public function sectionListAction() {
        $model = new SibirixKeyrightsBackend_Model_Entity();
        $this->_helper->json(array(
            'result' => 'ok',
            'data'   => $model->getSectionsTree(true)
        ));
    }

    /**
     *
     */
    public function sectionSaveAction() {
        $params = $this->getBodyJsonParams();

        $sectionId = $params['ID'];
        $parentId = $params['IBLOCK_SECTION_ID'];

        $itemModel = new SibirixKeyrightsBackend_Model_Item();

        $rightParams = $sectionId ? array('SECTION' => $sectionId) : array('SECTION' => $parentId ? $parentId : 0);
        $accessLevel = $itemModel->checkRightsLevel(array($rightParams));

        if ($accessLevel < $itemModel::ACCESS_CAN_WRITE) {
            $this->_helper->json(array(
                'result' => 'error',
                'error' => 'Не хватает прав для сохранения пароля',
            ));
            return;
        }

        $model = new SibirixKeyrightsBackend_Model_Entity();
        if ($sectionId) {
            $model->updateSection($params);
        } else {
            $sectionId = $model->addSection($params);
        }
        $section = $model->getSection(array('ID' => $sectionId));

        $this->_helper->json(array(
            'result' => 'ok',
            'data'   => array(
                'result' => $sectionId,
                'section' => $section[0],
            )
        ));
    }

    /**
     *
     */
    public function sectionMoveAction() {
        $params = $this->getBodyJsonParams();

        $sectionId   = (int)$params['id'];
        $newParentId = (int)$params['idNewParentFolder'];

        $rightParams = array(
            array('SECTION' => $sectionId),
            array('SECTION' => $newParentId),
        );
        $itemModel = new SibirixKeyrightsBackend_Model_Item();
        $accessLevel = $itemModel->checkRightsLevel($rightParams);

        if ($accessLevel < $itemModel::ACCESS_CAN_WRITE) {
            $this->_helper->json(array(
                'result' => 'error',
                'error' => 'Не хватает прав для сохранения раздела',
            ));
            return;
        }

        $model = new SibirixKeyrightsBackend_Model_Entity();
        $result = $model->updateSection(array(
            'ID'      => $sectionId,
            'SECTION' => $newParentId,
        ));

        $this->_helper->json(array(
            'result' => $result ? 'ok' : 'error',
        ));
    }

    public function sectionRemoveAction() {
        $params = $this->getBodyJsonParams();

        $itemModel = new SibirixKeyrightsBackend_Model_Item();

        $accessLevel = $itemModel->checkRightsLevel(array($params));
        if ($accessLevel < $itemModel::ACCESS_CAN_WRITE) {
            $this->_helper->json(array(
                'result' => 'error',
                'error' => 'Не хватает прав для удаления раздела',
            ));
            return;
        }

        $result = array('result' => 'error');
        $entityModel = new SibirixKeyrightsBackend_Model_Entity();
        $section = $entityModel->getSection(array('ID' => $params['sectionId']));
        $section = reset($section);
        if ($section['ID'] == $params['sectionId']) {
            $itemModel->deleteSectionRights($params['sectionId']);
            $entityModel->deleteSection(array('ID' => $params['sectionId']));
            $result = array('result' => 'ok');
        } else {
            $result['error'] = 'Такого раздела не существует';
        }

        $this->_helper->json($result);
    }

    /**
     *
     */
    public function passwordListAction() {
        $entityModel = new SibirixKeyrightsBackend_Model_Entity();
        $itemModel = new SibirixKeyrightsBackend_Model_Item();
        $list = $entityModel->getItem();
        $result = $itemModel->checkEntitiesRights($list);

        $this->_helper->json(array(
            'result' => 'ok',
            'data' => $result,
        ));
    }

    public function passwordListForIdAction() {
        $userModel = new SibirixKeyrightsBackend_Model_User();
        if (!$userModel->isAdmin()) {
            throw new Zend_Exception('Not authorized for this action', 403);
        }

        $params = $this->getAllParams();

        $entityModel = new SibirixKeyrightsBackend_Model_Entity();
        $itemModel = new SibirixKeyrightsBackend_Model_Item();
        $list = $entityModel->getItem();
        $result = $itemModel->checkEntitiesRights($list, $params['forId'], $params['isGroup']);

        $this->getHelper('render')->sendJson(array(
            'result' => 'ok',
            'data' => $result,
        ));
    }

    /**
     *
     */
    public function passwordSaveAction() {
        $params = $this->getBodyJsonParams();

        $itemModel = new SibirixKeyrightsBackend_Model_Item();

        $params['SECTION'] = intval($params['SECTION']);
        if (!$params['SECTION']) {
            $this->_helper->json(array(
                'result' => 'error',
                'error' => 'Не указан раздел для пароля',
            ));
            return;
        }

        $accessLevel = $itemModel->checkRightsLevel(array($params));
        if ($accessLevel < $itemModel::ACCESS_CAN_WRITE) {
            $this->_helper->json(array(
                'result' => 'error',
                'error' => 'Не хватает прав для сохранения пароля',
            ));
            return;
        }

        $fields = array(
            'NAME' => $params['NAME'],
            'SECTION' => $params['SECTION'],
            'PREVIEW_TEXT' => $params['COLOR'],
            'PROPERTY_VALUES' => array('CRYPTED' => SibirixKeyrights_Model_Crypt::crypt($params['CRYPTED'])),
        );

        $entityModel = new SibirixKeyrightsBackend_Model_Entity();
        if (!empty($params['ID'])) {
            $fields['ID'] = $params['ID'];
            $result = $entityModel->updateItem($fields);

            if ($result) {
                $historyModel = new SibirixKeyrightsBackend_Model_History();
                $historyModel->addHistory($params['ID'], SibirixKeyrightsBackend_Model_History::CHANGE);
            }
        } else {
            $result = $entityModel->addItem($fields);
        }

        if (false !== $result) {
            if (!empty($fields['ID'])) {
                $resultData = $entityModel->getItem(array('ID' => $fields['ID']));
            } else {
                $resultData = $entityModel->getItem(array('ID' => $result));
            }

            $item = reset($resultData);
            $resultData = array(
                'result' => $result,
                'DATE_CREATE' => $item['DATE_CREATE'],
                'TIMESTAMP_X' => $item['TIMESTAMP_X'],
            );

            $this->_helper->json(array(
                'result' => 'ok',
                'data' => $resultData
            ));
            return;
        }

        $this->_helper->json(array(
            'result' => 'error',
            'error' => 'error'// todo $entityModel->getLastError(),
        ));
    }

    /**
     *
     */
    public function passwordMoveAction() {
        $params = $this->getBodyJsonParams();

        $entityId    = (int)$params['entityId'];
        $oldParentId = (int)$params['idOldFolder'];
        $newParentId = (int)$params['idNewFolder'];
        if (($entityId <= 0) || ($oldParentId <= 0) || ($newParentId <= 0)) {
            $this->_helper->json(array('result' => 'error', 'error' => 'Не переданы обязательные параметры'));
            return;
        }

        $itemModel = new SibirixKeyrightsBackend_Model_Item();
        $model = new SibirixKeyrightsBackend_Model_Entity();
        $entity = reset($model->getItem(array('ID' => $entityId)));

        $accessLevel = array(
            $itemModel->checkRightsLevel(array($entity)),
            $itemModel->checkRightsLevel(array(array('SECTION' => $oldParentId))),
            $itemModel->checkRightsLevel(array(array('SECTION' => $newParentId)))
        );

        foreach ($accessLevel as $al) {
            if ($al < $itemModel::ACCESS_CAN_WRITE) {
                $this->_helper->json(array(
                    'result' => 'error',
                    'error'  => 'Не хватает прав для сохранения пароля',
                ));
                return;
            }
        }

        $result = $model->updateItem(array(
            'ID'      => $entityId,
            'SECTION' => $newParentId,
        ));

        $this->_helper->json(array(
            'result' => $result ? 'ok' : 'error',
        ));
    }

    public function passwordRemoveAction() {
        $params = $this->getBodyJsonParams();
        $itemModel = new SibirixKeyrightsBackend_Model_Item();

        $accessLevel = $itemModel->checkRightsLevel(array($params));
        if ($accessLevel < $itemModel::ACCESS_CAN_WRITE) {
            $this->_helper->json(array(
                'result' => 'error',
                'error' => 'Не хватает прав для удаления пароля',
            ));
            return;
        }

        $result = array('result' => 'error');
        $entityModel = new SibirixKeyrightsBackend_Model_Entity();
        if ($entityModel->deleteItem(array('ID' => $params['entityId']))) {
            $itemModel->deleteItemRights($params['entityId']);
            $result = array('result' => 'ok');
        } else {
            $result['error'] = 'Такого пароля не существует';
        }

        $this->_helper->json($result);
    }

    /**
     *
     */
    public function rightsListAction() {
        $params = $this->getBodyJsonParams();
        $params['section'] = isset($params['section']) && is_numeric($params['section']) ? intval($params['section']) : false;
        $params['item'] = isset($params['item']) ? intval($params['item']) : false;
        $where = array();

        if (array_key_exists('item', $params) && $params['item']) {
            $where['entity_id = ?'] = $params['item'];
        } else if (array_key_exists('section', $params) && false !== $params['section']) {
            $where['section_id = ?'] = $params['section'];
        }

        $model = new SibirixKeyrightsBackend_Model_Item();
        $item = $model->getRight($where);

        if (!$item) {
            $entityModel = new SibirixKeyrightsBackend_Model_Entity();

            if ($params['item']) {
                $entity = $entityModel->getItem(array('ID' => $params['item']));
                $entity = reset($entity);
                $userId = $entity['CREATED_BY'];
            } else {
                $section = $entityModel->getSection(array('ID' => $params['section']));
                $section = reset($section);
                $userId = $section['CREATED_BY'];
            }

            $itemRow = $model->create($params['section'], $params['item'], $userId);
            $item = $model->getRight(array('id = ?' => $itemRow->id));
        } else {
            //Если это итем то логируем просмотр
            $historyModel = new SibirixKeyrightsBackend_Model_History();
            $historyModel->addHistory($params['item'], SibirixKeyrightsBackend_Model_History::WATCH);
        }

        $result = $item->toArray();
        foreach ($result['rights'] as &$right) {
            if (!$right['timed']) {
                continue;
            }

            $timed = new DateTime($right['timed']);
            $right['timed'] = $timed->format('c');
        }
        unset($right);

        $this->_helper->json(array(
            'result' => 'ok',
            'data'   => $result,
        ));
    }

    /**
     *
     */
    public function rightsSaveAction() {
        $params = $this->getBodyJsonParams();
        $entityId = (int)$params['entityId'];
        if (!$entityId) $entityId = false;

        $sectionId = is_numeric($params['sectionId']) ? intval($params['sectionId']) : false;
        $rights = $params['rights'];

        if (false === $sectionId) {
            $this->_helper->json(array(
                'result' => 'error',
                'error'  => 'Не переданы обязательные параметры',
            ));
            return;
        }

        $itemModel = new SibirixKeyrightsBackend_Model_Item();
        $accessLevel = $itemModel->checkRightsLevel(array(array('SECTION' => $sectionId, 'ID' => $entityId)));

        if ($accessLevel < $itemModel::ACCESS_CAN_WRITE) {
            $this->_helper->json(array(
                'result' => 'error',
                'error' => 'Не хватает прав для сохранения прав',
            ));
            return;
        }

        $rightModel = new SibirixKeyrightsBackend_Model_Right();
        $rightModel->saveEntityRights($sectionId, $entityId, $rights);

        $this->_helper->json(array(
            'result' => 'ok',
        ));
    }

    /**
     *
     */
    public function rightsRemoveAction() {
        $params = $this->getBodyJsonParams();

        if (isset($params['data']) && is_array($params['data'])) {
            $rightModel = new SibirixKeyrightsBackend_Model_Right();

            $rightModel->deleteAll($params['data']);

            $this->_helper->json(array(
                'result' => 'ok',
            ));

        }

        $this->_helper->json(array(
            'result' => 'error',
        ));
    }

    /**
     *
     */
    public function setOwnerAction() {
        $params = $this->getBodyJsonParams();

        $entityId = (int)$params['entityId'];
        if (!$entityId) $entityId = false;

        $sectionId = (int)$params['sectionId'];
        $newOwner = $params['owner'];

        if ($sectionId <= 0) {
            $this->_helper->json(array('result' => 'error', 'error' => 'Не переданы обязательные параметры'));
            return;
        }

        $itemModel = new SibirixKeyrightsBackend_Model_Item();
        $accessLevel = $itemModel->checkRightsLevel(array(array('SECTION' => $sectionId, 'ID' => $entityId)));
        if ($accessLevel == $itemModel::ACCESS_CAN_OWN) {

            if ($entityId) {
                $params = array('entity_id = ?' => $entityId);
            } else {
                $params = array('section_id = ?' => $sectionId);
            }

            $item = $itemModel->fetchRow($params);
            $item->owner = $newOwner;
            $item->save();

            $this->_helper->json(array('result' => 'ok'));
        } else {
            $this->_helper->json(array('result' => 'error', 'error' => 'Не хватает прав для изменения владельца'));
        }

    }
}

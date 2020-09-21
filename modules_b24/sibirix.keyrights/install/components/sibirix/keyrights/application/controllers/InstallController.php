<?php

class InstallController extends SibirixKeyrightsBackend_Core_Controller {

    public function indexAction() {
        $this->_helper->layout->disableLayout();
        $authData = new Zend_Session_Namespace('authdata');
        $userData = new Zend_Session_Namespace('user');

        $hasAuthData = $authData->fullDomain && $authData->authId;
        $isAdmin = $userData->admin;

        if ($hasAuthData && $isAdmin) {
            $this->createEntities();
            $this->createEntityFields();

            $domainModel = new SibirixKeyrightsBackend_Model_Domain();
            $domainRow = $domainModel->fetchRow(['domain = ?' => $authData->domain]);
            if (!$domainRow) {
                $domainModel->insert([
                    'domain' => $authData->domain,
                    'key'    => Core_Helper::generatePass(50)
                ]);
            }

        } else {
            $this->redirect('/');
        }
    }

    private function createEntities() {
        $restModel = SibirixKeyrightsBackend_Model_Api::getInstance();
        $config = Zend_Registry::get('config');
        try {
            $restModel->callMethod('entity.add', [
                'ENTITY' => $config->bx24config->entity,
                'NAME'   => 'Sibirix.KeyRights',
                'ACCESS' => ['AU' => 'W']
            ]);
        } catch (Exception $e) {
        }
        try {
            $restModel->callMethod('entity.add', [
                'ENTITY' => $config->bx24config->historyEntity,
                'NAME'   => 'Sibirix.KeyRightsHistory',
                'ACCESS' => ['AU' => 'W']
            ]);
        } catch (Exception $e) {
        }
        try {
            $restModel->callMethod('entity.add', [
                'ENTITY' => $config->bx24config->userPassEntity,
                'NAME'   => 'Sibirix.KeyRights.User',
                'ACCESS' => ['U1' => 'W', 'AU' => 'R']
            ]);
        } catch (Exception $e) {
        }
    }

    private function createEntityFields() {
        $restModel = SibirixKeyrightsBackend_Model_Api::getInstance();
        $config = Zend_Registry::get('config');
        try {
            $restModel->callMethod('entity.item.property.add', [
                'ENTITY'   => $config->bx24config->entity,
                'PROPERTY' => 'CRYPTED',
                'NAME'     => 'Зашифрованные данные',
                'TYPE'     => 'S'
            ]);
        } catch (Exception $e) {
        }
        try {
            $restModel->callMethod('entity.item.property.add', [
                'ENTITY'   => $config->bx24config->historyEntity,
                'PROPERTY' => 'ITEM_ID',
                'NAME'     => 'Идентификатор элемента',
                'TYPE'     => 'S'
            ]);
        } catch (Exception $e) {
        }
        try {
            $restModel->callMethod('entity.item.property.add', [
                'ENTITY'   => $config->bx24config->historyEntity,
                'PROPERTY' => 'ACTION',
                'NAME'     => 'Действие',
                'TYPE'     => 'S'
            ]);
        } catch (Exception $e) {
        }
    }
}

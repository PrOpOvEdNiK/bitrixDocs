<?php

class SibirixKeyrightsBackend_Core_Controller extends Zend_Controller_Action {

    public function preDispatch() {
        try {
            $body = $this->getRequest()->getRawBody();
            $data = Zend_Json::decode($body);
            if ($data) {
                $this->getRequest()->setParams($data);
            }
        } catch (Exception $e) {}

        $this->saveAuthTokens();
        $this->saveUserData();
    }

    protected function _checkCsrfToken() {
        $token = $this->getParam('csrf_token');
        return Core_Helper::checkCsrfToken($token);
    }

    private function saveAuthTokens() {
        $session = new Zend_Session_Namespace('authdata');
        $authId = $this->getParam('AUTH_ID');
        $refreshId = $this->getParam('REFRESH_ID');
        $protocol = $this->getParam('PROTOCOL');
        $domain = $this->getParam('DOMAIN');

        $authIdChanged = false;
        if ($authId && ($session->authId != $authId)) {
            $session->authId = $authId;
            $session->refreshId = $refreshId;
            $authIdChanged = true;

            if ($protocol && $domain) {
                $session->protocol   = ($protocol == 0 ? 'http' : 'https');
                $session->domain     = $domain;
                $session->fullDomain = $session->protocol . '://' . $session->domain;
            }
        }

        if (!$session->domain) {
            $this->sendTokenError();
            return;
        }

        if ($authIdChanged || !$session->domainData) {
            // Загрузить данные домена
            $domainModel = new SibirixKeyrightsBackend_Model_Domain();
            $row         = $domainModel->fetchRow(['domain = ?' => $session->domain]);
            if ($row) {
                $session->domainData = $row->toArray();
            }
        }
    }

    private function saveUserData() {
        $session = new Zend_Session_Namespace('user');
        if (!$session->ID) {
            $restModel = SibirixKeyrightsBackend_Model_Api::getInstance();
            $userData = $restModel->callMethod('user.current');
            $adminData = $restModel->callMethod('user.admin');

            foreach ($userData['result'] as $key => $value) {
                $session->$key = $value;
            }
            $session->admin = $adminData['result'];

            if ($session->UF_DEPARTMENT && count($session->UF_DEPARTMENT)) {
                $departmentList = $restModel->callMethod('department.get');
                $session->UF_DEPARTMENT = $this->_getAllDepartments($session->UF_DEPARTMENT, $departmentList['result']);
            }
        }
    }

    private function _getAllDepartments($userDeps, $depList) {
        $depListById = [];
        $allUserDeps = [];
        for ($i = 0; $i < count($depList); $i++) {
            $depListById[$depList[$i]['ID']] = $depList[$i];
        }

        foreach ($depListById as $id => $dep) {
            $depListById[$id]['PARENT_LIST'] = $this->_recursiveGetParents($depListById[$id]['PARENT'], $depListById);
        }

        for ($i = 0; $i < count($userDeps); $i++) {
            $allUserDeps[] = $userDeps[$i];
            $allUserDeps = array_merge($allUserDeps, $depListById[$userDeps[$i]]['PARENT_LIST']);
        }

        return $allUserDeps;
    }

    private function _recursiveGetParents($parentId, $depList) {
        $parentList = [$parentId];
        if ($depList[$parentId] && $depList[$parentId]['PARENT']) {
            $parentList = array_merge($parentList, $this->_recursiveGetParents($depList[$parentId]['PARENT'], $depList));
        }

        return array_map(function($obj) { return (int)$obj; }, $parentList);
    }

    public function sendTokenError() {
        $this->_helper->json(['result' => 'error', 'error' => 'Ваша сессия истекла. Обновите страницу.']);
    }

    public function getBodyJsonParams() {
        $body = $this->getRequest()->getRawBody();
        return Zend_Json::decode($body);
    }
}

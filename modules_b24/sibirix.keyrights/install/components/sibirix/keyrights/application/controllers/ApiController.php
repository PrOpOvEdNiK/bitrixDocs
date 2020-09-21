<?php

class ApiController extends SibirixKeyrightsBackend_Core_Controller {

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

    public function callMethodAction() {
        $data = $this->getBodyJsonParams();
        $method = $data['method'];
        $params = $data['params'];

        $restModel = SibirixKeyrightsBackend_Model_Api::getInstance();

        $result = $restModel->callMethod($method, $params);

        $this->_helper->json(array(
            'result' => (!$result || !$result['result']) ? 'error' : 'ok',
            'data'   => ($result && $result['result']) ? $result['result'] : false
        ));

    }

    public function userAction() {
        $result = SibirixKeyrightsBackend_Model_User::getUserData();
        $this->_helper->json(array(
            'result' => !$result ? 'error' : 'ok',
            'data'   => $result
        ));
    }

    public function faviconAction() {
        $request = $this->getRequest();
        $referer = str_replace(array('https://', 'http://'), '', $request->getHeader('referer'));
        $siteDomain = $_SERVER['SERVER_NAME'];

        if (mb_strpos($referer, $siteDomain) === false) {
            $this->_helper->json(array('result' => 'error', 'error' => '404 Not found'));
        }
        $url = $this->getParam('url');
        $this->getHelper('favicon')->sendFavicon($url);
    }



    public function requestAccessAction() {
        $sectionId = $this->getParam('sectionId');

        $entityModel = new SibirixKeyrightsBackend_Model_Entity();
        $section = reset($entityModel->getSection(array('ID' => $sectionId)));

        if (!$section) {
            $this->getHelper('render')->sendJson(array('error' => $this->t('SECTION_NOT_FOUND')));
            return;
        }

        if (!CModule::IncludeModule('im')) {
            $this->getHelper('render')->sendJson(array('error' => $this->t('IM_NOT_INSTALLED')));
            return;
        }

        $itemModel = new SibirixKeyrightsBackend_Model_Item();
        $itemRow = $itemModel->getRight(array('section_id = ?' => $section['ID']));

        $userModel = new SibirixKeyrightsBackend_Model_User();
        $user = $userModel->getCurrentUser();

        $result = CIMMessage::Add(array(
            'TITLE' => $this->t('IM_ACCESS_REQUEST'),
            'TO_USER_ID' => $itemRow->owner,
            'FROM_USER_ID' => $user['ID'],
            'MESSAGE_TYPE' => IM_MESSAGE_SYSTEM,
            'NOTIFY_TYPE' => IM_NOTIFY_SYSTEM,
            'NOTIFY_MODULE' => 'sibirix.keyrights',
            'MESSAGE' => $this->t('IM_ACCESS_REQUEST_MESSAGE') .
                '[url=/keyrights/#?section=' . $section['ID'] . ']' . $section['NAME'] . '[/url].',
        ));

        $this->getHelper('render')->sendJson(array('result' => 'ok', 'data' => $result));
    }

    public function sendReportAction() {
        global $APPLICATION;
        $APPLICATION->RestartBuffer();
        $id = intval($this->getParam('id'));

        if (empty($id)) {
            die;
        }

        $cLog = new CEventLog();
        $logRes = $cLog->GetList(array(), array('MODULE_ID' => 'sibirix.keyrights', 'ID' => $id));
        $entry = $logRes->Fetch();

        $body = "KeyRights error.\nURI: " . $entry['REQUEST_URI'] . "\n" .
            "Time: " . $entry['TIMESTAMP_X'] . "\n\n" .
            "Exception: \n" . var_export(unserialize($entry['DESCRIPTION']), true);
        $result = mail('scrumban@sibirix.ru', 'KeyRights', $body);
        $this->getHelper('render')->sendJson(array('result' => $result ? 'ok' : 'error'));
    }
}

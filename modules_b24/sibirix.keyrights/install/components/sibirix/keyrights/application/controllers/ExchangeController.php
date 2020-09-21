<?php

/**
 * Class ExchangeController
 */
class ExchangeController extends SibirixKeyrightsBackend_Core_Controller {

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
     * @throws Zend_Exception
     */
    public function importAction() {
        $data = $this->getBodyJsonParams();

        if (!empty($data['data']) && is_array($data['data'])) {
            $importer = new SibirixKeyrights_Model_Entity_Import();
            $result   = $importer->import($data['data']);
            $this->_helper->json($result);

        } elseif (!empty($data['step'])) {
            $importer = new SibirixKeyrights_Model_Entity_Import();
            $result   = $importer->continueImport();
            $this->_helper->json($result);

        } else {
            $this->_helper->json(array('result' => 'error'));
        }
    }

    public function historyAction() {
        $data = $this->getAllParams();
        if (!empty($data['dateFrom']) && !empty($data['dateUntil'])) {
            $data = array(
                'dateFrom' => $data['dateFrom'],
                'dateUntil' => $data['dateUntil'],
            );

            $historian = new SibirixKeyrightsBackend_Model_History();
            $result = $historian->export($data);

            $this->_helper->json(array('data' => $result, 'result' => 'ok'));
        } else {
            $this->_helper->json(array('result' => 'error'));
        }
    }

    public function copyAction() {
        $params = $this->getAllParams();

        if (!empty($params['item_id'])) {
            $historyModel = new SibirixKeyrightsBackend_Model_History();
            $result = $historyModel->addHistory($params['item_id'], SibirixKeyrightsBackend_Model_History::COPY);
            if ($result) {
                $this->_helper->json(array('result' => 'ok'));
                return;
            }
        }

        $this->_helper->json(array('result' => 'error'));
    }
}

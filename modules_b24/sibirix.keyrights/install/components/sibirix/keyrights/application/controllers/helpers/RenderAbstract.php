<?php
abstract class Sibirix_Controller_Action_Helper_RenderAbstract extends Zend_Controller_Action_Helper_Abstract {

    function __construct() {}

    /**
     * Direct
     * @return Sibirix_Controller_Action_Helper_RenderAbstract
     */
    function direct() {
        return $this;
    }

    /**
     * Disable default rendering
     * @param bool $disable
     * @return Sibirix_Controller_Action_Helper_RenderAbstract
     */
    function setNoRender($disable = true) {
		$this->getActionController()->getHelper('viewRenderer')->setNoRender(true);
		$this->getActionController()->getHelper('layout')->disableLayout();

        return $this;
    }

    /**
     * Set header to plain text
     * @param bool $disable
     * @return Sibirix_Controller_Action_Helper_RenderAbstract
     */
    function setPlainText($disable = true) {
        $this->getActionController()->getResponse()->setHeader('content-type', 'text/plain', true);

        return $this;
    }

    /**
     * Set JSON content type
     * @return Sibirix_Controller_Action_Helper_RenderAbstract
     */
    function setJSON() {

        $this->getActionController()->getResponse()->setHeader('content-type', 'application/json; charset=UTF-8', true);

        return $this;
    }

    /**
     * Send API error
     */
    function sendErrorJSON() {
        $this->sendJSON(array("result" => "error"));

        return $this;
    }

    /**
     * Send API ok
     */
    function sendOkJSON() {
        $this->sendJSON(array("result" => "ok"));

        return $this;
    }

    /**
     * Send JSON data to client
     * @param $data
     * @return $this
     */
    function sendJson($data) {
        $this->setNoRender();
        $this->setJSON();

        $this->getActionController()->view->assign("data", $data);
        $result = $this->getActionController()->view->render("json.phtml");

        $this->getActionController()->getResponse()->setBody($result)->sendResponse();
        exit;
    }
}

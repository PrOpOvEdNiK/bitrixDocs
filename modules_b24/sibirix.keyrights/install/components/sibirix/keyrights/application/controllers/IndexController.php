<?php

class IndexController extends SibirixKeyrightsBackend_Core_Controller {

    public function indexAction() {
        // only renders view
    }

    public function firstTimeAction() {
        $this->_helper->layout->disableLayout();
    }
}

<?php
class Backend_Controller_Action_Helper_Render extends Sibirix_Controller_Action_Helper_RenderAbstract {

    /**
     * Disable default rendering
     * @param bool $disable
     * @return Sibirix_Controller_Action_Helper_RenderAbstract
     */
    function setNoRender($disable = true) {
        global $APPLICATION;
        $APPLICATION->RestartBuffer();
        return parent::setNoRender($disable);
    }
}

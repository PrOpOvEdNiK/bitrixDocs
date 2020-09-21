<?php


class SibirixKeyrightsBackend_View_Helper_Asset extends Zend_View_Helper_Abstract {

    public function asset() {
        return $this;
    }

    public function addHeadString($content) {
        global $APPLICATION;
        $APPLICATION->AddHeadString($content);
    }

    public function addJs($path) {
        if (CheckVersion(SM_VERSION, "15.0.0")) {
            Bitrix\Main\Page\Asset::getInstance()->addJs($path);
        } else {
            global $APPLICATION;
            $APPLICATION->AddHeadScript($path);
        }
    }

    public function addCss($path) {
        if (CheckVersion(SM_VERSION, "15.0.0")) {
            Bitrix\Main\Page\Asset::getInstance()->addCss($path);
        } else {
            global $APPLICATION;
            $APPLICATION->SetAdditionalCSS($path);
        }
    }
}

<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * @var $APPLICATION
 */
$module = new CModule();
if (!$module->IncludeModule('sibirix.keyrights') || !class_exists('CKeyrights')) {
    include_once($_SERVER["DOCUMENT_ROOT"] . BX_PERSONAL_ROOT . "/templates/" . SITE_TEMPLATE_ID . "/header.php");
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/sibirix.keyrights/include.php')) {
        $this->IncludeComponentTemplate('trial');
    } else {
        $this->IncludeComponentTemplate('installed');
    }
    require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
    return;
}

$dir = $APPLICATION->GetCurDir();
if (strpos($dir, "/keyrights/") === false) {
    echo("<h1>" . GetMessage("KEYRIGHTS_COMPONENT_WRONG_PATH") . "</h1>");
    return false;
}

$arParams['BASE_PATH'] = $_SERVER['DOCUMENT_ROOT'];
$arParams['APPLICATION_PATH'] = realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'application');

$arApplicationEnv = array(
    "production"  => "production",
    "development" => "development"
);

if (!isset($arApplicationEnv[ $arParams['APPLICATION_ENV'] ])) {
    $arParams['APPLICATION_ENV'] = 'production';
}

$APPLICATION->keyrights = CKeyrights::getInstance($arParams);
$APPLICATION->keyrights->run();

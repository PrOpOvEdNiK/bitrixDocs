<?
$sessionName = session_name();
if (!empty($_POST['cookie'])) {
    $_COOKIE[$sessionName] = $_POST['cookie'];
}
if (!empty($_POST['id']) && (strpos($_POST['id'], "cookie") !== false)) {
    $cookie = explode("cookie=", $_POST['id']);
    $_COOKIE['PHPSESSID'] = $cookie[1];
}
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
global $APPLICATION;
$APPLICATION->SetShowIncludeAreas(false);

?><?$APPLICATION->IncludeComponent("sibirix:scrumban", "", array(
        "APPLICATION_ENV" => "production",
        "DURATION_WORKING_DAY" => "8",
        "DEFAULT_RESPONSIBLE" => "USER",
        "SEF_MODE" => "Y",
        "SEF_FOLDER" => "/scrumban/"
    ),
    false,
    array('HIDE_ICONS' => 'Y')
);?>

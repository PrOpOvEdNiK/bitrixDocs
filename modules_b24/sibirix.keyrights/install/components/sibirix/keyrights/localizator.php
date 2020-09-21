<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

global $MESS;
IncludeModuleLangFile(dirname(__FILE__) . DIRECTORY_SEPARATOR . "component.php");
include(GetLangFileName($GLOBALS["DOCUMENT_ROOT"]."/bitrix/modules/sibirix.keyrights/lang/", "/general.php"));

$constants = explode(",", $_REQUEST['msg']);
if (!is_array($constants) || (count($constants) == 0)) {
    die();
}

$list = array();
foreach ($constants as $msg) {
    $list[] = $msg . "|" . GetMessage($msg);
}

echo(implode("\n", $list));

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>

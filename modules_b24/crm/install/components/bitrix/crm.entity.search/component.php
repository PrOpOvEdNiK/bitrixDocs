<?if(!Defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arParams['MULTIPLE'] = $arParams['MULTIPLE'] == 'Y' ? 'Y' : 'N'; // allow multiple user selection

$arParams['SHOW_BUTTON'] = $arParams['SHOW_BUTTON'] == 'N' ? 'N' : 'Y'; // show button for control run. Show() method should be used otherwise.
$arParams['SHOW_INPUT'] = $arParams['SHOW_INPUT'] == 'Y' ? 'Y' : 'N'; // whether to show input field.

$arParams['FORM_NAME'] = preg_match('/^[a-zA-Z0-9_]+$/', $arParams['FORM_NAME']) ? $arParams['FORM_NAME'] : false;
$arParams['INPUT_NAME'] = preg_match('/^[a-zA-Z0-9_]+$/', $arParams['INPUT_NAME']) ? $arParams['INPUT_NAME'] : false;
$arParams['SITE_ID'] = preg_match('/^[a-zA-Z0-9_]+$/', $arParams['SITE_ID']) ? $arParams['SITE_ID'] : false;
if(strlen($arParams['SITE_ID']) <= 0 || strlen($arParams['SITE_ID']) > 2)
	$arParams['SITE_ID'] = SITE_ID;

if (!$arParams['INPUT_NAME'] && !$arParams['ONSELECT'])
	return false;

$arParams['GET_FULL_INFO'] = $arParams['GET_FULL_INFO'] == 'Y' ? 'Y' : 'N'; 

$arParams['NAME'] = ($arParams['NAME'] && preg_match('/^[a-zA-Z0-9_]+$/', $arParams['NAME'])) ? $arParams['NAME'] : 'emp_selector_'.rand(0, 10000);

if ($arParams['MULTIPLE'] == 'N')
	$arParams['INPUT_VALUE'] = intval($arParams['INPUT_VALUE']);
elseif (is_array($arParams['INPUT_VALUE']))
	$arParams['INPUT_VALUE'] = implode(', ', $arParams['INPUT_VALUE']);

CUtil::InitJSCore();
	
$APPLICATION->AddHeadScript('/bitrix/js/main/admin_tools.js');
$APPLICATION->AddHeadScript('/bitrix/js/main/utils.js');
$this->IncludeComponentTemplate();

return CUtil::JSEscape($arParams['NAME']);
?>
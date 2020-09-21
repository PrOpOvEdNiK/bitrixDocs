<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();

if (!CModule::IncludeModule('crm'))
{
	ShowError(GetMessage('CRM_MODULE_NOT_INSTALLED'));
	return;
}

$CrmPerms = new CCrmPerms($USER->GetID()); 
if ($CrmPerms->HavePerm('CONTACT', BX_CRM_PERM_NONE))
{
	ShowError(GetMessage('CRM_PERMISSION_DENIED'));
	return;
}


if (!empty($_REQUEST['type']))
    $sType = strtolower(trim($_REQUEST['type']));
else 
    $sType = 'excel';

$APPLICATION->RestartBuffer();


$arResult['TYPE_LIST'] = CCrmStatus::GetStatusListEx('CONTACT_TYPE');
$arResult['SOURCE_LIST'] = CCrmStatus::GetStatusListEx('SOURCE');

global $USER_FIELD_MANAGER;

$CCrmFieldMulti = new CCrmFieldMulti();

$CCrmUserType = new CCrmUserType($USER_FIELD_MANAGER, CCrmLead::$sUFEntityID);
$arResult['HEADERS'] = array(
	array('id' => 'NAME', 'name' => GetMessage('CRM_COLUMN_NAME')), 
	array('id' => 'LAST_NAME', 'name' => GetMessage('CRM_COLUMN_LAST_NAME')), 
	array('id' => 'SECOND_NAME', 'name' => GetMessage('CRM_COLUMN_SECOND_NAME'))
);

$CCrmFieldMulti->ListAddHeaders($arResult['HEADERS']);
 	 
$arResult['HEADERS'] = array_merge($arResult['HEADERS'], array(
	//array('id' => 'BIRTHDATE', 'name' => GetMessage('CRM_COLUMN_BIRTHDATE')),
	array('id' => 'POST', 'name' => GetMessage('CRM_COLUMN_POST')), 
	array('id' => 'ADDRESS', 'name' => GetMessage('CRM_COLUMN_ADDRESS')), 
	array('id' => 'COMMENTS', 'name' => GetMessage('CRM_COLUMN_COMMENTS')), 
	array('id' => 'TYPE_ID', 'name' => GetMessage('CRM_COLUMN_TYPE')), 
	array('id' => 'SOURCE_ID', 'name' => GetMessage('CRM_COLUMN_SOURCE')),
	array('id' => 'SOURCE_DESCRIPTION', 'name' => GetMessage('CRM_COLUMN_SOURCE_DESCRIPTION')),  
	array('id' => 'ASSIGNED_BY', 'name' => GetMessage('CRM_COLUMN_ASSIGNED_BY')), 
	array('id' => 'DATE_CREATE', 'name' => GetMessage('CRM_COLUMN_DATE_CREATE')), 
	array('id' => 'DATE_MODIFY', 'name' => GetMessage('CRM_COLUMN_DATE_MODIFY')) 
)); 	

$CCrmUserType->ListAddHeaders($arResult['HEADERS']);

$obRes = CCrmContact::GetList(array(), array('EXPORT' => 'Y'), array());
	
$arResult['CONTACT'] = array();
$arResult['CONTACT_ID'] = array();
$arResult['CONTACT_UF'] = array();
while($arContact = $obRes->GetNext())  
{    
	$arContact['ASSIGNED_BY'] = CUser::FormatName('#LAST_NAME# #NAME#', 
		array(
			'LOGIN' => $arContact['ASSIGNED_BY_LOGIN'],
			'NAME' => $arContact['ASSIGNED_BY_NAME'],
			'LAST_NAME' => $arContact['ASSIGNED_BY_LAST_NAME'],
			'SECOND_NAME' => $arContact['ASSIGNED_BY_SECOND_NAME']
		), 
		true, false
	); 
	
	$arResult['CONTACT_UF'][$arContact['ID']] = array();
	$CCrmUserType->ListAddEnumFieldsValue($arContact, $arResult['CONTACT_UF'][$arContact['ID']], $arContact['ID'], '|', false);
	$arResult['CONTACT'][$arContact['ID']] = $arContact;
	$arResult['CONTACT_ID'][$arContact['ID']] = $arContact['ID'];
}   

if (isset($arResult['CONTACT_ID']) && !empty($arResult['CONTACT_ID']))
{
	$arFmList = array(); 
	$res = CCrmFieldMulti::GetList(array('ID' => 'asc'), array('ENTITY_ID' => 'CONTACT', 'ELEMENT_ID' => $arResult['CONTACT_ID']));
	while($ar = $res->Fetch())
		$arFmList[$ar['ELEMENT_ID']][$ar['COMPLEX_ID']][] = $ar['VALUE'];

	foreach ($arFmList as $elementId => $arFM)
		foreach ($arFM as $complexId => $arComplexName)
			$arResult['CONTACT'][$elementId][$complexId] = implode('|', $arComplexName);
}

switch($sType)
{
	case 'carddav': 
		break;
	case 'csv':	    
		// hack. any '.default' customized template should contain 'excel' page
		$this->__templateName = '.default';

		Header("Content-Type: application/force-download");
		Header("Content-Type: application/octet-stream");
		Header("Content-Type: application/download");
		Header("Content-Disposition: attachment;filename=contacts.csv");
		Header("Content-Transfer-Encoding: binary");         
	break;
	default :                                     
	case 'excel':	
		$sType = 'excel';
		// hack. any '.default' customized template should contain 'excel' page
		$this->__templateName = '.default';

		Header("Content-Type: application/force-download");
		Header("Content-Type: application/octet-stream");
		Header("Content-Type: application/download");
		//Header("Content-Type: application/vnd.ms-excel; charset=".LANG_CHARSET);
		Header("Content-Disposition: attachment;filename=contacts.xls");
		Header("Content-Transfer-Encoding: binary");         
	break;                             
}

$this->IncludeComponentTemplate($sType);
die();

?>
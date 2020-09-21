<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (CModule::IncludeModule('crm'))
{
	$CrmPerms = new CCrmPerms($GLOBALS["USER"]->GetID()); 
	$arMenuCrm = Array();
	if (!$CrmPerms->HavePerm('CONTACT', BX_CRM_PERM_NONE))
	{
		$arMenuCrm[] = Array(
			"Контакты", 
			"/crm/contact/", 
			Array(), 
			Array(), 
			"" 
		);
	}
	if (!$CrmPerms->HavePerm('COMPANY', BX_CRM_PERM_NONE))
	{
		$arMenuCrm[] = Array(
			"Компании", 
			"/crm/company/", 
			Array(), 
			Array(), 
			"" 
		);
	}
	if (!$CrmPerms->HavePerm('DEAL', BX_CRM_PERM_NONE))
	{
		$arMenuCrm[] = Array(
			"Сделки", 
			"/crm/deal/", 
			Array(), 
			Array(), 
			"" 
		);
	}
	if (!$CrmPerms->HavePerm('LEAD', BX_CRM_PERM_NONE))
	{
		$arMenuCrm[] = Array(
			"Лиды", 
			"/crm/lead/", 
			Array(), 
			Array(), 
			"" 
		);
	}

	$arMenuCrm[] = Array(
		"Каталог",
		"/crm/product/",
		Array(),
		Array(),
		""
	);

	if (!$CrmPerms->HavePerm('LEAD', BX_CRM_PERM_NONE) || !$CrmPerms->HavePerm('CONTACT', BX_CRM_PERM_NONE) ||
		!$CrmPerms->HavePerm('COMPANY', BX_CRM_PERM_NONE) || !$CrmPerms->HavePerm('DEAL', BX_CRM_PERM_NONE))
	{
		$arMenuCrm[] = Array(
			"События", 
			"/crm/events/", 
			Array(), 
			Array(), 
			"" 
		);
	}
	if (!$CrmPerms->HavePerm('LEAD', BX_CRM_PERM_NONE) || !$CrmPerms->HavePerm('CONTACT', BX_CRM_PERM_NONE) ||
		!$CrmPerms->HavePerm('COMPANY', BX_CRM_PERM_NONE) || !$CrmPerms->HavePerm('DEAL', BX_CRM_PERM_NONE))
	{
		$arMenuCrm[] = Array(
			"Отчеты", 
			"/crm/reports/", 
			Array(), 
			Array(), 
			"" 
		);
	
		$arMenuCrm[] = Array(
			"Справка", 
			"/crm/info/", 
			Array(), 
			Array(), 
			"" 
		);
	}
	if (!$CrmPerms->HavePerm('CONFIG', BX_CRM_PERM_NONE))
	{
		$arMenuCrm[] = Array(
			"Настройки", 
			"/crm/configs/", 
			Array(), 
			Array(), 
			"" 
		);
	}
	$aMenuLinks = array_merge($arMenuCrm, $aMenuLinks);
}

?>
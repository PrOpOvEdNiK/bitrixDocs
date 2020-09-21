<?

if (CModule::IncludeModule('crm'))
{
	$CrmPerms = new CCrmPerms($GLOBALS["USER"]->GetID()); 
	$arMenuCrm = Array();
	if (!$CrmPerms->HavePerm('CONTACT', BX_CRM_PERM_NONE))
	{
		$arMenuCrm[] = Array(
			"Kontakte", 
			"/crm/contact/", 
			Array(), 
			Array(), 
			"" 
		);
	}
	if (!$CrmPerms->HavePerm('COMPANY', BX_CRM_PERM_NONE))
	{
		$arMenuCrm[] = Array(
			"Unternehmen", 
			"/crm/company/", 
			Array(), 
			Array(), 
			"" 
		);
	}
	if (!$CrmPerms->HavePerm('DEAL', BX_CRM_PERM_NONE))
	{
		$arMenuCrm[] = Array(
			"Aufträge", 
			"/crm/deal/", 
			Array(), 
			Array(), 
			"" 
		);
	}
	if (!$CrmPerms->HavePerm('LEAD', BX_CRM_PERM_NONE))
	{
		$arMenuCrm[] = Array(
			"Leads", 
			"/crm/lead/", 
			Array(), 
			Array(), 
			"" 
		);
	}	
	if (!$CrmPerms->HavePerm('LEAD', BX_CRM_PERM_NONE) || !$CrmPerms->HavePerm('CONTACT', BX_CRM_PERM_NONE) ||
		!$CrmPerms->HavePerm('COMPANY', BX_CRM_PERM_NONE) || !$CrmPerms->HavePerm('DEAL', BX_CRM_PERM_NONE))
	{
		$arMenuCrm[] = Array(
			"Aktivitäten", 
			"/crm/events/", 
			Array(), 
			Array(), 
			"" 
		);
	}
	$arMenuCrm[] = Array(
		"Katalog",
		"/crm/product/",
		Array(),
		Array(),
		""
	);
	if (!$CrmPerms->HavePerm('LEAD', BX_CRM_PERM_NONE) || !$CrmPerms->HavePerm('CONTACT', BX_CRM_PERM_NONE) ||
		!$CrmPerms->HavePerm('COMPANY', BX_CRM_PERM_NONE) || !$CrmPerms->HavePerm('DEAL', BX_CRM_PERM_NONE))
	{
		$arMenuCrm[] = Array(
			"Berichte", 
			"/crm/reports/", 
			Array(), 
			Array(), 
			"" 
		);
	
		$arMenuCrm[] = Array(
			"Hilfe", 
			"/crm/info/", 
			Array(), 
			Array(), 
			"" 
		);
	}
	if (!$CrmPerms->HavePerm('CONFIG', BX_CRM_PERM_NONE))
	{
		$arMenuCrm[] = Array(
			"Einstellungen", 
			"/crm/configs/", 
			Array(), 
			Array(), 
			"" 
		);
	}
	$aMenuLinks = array_merge($arMenuCrm, $aMenuLinks);
}

?>
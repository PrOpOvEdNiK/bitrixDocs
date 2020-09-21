<?

if (CModule::IncludeModule('crm'))
{
	$CrmPerms = new CCrmPerms($GLOBALS["USER"]->GetID()); 
	$arMenuCrm = Array();
	if (!$CrmPerms->HavePerm('CONTACT', BX_CRM_PERM_NONE))
	{
		$arMenuCrm[] = Array(
			"Contacts", 
			"/crm/contact/", 
			Array(), 
			Array(), 
			"" 
		);
	}
	if (!$CrmPerms->HavePerm('COMPANY', BX_CRM_PERM_NONE))
	{
		$arMenuCrm[] = Array(
			"Companies", 
			"/crm/company/", 
			Array(), 
			Array(), 
			"" 
		);
	}
	if (!$CrmPerms->HavePerm('DEAL', BX_CRM_PERM_NONE))
	{
		$arMenuCrm[] = Array(
			"Deals", 
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
			"Events", 
			"/crm/events/", 
			Array(), 
			Array(), 
			"" 
		);
	}
	$arMenuCrm[] = Array(
		"Catalog",
		"/crm/product/",
		Array(),
		Array(),
		""
	);
	if (!$CrmPerms->HavePerm('LEAD', BX_CRM_PERM_NONE) || !$CrmPerms->HavePerm('CONTACT', BX_CRM_PERM_NONE) ||
		!$CrmPerms->HavePerm('COMPANY', BX_CRM_PERM_NONE) || !$CrmPerms->HavePerm('DEAL', BX_CRM_PERM_NONE))
	{
		$arMenuCrm[] = Array(
			"Reports", 
			"/crm/reports/", 
			Array(), 
			Array(), 
			"" 
		);
	
		$arMenuCrm[] = Array(
			"Help", 
			"/crm/info/", 
			Array(), 
			Array(), 
			"" 
		);
	}
	if (!$CrmPerms->HavePerm('CONFIG', BX_CRM_PERM_NONE))
	{
		$arMenuCrm[] = Array(
			"Settings", 
			"/crm/configs/", 
			Array(), 
			Array(), 
			"" 
		);
	}
	$aMenuLinks = array_merge($arMenuCrm, $aMenuLinks);
}

?>
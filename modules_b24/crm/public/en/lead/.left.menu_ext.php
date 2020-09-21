<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (CModule::IncludeModule('crm'))
{
	$CrmPerms = new CCrmPerms($GLOBALS["USER"]->GetID());
	$aMenuLinksExt = array();
	if (!$CrmPerms->HavePerm('LEAD', BX_CRM_PERM_NONE, 'ADD'))
	{
		$aMenuLinksExt[] =
			Array(
				"Add Lead",
				"/crm/lead/edit/0/",
				Array(),
				Array(),
				""
			);
	}
	if (!$CrmPerms->HavePerm('LEAD', BX_CRM_PERM_NONE, 'READ'))
	{
		$aMenuLinksExt[] =
			Array(
				"Leads",
				"/crm/lead/list/",
				Array(),
				Array(),
				""
			);
	}
	if (!$CrmPerms->HavePerm('LEAD', BX_CRM_PERM_NONE, 'ADD'))
	{
		$aMenuLinksExt[] =
			Array(
				"Import Leads",
				"/crm/lead/import/",
				Array(),
				Array(),
				""
			);
	}

	$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
}

?>
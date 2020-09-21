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
				"Lead hinzufügen",
				"#SITE_DIR#crm/lead/edit/0/",
				Array(),
				Array(),
				""
			);
	}
	if (!$CrmPerms->HavePerm('LEAD', BX_CRM_PERM_NONE, 'READ'))
	{
		$aMenuLinksExt[] =
			Array(
				"Liste der Leads",
				"#SITE_DIR#crm/lead/list/",
				Array(),
				Array(),
				""
			);
	}
	if (!$CrmPerms->HavePerm('LEAD', BX_CRM_PERM_NONE, 'ADD'))
	{
		$aMenuLinksExt[] =
			Array(
				"Leads importieren",
				"#SITE_DIR#crm/lead/import/",
				Array(),
				Array(),
				""
			);
	}
	$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
}

?>
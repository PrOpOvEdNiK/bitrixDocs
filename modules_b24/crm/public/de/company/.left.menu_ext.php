<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (CModule::IncludeModule('crm'))
{
	$CrmPerms = new CCrmPerms($GLOBALS['USER']->GetID());
	$aMenuLinksExt = array();
	if (!$CrmPerms->HavePerm('COMPANY', BX_CRM_PERM_NONE, 'ADD'))
	{
		$aMenuLinksExt[] =
			Array(
				'Unternehmen hinzufügen',
				'#SITE_DIR#crm/company/edit/0/',
				Array(),
				Array(),
				''
			);
	}
	if (!$CrmPerms->HavePerm('COMPANY', BX_CRM_PERM_NONE, 'READ'))
	{
		$aMenuLinksExt[] =
			Array(
				'Liste der Unternehmen',
				'#SITE_DIR#crm/company/list/',
				Array(),
				Array(),
				''
			);
	}
	if (!$CrmPerms->HavePerm('COMPANY', BX_CRM_PERM_NONE, 'ADD'))
	{
		$aMenuLinksExt[] =
			Array(
				'Unternehmen importieren',
				'#SITE_DIR#crm/company/import/',
				Array(),
				Array(),
				''
			);
	}


	$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
}

?>
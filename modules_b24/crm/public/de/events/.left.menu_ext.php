<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (CModule::IncludeModule('crm'))
{
	$aMenuLinksExt = array(
		Array(
			"Aktivitäten", 
			"#SITE_DIR#crm/events/index.php", 
			Array(), 
			Array(), 
			"" 
		),
		Array(
			"Aufgaben", 
			"#SITE_DIR#crm/events/task/", 
			Array(), 
			Array(), 
			"" 
		)	
	);

	$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
}

?>
<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (CModule::IncludeModule('crm'))
{
	$aMenuLinksExt = array(
		Array(
			"Список событий",
			"/crm/events/index.php",
			Array(),
			Array(),
			""
		),
		Array(
			"Список задач",
			"/crm/events/task/",
			Array(),
			Array(),
			""
		)
	);

	$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
}

?>
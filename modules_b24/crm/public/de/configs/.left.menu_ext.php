<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (CModule::IncludeModule('crm'))
{
	$aMenuLinksExt = array(
		Array(
			"Auswahllisten",
			"/crm/configs/status/",
			Array(),
			Array(),
			""
		),
		Array(
			"Währungen",
			"/crm/configs/currency/",
			Array(),
			Array(),
			""
		),		
		Array(
			"Zugriffsberechtigungen",
			"/crm/configs/perms/",
			Array(),
			Array(),
			""
		),
		Array(
			"Geschäftsprozesse",
			"/crm/configs/bp/",
			Array(),
			Array(),
			"CModule::IncludeModule('bizproc') && CModule::IncludeModule('bizprocdesigner')"
		),
		Array(
			"Benutzerdefinierte Felder", 
			"/crm/configs/fields/",
			Array(),
			Array(),
			""
		),
		Array(
			"Einstellungen",
			"/crm/configs/config/",
			Array(),
			Array(),
			"CModule::IncludeModule('subscribe')"
		),
		Array(
			"Integration mit Send&Save", 
			"/crm/configs/sendsave/",
			Array(),
			Array(),
			"CModule::IncludeModule('mail')"
		),
		Array(
			"E-Shops",
			"/crm/configs/external_sale/",
			Array(),
			Array(),
			""
		)
	);

	$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
}

?>
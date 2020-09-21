<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (CModule::IncludeModule('crm'))
{
	$aMenuLinksExt = array(
		Array(
			"Selection Lists",
			"/crm/configs/status/",
			Array(),
			Array(),
			""
		),
		Array(
			"Currencies",
			"/crm/configs/currency/",
			Array(),
			Array(),
			""
		),		
		Array(
			"Access Permissions",
			"/crm/configs/perms/",
			Array(),
			Array(),
			""
		),
		Array(
			"Business processes",
			"/crm/configs/bp/",
			Array(),
			Array(),
			"CModule::IncludeModule('bizproc') && CModule::IncludeModule('bizprocdesigner')"
		),
		Array(
			"Custom Fields",
			"/crm/configs/fields/",
			Array(),
			Array(),
			""
		),
		Array(
			"Settings",
			"/crm/configs/config/",
			Array(),
			Array(),
			"CModule::IncludeModule('subscribe')"
		),
		Array(
			"Send&Save Integration",
			"/crm/configs/sendsave/",
			Array(),
			Array(),
			"CModule::IncludeModule('mail')"
		),
		Array(
			"e-Stores",
			"/crm/configs/external_sale/",
			Array(),
			Array(),
			""
		)
	);

	$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
}

?>
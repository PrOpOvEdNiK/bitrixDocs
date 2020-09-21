<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();


if (CModule::IncludeModule('crm'))
{
	$aMenuLinksExt = array(
		Array(
			"Справочники",
			"/crm/configs/status/",
			Array(),
			Array(),
			""
		),
		Array(
			"Валюты",
			"/crm/configs/currency/",
			Array(),
			Array(),
			""
		),	
		Array(
			"Права доступа",
			"/crm/configs/perms/",
			Array(),
			Array(),
			""
		),
		Array(
			"Бизнес-процессы",
			"/crm/configs/bp/",
			Array(),
			Array(),
			"CModule::IncludeModule('bizproc') && CModule::IncludeModule('bizprocdesigner')"
		),
		Array(
			"Пользовательские поля",
			"/crm/configs/fields/",
			Array(),
			Array(),
			""
		),
		Array(
			"Настройки",
			"/crm/configs/config/",
			Array(),
			Array(),
			"CModule::IncludeModule('subscribe')"
		),
		Array(
			"Интеграция c почтой",
			"/crm/configs/sendsave/",
			Array(),
			Array(),
			"CModule::IncludeModule('mail')"
		),
		Array(
			"Интернет-магазины",
			"/crm/configs/external_sale/",
			Array(),
			Array(),
			""
		)
	);

	$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
}

?>
<?php

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Text\HtmlFilter;

$isFirst = true;
foreach($arResult['value'] as $value)
{
	if(!$isFirst)
	{
		print '<br>';
	}
	$isFirst = false;
	print (!empty($value) ? HtmlFilter::encode($arResult['userField']['USER_TYPE']['FIELDS'][$value]) : '');
}
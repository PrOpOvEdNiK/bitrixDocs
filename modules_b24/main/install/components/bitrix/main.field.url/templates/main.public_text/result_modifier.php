<?php

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$result = [];

foreach($arResult['value'] as $res)
{
	if(is_string($res) && $res !== '')
	{
		$result[] = $res;
	}
}
$arResult['value'] = implode(', ', $result);
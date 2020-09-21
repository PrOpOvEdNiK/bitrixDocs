<?php

if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

if($arResult['additionalParameters']['bVarsFromForm'])
{
	$precision = (int)$GLOBALS[$arResult['additionalParameters']['NAME']]['PRECISION'];
	$value = (double)$GLOBALS[$arResult['additionalParameters']['NAME']]['DEFAULT_VALUE'];
	$size = (int)$GLOBALS[$arResult['additionalParameters']['NAME']]['SIZE'];
	$min = (double)$GLOBALS[$arResult['additionalParameters']['NAME']]['MIN_VALUE'];
	$max = (double)$GLOBALS[$arResult['additionalParameters']['NAME']]['MAX_VALUE'];
}
elseif(is_array($arResult['userField']))
{
	$precision = (int)$arResult['userField']['SETTINGS']['PRECISION'];
	$value = (double)$arResult['userField']['SETTINGS']['DEFAULT_VALUE'];
	$size = (int)$arResult['userField']['SETTINGS']['SIZE'];
	$min = (double)$arResult['userField']['SETTINGS']['MIN_VALUE'];
	$max = (double)$arResult['userField']['SETTINGS']['MAX_VALUE'];
}
else
{
	$precision = 4;
	$value = '';
	$size = 20;
	$min = 0;
	$max = 0;
}

$arResult['precision'] = $precision;
$arResult['value'] = $value;
$arResult['size'] = $size;
$arResult['min'] = $min;
$arResult['max'] = $max;
<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();

if (!is_array($arResult['CONTACT']) || !($USERS_CNT = count($arResult['CONTACT']))):
	echo(GetMessage('ERROR_CONTACT_IS_EMPTY'));
else:
	foreach ($arResult['HEADERS'] as $arHead):
		echo '"', str_replace('"', '""', $arHead['name']),'";';
	endforeach;

	foreach ($arResult['CONTACT'] as $i => $arContact):
		echo "\n";
		foreach ($arResult['HEADERS'] as $arHead):
			switch($arHead['id'])
			{			
				case 'TYPE_ID':
					$arResult['CONTACT'][$i][$arHead['id']] = $arResult['TYPE_LIST'][$arContact['TYPE_ID']];	
					break ;
				case 'SOURCE_ID':
					$arResult['CONTACT'][$i][$arHead['id']] = $arResult['SOURCE_LIST'][$arContact['SOURCE_ID']];	
					break ;								
				default:
					$arResult['CONTACT'][$i][$arHead['id']] = (string)$arResult['CONTACT'][$i][$arHead['id']]; 
				break;
			}			
			echo '"', str_replace('"', '""', $arResult['CONTACT'][$i][$arHead['id']]), '";';
		endforeach;
	endforeach;
endif;
?>
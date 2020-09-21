<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();

if (!is_array($arResult['CONTACT']) || !($USERS_CNT = count($arResult['CONTACT']))):
	echo(GetMessage('ERROR_CONTACT_IS_EMPTY'));
else:
    ?>
	<meta http-equiv="Content-type" content="text/html;charset=<?echo LANG_CHARSET?>" />
	<table border="1">
	<thead>
		<tr>
    <?
	foreach ($arResult['HEADERS'] as $arHead):
		if ($key == 'PERSONAL_PHOTO') continue;
    ?>
		<th><?=$arHead['name']?></th>
    <?
	endforeach;
    ?>
		</tr>
	</thead>
	<tbody>
<?
	foreach ($arResult['CONTACT'] as $i => $arContact):
?>
		<tr>
<?
		foreach ($arResult['HEADERS'] as $arHead):			
			$cell_height = 0;
			$cell_width = 0;
			switch($arHead['id'])
			{			
				case 'TYPE_ID':
					$arResult['CONTACT'][$i][$arHead['id']] = $arResult['TYPE_LIST'][$arContact['TYPE_ID']];	
					break ;
				case 'SOURCE_ID':
					$arResult['CONTACT'][$i][$arHead['id']] = $arResult['SOURCE_LIST'][$arContact['SOURCE_ID']];	
					break ;					
				case 'EMAIL':
					$arResult['CONTACT'][$i][$arHead['id']] = '<a href="mailto:'.urlencode($arResult['CONTACT'][$i][$arHead['id']]).'">'.htmlspecialchars($arResult['CONTACT'][$i][$arHead['id']]).'</a>';
				break;
				case 'WEB':
					$arResult['CONTACT'][$i][$arHead['id']] = '<a href="http://'.urlencode($arResult['CONTACT'][$i][$arHead['id']]).'" target="_blank">'.htmlspecialchars($arResult['CONTACT'][$i][$arHead['id']]).'</a>';
				break;								
				default:
					$arResult['CONTACT'][$i][$arHead['id']] = $arResult['CONTACT'][$i][$arHead['id']]; 
				break;
			}
			
			echo '<td'.($cell_height ? ' height="'.$cell_height.'"' : '').($cell_width ? ' width="'.$cell_width.'"' : '').'>'.$arResult['CONTACT'][$i][$arHead['id']].'</td>';
?>
<?
		endforeach;
?>
		</tr>
<?
	endforeach;
?>
	</tbody>
</table>
<?
endif;
?>
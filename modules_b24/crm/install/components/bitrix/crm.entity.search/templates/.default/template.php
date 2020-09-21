<?
if(!Defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$name_x = CUtil::JSEscape($arParams['NAME']);

$arParams['FORM_NAME'] = CUtil::JSEscape($arParams['FORM_NAME']);
$arParams['INPUT_NAME'] = CUtil::JSEscape($arParams['INPUT_NAME']);

if ($arParams['SHOW_INPUT'] == 'Y'):
?>
<input type="text" id="<?=htmlspecialcharsex($arParams['~INPUT_NAME'])?>" name="<?=htmlspecialcharsex($arParams['~INPUT_NAME'])?>" value="<?echo $arParams['INPUT_VALUE']?>" size="3" />
<?
endif;

if ($arParams['SHOW_BUTTON'] == 'Y'):
?>
<input type="button" onclick="<?=$name_x?>.Show()" value="<? echo $arParams['BUTTON_CAPTION'] ? htmlspecialcharsex($arParams['BUTTON_CAPTION']) : '...'?>" />
<?
endif;
?>
<script type="text/javascript">
<?
if ($arParams['INPUT_NAME']):
?>

function GetInput_<?=$name_x?>() {return document.<?if ($arParams['FORM_NAME']):?>forms['<?=$arParams['FORM_NAME']?>']['<?=$arParams['INPUT_NAME']?>'];<?else:?>getElementById('<?=$arParams['INPUT_NAME']?>')<?endif;?>}

<?
	if (!$arParams['ONSELECT']):
?>
function OnSelect_<?=$name_x?>(value){GetInput_<?=$name_x?>().value = value;}
<?
		$arParams['ONSELECT'] = 'OnSelect_'.$name_x;
	endif;
endif;
?>

var <?=$name_x?> = new JSEntitySelectControl({ENTITY_TYPE: '<?echo $arParams['ENTITY_TYPE']?>', MULTIPLE: <?echo $arParams['MULTIPLE'] == 'Y' ? 'true' : 'false'?>, LANGUAGE_ID:'<?=LANGUAGE_ID?>', GET_FULL_INFO: <?echo $arParams['GET_FULL_INFO'] == 'Y' ? 'true' : 'false'?>, ONSELECT: function(v){<?echo $arParams['ONSELECT']?>(v)}, SITE_ID: '<?=$arParams['SITE_ID']?>'});

<?
if ($arParams['INPUT_NAME']):
?>
BX.ready(function() {
	<?=$name_x?>.SetValue(GetInput_<?=$name_x?>().value);
	GetInput_<?=$name_x?>().onchange = function () {<?=$name_x?>.SetValue(this.value)}
});
<?
endif;
if (defined('ADMIN_SECTION')):
?>
BX.loadCSS("/bitrix/components/bitrix/crm.entity.search/templates/.default/style.css");
<?
endif;
?>
</script>
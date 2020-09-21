<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\UI\Extension,
	Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);
$messages = Loc::loadLanguageFile(__FILE__);

$bodyClass = $APPLICATION->GetPageProperty("BodyClass");
$APPLICATION->SetPageProperty("BodyClass", ($bodyClass ? $bodyClass." " : "") . "no-all-paddings no-hidden no-background");
$APPLICATION->SetTitle(Loc::getMessage('SCP_SALESCENTER_TITLE'));
Extension::load([
	'ui.tilegrid',
	'ui.fonts.opensans',
	'sidepanel',
	'popup',
	'salescenter.manager',
]);
?>

<div class="salescenter-cashbox-title"><?=Loc::getMessage('SCP_SALESCENTER_CASHBOX_SUB_TITLE')?></div>
<div id="salescenter-cashbox" class="salescenter-cashbox"></div>

<script>
	BX.ready(function()
	{
		BX.message(<?=CUtil::PhpToJSObject($messages)?>);

		// cashbox
		var cashboxParams = <?=CUtil::PhpToJSObject($arResult['cashboxPanelParams']);?>;
		cashboxParams.container = document.getElementById('salescenter-cashbox');
		cashboxParams.sizeRatio = "55%";
		cashboxParams.itemMinWidth = 200;
		cashboxParams.tileMargin = 7;
		cashboxParams.itemType = 'BX.SaleCenterCashbox.TileGrid';

		BX.SaleCenterCashbox.init({
			cashboxParams: cashboxParams,
		});
	});
</script>

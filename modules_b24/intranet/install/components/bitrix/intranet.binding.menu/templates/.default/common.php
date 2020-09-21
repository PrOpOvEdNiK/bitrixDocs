<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
	die();
}

use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__DIR__ . '/template.php');

$id = 'intranet_binding_menu';
//ec($arResult['ITEMS'],1);
?>

<a href="#" id="<?= $id;?>_top" class="ui-btn ui-btn-light-border ui-btn-no-caps ui-btn-themes">
	<?= Loc::getMessage('INTRANET_CMP_BIND_MENU_BUTTON_NAME');?>
</a>
<div class="ui-btn-split" id="<?= $id;?>">
	<div class="ui-btn-menu"></div>
</div>

<script type="text/javascript">
	BX.ready(function()
	{
		(new BX.Intranet.Binding.Menu(
			'<?= $id;?>',
			<?= \CUtil::phpToJSObject($arResult['ITEMS']);?>,
			{
				sections: {
					<?foreach ($arResult['SECTIONS'] as $code):?>
					'<?= $code;?>': '<?= \CUtil::jsEscape(Loc::getMessage('INTRANET_CMP_BIND_MENU_SECTION_' . strtoupper($code)));?>',
					<?endforeach;?>
				}
			}
		)).binding();
	});
</script>

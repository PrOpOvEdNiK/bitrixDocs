<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\UI\Extension;

$messages = Loc::loadLanguageFile(__FILE__);

$bodyClass = $APPLICATION->GetPageProperty("BodyClass");
$APPLICATION->SetPageProperty("BodyClass", ($bodyClass ? $bodyClass." " : "") . "no-paddings no-hidden no-background");

CJSCore::Init([
	"admin_sidepanel",
]);

Extension::load([
	'salescenter.manager',
	'ui.tilegrid',
	'ui.fonts.opensans',
	'popup',
	'ajax',
]);

\Bitrix\SalesCenter\Integration\Bitrix24Manager::getInstance()->addFeedbackButtonToToolbar();

?>
<div class="mp<?=((isset($_REQUEST["IFRAME"]) && $_REQUEST["IFRAME"] === "Y") ? 'mp-slider' : '');?>">
	<?php
	foreach($arResult['panels'] as $panel)
	{
		$nodeName = CUtil::JSEscape($panel['id']).'-node';
		?>
		<div class="salescenter-container">
			<?php
			if(!empty($panel['title']))
			{
				?>
				<div class="salescenter-block-title"><?=$panel['title'];?></div>
				<?php
			}
			?>
			<div class="salescenter-container" id="<?=$nodeName;?>"></div>
			<script>
				BX.ready(function()
				{
					var params = <?=CUtil::PhpToJSObject($panel, false, false, true);?>;
					params.container = document.getElementById('<?=$nodeName;?>');
					params.sizeRatio = "55%";
					params.itemMinWidth = 180;
					params.tileMargin = 7;
					var panel = new BX.TileGrid.Grid(params);
					panel.draw();
				});
			</script>
		</div>
		<?php
	}
	?>
</div>

<script>
	BX.ready(function()
	{
		BX.message(<?=CUtil::PhpToJSObject($messages)?>);
		BX.Salescenter.Manager.init(<?=CUtil::PhpToJSObject($arResult['managerParams'])?>);

		BX.Salescenter.ControlPanel.init();
	});
</script>
<?
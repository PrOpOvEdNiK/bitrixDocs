<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * Bitrix vars
 * @global CUser $USER
 * @global CMain $APPLICATION
 * @global CDatabase $DB
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponent $component
 */

use Bitrix\Crm;

CJSCore::Init(array('amcharts', 'amcharts_funnel', 'amcharts_serial', 'amcharts_pie', 'fx', 'drag_drop', 'popup', 'date'));
$asset = Bitrix\Main\Page\Asset::getInstance();
$asset->addJs('/bitrix/js/crm/common.js');
$asset->addCss('/bitrix/themes/.default/crm-entity-show.css');
$asset->addCss('/bitrix/js/crm/css/crm.css');

if(SITE_TEMPLATE_ID === 'bitrix24')
{
	$APPLICATION->SetAdditionalCSS('/bitrix/themes/.default/bitrix24/crm-entity-show.css');
	$bodyClass = $APPLICATION->GetPageProperty('BodyClass');
	$APPLICATION->SetPageProperty('BodyClass', ($bodyClass ? $bodyClass.' ' : '').'pagetitle-toolbar-field-view flexible-layout crm-toolbar crm-pagetitle-view');
}
$quid = $arResult['GUID'];
$prefix = strtolower($quid);
$containerID = "{$prefix}_container";
$settingButtonID = "{$prefix}_settings";
$disableDemoModeButtonID = "{$prefix}_disable_demo";
$demoModeInfoCloseButtonID = "{$prefix}_demo_info_close";
$demoModeInfoContainerID = "{$prefix}_demo_info";

if($arResult['ENABLE_TOOLBAR'])
{
	$toolbarButtons = array(
		array(
			'TEXT' => GetMessage('CRM_WGT_MENU_ITEM_ADD'),
			'ONCLICK' => 'BX.CrmWidgetPanel.current.processAction("add")'
		),
		array(
			'NEWBAR' => true
		),
		array(
			'TEXT' => GetMessage('CRM_WGT_MENU_CHANGE_LAYOUT'),
			'ONCLICK' => 'BX.CrmWidgetPanel.current.processAction("layout")'
		),
		array(
			'TEXT' => GetMessage('CRM_WGT_MENU_ITEM_RESET'),
			'ONCLICK' => 'BX.CrmWidgetPanel.current.processAction("reset")'
		),
	);

	if ($arResult['USE_DEMO'])
	{
		$toolbarButtons[] = array(
			'TEXT' => GetMessage('CRM_WGT_MENU_ITEM_ENABLE_DEMO_MODE'),
			'ONCLICK' => 'BX.CrmWidgetPanel.current.processAction("enabledemomode")'
		);
	}

	$APPLICATION->IncludeComponent(
		'bitrix:crm.interface.toolbar',
		'title',
		array(
			'TOOLBAR_ID' => "{$prefix}_toolbar",
			'BUTTONS' => $toolbarButtons
		),
		$component,
		array('HIDE_ICONS' => 'Y')
	);
}

if($arResult['ENABLE_DEMO']):
	?><div id="<?=htmlspecialcharsbx($demoModeInfoContainerID)?>" class="crm-widg-white-tooltip">
		<div class="crm-widg-white-text"><?=$arResult['DEMO_TITLE']?></div>
		<div class="crm-widg-white-text"><?=$arResult['DEMO_CONTENT']?></div>
		<div class="crm-widg-white-text">
			<div id="<?=htmlspecialcharsbx($disableDemoModeButtonID)?>" class="crm-widg-white-bottom-link"><?=GetMessage('CRM_WGT_DISABLE_DEMO')?></div>
		</div>
		<div id="<?=htmlspecialcharsbx($demoModeInfoCloseButtonID)?>" class="crm-widg-white-close"></div>
	</div><?
endif;

$listUrl = $arResult['PATH_TO_LIST'];
$widgetUrl = $arResult['PATH_TO_WIDGET'];
$kanbanUrl = $arResult['PATH_TO_KANBAN'];
$switchToListButtonID = "{$prefix}_list";
$reloadButtonID = "{$prefix}_widget";
$settings = array(
	'defaultEntityType' => $arResult['DEFAULT_ENTITY_TYPE'],
	'entityTypes' => $arResult['ENTITY_TYPES'],
	'layout' => $arResult['LAYOUT'],
	'rows' => $arResult['ROWS'],
	'prefix' => $prefix,
	'containerId' => $containerID,
	'settingButtonId' => $settingButtonID,
	'serviceUrl' => '/bitrix/components/bitrix/crm.widget_panel/settings.php?'.bitrix_sessid_get(),
	'listUrl' => $listUrl,
	'widgetUrl' => $widgetUrl,
	'currencyFormat' => $arResult['CURRENCY_FORMAT'],
	'maxGraphCount' => $arResult['MAX_GRAPH_COUNT'],
	'maxWidgetCount' => $arResult['MAX_WIDGET_COUNT'],
	'isDemoMode' => $arResult['ENABLE_DEMO'],
	'useDemoMode' => $arResult['USE_DEMO'],
	'demoModeInfoContainerId'=> $demoModeInfoContainerID,
	'disableDemoModeButtonId' => $disableDemoModeButtonID,
	'demoModeInfoCloseButtonId' => $demoModeInfoCloseButtonID,
	'isAjaxMode' => \Bitrix\Main\Page\Frame::isAjaxRequest()
);

$filterFieldInfos = array();

$headViewID =  isset($arParams['~RENDER_HEAD_INTO_VIEW']) ? $arParams['~RENDER_HEAD_INTO_VIEW'] : false;
if($headViewID && is_string($headViewID))
	$this->SetViewTarget('below_pagetitle', 0);

if(!$arResult['ENABLE_TOOLBAR'])
{
	?><div class="crm-btn-panel"><span id="<?=htmlspecialcharsbx($settingButtonID)?>" class="crm-btn-panel-btn"></span></div><?
}
?><div class="crm-filter-wrap"><?

$navigationBar = null;
if($arResult['ENABLE_NAVIGATION'])
{
	$navigationBar = array(
		'ITEMS' => array(),
		'BINDING' => array(
			'category' => 'crm.navigation',
			'name' => 'index',
			'key' => strtolower($arResult['NAVIGATION_CONTEXT_ID'])
		)
	);

	if($kanbanUrl !== '')
	{
		$navigationBar['ITEMS'][] = array(
			//'icon' => 'kanban',
			'id' => 'kanban',
			'name' => GetMessage('CRM_WGT_FILTER_NAV_BUTTON_KANBAN'),
			'active' => false,
			'url' => $kanbanUrl
		);
	}

	$navigationBar['ITEMS'][] = array(
		//'icon' => 'table',
		'id' => 'list',
		'name' => GetMessage('CRM_WGT_FILTER_NAV_BUTTON_LIST'),
		'active' => false,
		'counter' => $arResult['NAVIGATION_COUNTER'],
		'url' => $listUrl
	);

	$navigationBar['ITEMS'][] = array(
		//'icon' => 'chart',
		'id' => 'widget',
		'name' => GetMessage('CRM_WGT_FILTER_NAV_BUTTON_WIDGET'),
		'active' => true,
		'hint' => array(
			'title' => GetMessage('CRM_WGT_LIST_HINT_TITLE'),
			'content' => GetMessage('CRM_WGT_LIST_HINT_CONTENT'),
			'disabling' => GetMessage('CRM_WGT_DISABLE_LIST_HINT')
		),
		'url' => $widgetUrl
	);
}

$APPLICATION->IncludeComponent(
	'bitrix:crm.interface.filter',
	'title',
	array(
		'GRID_ID' => $quid,
		'FILTER' => $arResult['FILTER'],
		'FILTER_ROWS' => $arResult['FILTER_ROWS'],
		'FILTER_FIELDS' => $arResult['FILTER_FIELDS'],
		'FILTER_PRESETS' => $arResult['FILTER_PRESETS'],
		'RENDER_FILTER_INTO_VIEW' => false,
		'OPTIONS' => $arResult['OPTIONS'],
		'ENABLE_PROVIDER' => true,
		'DISABLE_SEARCH' => true,
		'VALUE_REQUIRED_MODE' => true,
		'NAVIGATION_BAR' => $navigationBar
	),
	$component,
	array('HIDE_ICONS' => true)
);
if($headViewID && is_string($headViewID))
{
	$this->EndViewTarget();
}

$filterTypeDescriptions =  Crm\Widget\FilterPeriodType::getAllDescriptions();
//Remove unsupported types
unset($filterTypeDescriptions[Crm\Widget\FilterPeriodType::BEFORE]);

?></div>

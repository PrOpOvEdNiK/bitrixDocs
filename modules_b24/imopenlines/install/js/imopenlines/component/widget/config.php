<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}

return [
	'js' => [
		'/bitrix/js/imopenlines/component/widget/dist/widget.bundle.js',
	],
	'css' =>[
		'/bitrix/js/imopenlines/component/widget/dist/widget.bundle.css',
	],
	'rel' => [
		'main.polyfill.core',
		'main.polyfill.customevent',
		'pull.components.status',
		'ui.vue.components.smiles',
		'im.component.dialog',
		'im.component.textarea',
		'im.component.quotepanel',
		'imopenlines.component.message',
		'imopenlines.component.form',
		'rest.client',
		'main.date',
		'pull.client',
		'im.model',
		'im.controller',
		'im.tools.localstorage',
		'im.provider.rest',
		'im.provider.pull',
		'im.tools.logger',
		'main.md5',
		'im.const',
		'ui.icons',
		'ui.forms',
		'im.utils',
		'ui.vue',
		'ui.vue.vuex',
	],
	'skip_core' => true,
];
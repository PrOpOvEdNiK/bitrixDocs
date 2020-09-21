<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
	die();
}

use \Bitrix\Intranet\Binding;
use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

class IntranetBindingMenuComponent extends \CBitrixComponent
{
	/**
	 * Check var in arParams. If no exists, create with default val.
	 * @param string|int $var Variable.
	 * @param mixed $default Default value.
	 * @return void
	 */
	protected function checkParam($var, $default)
	{
		if (!isset($this->arParams[$var]))
		{
			$this->arParams[$var] = $default;
		}
		if (is_int($default))
		{
			$this->arParams[$var] = (int)$this->arParams[$var];
		}
		if (substr($var, 0, 1) !== '~')
		{
			$this->checkParam('~' . $var, $default);
		}
	}

	/**
	 * Base executable method.
	 * @return void
	 */
	public function executeComponent()
	{
		$this->checkParam('SECTION_CODE', '');
		$this->checkParam('MENU_CODE', '');

		$this->arParams['SECTION_CODE'] = strtolower($this->arParams['SECTION_CODE']);
		$this->arParams['MENU_CODE'] = strtolower($this->arParams['MENU_CODE']);

		$this->arResult['SECTIONS'] = Binding\Menu::SECTIONS;
		$this->arResult['ITEMS'] = Binding\Menu::getMenuItems(
			$this->arParams['SECTION_CODE'],
			$this->arParams['MENU_CODE']
		);

		//ec($this->arResult['ITEMS'],1);

		if (!$this->arResult['ITEMS'])
		{
			return;
		}

		$this->includeComponentTemplate($this->arParams['SECTION_CODE']);
	}
}

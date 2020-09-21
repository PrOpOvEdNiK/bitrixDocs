<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage sale
 * @copyright 2001-2015 Bitrix
 */

use Bitrix\Main\Localization\Loc;
use Bitrix\Tasks\Helper;
use Bitrix\Tasks\Internals\Counter;
use Bitrix\Tasks\Ui\Filter;
use Bitrix\Tasks\Util\Restriction\Bitrix24Restriction\Limit\TaskLimit;

Loc::loadMessages(__FILE__);

CBitrixComponent::includeComponentClass("bitrix:tasks.base");

class TasksToolbarComponent extends TasksBaseComponent
{
	protected $gridOptions;
	protected $listState;
	protected $listCtrl;

	protected function checkParameters()
	{
		parent::checkParameters();

		$arParams =& $this->arParams;

		static::tryParseStringParameter($arParams['DEFAULT_ROLEID'], 'view_all');
		static::tryParseStringParameter($arParams['SHOW_TOOLBAR'], 'N');

		if ($arParams['GROUP_ID'] > 0)
		{
			$arParams['SHOW_TOOLBAR'] = 'N';
		}
	}

	protected function doPreAction()
	{
		parent::doPreAction();

		$this->listState = Filter\Task::getListStateInstance();
		$this->listCtrl = Filter\Task::getListCtrlInstance();
		$this->listCtrl->useState($this->listState);

		$viewList = $this->getViewList();
		$showCounters = !isset($this->arParams['SPRINT_SELECTED']) || $this->arParams['SPRINT_SELECTED'] != 'Y';
		$showSpotlight = (
			$this->showSpotlight('timeline')
			&& $this->arParams['SHOW_VIEW_MODE'] == 'Y'
			&& array_key_exists('VIEW_MODE_TIMELINE', $viewList)
		);

		$this->arResult['TASK_LIMIT_EXCEEDED'] = TaskLimit::isLimitExceeded();
		$this->arResult['VIEW_LIST'] = $viewList;
		$this->arResult['SPOTLIGHT_TIMELINE'] = $showSpotlight;
		$this->arResult['COUNTERS_SHOW'] = $showCounters;

		if ($showCounters)
		{
			$this->arResult['COUNTERS'] = $this->getCounters();
		}
	}

	/**
	 * @return mixed
	 */
	protected function getViewList()
	{
		$viewState = $this->getViewState();
		return $viewState['VIEWS'];
	}

	/**
	 * @return array
	 */
	private function getViewState(): array
	{
		static $viewState = null;
		if ($viewState === null)
		{
			$viewState = $this->listState->getState();
		}

		return $viewState;
	}

	/**
	 * @return string
	 */
	private function getFilterRole(): string
	{
		$filterInstance = Helper\Filter::getInstance($this->arParams['USER_ID'], $this->arParams['GROUP_ID']);
		$filterOptions = $filterInstance->getOptions();
		$filter = $filterOptions->getFilter();

		return (array_key_exists('ROLEID', $filter) ? $filter['ROLEID'] : Counter\Role::ALL);
	}

	/**
	 * @return array
	 */
	protected function getCounters(): array
	{
		if ($this->arParams['GROUP_ID'] > 0)
		{
			$counterInstance = Counter\Group::getInstance($this->arParams['GROUP_ID']);
			return $counterInstance->getCounters();
		}

		$counterInstance = Counter::getInstance($this->arParams['USER_ID'], $this->arParams['GROUP_ID']);
		return $counterInstance->getCounters($this->getFilterRole());
	}
}
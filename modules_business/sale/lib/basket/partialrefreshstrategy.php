<?php

namespace Bitrix\Sale\Basket;

use Bitrix\Main\Config\Option;
use Bitrix\Sale\BasketBase;
use Bitrix\Sale\BasketItemBase;
use Bitrix\Sale\Internals\Catalog\Provider;
use Bitrix\Sale\Result;

class PartialRefreshStrategy extends RefreshStrategy
{
	const SESSION_REFRESH_TIMESTAMP = 'INITIAL_BASKET_REFRESH_TIMESTAMP';
	const SESSION_REFRESH_LAST_BASKET_ITEM = 'LAST_REFRESHED_BASKET_ITEM_CODE';

	public function __construct(array $data = null)
	{
		parent::__construct($data);

		if (isset($this->data['IS_INITIAL']) && $this->data['IS_INITIAL'])
		{
			$this->clearRefreshSessionData();
		}
	}

	public function clearRefreshSessionData()
	{
		unset($_SESSION[self::SESSION_REFRESH_TIMESTAMP]);
		unset($_SESSION[self::SESSION_REFRESH_LAST_BASKET_ITEM]);
	}

	protected function getBasketRefreshStartTimestamp()
	{
		if (!isset($_SESSION[self::SESSION_REFRESH_TIMESTAMP]))
		{
			$_SESSION[self::SESSION_REFRESH_TIMESTAMP] = time();
		}

		return $_SESSION[self::SESSION_REFRESH_TIMESTAMP];
	}

	protected function getLastRefreshedBasketItemCode()
	{
		return isset($_SESSION[self::SESSION_REFRESH_LAST_BASKET_ITEM])
			? $_SESSION[self::SESSION_REFRESH_LAST_BASKET_ITEM]
			: null;
	}

	protected function setLastRefreshedBasketItemCode($basketCode)
	{
		$_SESSION[self::SESSION_REFRESH_LAST_BASKET_ITEM] = $basketCode;
	}

	protected function getRefreshQuantity()
	{
		return (int)Option::get('sale', 'basket_partial_refresh_quantity', 100);
	}

	protected function getPartialRefreshData(BasketBase $basket)
	{
		$itemsToRefresh = array();
		$anotherRefreshRequired = false;

		$partialRefreshQuantity = $this->getRefreshQuantity();
		if ($partialRefreshQuantity > 0)
		{
			$itemsToRefresh = $this->getBasketItemsToRefresh($basket, $partialRefreshQuantity + 1);
			$anotherRefreshRequired = count($itemsToRefresh) > $partialRefreshQuantity;
		}

		if ($anotherRefreshRequired)
		{
			/** @var BasketItemBase $poppedBasketItem */
			$poppedBasketItem = array_pop($itemsToRefresh);
			$this->setLastRefreshedBasketItemCode($poppedBasketItem->getBasketCode());
		}

		return array($itemsToRefresh, $anotherRefreshRequired);
	}

	protected function getProductData(BasketBase $basket)
	{
		list($itemsToRefresh, $anotherRefreshRequired) = $this->getPartialRefreshData($basket);

		$result = $this->getProviderResult($basket, $itemsToRefresh);
		$result->addData(array(
			'ANOTHER_REFRESH_REQUIRED' => $anotherRefreshRequired
		));

		return $result;
	}
}
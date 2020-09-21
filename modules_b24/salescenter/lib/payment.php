<?php

namespace Bitrix\SalesCenter;

use Bitrix\Main;
use Bitrix\Crm;
use Bitrix\Catalog;
use Bitrix\Sale;
use Bitrix\Sale\Helpers\Order\Builder;

class Payment
{
	private $errorCollection;
	private $fields = [];

	/** @var Crm\Order\Order $order */
	private $order;

	/**
	 * Get public url by order ID.
	 *
	 * @param int $orderId Order ID.
	 * @return string|null
	 */
	public static function getUrl($orderId)
	{
		$order = Sale\Order::load($orderId);
		if (!$order)
		{
			return null;
		}
		$info = self::getUrlInfo($order);
		return $info['url'] ?? null;
	}

	public function __construct()
	{
		$this->errorCollection = new Main\ErrorCollection();
		$this->fields = [
			'SITE_ID' => SITE_ID,
			'SHIPMENT' => [
				[
					'DELIVERY_ID' =>  Sale\Delivery\Services\EmptyDeliveryService::getEmptyDeliveryServiceId(),
					'ALLOW_DELIVERY' => 'Y',
					'DEDUCTED' => 'N'
				]
			],
			'PRODUCT' => [],
			'CLIENT' => [],
		];

		if (Integration\LandingManager::getInstance()->isSiteExists())
		{
			$connectedSiteId = Integration\LandingManager::getInstance()->getConnectedSiteId();
			$this->fields['TRADING_PLATFORM'] = Sale\TradingPlatform\Landing\Landing::getCodeBySiteId($connectedSiteId);
		}
	}

	public function setUserId($userId)
	{
		$this->fields['USER_ID'] = (int) $userId;
		return $this;
	}

	public function setResponsibleId($responsibleId)
	{
		$this->fields['RESPONSIBLE_ID'] = (int) $responsibleId;
		return $this;
	}

	public function setClient(array $client)
	{
		$this->fields['CLIENT'] = $client;
		return $this;
	}

	public function setClientByCrmOwner($ownerTypeId, $ownerId)
	{
		$this->fields['CLIENT'] = Integration\CrmManager::getInstance()->getClientInfo($ownerTypeId, $ownerId);;
		return $this;
	}

	public function setBasketItem($code, $fieldValues)
	{
		$this->fields['PRODUCT'][$code] = ['FIELDS_VALUES' => $fieldValues];
		return $this;
	}

	public function setBasketItemById($productId, array $options = [])
	{
		$product = \CCrmProduct::getByID($productId);
		if (!$product)
		{
			return $this;
		}
		$measure = \Bitrix\Crm\Measure::getProductMeasures($productId);
		$fieldValues = self::prepareNewProductFields([
			'productId' => $productId,
			'sort' => $product['SORT'],
			'module' => 'catalog',
			'quantity' => 1,
			'isCustomPrice' => 'Y',
			'name' => $product['NAME'],
			'basePrice' => $options['price'] ?? $product['PRICE'],
			'measureName' => $measure[$productId][0]['SYMBOL'],
			'measureCode' => $measure[$productId][0]['CODE']
		]);

		$this->setBasketItem($productId, Main\Web\Json::encode($fieldValues));
		return $this;
	}

	/*
	 * Save.
	 *
	 * @return Main\Result
	 */
	public function save()
	{
		$this->errorCollection->clear();
		$this->checkModules();
		if ($this->errorCollection->count() > 0)
		{
			return $this->createResult();
		}

		$dealId = null;
		$formData = $this->fields;
		if (empty($formData['USER_ID']))
		{
			$formData['USER_ID'] = (int) \CSaleUser::GetAnonymousUserID();
		}
		if (empty($formData['RESPONSIBLE_ID']))
		{
			$formData['RESPONSIBLE_ID'] = \CCrmSecurityHelper::GetCurrentUserID();
		}
		if(!empty($formData['CLIENT']['DEAL_ID']))
		{
			$dealId = $formData['CLIENT']['DEAL_ID'];
			unset($formData['CLIENT']['DEAL_ID']);
		}

		$personType = $this->getPersonTypeId($formData['CLIENT']);
		if ($personType > 0)
		{
			$formData['PERSON_TYPE_ID'] = $personType;
		}

		/** @var Crm\Order\Order $order */
		$this->order = $this->buildOrder($formData);
		$order = $this->order;
		if (!$order)
		{
			return $this->createResult();
		}

		if (!$dealId)
		{
			$selector = Integration\SaleManager::getActualEntitySelector($order);
			$dealId = (int)$selector->search()->getDealId();

			if ($dealId <= 0)
			{
				$dealData = Crm\Order\DealBinding::getList([
					'select' => ['DEAL_ID'],
					'filter' => [
						'=ORDER.USER_ID' => $order->getUserId(),
						'=DEAL.CLOSED' => 'N'
					],
					'limit' => 1,
					'order' => ['DEAL_ID' => 'DESC']
				])->fetch();

				$dealId = (int)$dealData['DEAL_ID'];
			}
		}

		if ($dealId > 0)
		{
			$dealBinding = $order->getDealBinding();

			if ($dealBinding === null)
			{
				$dealBinding = $order->createDealBinding();
			}

			if ($dealBinding)
			{
				$dealBinding->setField('DEAL_ID', $dealId);
			}
		}

		/** @var Sale\BasketItem $basketItem */
		foreach ($order->getBasket() as $basketItem)
		{
			if ($basketItem->isCustom())
			{
				$productId = $this->createProduct($basketItem->getFieldValues());
				if ((int)$productId > 0)
				{
					$basketItem->setFieldsNoDemand([
						'MODULE' => 'catalog',
						'PRODUCT_ID' => $productId,
						'PRODUCT_PROVIDER_CLASS' => Catalog\Product\Basket::getDefaultProviderName()
					]);
				}
			}
		}

		$paymentCollection = $order->getPaymentCollection();
		$payment = $paymentCollection->current();
		if (!$payment)
		{
			$payment = $paymentCollection->createItem();
		}

		$paySystemList = Sale\PaySystem\Manager::getListWithRestrictions($payment);

		$selectedPaySystem = $firstPaySystemInList = null;
		foreach ($paySystemList as $paySystem)
		{
			if ($paySystem['ACTION_FILE'] === 'cash')
			{
				$selectedPaySystem = $paySystem;
				break;
			}
			if (!$firstPaySystemInList && $paySystem['ACTION_FILE'] !== 'inner')
			{
				$firstPaySystemInList = $paySystem;
			}
		}

		if (!$selectedPaySystem)
		{
			$selectedPaySystem = $firstPaySystemInList;
		}

		$paymentFields = [
			'SUM' => $order->getPrice(),
			'CURRENCY'=> $order->getCurrency(),
		];
		if (!empty($selectedPaySystem))
		{
			$paymentFields['PAY_SYSTEM_ID'] = $selectedPaySystem['ID'];
			$paymentFields['PAY_SYSTEM_NAME'] = $selectedPaySystem['NAME'];
		}
		$payment->setFields($paymentFields);

		$resultSaving = $order->save();
		if ($resultSaving->isSuccess())
		{
			Integration\Bitrix24Manager::getInstance()->increasePaymentsCount();
		}
		else
		{
			$this->errorCollection->add($resultSaving->getErrors());
		}

		return $resultSaving;
	}

	public function getOrder()
	{
		return $this->order;
	}

	public function getErrors()
	{
		return $this->errorCollection->toArray();
	}

	private function checkModules()
	{
		if (!Main\Loader::includeModule('crm'))
		{
			$this->errorCollection->setError(new Main\Error('module "crm" is not installed.'));
			return;
		}
		if (!Main\Loader::includeModule('catalog'))
		{
			$this->errorCollection->setError(new Main\Error('module "catalog" is not installed.'));
			return;
		}
		if (!Main\Loader::includeModule('sale'))
		{
			$this->errorCollection->setError(new Main\Error('module "sale" is not installed.'));
			return;
		}
		if(Integration\Bitrix24Manager::getInstance()->isPaymentsLimitReached())
		{
			$this->errorCollection->setError(new Main\Error('You have reached limit of payments for your tariff'));
			return;
		}
	}

	private function createResult()
	{
		return (new Main\Result())->addErrors($this->errorCollection->toArray());
	}

	/**
	 * @param array $formData
	 * @return Sale\Order
	 * @throws Main\ArgumentOutOfRangeException
	 */
	private function buildOrder(array $formData = [])
	{
		$settings =	[
			'createUserIfNeed' => Builder\SettingsContainer::SET_ANONYMOUS_USER,
			'acceptableErrorCodes' => [],
			'cacheProductProviderData' => true,
		];
		$builderSettings = new Builder\SettingsContainer($settings);
		$orderBuilder = new Crm\Order\OrderBuilderCrm($builderSettings);
		$director = new Builder\Director;

		/** @var Sale\Order $order */
		$order = $director->createOrder($orderBuilder, $formData);
		if (!$order)
		{
			$this->errorCollection->add($orderBuilder->getErrorsContainer()->getErrors());
		}

		return $order;
	}

	private function createProduct(array $fields)
	{
		if (empty($fields['CURRENCY']) || empty($fields['PRICE']))
			return null;

		$elementObject = new \CIBlockElement();

		$catalogIblockId = Main\Config\Option::get('crm', 'default_product_catalog_id');
		if (!$catalogIblockId)
			return null;

		$productId = $elementObject->Add([
			'NAME' => $fields['NAME'],
			'ACTIVE' => 'Y',
			'IBLOCK_ID' => $catalogIblockId
		]);

		if ((int)$productId <= 0)
			return null;

		$addFields = [
			'ID' => $productId,
			'QUANTITY_TRACE' => \Bitrix\Catalog\ProductTable::STATUS_DEFAULT,
			'CAN_BUY_ZERO' => \Bitrix\Catalog\ProductTable::STATUS_DEFAULT,
			'WEIGHT' => 0,
		];

		if (!empty($fields['MEASURE_CODE']))
		{
			$measureRaw = Catalog\MeasureTable::getList(array(
				'select' => array('ID'),
				'filter' => ['CODE' => $fields['MEASURE_CODE']],
				'limit' => 1
			));

			if ($measure = $measureRaw->fetch())
			{
				$addFields['MEASURE'] = $measure['ID'];
			}
		}

		if (
			Main\Config\Option::get('catalog', 'default_quantity_trace') === 'Y'
			&& Main\Config\Option::get('catalog', 'default_can_buy_zero') !== 'Y'
		)
		{
			$addFields['QUANTITY'] = $fields['QUANTITY'];
		}

		$r = Catalog\Model\Product::add($addFields);
		if (!$r->isSuccess())
			return null;

		\Bitrix\Catalog\MeasureRatioTable::add(array(
			'PRODUCT_ID' => $productId,
			'RATIO' => 1
		));

		$priceBaseGroup = \CCatalogGroup::GetBaseGroup();
		$r = Catalog\Model\Price::add([
			'PRODUCT_ID' => $productId,
			'CATALOG_GROUP_ID' => $priceBaseGroup['ID'],
			'CURRENCY' => $fields['CURRENCY'],
			'PRICE' => $fields['PRICE'],
		]);

		if (!$r->isSuccess())
			return null;

		return $productId;
	}

	private function getPersonTypeId($clientInfo)
	{
		Main\Loader::includeModule('sale');

		$searchCode = 'CRM_CONTACT';
		$businessValueDomain = Sale\BusinessValue::INDIVIDUAL_DOMAIN;
		if (!empty($clientInfo['COMPANY']))
		{
			$searchCode = 'CRM_COMPANY';
			$businessValueDomain = Sale\BusinessValue::ENTITY_DOMAIN;
		}

		$personTypeRaw = Sale\PersonType::getList([
			'filter' => [
				'CODE' => $searchCode,
				'ENTITY_REGISTRY_TYPE' => 'ORDER'
			],
			'select' => ['ID'],
			'limit' => 1
		]);
		if ($personType = $personTypeRaw->fetch())
		{
			return $personType['ID'];
		}

		$personTypeRaw = Sale\PersonType::getList([
			'filter' => [
				'ENTITY_REGISTRY_TYPE' => 'ORDER',
				'BIZVAL.DOMAIN' => $businessValueDomain,
			],
			'select' => ['ID'],
			'runtime' => array(
				new \Bitrix\Main\Entity\ReferenceField(
					'BIZVAL',
					'Bitrix\Sale\Internals\BusinessValuePersonDomainTable',
					array(
						'=this.ID' => 'ref.PERSON_TYPE_ID'
					),
					array('join_type' => 'LEFT')
				),
			),
			'limit' => 1
		]);
		if ($personType = $personTypeRaw->fetch())
		{
			return $personType['ID'];
		}

		return null;
	}

	/**
	 * Get url info by order.
	 *
	 * @param Sale\Order $order Order.
	 * @param array $urlParameters Url parameters.
	 * @return array|false
	 */
	public static function getUrlInfo(Sale\Order $order, array $urlParameters = [])
	{
		static $info = [];
		if(!isset($info[$order->getId()]))
		{
			$urlInfo = false;
			if(Integration\LandingManager::getInstance()->isOrderPublicUrlAvailable())
			{
				$urlParameters = [
						'orderId' => $order->getId(),
						'access' => $order->getHash()
					] + $urlParameters;

				$urlInfo = Integration\LandingManager::getInstance()->getOrderPublicUrlInfo($urlParameters);
			}
			$info[$order->getId()] = $urlInfo;
		}

		return $info[$order->getId()];
	}

	public static function prepareNewProductFields($item)
	{
		$newItem = [
			'QUANTITY' => (float)$item['quantity'] > 0 ? (float)$item['quantity'] : 1,
			'PRODUCT_PROVIDER_CLASS' => '',
			'SORT' => (int)$item['sort'],
			'PRODUCT_ID' => $item['productId'],
		];

		if ($item['module'] === 'catalog')
		{
			$newItem['MODULE'] = 'catalog';
			if ((float)$item['basePrice'] > 0.0)
			{
				$newItem['PRODUCT_PROVIDER_CLASS'] = Catalog\Product\Basket::getDefaultProviderName();
			}
		}

		if ($item['module'] !== 'catalog' || $item['isCustomPrice'] === 'Y' || (float)$item['basePrice'] === 0.0)
		{
			if (empty($newItem['PRODUCT_ID']))
			{
				$newItem['PRODUCT_ID'] = (int)$item['sort'] + 1;
			}
			$newItem['BASE_PRICE'] = $item['basePrice'];
			$newItem['PRICE'] = $newItem['BASE_PRICE'];
			$newItem['NAME'] = $item['name'];
			$newItem['SORT'] = $item['sort'];
			$newItem['CUSTOM_PRICE'] = 'Y';
			if (!empty($item['measureName']))
			{
				$newItem['MEASURE_NAME'] = $item['measureName'];
			}
			if (!empty($item['measureCode']))
			{
				$newItem['MEASURE_CODE'] = $item['measureCode'];
			}
		}

		return $newItem;
	}
}
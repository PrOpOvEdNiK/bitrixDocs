<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main,
	Bitrix\Main\Loader,
	Bitrix\Main\Localization\Loc,
	Bitrix\Sale,
	Bitrix\Rest,
	Bitrix\SalesCenter,
	Bitrix\SalesCenter\Integration\SaleManager,
	Bitrix\Main\Engine\Contract\Controllerable;

Loc::loadMessages(__FILE__);

/**
 * Class SalesCenterPaySystemPanel
 */
class SalesCenterPaySystemPanel extends CBitrixComponent implements Controllerable
{
	private const INTEGRATIONS_URL = 'https://integrations.bitrix24.site/';

	private const PAYSYSTEM_TITLE_LENGTH_LIMIT = 50;

	private const MARKETPLACE_CATEGORY_PAYMENT = "payment";

	private $paySystemPanelId = 'salescenter-paysystem';
	private $paySystemAppPanelId = 'salescenter-paysystem-app';

	private $mode;

	/**
	 * SalesCenterPaySystemPanel constructor.
	 * @param CBitrixComponent|null $component
	 * @param string $mode
	 */
	public function __construct(CBitrixComponent $component = null, $mode = "main")
	{
		parent::__construct($component);
		$this->mode = $mode;
	}

	/**
	 * @param $arParams
	 * @return array
	 */
	public function onPrepareComponentParams($arParams)
	{
		$arParams["SEF_FOLDER"] = !empty($arParams["SEF_FOLDER"]) ? $arParams["SEF_FOLDER"] : "/shop/settings/";
		$this->mode = (!empty($arParams["MODE"]) ? $arParams["MODE"] : "main");

		return parent::onPrepareComponentParams($arParams);
	}

	/**
	 * @return bool
	 */
	private function isMainMode(): bool
	{
		return $this->mode === "main";
	}

	/**
	 * @return mixed|void
	 * @throws Main\ArgumentException
	 * @throws Main\LoaderException
	 * @throws Main\SystemException
	 */
	public function executeComponent()
	{
		if (!Loader::includeModule('salescenter'))
		{
			$this->showError(Loc::getMessage('SPP_SALESCENTER_MODULE_ERROR'));
			return;
		}

		if (!Loader::includeModule('sale'))
		{
			$this->showError(Loc::getMessage('SPP_SALE_MODULE_ERROR'));
			return;
		}

		if(!SaleManager::getInstance()->isManagerAccess())
		{
			$this->showError(Loc::getMessage('SPP_ACCESS_DENIED'));
			return;
		}

		$this->prepareResult();

		$this->includeComponentTemplate();
	}

	/**
	 * @return array
	 * @throws Main\ArgumentException
	 * @throws Main\ArgumentNullException
	 * @throws Main\ArgumentOutOfRangeException
	 * @throws Main\IO\FileNotFoundException
	 * @throws Main\LoaderException
	 * @throws Main\ObjectPropertyException
	 * @throws Main\SystemException
	 */
	public function prepareResult(): array
	{
		$this->arResult["mode"] = $this->mode;
		$this->arResult["isMainMode"] = $this->isMainMode();

		// paysystem
		$paySystemItems = $this->getPaySystemItems();
		if ($this->isMainMode())
		{
			$paySystemItems = array_merge($paySystemItems, $this->getPaySystemExtraItem());
		}
		$this->arResult['paySystemPanelParams'] = [
			'id' => $this->paySystemPanelId,
			'items' => $paySystemItems,
		];

		// marketplace
		$marketplaceItems = array_merge(
			$this->getUserPaySystemItem(),
			$this->getPartnerItems(),
			$this->getActionboxItems(),
			$this->getIntegrationItems()
		);
		$this->arResult['paySystemAppPanelParams'] = [
			'id' => $this->paySystemAppPanelId,
			'items' => $marketplaceItems,
		];

		return $this->arResult;
	}

	/**
	 * @param $error
	 */
	private function showError($error)
	{
		ShowError($error);
	}

	/**
	 * @return array
	 */
	private function getPaySystemHandlers()
	{
		if ($this->isMainMode())
		{
			$fullList = [
				'cash' => [],
				'paypal' => [],
				'sberbankonline' => [],
				'qiwi' => [],
				'webmoney' => [],
				'yandexcheckout' => [
					'bank_card',
					'sberbank',
					'sberbank_sms',
					'alfabank',
					'yandex_money',
					'webmoney',
					'qiwi'
				],
				'uapay' => [],
				'liqpay' => [],
			];

			if(
				!SalesCenter\Integration\Bitrix24Manager::getInstance()->isEnabled()
				&& !SalesCenter\Integration\IntranetManager::getInstance()->isEnabled()
			)
			{
				return $fullList;
			}

			if (
				SalesCenter\Integration\Bitrix24Manager::getInstance()->isCurrentZone('ru')
				|| SalesCenter\Integration\IntranetManager::getInstance()->isCurrentZone('ru')
			)
			{
				return [
					'cash' => [],
					'paypal' => [],
					'sberbankonline' => [],
					'qiwi' => [],
					'webmoney' => [],
					'yandexcheckout' => [
						'bank_card',
						'sberbank',
						'sberbank_sms',
						'alfabank',
						'yandex_money',
						'webmoney',
						'qiwi'
					],
				];
			}

			if (
				SalesCenter\Integration\Bitrix24Manager::getInstance()->isCurrentZone('ua')
				|| SalesCenter\Integration\IntranetManager::getInstance()->isCurrentZone('ua')
			)
			{
				return [
					'cash' => [],
					'paypal' => [],
					'liqpay' => [],
					'uapay' => [],
				];
			}

			return [
				'cash' => [],
				'paypal' => [],
			];
		}
		else
		{
			$fullList = [
				'paypal' => [],
				'yandexcheckout' => [
					'yandex_money',
					'webmoney',
					'qiwi'
				],
				'liqpay' => [],
			];

			if (
				!SalesCenter\Integration\Bitrix24Manager::getInstance()->isEnabled()
				&& !SalesCenter\Integration\IntranetManager::getInstance()->isEnabled()
			)
			{
				return $fullList;
			}

			if (
				SalesCenter\Integration\Bitrix24Manager::getInstance()->isCurrentZone('ru')
				|| SalesCenter\Integration\IntranetManager::getInstance()->isCurrentZone('ru')
			)
			{
				return [
					'yandexcheckout' => [
						'yandex_money',
						'webmoney',
						'qiwi'
					],
					'paypal' => [],
				];
			}

			if (
				SalesCenter\Integration\Bitrix24Manager::getInstance()->isCurrentZone('ua')
				|| SalesCenter\Integration\IntranetManager::getInstance()->isCurrentZone('ua')
			)
			{
				return [
					'liqpay' => [],
					'paypal' => [],
				];
			}

			return [
				'paypal' => [],
			];
		}
	}

	/**
	 * @param $paySystemHandlers
	 * @return array
	 */
	private function getFilterForPaySystem($paySystemHandlers): array
	{
		$filter = $subFilter = [];
		foreach ($paySystemHandlers as $paySystemHandler => $paySystemMode)
		{
			if (empty($paySystemMode))
			{
				$subFilter[] = [
					'=ACTION_FILE' => $paySystemHandler,
				];
			}
			else
			{
				$subFilter[] = [
					'=ACTION_FILE' => $paySystemHandler,
					'=PS_MODE' => $paySystemMode,
				];
			}
		}

		if ($subFilter)
		{
			$filter = array_merge(['LOGIC' => 'OR'], $subFilter);
		}

		return $filter;
	}

	/**
	 * @return Main\Web\Uri
	 */
	private function getPaySystemComponentPath(): \Bitrix\Main\Web\Uri
	{
		$paySystemPath = \CComponentEngine::makeComponentPath('bitrix:salescenter.paysystem');
		$paySystemPath = getLocalPath('components'.$paySystemPath.'/slider.php');
		$paySystemPath = new \Bitrix\Main\Web\Uri($paySystemPath);

		return $paySystemPath;
	}

	/**
	 * @return array
	 * @throws Main\ArgumentException
	 * @throws Main\ArgumentNullException
	 * @throws Main\ArgumentOutOfRangeException
	 */
	private function getPaySystemItems(): array
	{
		if ($this->isMainMode())
		{
			$paySystemPanel = [
				'cash' => [],
				'sberbankonline' => [],
				'yandexcheckout' => [
					'bank_card',
					'sberbank',
					'sberbank_sms',
					'alfabank'
				],
				'uapay' => []
			];

			$paySystemColorList = [
				'cash' => '#8EB927',
				'paypal' => '#243B80',
				'sberbankonline' => '#2C9B47',
				'qiwi' => '#E9832C',
				'webmoney' => '#006FA8',
				'yandexcheckout' => [
					'alfabank' => '#EE2A23',
					'bank_card' => '#19D0C8',
					'yandex_money' => '#E10505',
					'sberbank' => '#327D36',
					'sberbank_sms' => '#327D36',
					'qiwi' => '#E9832C',
					'webmoney' => '#006FA8'
				],
				'liqpay' => '#7AB72B',
				'uapay' => '#E41F18',
			];

			$paySystemSortList = [
				'cash' => 100,
				'paypal' => 900,
				'sberbankonline' => 200,
				'qiwi' => 1400,
				'webmoney' => 1500,
				'yandexcheckout' => [
					'alfabank' => 1200,
					'bank_card' => 500,
					'yandex_money' => 1300,
					'sberbank' => 600,
					'sberbank_sms' => 700,
					'qiwi' => 1600,
					'webmoney' => 1700
				],
				'liqpay' => 1800,
				'uapay' => 2000
			];
		}
		else
		{
			$paySystemPanel = [
				'yandexcheckout' => [
					'yandex_money',
					'qiwi',
					'webmoney'
				],
				'paypal' => [],
				'liqpay' => [],
			];

			$paySystemColorList = [
				'qiwi' => '#E9832C',
				'paypal' => '#243B80',
				'webmoney' => '#006FA8',
				'yandexcheckout' => [
					'yandex_money' => '#E10505',
					'qiwi' => '#E9832C',
					'webmoney' => '#006FA8'
				],
				'liqpay' => '#7AB72B',
			];

			$paySystemSortList = [
				'paypal' => 2000,
				'yandexcheckout' => [
					'yandex_money' => 1300,
					'qiwi' => 1600,
					'webmoney' => 1700
				],
				'liqpay' => 2100
			];
		}

		$paySystemHandlerList = $this->getPaySystemHandlers();
		$filter = $this->getFilterForPaySystem($paySystemHandlerList);
		$paySystemIterator = Sale\PaySystem\Manager::getList([
			'select' => ['ID', 'ACTIVE', 'NAME', 'ACTION_FILE', 'PS_MODE'],
			'filter' => $filter,
		]);

		$paySystemActions = $paySystemList = [];
		foreach ($paySystemIterator as $paySystem)
		{
			$paySystemList[$paySystem['ACTION_FILE']][] = $paySystem;
		}

		foreach ($paySystemHandlerList as $paySystemHandler => $paySystemMode)
		{
			// check existence
			if (!$this->isPaySystemHandlerExist($paySystemHandler))
			{
				continue;
			}

			$paySystemItems = $paySystemList[$paySystemHandler] ?? false;
			if ($paySystemItems)
			{
				foreach ($paySystemItems as $paySystemItem)
				{
					$queryParams = [
						'lang' => LANGUAGE_ID,
						'publicSidePanel' => 'Y',
						'ID' => $paySystemItem['ID'],
						'ACTION_FILE' => $paySystemItem['ACTION_FILE'],
					];

					// ps_mode
					if(!empty($paySystemItem['PS_MODE']))
					{
						$queryParams["PS_MODE"] = $paySystemItem['PS_MODE'];

						foreach ($paySystemMode as $psMode)
						{
							if ($psMode === $paySystemItem['PS_MODE'])
							{
								if (!isset($paySystemActions[$paySystemItem['ACTION_FILE']]['ACTIVE'][$paySystemItem['PS_MODE']]))
								{
									$paySystemActions[$paySystemItem['ACTION_FILE']]['ACTIVE'][$paySystemItem['PS_MODE']] = false;
									$paySystemActions[$paySystemItem['ACTION_FILE']]['DELIMITER'][$paySystemItem['PS_MODE']] = false;
								}

								if ($paySystemItem['ACTIVE'] === 'Y')
								{
									$paySystemActions[$paySystemItem['ACTION_FILE']]['ACTIVE'][$paySystemItem['PS_MODE']] = true;
								}
								elseif($paySystemActions[$paySystemItem['ACTION_FILE']]['ACTIVE'][$paySystemItem['PS_MODE']] === true
									&& !$paySystemActions[$paySystemItem['ACTION_FILE']]['DELIMITER'][$paySystemItem['PS_MODE']]
								)
								{
									$paySystemActions[$paySystemItem['ACTION_FILE']]['ITEMS'][$paySystemItem['PS_MODE']][] = [
										'DELIMITER' => true,
									];
									$paySystemActions[$paySystemItem['ACTION_FILE']]['DELIMITER'][$paySystemItem['PS_MODE']] = true;
								}

								$paySystemActions[$paySystemItem['ACTION_FILE']]['PS_MODE'] = true;

								$paySystemPath = $this->getPaySystemComponentPath();
								$paySystemPath->addParams($queryParams);
								$paySystemActions[$paySystemItem['ACTION_FILE']]['ITEMS'][$paySystemItem['PS_MODE']][] = [
									'NAME' => Loc::getMessage('SPP_PAYSYSTEM_SETTINGS', [
										'#PAYSYSTEM_NAME#' => htmlspecialcharsbx($paySystemItem['NAME'])
									]),
									'LINK' => $paySystemPath->getLocator()
								];
							}
							else
							{
								if (!isset($paySystemActions[$paySystemHandler]['ITEMS'][$psMode]))
								{
									$paySystemActions[$paySystemHandler]['ITEMS'][$psMode] = [];
								}
							}
						}
					}
					else
					{
						if (!isset($paySystemActions[$paySystemItem['ACTION_FILE']]['ACTIVE']))
						{
							$paySystemActions[$paySystemItem['ACTION_FILE']]['ACTIVE'] = false;
							$paySystemActions[$paySystemItem['ACTION_FILE']]['DELIMITER'] = false;
						}

						if ($paySystemItem['ACTIVE'] === 'Y')
						{
							$paySystemActions[$paySystemItem['ACTION_FILE']]['ACTIVE'] = true;
						}
						elseif($paySystemActions[$paySystemItem['ACTION_FILE']]['ACTIVE'] === true
							&& !$paySystemActions[$paySystemItem['ACTION_FILE']]['DELIMITER']
						)
						{
							$paySystemActions[$paySystemItem['ACTION_FILE']]['ITEMS'][] = [
								'DELIMITER' => true,
							];
							$paySystemActions[$paySystemItem['ACTION_FILE']]['DELIMITER'] = true;
						}

						$paySystemActions[$paySystemItem['ACTION_FILE']]['PS_MODE'] = false;

						$paySystemPath = $this->getPaySystemComponentPath();
						$paySystemPath->addParams($queryParams);
						$paySystemActions[$paySystemItem['ACTION_FILE']]['ITEMS'][] = [
							'NAME' => Loc::getMessage('SPP_PAYSYSTEM_SETTINGS', [
								'#PAYSYSTEM_NAME#' => htmlspecialcharsbx($paySystemItem['NAME'])
							]),
							'LINK' => $paySystemPath->getLocator(),
						];
					}
				}
			}
			elseif (array_key_exists($paySystemHandler, $paySystemPanel))
			{
				$handlerModeList = $this->getHandlerModeList($paySystemHandler);
				if ($handlerModeList)
				{
					foreach ($paySystemMode as $psMode)
					{
						if (in_array($psMode, $handlerModeList))
						{
							$paySystemActions[$paySystemHandler]['PS_MODE'] = true;
							$paySystemActions[$paySystemHandler]['ACTIVE'][$psMode] = false;
							$paySystemActions[$paySystemHandler]['ITEMS'][$psMode] = [];
						}
					}
				}
				else
				{
					$paySystemActions[$paySystemHandler] = [
						'ACTIVE' => false,
						'PS_MODE' => false,
					];
				}
			}
		}

		if ($paySystemActions)
		{
			$paySystemActions = $this->getPaySystemMenu($paySystemActions);
		}

		$paySystemItems = [];
		foreach ($paySystemActions as $handler => $paySystem)
		{
			$queryParams = [
				'lang' => LANGUAGE_ID,
				'publicSidePanel' => 'Y',
				'CREATE' => 'Y',
			];

			$isActive = false;
			$title = Loc::getMessage('SPP_PAYSYSTEM_'.strtoupper($handler).'_TITLE');

			if (isset($paySystem["ITEMS"]))
			{
				$isPsMode = $paySystem['PS_MODE'];
				if ($isPsMode)
				{
					foreach ($paySystem['ITEMS'] as $psMode => $paySystemItem)
					{
						$type = $psMode;
						$isActive = $paySystemActions[$handler]['ACTIVE'][$psMode];
						if (!$isActive && (!in_array($psMode, $paySystemPanel[$handler])))
						{
							continue;
						}

						if (empty($paySystemItem) && (!in_array($psMode, $paySystemPanel[$handler])))
						{
							continue;
						}

						$title = Loc::getMessage('SPP_PAYSYSTEM_'.strtoupper($handler).'_'.strtoupper($psMode).'_TITLE');

						$queryParams["ACTION_FILE"] = $handler;
						$queryParams["PS_MODE"] = $psMode;
						$paySystemPath = $this->getPaySystemComponentPath();
						$paySystemPath->addParams($queryParams);

						$paySystemItems[] = [
							'id' => $handler.'_'.$psMode,
							'sort' => ($paySystemSortList[$handler][$psMode] ?? 100),
							'title' => $title,
							'image' => $this->getImagePath().$handler.'_'.$psMode.'.svg',
							'itemSelectedColor' => $paySystemColorList[$handler][$psMode],
							'itemSelected' => $isActive,
							'itemSelectedImage' => $this->getImagePath().$handler.'_'.$psMode.'_s.svg',
							'data' => [
								'type' => 'paysystem',
								'connectPath' => $paySystemPath->getLocator(),
								'menuItems' => $paySystemItem,
								'showMenu' => !empty($paySystemItem),
								'paySystemType' => $type,
							],
						];
					}
				}
				else
				{
					$isActive = $paySystemActions[$handler]['ACTIVE'];

					if (!$isActive && (!array_key_exists($handler, $paySystemPanel)))
					{
						continue;
					}
					$type = $handler;

					$queryParams["ACTION_FILE"] = $handler;
					$paySystemPath = $this->getPaySystemComponentPath();
					$paySystemPath->addParams($queryParams);

					$paySystemItems[] = [
						'id' => $handler,
						'sort' => ($paySystemSortList[$handler] ?? 100),
						'title' => $title,
						'image' => $this->getImagePath().$handler.'.svg',
						'itemSelectedColor' => $paySystemColorList[$handler],
						'itemSelected' => $isActive,
						'itemSelectedImage' => $this->getImagePath().$handler.'_s.svg',
						'data' => [
							'type' => 'paysystem',
							'connectPath' => $paySystemPath->getLocator(),
							'menuItems' => $paySystem['ITEMS'],
							'showMenu' => !empty($paySystem['ITEMS']),
							'paySystemType' => $type,
						],
					];
				}
			}
			else
			{
				$type = $handler;
				$queryParams["ACTION_FILE"] = $handler;
				$paySystemPath = $this->getPaySystemComponentPath();
				$paySystemPath->addParams($queryParams);

				$paySystemItems[] = [
					'id' => $handler,
					'sort' => ($paySystemSortList[$handler] ?? 100),
					'title' => $title,
					'image' => $this->getImagePath().$handler.'.svg',
					'itemSelectedColor' => $paySystemColorList[$handler],
					'itemSelected' => $isActive,
					'itemSelectedImage' => $this->getImagePath().$handler.'_s.svg',
					'data' => [
						'type' => 'paysystem',
						'connectPath' => $paySystemPath->getLocator(),
						'menuItems' => [],
						'showMenu' => false,
						'paySystemType' => $type,
					],
				];
			}
		}

		sortByColumn($paySystemItems, ["sort" => SORT_ASC]);

		return $paySystemItems;
	}

	/**
	 * @param $handler
	 * @return array
	 */
	private function getHandlerModeList($handler)
	{
		/** @var Sale\PaySystem\BaseServiceHandler $className */
		$className = Sale\PaySystem\Manager::getClassNameFromPath($handler);
		if (!class_exists($className))
		{
			$documentRoot = Main\Application::getDocumentRoot();
			$path = Sale\PaySystem\Manager::getPathToHandlerFolder($handler);
			$fullPath = $documentRoot.$path.'/handler.php';
			if ($path && Main\IO\File::isFileExists($fullPath))
			{
				require_once $fullPath;
			}
		}

		$handlerModeList = [];
		if (class_exists($className))
		{
			$handlerModeList = $className::getHandlerModeList();
			if ($handlerModeList)
			{
				$handlerModeList = array_keys($handlerModeList);
			}
		}

		return $handlerModeList;
	}

	/**
	 * @param array $paySystemActions
	 * @param array $additionalQueryParams
	 * @return array
	 */
	private function getPaySystemMenu(array $paySystemActions, $additionalQueryParams = []): array
	{
		$name = Loc::getMessage('SPP_PAYSYSTEM_ADD');

		foreach ($paySystemActions as $handler => $paySystems)
		{
			if (!$paySystems || empty($paySystems['ITEMS']))
			{
				continue;
			}

			$queryParams = [
				'lang' => LANGUAGE_ID,
				'publicSidePanel' => 'Y',
				'CREATE' => 'Y',
				'ACTION_FILE' => strtolower($handler)
			];
			if ($additionalQueryParams)
			{
				$queryParams = array_merge($queryParams, $additionalQueryParams);
			}

			if ($paySystems['PS_MODE'])
			{
				foreach ($paySystems['ITEMS'] as $psMode => $paySystem)
				{
					if (!$paySystem)
					{
						continue;
					}

					$queryParams['PS_MODE'] = $psMode;
					$paySystemPath = $this->getPaySystemComponentPath();
					$paySystemPath->addParams($queryParams);

					array_unshift($paySystemActions[$handler]['ITEMS'][$psMode],
						[
							'NAME' => $name,
							'LINK' => $paySystemPath->getLocator(),
						],
						[
							'DELIMITER' => true
						]
					);
				}
			}
			else
			{
				$paySystemPath = $this->getPaySystemComponentPath();
				$paySystemPath->addParams($queryParams);

				array_unshift($paySystemActions[$handler]['ITEMS'],
					[
						'NAME' => $name,
						'LINK' => $paySystemPath->getLocator(),
					],
					[
						'DELIMITER' => true
					]
				);
			}
		}

		return $paySystemActions;
	}

	/**
	 * @param $handler
	 * @return bool
	 * @throws Main\ArgumentNullException
	 * @throws Main\ArgumentOutOfRangeException
	 */
	private function isPaySystemHandlerExist($handler)
	{
		$handlerDirectories = Sale\PaySystem\Manager::getHandlerDirectories();
		if (Main\IO\File::isFileExists($_SERVER['DOCUMENT_ROOT'].$handlerDirectories['SYSTEM'].$handler.'/handler.php'))
		{
			return true;
		}

		return false;
	}

	/**
	 * @return array|mixed
	 * @throws \Bitrix\Main\ArgumentException
	 * @throws \Bitrix\Main\ArgumentNullException
	 * @throws \Bitrix\Main\ArgumentOutOfRangeException
	 */
	private function getYandexCheckoutEmbeddedPaySystem()
	{
		$paySystemPath = \CComponentEngine::makeComponentPath('bitrix:salescenter.paysystem');
		$paySystemPath = getLocalPath('components'.$paySystemPath.'/slider.php')."?";

		$handler = "yandexcheckout";
		$psMode = "embedded";

		$handlerModeList = $this->getHandlerModeList($handler);
		if (!in_array($psMode, $handlerModeList))
		{
			return [];
		}

		$paySystemIterator = Sale\PaySystem\Manager::getList([
			'select' => ['ID', 'ACTIVE', 'NAME', 'ACTION_FILE', 'PS_MODE'],
			'filter' => [
				'=ACTION_FILE' => $handler,
				'=PS_MODE' => $psMode,
			],
			'order' => ['ACTIVE' => 'DESC', 'ID' => 'ASC'],
		]);

		$paySystemActions = $paySystemList = [];
		foreach ($paySystemIterator as $paySystem)
		{
			$paySystemList[$paySystem['ACTION_FILE']][] = $paySystem;
		}


		if (!$this->isPaySystemHandlerExist($handler))
		{
			return [];
		}

		$paySystemItems = $paySystemList[$handler];
		if ($paySystemItems)
		{
			foreach ($paySystemItems as $paySystemItem)
			{
				$queryParams = [
					'lang' => LANGUAGE_ID,
					'publicSidePanel' => 'Y',
					'ID' => $paySystemItem['ID'],
					'ACTION_FILE' => $paySystemItem['ACTION_FILE'],
					'PS_MODE' => $paySystemItem['PS_MODE'],
				];

				if(!empty($paySystemItem['PS_MODE']))
				{
					if (!isset($paySystemActions[$paySystemItem['ACTION_FILE']]['ACTIVE'][$paySystemItem['PS_MODE']]))
					{
						$paySystemActions[$paySystemItem['ACTION_FILE']]['ACTIVE'][$paySystemItem['PS_MODE']] = false;
						$paySystemActions[$paySystemItem['ACTION_FILE']]['DELIMITER'][$paySystemItem['PS_MODE']] = false;
					}
					if ($paySystemItem['ACTIVE'] === 'Y')
					{
						$paySystemActions[$paySystemItem['ACTION_FILE']]['ACTIVE'][$paySystemItem['PS_MODE']] = true;
					}
					elseif($paySystemActions[$paySystemItem['ACTION_FILE']]['ACTIVE'][$paySystemItem['PS_MODE']] === true && !$paySystemActions[$paySystemItem['ACTION_FILE']]['DELIMITER'][$paySystemItem['PS_MODE']])
					{
						$paySystemActions[$paySystemItem['ACTION_FILE']]['ITEMS'][$paySystemItem['PS_MODE']][] = [
							'DELIMITER' => true,
						];
						$paySystemActions[$paySystemItem['ACTION_FILE']]['DELIMITER'][$paySystemItem['PS_MODE']] = true;
					}

					$paySystemActions[$paySystemItem['ACTION_FILE']]['PS_MODE'] = true;

					$link = $paySystemPath.http_build_query($queryParams);
					$paySystemActions[$paySystemItem['ACTION_FILE']]['ITEMS'][$paySystemItem['PS_MODE']][] = [
						'NAME' => Loc::getMessage('SPP_PAYSYSTEM_SETTINGS', [
							'#PAYSYSTEM_NAME#' => htmlspecialcharsbx($paySystemItem['NAME'])
						]),
						'LINK' => $link
					];
				}
			}
		}
		else
		{
			$handlerModeList = $this->getHandlerModeList($handler);
			if ($handlerModeList)
			{
				if (in_array($psMode, $handlerModeList))
				{
					$paySystemActions[$handler]['PS_MODE'] = true;
					$paySystemActions[$handler]['ACTIVE'][$psMode] = false;
					$paySystemActions[$handler]['ITEMS'][$psMode] = [];
				}
			}
			else
			{
				$paySystemActions[$handler] = [
					'ACTIVE' => false,
					'PS_MODE' => false,
				];
			}
		}

		$paySystemFinalActions = [];
		if ($paySystemActions)
		{
			$paySystemFinalActions = [
				"applepay" => $this->getPaySystemMenu($paySystemActions, ['EMBEDDED_TYPE' => 'applepay']),
				"googlepay" => $this->getPaySystemMenu($paySystemActions, ['EMBEDDED_TYPE' => 'googlepay']),
			];
		}

		$queryParams = [
			'lang' => LANGUAGE_ID,
			'publicSidePanel' => 'Y',
			'CREATE' => 'Y',
		];

		$isActive = $paySystemActions[$handler]['ACTIVE'][$psMode] ?? false;
		$menuItems = $paySystemActions[$handler]['ITEMS'][$psMode] ?? [];
		$showMenu = $menuItems ? true : false;

		$paySystemItems = [
			[
				'id' => $handler,
				'sort' => 2000,
				'title' => Loc::getMessage('SPP_PAYSYSTEM_YANDEXCHECKOUT_EMBEDDED_APPLEPAY_TITLE'),
				'image' => $this->getImagePath().'yandexcheckout_embedded_applepay.svg',
				'itemSelectedColor' => "#69809F",
				'itemSelected' => $isActive,
				'itemSelectedImage' => $this->getImagePath().'yandexcheckout_embedded_applepay_s.svg',
				'data' => [
					'type' => 'paysystem',
					'connectPath' => $paySystemPath.http_build_query(
							array_merge(
								$queryParams,
								[
									'ACTION_FILE' => $handler,
									'PS_MODE' => $psMode,
									'EMBEDDED_TYPE' => 'applepay',
								]
							)
						),
					'menuItems' => $paySystemFinalActions['applepay'][$handler]['ITEMS'][$psMode] ?? [],
					'showMenu' => $showMenu,
					'paySystemType' => $psMode,
					'additionalParams' => ['EMBEDDED_TYPE' => 'applepay'],
				],
			],
			[
				'id' => $handler,
				'sort' => 2100,
				'title' => Loc::getMessage('SPP_PAYSYSTEM_YANDEXCHECKOUT_EMBEDDED_GOOGLEPAY_TITLE'),
				'image' => $this->getImagePath().'yandexcheckout_embedded_googlepay.svg',
				'itemSelectedColor' => "#397CED",
				'itemSelected' => $isActive,
				'itemSelectedImage' => $this->getImagePath().'yandexcheckout_embedded_googlepay_s.svg',
				'data' => [
					'type' => 'paysystem',
					'connectPath' => $paySystemPath.http_build_query(
							array_merge(
								$queryParams,
								[
									'ACTION_FILE' => $handler,
									'PS_MODE' => $psMode,
									'EMBEDDED_TYPE' => 'googlepay',
								]
							)
						),
					'menuItems' => $paySystemFinalActions['googlepay'][$handler]['ITEMS'][$psMode] ?? [],
					'showMenu' => $showMenu,
					'paySystemType' => $psMode,
					'additionalParams' => ['EMBEDDED_TYPE' => 'googlepay'],
				],
			]
		];

		return $paySystemItems;
	}

	/**
	 * @return string
	 */
	private function getImagePath(): string
	{
		static $imagePath = '';
		if ($imagePath)
		{
			return $imagePath;
		}

		$componentPath = \CComponentEngine::makeComponentPath('bitrix:salescenter.paysystem.panel');
		$componentPath = getLocalPath('components'.$componentPath);

		$imagePath = $componentPath.'/templates/.default/images/';
		return $imagePath;
	}

	/**
	 * @return array
	 */
	private function getPaySystemExtraItem(): array
	{
		$paySystemPath = \CComponentEngine::makeComponentPath('bitrix:salescenter.paysystem.panel');
		$paySystemPath = getLocalPath('components'.$paySystemPath.'/slider.php');
		$paySystemPath = new \Bitrix\Main\Web\Uri($paySystemPath);
		$paySystemPath->addParams([
			'analyticsLabel' => 'salescenterClickPaymentTile',
			'type' => 'extra',
			'mode' => 'extra'
		]);

		return [
			[
				'id' => 'paysystem',
				'title' => Loc::getMessage('SPP_PAYSYSTEM_ITEM_EXTRA'),
				'image' => $this->getImagePath().'paysystem.svg',
				'selectedColor' => "#E8A312",
				'selected' => false,
				'selectedImage' => $this->getImagePath().'paysystem_s.svg',
				'data' => [
					'type' => 'paysystem_extra',
					'connectPath' => $paySystemPath->getLocator(),
				]
			]
		];
	}

	/**
	 * @return array
	 * @throws Main\ArgumentException
	 * @throws Main\ArgumentNullException
	 * @throws Main\ArgumentOutOfRangeException
	 * @throws Main\IO\FileNotFoundException
	 */
	private function getUserPaySystemItem(): array
	{
		$userHandlerList = $this->getUserHandlerList();
		$userPaySystemHandlers = $this->getUserPaySystemHandlers($userHandlerList);

		$filter = $this->getFilterForPaySystem($userPaySystemHandlers);
		$paySystemIterator = Sale\PaySystem\Manager::getList([
			'select' => ['ID', 'ACTIVE', 'NAME', 'ACTION_FILE', 'PS_MODE'],
			'filter' => $filter,
		]);

		$paySystemActions = $paySystemList = [];
		foreach ($paySystemIterator as $paySystem)
		{
			$paySystemList[$paySystem['ACTION_FILE']][] = $paySystem;
		}

		foreach ($userPaySystemHandlers as $paySystemHandler => $paySystemMode)
		{
			$paySystemItems = $paySystemList[$paySystemHandler] ?? false;
			if ($paySystemItems)
			{
				foreach ($paySystemItems as $paySystemItem)
				{
					$queryParams = [
						'lang' => LANGUAGE_ID,
						'publicSidePanel' => 'Y',
						'ID' => $paySystemItem['ID'],
						'ACTION_FILE' => $paySystemItem['ACTION_FILE'],
					];

					// ps_mode
					if(!empty($paySystemItem['PS_MODE']))
					{
						$queryParams["PS_MODE"] = $paySystemItem['PS_MODE'];

						foreach ($paySystemMode as $psMode)
						{
							if ($psMode === $paySystemItem['PS_MODE'])
							{
								if (!isset($paySystemActions[$paySystemItem['ACTION_FILE']]['ACTIVE'][$paySystemItem['PS_MODE']]))
								{
									$paySystemActions[$paySystemItem['ACTION_FILE']]['ACTIVE'][$paySystemItem['PS_MODE']] = false;
									$paySystemActions[$paySystemItem['ACTION_FILE']]['DELIMITER'][$paySystemItem['PS_MODE']] = false;
								}

								if ($paySystemItem['ACTIVE'] === 'Y')
								{
									$paySystemActions[$paySystemItem['ACTION_FILE']]['ACTIVE'][$paySystemItem['PS_MODE']] = true;
								}
								elseif($paySystemActions[$paySystemItem['ACTION_FILE']]['ACTIVE'][$paySystemItem['PS_MODE']] === true
									&& !$paySystemActions[$paySystemItem['ACTION_FILE']]['DELIMITER'][$paySystemItem['PS_MODE']]
								)
								{
									$paySystemActions[$paySystemItem['ACTION_FILE']]['ITEMS'][$paySystemItem['PS_MODE']][] = [
										'DELIMITER' => true,
									];
									$paySystemActions[$paySystemItem['ACTION_FILE']]['DELIMITER'][$paySystemItem['PS_MODE']] = true;
								}

								$paySystemActions[$paySystemItem['ACTION_FILE']]['PS_MODE'] = true;

								$paySystemPath = $this->getPaySystemComponentPath();
								$paySystemPath->addParams($queryParams);
								$paySystemActions[$paySystemItem['ACTION_FILE']]['ITEMS'][$paySystemItem['PS_MODE']][] = [
									'NAME' => Loc::getMessage('SPP_PAYSYSTEM_SETTINGS', [
										'#PAYSYSTEM_NAME#' => htmlspecialcharsbx($paySystemItem['NAME'])
									]),
									'LINK' => $paySystemPath->getLocator()
								];
							}
							else
							{
								if (!isset($paySystemActions[$paySystemHandler]['ITEMS'][$psMode]))
								{
									$paySystemActions[$paySystemHandler]['ITEMS'][$psMode] = [];
								}
							}
						}
					}
					else
					{
						if (!isset($paySystemActions[$paySystemItem['ACTION_FILE']]['ACTIVE']))
						{
							$paySystemActions[$paySystemItem['ACTION_FILE']]['ACTIVE'] = false;
							$paySystemActions[$paySystemItem['ACTION_FILE']]['DELIMITER'] = false;
						}

						if ($paySystemItem['ACTIVE'] === 'Y')
						{
							$paySystemActions[$paySystemItem['ACTION_FILE']]['ACTIVE'] = true;
						}
						elseif($paySystemActions[$paySystemItem['ACTION_FILE']]['ACTIVE'] === true
							&& !$paySystemActions[$paySystemItem['ACTION_FILE']]['DELIMITER']
						)
						{
							$paySystemActions[$paySystemItem['ACTION_FILE']]['ITEMS'][] = [
								'DELIMITER' => true,
							];
							$paySystemActions[$paySystemItem['ACTION_FILE']]['DELIMITER'] = true;
						}

						$paySystemActions[$paySystemItem['ACTION_FILE']]['PS_MODE'] = false;

						$paySystemPath = $this->getPaySystemComponentPath();
						$paySystemPath->addParams($queryParams);
						$paySystemActions[$paySystemItem['ACTION_FILE']]['ITEMS'][] = [
							'NAME' => Loc::getMessage('SPP_PAYSYSTEM_SETTINGS', [
								'#PAYSYSTEM_NAME#' => htmlspecialcharsbx($paySystemItem['NAME'])
							]),
							'LINK' => $paySystemPath->getLocator(),
						];
					}
				}
			}
			else
			{
				$handlerModeList = $this->getHandlerModeList($paySystemHandler);
				if ($handlerModeList)
				{
					foreach ($paySystemMode as $psMode)
					{
						if (in_array($psMode, $handlerModeList))
						{
							$paySystemActions[$paySystemHandler]['PS_MODE'] = true;
							$paySystemActions[$paySystemHandler]['ACTIVE'][$psMode] = false;
							$paySystemActions[$paySystemHandler]['ITEMS'][$psMode] = [];
						}
					}
				}
				else
				{
					$paySystemActions[$paySystemHandler] = [
						'ACTIVE' => false,
						'PS_MODE' => false,
					];
				}
			}
		}

		if ($paySystemActions)
		{
			$paySystemActions = $this->getPaySystemMenu($paySystemActions);
		}

		$paySystemItems = [];
		foreach ($paySystemActions as $handler => $paySystem)
		{
			$queryParams = [
				'lang' => LANGUAGE_ID,
				'publicSidePanel' => 'Y',
				'CREATE' => 'Y',
			];

			$isActive = false;
			$title = $userHandlerList[$handler]["name"];
			$title = $this->getFormattedTitle($title);

			$image = $this->getImagePath()."marketplace_default.svg";
			$selectedImage = $this->getImagePath()."marketplace_default_s.svg";

			if (isset($paySystem["ITEMS"]))
			{
				$isPsMode = $paySystem['PS_MODE'];
				if ($isPsMode)
				{
					foreach ($paySystem['ITEMS'] as $psMode => $paySystemItem)
					{
						$type = $psMode;
						$isActive = $paySystemActions[$handler]['ACTIVE'][$psMode];

						$title = "{$userHandlerList[$handler]["name"]}({$userHandlerList[$handler]["psMode"][$psMode]})";
						$title = $this->getFormattedTitle($title);

						$queryParams["ACTION_FILE"] = $handler;
						$queryParams["PS_MODE"] = $psMode;
						$paySystemPath = $this->getPaySystemComponentPath();
						$paySystemPath->addParams($queryParams);

						$paySystemItems[] = [
							'id' => $handler.'_'.$psMode,
							'sort' => ($paySystemSortList[$handler][$psMode] ?? 100),
							'title' => $title,
							'image' => $image,
							'itemSelectedColor' => "#56C472",
							'itemSelected' => $isActive,
							'itemSelectedImage' => $selectedImage,
							'data' => [
								'type' => 'paysystem',
								'connectPath' => $paySystemPath->getLocator(),
								'menuItems' => $paySystemItem,
								'showMenu' => !empty($paySystemItem),
								'paySystemType' => $type,
							],
						];
					}
				}
				else
				{
					$isActive = $paySystemActions[$handler]['ACTIVE'];
					$type = $handler;

					$queryParams["ACTION_FILE"] = $handler;
					$paySystemPath = $this->getPaySystemComponentPath();
					$paySystemPath->addParams($queryParams);

					$paySystemItems[] = [
						'id' => $handler,
						'sort' => ($paySystemSortList[$handler] ?? 100),
						'title' => $title,
						'image' => $image,
						'itemSelectedColor' => "#56C472",
						'itemSelected' => $isActive,
						'itemSelectedImage' => $selectedImage,
						'data' => [
							'type' => 'paysystem',
							'connectPath' => $paySystemPath->getLocator(),
							'menuItems' => $paySystem['ITEMS'],
							'showMenu' => !empty($paySystem['ITEMS']),
							'paySystemType' => $type,
						],
					];
				}
			}
			else
			{
				$type = $handler;
				$queryParams["ACTION_FILE"] = $handler;
				$paySystemPath = $this->getPaySystemComponentPath();
				$paySystemPath->addParams($queryParams);

				$paySystemItems[] = [
					'id' => $handler,
					'sort' => ($paySystemSortList[$handler] ?? 100),
					'title' => $title,
					'image' => $image,
					'itemSelectedColor' => "#56C472",
					'itemSelected' => $isActive,
					'itemSelectedImage' => $selectedImage,
					'data' => [
						'type' => 'paysystem',
						'connectPath' => $paySystemPath->getLocator(),
						'menuItems' => [],
						'showMenu' => false,
						'paySystemType' => $type,
					],
				];
			}
		}

		sortByColumn($paySystemItems, ["sort" => SORT_ASC]);

		return $paySystemItems;
	}

	/**
	 * @return array
	 * @throws Main\ArgumentNullException
	 * @throws Main\ArgumentOutOfRangeException
	 * @throws Main\IO\FileNotFoundException
	 */
	private function getUserHandlerList(): array
	{
		$userHandlerList = [];

		$handlerList = Sale\PaySystem\Manager::getHandlerList();
		if (isset($handlerList["USER"]))
		{
			$userHandlers = array_keys($handlerList["USER"]);
			foreach ($userHandlers as $key => $userHandler)
			{
				if (strpos($userHandler, 'quote_') !== false)
				{
					unset($userHandlers[$key]);
					continue;
				}

				$handlerDescription = Sale\PaySystem\Manager::getHandlerDescription($userHandler);
				if (empty($handlerDescription))
				{
					continue;
				}

				$userHandlerList[$userHandler] = [
					"name" => $handlerDescription["NAME"] ?? $handlerList["USER"]["$userHandler"],
				];

				/** @var Sale\PaySystem\BaseServiceHandler $handlerClass */
				$handlerClass = Sale\PaySystem\Manager::getClassNameFromPath($userHandler);
				if (!class_exists($handlerClass))
				{
					$documentRoot = Main\Application::getDocumentRoot();
					$path = Sale\PaySystem\Manager::getPathToHandlerFolder($userHandler);
					$fullPath = $documentRoot.$path.'/handler.php';
					if ($path && Main\IO\File::isFileExists($fullPath))
					{
						require_once $fullPath;
					}
				}

				if (class_exists($handlerClass) && ($psMode = $handlerClass::getHandlerModeList()))
				{
					$userHandlerList[$userHandler]["psMode"] = $psMode;
				}
			}
		}

		return $userHandlerList;
	}

	/**
	 * @param $userHandlerList
	 * @return array
	 */
	private function getUserPaySystemHandlers($userHandlerList): array
	{
		$userPaySystemHandlers = [];
		foreach ($userHandlerList as $userHandler => $userHandlerData)
		{
			$psMode = isset($userHandlerData["psMode"]) ? array_keys($userHandlerData["psMode"]) : [];
			$userPaySystemHandlers[$userHandler] = $psMode;
		}

		return $userPaySystemHandlers;
	}

	/**
	 * @return array
	 * @throws Main\SystemException
	 */
	private function getIntegrationItems(): array
	{
		$showAllItem = $this->getShowAllItem();
		$integrationItem = $this->getNeedIntegrationItem();

		return array_merge([$showAllItem], [$integrationItem]);
	}

	/**
	 * @return array
	 * @throws Main\ArgumentException
	 * @throws Main\LoaderException
	 * @throws Main\ObjectPropertyException
	 * @throws Main\SystemException
	 */
	private function getPartnerItems(): array
	{
		$installedApps = $this->getMarketplaceInstalledApps();
		$partnerItemCodeList = $this->getPartnerItemCodeList();
		$partnerItemCodeList = array_unique(array_merge(array_keys($installedApps), $partnerItemCodeList));

		$partnerItemList = [];
		foreach($partnerItemCodeList as $partnerItemCode)
		{
			if ($marketplaceApp = $this->getMarketplaceAppByCode($partnerItemCode))
			{
				$partnerItemList[] = [
					"id" => (array_key_exists($partnerItemCode, $installedApps)
						? $installedApps[$partnerItemCode]["ID"]
						: $marketplaceApp["ID"]
					),
					"title" => $this->getFormattedTitle($marketplaceApp["NAME"]),
					"image" => $this->getImagePath()."marketplace_default.svg",
					"itemSelected" => array_key_exists($partnerItemCode, $installedApps),
					"itemSelectedColor" => "#56C472",
					"itemSelectedImage" => $this->getImagePath()."marketplace_default_s.svg",
					"data" => [
						"type" => "marketplaceApp",
						"code" => $marketplaceApp["CODE"],
					],
				];
			}
		}

		return $partnerItemList;
	}

	/**
	 * @return array
	 */
	private function getPartnerItemCodeList(): array
	{
		$partnerItemCodeList = [];

		if(!SalesCenter\Integration\Bitrix24Manager::getInstance()->isEnabled())
		{
			if (LANGUAGE_ID === "en"
				|| LANGUAGE_ID === "br"
				|| LANGUAGE_ID === "la"
			)
			{
				$partnerItemCodeList = [
					"integrations24.mercadopago",
				];
			}
		}
		else
		{
			$com = SalesCenter\Integration\Bitrix24Manager::getInstance()->isCurrentZone('en');
			$latam = (SalesCenter\Integration\Bitrix24Manager::getInstance()->isCurrentZone('br')
				|| SalesCenter\Integration\Bitrix24Manager::getInstance()->isCurrentZone('la')
			);
			if ($com || $latam)
			{
				$partnerItemCodeList = [
					"integrations24.mercadopago",
				];
			}
		}

		return $partnerItemCodeList;
	}

	/**
	 * @return array
	 * @throws Main\ArgumentException
	 * @throws Main\LoaderException
	 * @throws Main\ObjectPropertyException
	 * @throws Main\SystemException
	 */
	private function getMarketplaceInstalledApps(): array
	{
		if(!Main\Loader::includeModule('rest'))
		{
			return [];
		}

		static $marketplaceInstalledApps = [];
		if(!empty($marketplaceInstalledApps))
		{
			return $marketplaceInstalledApps;
		}

		$marketplaceAppCodeList = $this->getMarketplaceAppCodeList();

		$appIterator = Rest\AppTable::getList([
			'select' => [
				'ID',
				'CODE',
			],
			'filter' => [
				'=CODE' => $marketplaceAppCodeList,
				'SCOPE' => '%pay_system%',
				'=ACTIVE' => 'Y',
			]
		]);
		while ($row = $appIterator->fetch())
		{
			$marketplaceInstalledApps[$row["CODE"]] = $row;
		}

		return $marketplaceInstalledApps;
	}

	/**
	 * @return array
	 * @throws Main\SystemException
	 */
	private function getMarketplaceAppCodeList(): array
	{
		$cacheTTL = 43200;
		$cacheId = 'salescenter_paysystem_app_rest_app_codes';
		$cachePath = '/salescenter/paysystem/app/rest_partners/';
		$cache = Main\Application::getInstance()->getCache();

		$appCodeList = [];
		if ($cache->initCache($cacheTTL, $cacheId, $cachePath))
		{
			$appCodeList = $cache->getVars();
		}
		else
		{
			$page = 1;
			do
			{
				$categoryItems = Rest\Marketplace\Client::getCategory(self::MARKETPLACE_CATEGORY_PAYMENT, $page, 100);
				if (!is_array($categoryItems))
				{
					break;
				}

				foreach ($categoryItems["ITEMS"] as $item)
				{
					$appCodeList[] = $item["CODE"];
				}
				$page++;
			}
			while((int)$categoryItems["PAGES"] !== (int)$categoryItems["CUR_PAGE"]);

			if ($appCodeList)
			{
				$cache->startDataCache();
				$cache->endDataCache($appCodeList);
			}
		}

		return $appCodeList;
	}

	/**
	 * @param string $code
	 * @return array
	 * @throws Main\SystemException
	 */
	private function getMarketplaceAppByCode(string $code): array
	{
		$cacheTTL = 43200;
		$cacheId = "salescenter_paysystem_app_rest_concrete_app";
		$cachePath = "/salescenter/paysystem/app/{$code}/";
		$cache = Main\Application::getInstance()->getCache();
		if($cache->initCache($cacheTTL, $cacheId, $cachePath))
		{
			$marketplaceApp = $cache->getVars();
		}
		else
		{
			$marketplaceApp = Rest\Marketplace\Client::getApp($code);
			if (isset($marketplaceApp["ITEMS"]))
			{
				$marketplaceApp = $marketplaceApp["ITEMS"];
			}

			if(isset($marketplaceApp["NAME"]))
			{
				$cache->startDataCache();
				$cache->endDataCache($marketplaceApp);
			}
		}

		return $marketplaceApp;
	}

	/**
	 * @return array
	 * @throws Main\SystemException
	 */
	private function getShowAllItem(): array
	{
		$paySystemAppsCount = $this->getMarketplaceAppsCount();
		return [
			'id' => 'counter',
			'title' => Loc::getMessage('SPP_PAYSYSTEM_APP_TOTAL_APPLICATIONS'),
			'data' => [
				'type' => 'counter',
				'connectPath' => "/marketplace/?category=".self::MARKETPLACE_CATEGORY_PAYMENT,
				'count' => $paySystemAppsCount,
				'description' => Loc::getMessage('SPP_PAYSYSTEM_APP_SEE_ALL'),
			],
		];
	}

	/**
	 * @return mixed
	 * @throws Main\SystemException
	 */
	private function getMarketplaceAppsCount()
	{
		$cacheTTL = 43200;
		$cacheId = 'salescenter_paysystem_app_rest_app_count';
		$cachePath = '/salescenter/paysystem/app/rest_partners/';
		$cache = Main\Application::getInstance()->getCache();

		if ($cache->initCache($cacheTTL, $cacheId, $cachePath))
		{
			$categoryItems = $cache->getVars();
		}
		else
		{
			$categoryItems = Rest\Marketplace\Client::getCategory(self::MARKETPLACE_CATEGORY_PAYMENT, 0, 1);
			if (is_array($categoryItems))
			{
				$cache->startDataCache();
				$cache->endDataCache($categoryItems);
			}
		}

		return $categoryItems['PAGES'] ?? 0;
	}

	/**
	 * @return array
	 */
	private function getNeedIntegrationItem(): array
	{
		$integrationsUrl = static::INTEGRATIONS_URL;
		if (Main\Context::getCurrent()->getLanguage() !== 'en')
		{
			$integrationsUrl .= Main\Context::getCurrent()->getLanguage() . '/';
		}

		return [
			'id' => 'integration',
			'data' => [
				'type' => 'integration',
				'url' => $integrationsUrl,
				'description' => Loc::getMessage('SPP_PAYSYSTEM_APP_INTEGRATION_REQUIRED'),
			],
		];
	}

	/**
	 * @return array
	 */
	private function getActionboxItems(): array
	{
		$dynamicItems = [];
		$userLang = LANGUAGE_ID ?? 'en';

		$cacheTTL = 86400;
		$cacheId = 'scActionsRest' . $userLang;
		$cachePath = 'restItems';
		$cache = Main\Data\Cache::createInstance();

		if ($cache->InitCache($cacheTTL, $cacheId, $cachePath))
		{
			$res = $cache->GetVars();

			if (is_array($res) && (count($res) > 0))
			{
				$dynamicItems = $res;
			}
		}

		if (count($dynamicItems) <= 0)
		{
			$marketplace = new Rest\Marketplace\MarketplaceActions();
			$restItems = $marketplace->getItems('salecenter', $userLang);

			if (!empty($restItems) && count($restItems) > 0)
			{
				$dynamicItems = $this->prepareRestItems($restItems);
				if ($dynamicItems !== null)
				{
					$cache->startDataCache($cacheTTL, $cacheId, $cachePath);
					$cache->endDataCache($dynamicItems);
				}
			}
		}

		return $dynamicItems;
	}

	/**
	 * @param $items
	 * @return array
	 */
	private function prepareRestItems($items): array
	{
		$result = [];

		if (is_array($items))
		{
			foreach ($items as $item)
			{
				if ($item['SLIDER'] === "Y")
				{
					preg_match("/^(http|https|ftp):\/\/(([A-Z0-9][A-Z0-9_-]*)(\.[A-Z0-9][A-Z0-9_-]*)+)/i", $item['HANDLER'])
						? $handler = 'landing'
						: $handler = 'marketplace';
				}
				else
				{
					$handler = 'anchor';
				}

				$result[] = [
					'title' => $item['NAME'],
					'image' => $item['IMAGE'],
					'outerImage' => true,
					'itemSelected' => false,
					'data' => [
						'type' => 'actionbox',
						'showMenu' => false,
						'move' => $item['HANDLER'],
						'handler' => $handler,
					],
				];
			}
		}

		return $result;
	}

	/**
	 * @param $title
	 * @return string
	 */
	private function getFormattedTitle($title): string
	{
		if (strlen($title) > self::PAYSYSTEM_TITLE_LENGTH_LIMIT)
		{
			$title = substr($title, 0, self::PAYSYSTEM_TITLE_LENGTH_LIMIT - 3)."...";
		}

		return $title;
	}

	/**
	 * @inheritDoc
	 */
	public function configureActions()
	{
		return [];
	}
}
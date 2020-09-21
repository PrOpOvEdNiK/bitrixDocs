<?php

namespace Bitrix\Fileman\UserField\Types;

use Bitrix\Bitrix24\RestrictionCounter;
use Bitrix\Main\ArgumentNullException;
use Bitrix\Main\ArgumentOutOfRangeException;
use Bitrix\Main\Config\Option;
use Bitrix\Main\Loader;
use Bitrix\Main\LoaderException;
use Bitrix\Main\Localization\Loc;
use CUserTypeManager;
use Bitrix\Main\UserField\Types\BaseType;

Loc::loadMessages(__FILE__);

/**
 * Class AddressType
 * @package Bitrix\Fileman\UserField\Types
 */
class AddressType extends BaseType
{
	public const
		USER_TYPE_ID = 'address',
		RENDER_COMPONENT = 'bitrix:fileman.field.address',
		BITRIX24_RESTRICTION = 100,
		BITRIX24_RESTRICTION_CODE = 'uf_address';

	protected static $restrictionCount = null;

	public static function getDescription(): array
	{
		return [
			'DESCRIPTION' => Loc::getMessage('USER_TYPE_ADDRESS_DESCRIPTION'),
			'BASE_TYPE' => CUserTypeManager::BASE_TYPE_STRING,
		];
	}

	/**
	 * @return string|null
	 * @throws ArgumentNullException
	 * @throws ArgumentOutOfRangeException
	 * @throws LoaderException
	 */
	public static function getApiKey(): ?string
	{
		$apiKey = Option::get('fileman', 'google_map_api_key', '');
		if(Loader::includeModule('bitrix24') && \CBitrix24::isCustomDomain())
		{
			$apiKey = null;
			$key = Option::get('bitrix24', 'google_map_api_key', '');
			$keyHost = Option::get('bitrix24', 'google_map_api_key_host', '');
			if($keyHost === BX24_HOST_NAME)
			{
				$apiKey = $key;
			}
		}

		return $apiKey;
	}

	public static function getApiKeyHint(): string
	{
		$hint = '';
		if(static::getApiKey() === null)
		{
			if(Loader::includeModule('bitrix24'))
			{
				if(\CBitrix24::isCustomDomain())
				{
					$hint = Loc::getMessage(
						'USER_TYPE_ADDRESS_NO_KEY_HINT_B24',
						['#settings_path#' => \CBitrix24::PATH_CONFIGS]
					);
				}
			}
			else
			{
				if(defined('ADMIN_SECTION') && ADMIN_SECTION === true)
				{
					$settingsPath = '/bitrix/admin/settings.php?lang=' . LANGUAGE_ID . '&mid=fileman';
				}
				else
				{
					$settingsPath = SITE_DIR . 'configs/';
				}

				if(
					!file_exists($_SERVER['DOCUMENT_ROOT'] . $settingsPath)
					||
					!is_dir($_SERVER['DOCUMENT_ROOT'] . $settingsPath)
				)
				{
					$settingsPath = SITE_DIR . 'settings/configs/';
				}

				$hint = Loc::getMessage(
					'USER_TYPE_ADDRESS_NO_KEY_HINT',
					['#settings_path#' => $settingsPath]
				);
			}
		}

		return $hint;
	}

	/**
	 * @return array|null
	 */
	public static function getTrialHint(): ?array
	{
		if(static::useRestriction() && !static::checkRestriction())
		{
			\CBitrix24::initLicenseInfoPopupJS(static::BITRIX24_RESTRICTION_CODE);

			return [
				Loc::getMessage('USER_TYPE_ADDRESS_TRIAL_TITLE'),
				Loc::getMessage('USER_TYPE_ADDRESS_TRIAL')
			];
		}

		return null;
	}

	/**
	 * @return bool
	 * @throws ArgumentNullException
	 * @throws ArgumentOutOfRangeException
	 * @throws LoaderException
	 */
	public static function canUseMap(): bool
	{
		return (static::getApiKey() !== null && static::checkRestriction());
	}

	/**
	 * @return bool
	 * @throws LoaderException
	 */
	public static function checkRestriction(): bool
	{
		if(
			static::useRestriction()
			&&
			static::$restrictionCount === null
			&&
			Loader::includeModule('bitrix24')
		)
		{
			static::$restrictionCount = RestrictionCounter::get(static::BITRIX24_RESTRICTION_CODE);
		}

		return (static::$restrictionCount < static::BITRIX24_RESTRICTION);
	}

	/**
	 * @return bool
	 * @throws LoaderException
	 */
	public static function useRestriction(): bool
	{
		return (
			Loader::includeModule('bitrix24')
			&&
			!\CBitrix24::IsLicensePaid()
			&&
			!\CBitrix24::IsNfrLicense()
			&&
			!\CBitrix24::IsDemoLicense()
		);
	}

	public static function getDbColumnType(): string
	{
		return 'text';
	}

	public static function prepareSettings(array $userField): array
	{
		return [
			'SHOW_MAP' => ($userField['SETTINGS']['SHOW_MAP'] === 'N' ? 'N' : 'Y')
		];
	}

	public static function checkFields(array $userField, $value): array
	{
		return [];
	}

	/**
	 * @param array $userField
	 * @param $value
	 * @return string|null
	 * @throws LoaderException
	 */
	public static function onBeforeSave(array $userField, $value)
	{
		if(
			$value !== ''
			&&
			static::useRestriction()
			&&
			static::checkRestriction()
			&&
			strpos($value, '|') >= 0
		)
		{
			if($userField['MULTIPLE'] === 'Y')
			{
				$increment = (!is_array($userField['VALUE']) || !in_array($value, $userField['VALUE']));
			}
			else
			{
				$increment = ($userField['VALUE'] !== $value);
			}

			if($increment && Loader::includeModule('bitrix24'))
			{
				RestrictionCounter::increment(static::BITRIX24_RESTRICTION_CODE);
			}
		}

		return $value;
	}

	/**
	 * @param string|null $value
	 * @return array
	 */
	public static function parseValue(?string $value):array
	{
		$coords = '';
		if(strpos($value, '|') !== false)
		{
			list($value, $coords) = explode('|', $value);
			if($coords !== '' && strpos($coords, ';') !== false)
			{
				$coords = explode(';', $coords);
			}
			else
			{
				$coords = '';
			}
		}

		return [$value, $coords];
	}





	/**
	 * @param null|array $userField
	 * @param array $additionalSettings
	 * @return array
	 */
	public static function getFilterData(?array $userField, array $additionalSettings): array
	{
		return [
			'id' => $additionalSettings['ID'],
			'name' => $additionalSettings['NAME'],
			'filterable' => ''
		];
	}


	/**
	 * This function should return a representation of the field value for the search.
	 * It is called from the OnSearchIndex method of the object $ USER_FIELD_MANAGER,
	 * which is also called the update function of the entity search index.
	 * For multiple values, the VALUE field is an array.
	 * @param array $userField
	 * @return string|null
	 */
	public static function onSearchIndex(array $userField): ?string
	{
		if(is_array($userField['VALUE']))
		{
			$result = implode('\r\n', $userField['VALUE']);
		}
		else
		{
			$result = $userField['VALUE'];
		}

		return $result;
	}

	//<editor-fold desc="Events and methods..."  defaultstate="collapsed">
	/**
	 * You can register the onBeforeGetPublicView event handler
	 * and customize the display by manipulating the metadata of a custom property.
	 * \Bitrix\Main\EventManager::getInstance()->addEventHandler(
	 * 'main',
	 * 'onBeforeGetPublicView',
	 * array('CUserTypeString', 'onBeforeGetPublicView')
	 * );
	 * You can do the same for editing:
	 * onBeforeGetPublicEdit (EDIT_COMPONENT_NAME è EDIT_COMPONENT_TEMPLATE)
	 */
	/*
		public static function onBeforeGetPublicView($event)
		{
			$params = $event->getParameters();
			$arUserField = &$params[0];
			$arAdditionalParameters = &$params[1];
			if ($arUserField['USER_TYPE_ID'] == 'string')
			{
				$arUserField['VIEW_COMPONENT_NAME'] = 'my:system.field.view';
				$arUserField['VIEW_COMPONENT_TEMPLATE'] = 'string';
			}
		}
	*/

	/**
	 * You can register the onGetPublicView event handler
	 * and display the property as you need.
	 * \Bitrix\Main\EventManager::getInstance()->addEventHandler(
	 * 'main',
	 * 'onGetPublicView',
	 * array('CUserTypeString', 'onGetPublicView')
	 * );
	 * You can do the same for editing: onGetPublicEdit
	 */
	/*
		public static function onGetPublicView($event)
		{
			$params = $event->getParameters();
			$arUserField = $params[0];
			$arAdditionalParameters = $params[1];
			if ($arUserField['USER_TYPE_ID'] == 'string')
			{
				$html = 'demo string';
				return new \Bitrix\Main\EventResult(\Bitrix\Main\EventResult::SUCCESS, $html);
			}
		}
	*/

	/**
	 * You can register the onAfterGetPublicView event handler
	 * and modify the html before displaying it.
	 * \Bitrix\Main\EventManager::getInstance()->addEventHandler(
	 * 'main',
	 * 'onAfterGetPublicView',
	 * array('CUserTypeString', 'onAfterGetPublicView')
	 * );
	 * You can do the same for editing: onAfterGetPublicEdit
	 */
	/*
		public static function onAfterGetPublicView($event)
		{
			$params = $event->getParameters();
			$arUserField = $params[0];
			$arAdditionalParameters = $params[1];
			$html = &$params[2];
			if ($arUserField['USER_TYPE_ID'] == 'string')
			{
				$html .= '!';
			}
		}
	*/

	/**
	 * This function is called before storing the values in the database.
	 * Called from the Update method of the $ USER_FIELD_MANAGER object.
	 * For multiple values, the function is called several times.
	 * @param array $arUserField
	 * @param $value
	 * @return string
	 */
	/*	static function OnBeforeSave($arUserField, $value)
	{
		if(strlen($value)>0)
			return ''.round(doubleval($value), $arUserField['SETTINGS']['PRECISION']);
	}*/
	//</editor-fold>
}
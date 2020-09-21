<?php

namespace Bitrix\Main\UserField\Types;

use Bitrix\Main\Localization\Loc;
use CUserTypeManager;

Loc::loadMessages(__FILE__);

/**
 * Class DoubleType
 * @package Bitrix\Main\UserField\Types
 */
class DoubleType extends BaseType
{
	public const
		USER_TYPE_ID = 'double',
		RENDER_COMPONENT = 'bitrix:main.field.double';

	/**
	 * @return array
	 */
	public static function getDescription(): array
	{
		return [
			'DESCRIPTION' => GetMessage('USER_TYPE_DOUBLE_DESCRIPTION'),
			'BASE_TYPE' => CUserTypeManager::BASE_TYPE_DOUBLE,
		];
	}

	/**
	 * @return string
	 */
	public static function getDbColumnType(): string
	{
		return 'double';
	}

	/**
	 * @param array $userField
	 * @return array
	 */
	public static function prepareSettings(array $userField): array
	{
		$prec = (int)$userField['SETTINGS']['PRECISION'];
		$size = (int)$userField['SETTINGS']['SIZE'];
		$min = (double)$userField['SETTINGS']['MIN_VALUE'];
		$max = (double)$userField['SETTINGS']['MAX_VALUE'];

		return [
			'PRECISION' => ($prec < 0 ? 0 : ($prec > 12 ? 12 : $prec)),
			'SIZE' => ($size <= 1 ? 20 : ($size > 255 ? 225 : $size)),
			'MIN_VALUE' => $min,
			'MAX_VALUE' => $max,
			'DEFAULT_VALUE' => (
			strlen($userField['SETTINGS']['DEFAULT_VALUE']) > 0 ?
				(double)$userField['SETTINGS']['DEFAULT_VALUE'] : ''
			)
		];
	}

	/**
	 * @param array|null $userField
	 * @param array $additionalSettings
	 * @return array
	 */
	public static function getFilterData(?array $userField, array $additionalSettings): array
	{
		return [
			'id' => $additionalSettings['ID'],
			'name' => $additionalSettings['NAME'],
			'type' => 'number',
			'filterable' => ''
		];
	}

	/**
	 * @param array $userField
	 * @param string|array $value
	 * @return array
	 */
	public static function checkFields(array $userField, $value): array
	{
		$msg = [];

		$value = str_replace([',', ' '], ['.', ''], $value);

		if(
			strlen($value) > 0 &&
			$userField['SETTINGS']['MIN_VALUE'] != 0 &&
			(double)$value < $userField['SETTINGS']['MIN_VALUE']
		)
		{
			$msg[] = [
				'id' => $userField['FIELD_NAME'],
				'text' => GetMessage(
					'USER_TYPE_DOUBLE_MIN_VALUE_ERROR',
					[
						'#FIELD_NAME#' => $userField['EDIT_FORM_LABEL'],
						'#MIN_VALUE#' => $userField['SETTINGS']['MIN_VALUE']
					]
				)
			];
		}
		if(
			strlen($value) > 0 &&
			$userField['SETTINGS']['MAX_VALUE'] <> 0 &&
			(double)$value > $userField['SETTINGS']['MAX_VALUE']
		)
		{
			$msg[] = [
				'id' => $userField['FIELD_NAME'],
				'text' => GetMessage(
					'USER_TYPE_DOUBLE_MAX_VALUE_ERROR',
					[
						'#FIELD_NAME#' => $userField['EDIT_FORM_LABEL'],
						'#MAX_VALUE#' => $userField['SETTINGS']['MAX_VALUE']
					]
				),
			];
		}
		return $msg;
	}

	/**
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

	/**
	 * @param array $userField
	 * @param $value
	 * @return string|null
	 */
	public static function onBeforeSave(array $userField, $value)
	{
		$value = str_replace([',', ' '], ['.', ''], $value);
		if(strlen($value))
		{
			return round((double)$value, $userField['SETTINGS']['PRECISION']);
		}
		return null;
	}

}
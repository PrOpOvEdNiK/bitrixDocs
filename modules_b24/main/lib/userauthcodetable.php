<?php
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2020 Bitrix
 */

namespace Bitrix\Main;

use Bitrix\Main\ORM\Query\Join;
use Bitrix\Main\ORM\Data;
use Bitrix\Main\ORM\Fields;

class UserAuthCodeTable extends Data\DataManager
{
	const TYPE_EMAIL = 'email';

	public static function getTableName()
	{
		return 'b_user_auth_code';
	}

	public static function getMap()
	{
		return array(
			new Fields\IntegerField("USER_ID", array(
				'primary' => true,
			)),

			new Fields\StringField("CODE_TYPE", array(
				'default_value' => self::TYPE_EMAIL,
				'primary' => true,
			)),

			new Fields\SecretField("OTP_SECRET", array(
				'crypto_enabled' => static::cryptoEnabled("OTP_SECRET"),
			)),

			new Fields\IntegerField("ATTEMPTS", array(
				"default_value" => 0,
			)),

			new Fields\DatetimeField("DATE_SENT"),

			(new Fields\Relations\Reference(
				'USER',
				UserTable::class,
				Join::on('this.USER_ID', 'ref.ID')
			))->configureJoinType('inner'),
		);
	}
}

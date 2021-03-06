<?php
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage sender
 * @copyright 2001-2021 Bitrix
 */

namespace Bitrix\Sender\Access\Permission;

use Bitrix\Main\Access\Permission\AccessPermissionTable;
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

/**
 * Class PermissionTable
 *
 * DO NOT WRITE ANYTHING BELOW THIS
 *
 * <<< ORMENTITYANNOTATION
 * @method static EO_Permission_Query query()
 * @method static EO_Permission_Result getByPrimary($primary, array $parameters = array())
 * @method static EO_Permission_Result getById($id)
 * @method static EO_Permission_Result getList(array $parameters = array())
 * @method static EO_Permission_Entity getEntity()
 * @method static \Bitrix\Sender\Access\Permission\EO_Permission createObject($setDefaultValues = true)
 * @method static \Bitrix\Sender\Access\Permission\EO_Permission_Collection createCollection()
 * @method static \Bitrix\Sender\Access\Permission\EO_Permission wakeUpObject($row)
 * @method static \Bitrix\Sender\Access\Permission\EO_Permission_Collection wakeUpCollection($rows)
 */
class PermissionTable extends AccessPermissionTable
{
	/**
	 * Get table name.
	 * @return string
	 */
	public static function getTableName()
	{
		return 'b_sender_permission';
	}
}
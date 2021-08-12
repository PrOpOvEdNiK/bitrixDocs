<?php
class CCrmFieldInfoAttr
{
	public const Undefined = '';
	public const Hidden = 'HID'; // Field is not accessible via REST service and skipped in merge
	public const NotDisplayed = 'N-D'; // Field is not displayed in a component
	public const ReadOnly = 'R-O';
	public const Immutable = 'IM'; //User can define field value only on create
	public const UserPKey = 'UPK'; //User defined primary key (currency alpha code for example)
	public const Required = 'REQ';
	public const Multiple = 'MUL';
	public const Dynamic = 'DYN';
	public const Deprecated = 'DEP';
	public const Progress = 'PROG'; //It is progress field (for example: STAGE_ID in Deal)
	public const HasDefaultValue = 'HAS_DEFAULT_VALUE';
	public const AutoGenerated = 'AUTO_GENERATED';
	public const Unique = 'UNIQUE';
	public const CanNotBeEmptied = 'CAN_NOT_BE_EMPTIED'; // If a user saves an empty field value on an existing item, the previous field value is set

	public static function isFieldHasAttribute(array $field, string $attribute): bool
	{
		if(isset($field['ATTRIBUTES']) && is_array($field['ATTRIBUTES']))
		{
			return in_array($attribute, $field['ATTRIBUTES'], true);
		}

		return false;
	}

	public static function isFieldReadOnly(array $field): bool
	{
		return static::isFieldHasAttribute($field, static::ReadOnly);
	}

	public static function isFieldMultiple(array $field): bool
	{
		return static::isFieldHasAttribute($field, static::Multiple);
	}
}

<?php
namespace Bitrix\Crm\Automation\Trigger;

Use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

class VisitTrigger extends BaseTrigger
{
	public static function isSupported($entityTypeId)
	{
		return $entityTypeId !== \CCrmOwnerType::Quote ? parent::isSupported($entityTypeId) : false;
	}

	protected static function areDynamicTypesSupported(): bool
	{
		return false;
	}

	public static function isEnabled()
	{
		return \Bitrix\Crm\Activity\Provider\Visit::isAvailable();
	}

	public static function getCode()
	{
		return 'VISIT';
	}

	public static function getName()
	{
		return Loc::getMessage('CRM_AUTOMATION_TRIGGER_VISIT_NAME');
	}
}
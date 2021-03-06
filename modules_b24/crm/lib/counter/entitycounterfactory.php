<?php
namespace Bitrix\Crm\Counter;
use Bitrix\Main;

class EntityCounterFactory
{
	const TOTAL_COUNTER = 'crm_all';
	public const NO_ORDERS_COUNTER = 'crm_all_no_orders';
	static public function isEntityTypeSupported($entityTypeID)
	{
		if(!is_int($entityTypeID))
		{
			$entityTypeID = (int)$entityTypeID;
		}

		return $entityTypeID === \CCrmOwnerType::Deal
			|| $entityTypeID === \CCrmOwnerType::Lead
			|| $entityTypeID === \CCrmOwnerType::Contact
			|| $entityTypeID === \CCrmOwnerType::Company
			|| $entityTypeID === \CCrmOwnerType::Order;
	}

	static public function createNamed($code, $userID = 0)
	{
		if($code === self::TOTAL_COUNTER)
		{
			return new AggregateCounter(
				$code,
				array(
					array('entityTypeID' => \CCrmOwnerType::Lead, 'counterTypeID' => EntityCounterType::ALL),
					array('entityTypeID' => \CCrmOwnerType::Contact, 'counterTypeID' => EntityCounterType::ALL),
					array('entityTypeID' => \CCrmOwnerType::Company, 'counterTypeID' => EntityCounterType::ALL),
					array('entityTypeID' => \CCrmOwnerType::Deal, 'counterTypeID' => EntityCounterType::ALL),
					array('entityTypeID' => \CCrmOwnerType::Order, 'counterTypeID' => EntityCounterType::ALL)
				),
				$userID
			);
		}
		elseif ($code === self::NO_ORDERS_COUNTER)
		{
			return new AggregateCounter(
				$code,
				[
					[
						'entityTypeID' => \CCrmOwnerType::Lead,
						'counterTypeID' => EntityCounterType::ALL
					],
					[
						'entityTypeID' => \CCrmOwnerType::Contact,
						'counterTypeID' => EntityCounterType::ALL
					],
					[
						'entityTypeID' => \CCrmOwnerType::Company,
						'counterTypeID' => EntityCounterType::ALL
					],
					[
						'entityTypeID' => \CCrmOwnerType::Deal,
						'counterTypeID' => EntityCounterType::ALL
					],
				],
				$userID
			);
		}

		return null;
	}

	static public function create($entityTypeID, $typeID, $userID = 0, array $extras = null)
	{
		if(!is_int($entityTypeID))
		{
			$entityTypeID = (int)$entityTypeID;
		}

		if(!\CCrmOwnerType::IsDefined($entityTypeID))
		{
			throw new Main\ArgumentOutOfRangeException('entityTypeID',
				\CCrmOwnerType::FirstOwnerType,
				\CCrmOwnerType::LastOwnerType
			);
		}

		if($entityTypeID === \CCrmOwnerType::Deal)
		{
			return new DealCounter($typeID, $userID, $extras);
		}
		elseif($entityTypeID === \CCrmOwnerType::Activity)
		{
			return new ActivityCounter($typeID, $userID, $extras);
		}

		return new EntityCounter($entityTypeID, $typeID, $userID, $extras);
	}

	public static function createCallTrackerCounter(int $userId = 0): EntityCounter
	{
		return new CallTrackerActivityCounter(\Bitrix\Crm\Counter\EntityCounterType::CURRENT, $userId);
	}
}
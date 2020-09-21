<?php
namespace Bitrix\Crm\Timeline;

use Bitrix\Crm\Order\OrderShipmentStatus;
use Bitrix\Main\Localization\Loc;
use Bitrix\Sale\Cashbox;

Loc::loadMessages(__FILE__);

class OrderCheckController extends EntityController
{
	//region Singleton
	/** @var OrderCheckController|null */
	protected static $instance = null;
	/**
	 * @return OrderCheckController
	 */
	public static function getInstance()
	{
		if(self::$instance === null)
		{
			self::$instance = new OrderCheckController();
		}
		return self::$instance;
	}
	//endregion
	//region EntityController
	public function getEntityTypeID()
	{
		return \CCrmOwnerType::OrderCheck;
	}

	public function prepareHistoryDataModel(array $data, array $options = null)
	{
		$typeId = (int)$data['TYPE_CATEGORY_ID'];

		$data['TITLE'] = Loc::getMessage('CRM_ORDER_CHECK_TITLE', [
			'#CHECK_ID#' => $data['ASSOCIATED_ENTITY_ID']
		]);

		$check = Cashbox\CheckManager::getObjectById($data['ASSOCIATED_ENTITY_ID']);
		$data['CHECK_NAME'] = ($check) ? $check::getName() : '';

		if ($typeId === TimelineType::MARK)
		{
			$data['SENDED'] = $data['SETTINGS']['SENDED'];

			$data['LEGEND'] = Loc::getMessage('CRM_ORDER_CHECK_SENDED_TO_IM');
		}
		elseif ($typeId === TimelineType::UNDEFINED)
		{
			$entity = $data['ASSOCIATED_ENTITY'];
			$data['LEGEND'] = Loc::getMessage('CRM_ORDER_CHECK_LEGEND', [
				'#DATE_CREATE#' => $entity['DATE_CREATE_FORMATTED'],
				'#SUM_WITH_CURRENCY#' => $entity['SUM_WITH_CURRENCY']
			]);

			$data['PRINTED'] = $data['SETTINGS']['PRINTED'];

			$data['CHECK_URL'] = '';
			$cashbox = Cashbox\Manager::getObjectById($check->getField('CASHBOX_ID'));
			if ($cashbox)
			{
				$data['CHECK_URL'] = $cashbox->getCheckLink($check->getField('LINK_PARAMS'));
			}
		}

		unset($data['SETTINGS']);

		return parent::prepareHistoryDataModel($data, $options);
	}

	/**
	 * @param array $fields
	 * @return int
	 */
	protected static function resolveCreatorID(array $fields)
	{
		$authorID = 0;
		if (isset($fields['CREATED_BY']))
		{
			$authorID = (int)$fields['CREATED_BY'];
		}

		if ($authorID <= 0 && isset($fields['RESPONSIBLE_ID']))
		{
			$authorID = (int)$fields['RESPONSIBLE_ID'];
		}

		if ($authorID <= 0)
		{
			//Set portal admin as default creator
			$authorID = 1;
		}

		return $authorID;
	}

	/**
	 * @param $ownerId
	 * @param array $params
	 * @throws \Bitrix\Main\ArgumentException
	 */
	public function onSendCheckToIm($ownerId, array $params)
	{
		$bindings = $params['BINDINGS'] ?? [];
		$settings = $params['SETTINGS'] ?? [];
		$orderFields = $params['ORDER_FIELDS'] ?? [];

		OrderCheckEntry::create([
			'ENTITY_ID' => $ownerId,
			'TYPE_CATEGORY_ID' => TimelineType::MARK,
			'AUTHOR_ID' => self::resolveCreatorID($orderFields),
			'SETTINGS' => $settings,
			'BINDINGS' => $bindings
		]);
	}
}
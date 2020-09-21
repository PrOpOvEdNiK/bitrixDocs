<?php
namespace Bitrix\Crm\Filter;

use Bitrix\Main;

Main\Localization\Loc::loadMessages(__FILE__);

abstract class DataProvider
{
	/**
	 * Get Settings
	 * @return Settings
	 */
	abstract public function getSettings();

	/**
	 * Get ID.
	 * @return string
	 */
	public function getID()
	{
		return $this->getSettings()->getID();
	}

	/**
	 * Prepare field list.
	 * @return Field[]
	 */
	public abstract function prepareFields();
	/**
	 * Prepare complete field data for specified field.
	 * @param string $fieldID Field ID.
	 * @return array|null
	 */
	public abstract function prepareFieldData($fieldID);

	/**
	 * Prepare Field additional HTML.
	 * @param Field $field Field.
	 * @return string
	 */
	public function prepareFieldHtml(Field $field)
	{
		return '';
	}

	/**
	 * Prepare field parameter for specified field.
	 * @param array $filter Filter params.
	 * @param string $fieldID Field ID.
	 * @return void
	 */
	public function prepareListFilterParam(array &$filter, $fieldID)
	{
	}

	/**
	 * Create filter field.
	 * @param string $fieldID Field ID.
	 * @param array|null $params Field parameters (optional).
	 * @return Field
	 */
	protected function createField($fieldID, array $params = null)
	{
		if(!is_array($params))
		{
			$params = array();
		}

		if(!isset($params['name']))
		{
			$params['name'] = $fieldID;
		}

		return new Field($this, $fieldID, $params);
	}
}
<?
namespace Sale\Handlers\Delivery\Spsr;

use Bitrix\Main\Error;
use Bitrix\Main\Loader;
use Bitrix\Sale\Location\Comparator\Mapper;
use Bitrix\Sale\Result;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ArgumentTypeException;
use Bitrix\Main\ArgumentNullException;
use Bitrix\Sale\Location\ExternalTable;
use Bitrix\Sale\Delivery\ExternalLocationMap;
use Bitrix\Sale\Location\Comparator\MapResult;

Loc::loadMessages(__FILE__);

Loader::registerAutoLoadClasses(
	'sale',
	array(
		'Sale\Handlers\Delivery\Spsr\Replacement' => 'handlers/delivery/spsr/replacement/ru/replacement.php'
	)
);
class LocationMapper extends Mapper
{
	public function getLocationsRequest($cityName = '', $countryName = '')
	{
		set_time_limit(0);
		$result = new Result();

		$requestData = '
			<root xmlns="http://spsr.ru/webapi/Info/GetCities/1.0">
				<p:Params Name="WAGetCities" Ver="1.0" xmlns:p="http://spsr.ru/webapi/WA/1.0" />
				<GetCities CityName="'.strtolower($cityName).'" CountryName="'.strtolower($countryName).'" />
			</root>';

		$request = new Request();
		$res = $request->send($requestData);

		if($res->isSuccess())
		{
			$data = $res->getData();
			$xmlAnswer = new \SimpleXMLElement($data[0]);
			$cities = array();

			foreach($xmlAnswer->City->Cities as $city)
			{
				$cities[(string)$city['City_ID']."|".(string)$city['City_owner_ID']] = array(
					'City_ID' => (string)$city['City_ID'],
					'City_owner_ID' => (string)$city['City_owner_ID'],
					'CityName' => self::utfDecode(
						(string)$city['CityName']
					),
					'RegionName' => self::utfDecode(
						(string)$city['RegionName']
					)
				);
			}

			if(!empty($cities))
			{
				$result->setData($cities);
			}
		}
		else
		{
			$result->addErrors($res->getErrors());
		}

		return $result;
	}

	protected static function byNames($srvId, $startId = 0, $timeout = 0)
	{
		$startTime = mktime(true);
		$result = new MapResult;
		\Bitrix\Sale\Location\Comparator::setVariants(Replacement::getVariants());

		$dbRes = \Bitrix\Sale\Location\Comparator\TmpTable::getUnmappedLocations($startId);

		while($ethLoc = $dbRes->fetch())
		{
			/**
			 * Extract city name and subregion name from
			 * Abramtsevo (Balashihinskiy)
			 * Abramtsevo (Dmitrovskiy,  141880)
			 * Aborino
			 */
			$matches = array();
			preg_match('/([^(]*)(\(([^\,\s]*)(\s*\,\s*\d*){0,1}\)){0,1}/i', $ethLoc['CityName'], $matches);

			if(empty($matches[1]))
			{
				$result->addNotFound($ethLoc['XML_ID'], $ethLoc['CityName'].' : '.$ethLoc['RegionName']);
				continue;
			}

			$cityName = !empty($matches[1]) ? trim($matches[1]) : '';
			$subRegionName = !empty($matches[3]) ? trim($matches[3]) : '';
			$locId = 0;

			if(strlen($cityName) > 0)
			{
				$locId = self::getLocationIdByNames($cityName, "", $subRegionName, $ethLoc['RegionName'], "", true);

				if(intval($locId) <= 0)
					$locId = self::getLocationIdByNames($cityName, "", $subRegionName, $ethLoc['RegionName'], "", false);
			}

			if(intval($locId) > 0)
			{
				$res = self::setExternalLocation2($srvId, $locId, $ethLoc['XML_ID'], false);

				if($res->isSuccess())
				{
					$result->addMapped($ethLoc['XML_ID'], $ethLoc['CityName'].', '.$ethLoc['RegionName'], $locId);
					self::saveLocationIdToTmpTable($locId, $ethLoc['XML_ID']);
					//$result->incrementMappedCount();
				}
				else
				{
					foreach($res->getErrors() as $error)
					{
						if($error->getCode() == 'EXTERNAL_LOCATION_EXISTS')
						{
							$result->addDuplicated($ethLoc['XML_ID'], $ethLoc['CityName'].':'.$ethLoc['RegionName'], $locId);
							break;
						}
					}
				}
			}
			else
			{
				$result->addNotFound($ethLoc['XML_ID'], $ethLoc['CityName'].':'.$ethLoc['RegionName']);
			}

			$result->setLastProcessedId(intval($ethLoc['ID']));

			if($timeout > 0 && (mktime(true)-$startTime) >= $timeout)
				return $result;
		}

		return $result;
	}
}
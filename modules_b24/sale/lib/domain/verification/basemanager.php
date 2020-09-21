<?php
namespace Bitrix\Sale\Domain\Verification;

use Bitrix\Main,
	Bitrix\Landing,
	Bitrix\Main\NotImplementedException;

/**
 * Class Manager
 * @package Bitrix\Main\Domain
 */
abstract class BaseManager
{
	/**
	 * @return string
	 */
	abstract protected static function getPathPrefix(): string;

	/**
	 * @return string
	 */
	abstract protected static function getUrlRewritePath(): string;

	/**
	 * @return array
	 * @throws Main\ArgumentException
	 * @throws Main\LoaderException
	 * @throws Main\ObjectPropertyException
	 * @throws Main\SystemException
	 */
	public static function getSiteList() : array
	{
		$siteList = [];

		$res = Main\SiteTable::getList([
			"select" => ["ID" => "LID", "NAME", "SERVER_NAME"],
			"filter" => [
				"ACTIVE" => "Y"
			]
		]);
		while ($row = $res->fetch())
		{
			if (empty($row["SERVER_NAME"]))
			{
				$row["SERVER_NAME"] = Main\Application::getInstance()->getContext()->getServer()->getServerName();
			}

			$siteList[] = $row;
		}

		$landingSiteList = self::getLandingSiteList();
		if ($landingSiteList)
		{
			$siteList = array_merge($siteList, $landingSiteList);
		}

		return $siteList;
	}

	/**
	 * @return array
	 * @throws Main\LoaderException
	 */
	private static function getLandingSiteList() : array
	{
		$landingSiteList = [];

		if (Main\Loader::includeModule('landing'))
		{
			$res = Landing\Site::getList([
				'select' => [
					'ID', 'NAME' => 'TITLE', 'SERVER_NAME' => 'DOMAIN.DOMAIN'
				],
				'filter' => [
					'ACTIVE' => 'Y',
					'TYPE' => 'STORE'
				]
			]);
			while ($row = $res->fetch())
			{
				$landingSiteList[] = $row;
			}
		}

		return $landingSiteList;
	}

	/**
	 * @param $domain
	 * @return bool
	 * @throws Main\LoaderException
	 */
	public static function isLandingSite($domain) : bool
	{
		$landingSiteList = self::getLandingSiteList();

		$result = array_filter($landingSiteList, static function($site) use ($domain) {
			return $site['DOMAIN_NAME'] === $domain;
		});

		return $result ? true : false;
	}

	/**
	 * @param array $parameters
	 * @return Main\ORM\Query\Result
	 * @throws Main\ArgumentException
	 * @throws Main\ObjectPropertyException
	 * @throws Main\SystemException
	 */
	public static function getList(array $parameters = []) : Main\ORM\Query\Result
	{
		return Internals\DomainVerificationTable::getList($parameters);
	}

	/**
	 * @param $data
	 * @param $file (from $_FILES)
	 * @return Main\ORM\Data\AddResult|Main\ORM\Data\UpdateResult|Main\Result
	 * @throws Main\ArgumentException
	 * @throws Main\ArgumentNullException
	 * @throws Main\IO\FileNotFoundException
	 * @throws Main\LoaderException
	 * @throws Main\ObjectPropertyException
	 * @throws Main\SystemException
	 */
	public static function save($data, $file)
	{
		if (empty($file["tmp_name"]) || empty($file["name"]))
		{
			return (new Main\Result())->addError(new Main\Error("File not found"));
		}

		$data["CONTENT"] = self::readFile($file["tmp_name"]);

		$data = self::prepareData($data);
		$checkDataResult = self::checkData($data);
		if (!$checkDataResult->isSuccess())
		{
			return $checkDataResult;
		}

		$res = Internals\DomainVerificationTable::getList([
			"select" => ["ID"],
			"filter" => [
				"=PATH" => $data["PATH"],
				"=DOMAIN" => $data["DOMAIN"],
			]
		])->fetch();
		if ($res)
		{
			return Internals\DomainVerificationTable::update($res["ID"], [
				"CONTENT" => $data["CONTENT"],
				"ENTITY" => $data["ENTITY"],
			]);
		}

		self::addUrlRewrite($data["DOMAIN"], $data["PATH"]);

		return Internals\DomainVerificationTable::add($data);
	}

	/**
	 * @param array $data
	 * @return array
	 */
	private static function prepareData(array $data) : array
	{
		if ($data["PATH"])
		{
			$data["PATH"] = static::getPathPrefix().$data["PATH"];
		}

		$data["DOMAIN"] = self::prepareDomain($data["DOMAIN"]);

		return $data;
	}

	/**
	 * @param $data
	 * @return Main\Result
	 */
	private static function checkData($data) : Main\Result
	{
		$result = new Main\Result();

		if (!isset($data["PATH"]))
		{
			$result->addError(new Main\Error("Path not found"));
		}
		elseif (!isset($data["DOMAIN"]))
		{
			$result->addError(new Main\Error("Domain not found"));
		}
		elseif (!isset($data["CONTENT"]))
		{
			$result->addError(new Main\Error("Content not found"));
		}
		elseif (!isset($data["ENTITY"]))
		{
			$result->addError(new Main\Error("Entity not found"));
		}

		return $result;
	}

	/**
	 * @param $id
	 * @return Main\ORM\Data\DeleteResult
	 * @throws \Exception
	 */
	public static function delete($id): Main\ORM\Data\DeleteResult
	{
		$domainVerificationData = Internals\DomainVerificationTable::getById($id)->fetch();
		self::deleteUrlRewrite($domainVerificationData["DOMAIN"], $domainVerificationData["PATH"]);

		return Internals\DomainVerificationTable::delete($id);
	}

	/**
	 * @param $path
	 * @return bool|false|string
	 * @throws Main\IO\FileNotFoundException
	 */
	private static function readFile($path)
	{
		$file = new Main\IO\File($path);
		if ($file->isExists())
		{
			return $file->getContents();
		}

		return null;
	}

	/**
	 * @param $domain
	 * @return mixed|string
	 */
	private static function prepareDomain($domain)
	{
		$domain = filter_var($domain, FILTER_SANITIZE_URL);
		$domain = trim($domain, " \t\n\r\0\x0B/\\");
		$components = parse_url($domain);

		if (isset($components["host"]) && !empty($components["host"]))
		{
			return $components["host"];
		}

		if (isset($components["path"]) && !empty($components["path"]))
		{
			return $components["path"];
		}

		return $domain;
	}

	/**
	 * @param $entityName
	 * @return bool
	 * @throws NotImplementedException
	 */
	public static function needVerification($entityName) : bool
	{
		$handlerList = static::getEntityList();
		return in_array($entityName, $handlerList);
	}

	/**
	 * @return array
	 * @throws NotImplementedException
	 */
	abstract protected static function getEntityList() : array;

	/**
	 * @param string $domain
	 * @param string $path
	 * @return bool
	 * @throws Main\ArgumentException
	 * @throws Main\ArgumentNullException
	 * @throws Main\LoaderException
	 * @throws Main\ObjectPropertyException
	 * @throws Main\SystemException
	 */
	private static function addUrlRewrite(string $domain, string $path): bool
	{
		$fields = [
			"CONDITION" => "#^{$path}#",
			"RULE" => "",
			"ID" => "",
			"PATH" => static::getUrlRewritePath(),
		];

		$siteId = self::getSiteIdByDomain($domain);
		if (!$siteId)
		{
			return false;
		}

		Main\UrlRewriter::add($siteId, $fields);
		return true;
	}

	/**
	 * @param string $domain
	 * @param string $path
	 * @return bool
	 * @throws Main\ArgumentException
	 * @throws Main\ArgumentNullException
	 * @throws Main\LoaderException
	 * @throws Main\ObjectPropertyException
	 * @throws Main\SystemException
	 */
	private static function deleteUrlRewrite(string $domain, string $path): bool
	{
		$fields = [
			"CONDITION" => "#^{$path}#",
			"PATH" => static::getUrlRewritePath(),
		];

		$siteId = self::getSiteIdByDomain($domain);
		if (!$siteId)
		{
			return false;
		}

		Main\UrlRewriter::delete($siteId, $fields);

		return true;
	}

	/**
	 * @param $domain
	 * @return mixed|null
	 * @throws Main\ArgumentException
	 * @throws Main\LoaderException
	 * @throws Main\ObjectPropertyException
	 * @throws Main\SystemException
	 */
	private static function getSiteIdByDomain($domain)
	{
		$site = array_filter(static::getSiteList(), function($site) use ($domain) {
			return $domain === $site["SERVER_NAME"];
		});

		if (!$site)
		{
			return null;
		}

		$site = current($site);
		if (self::isLandingSite($site["SERVER_NAME"]))
		{
			$site = Main\SiteTable::getList([
				"select" => ["ID" => "LID"],
				"filter" => ["=DEF" => "Y"],
			])->fetch();
		}

		if ($site["ID"])
		{
			return $site["ID"];
		}

		return null;
	}

	/**
	 * @param $serverName
	 * @param $requestUri
	 * @return array|false
	 * @throws Main\ArgumentException
	 * @throws Main\ObjectPropertyException
	 * @throws Main\SystemException
	 */
	public static function searchByRequest($serverName, $requestUri)
	{
		return self::getList([
			"select" => ["*"],
			"filter" => [
				"=PATH" => $requestUri,
				"=DOMAIN" => $serverName,
			],
			"limit" => 1
		])->fetch();
	}
}
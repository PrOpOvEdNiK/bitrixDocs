<?php
define("NOT_CHECK_FILE_PERMISSIONS", true);
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main,
	Bitrix\Sale;

if (Main\Loader::includeModule("sale"))
{
	$domainVerification = Sale\Domain\Verification\BaseManager::searchByRequest(
		$_SERVER["SERVER_NAME"],
		$requestUriWithoutParams
	);

	if ($domainVerification)
	{
		/** @noinspection PhpVariableNamingConventionInspection */
		global $APPLICATION;
		$APPLICATION->restartBuffer();
		header('Content-Type: text/plain');

		$service = new Sale\Domain\Verification\Service($domainVerification);
		if (Sale\Domain\Verification\BaseManager::isLandingSite($service->getDomain()))
		{
			$service->setPubHttpStatusHandler();
		}

		$service->setEndBufferContentHandler();
	}
	else
	{
		\CHTTP::SetStatus("404 Not Found");
	}
}

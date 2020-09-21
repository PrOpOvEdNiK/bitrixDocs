<?php
namespace Bitrix\Sale\Domain\Verification;

use Bitrix\Main;

/**
 * Class Service
 * @package Bitrix\Main\Domain
 */
final class Service
{
	private $domain;
	private $content;

	/**
	 * Service constructor.
	 *
	 * @param array $domainVerification
	 */
	public function __construct(array $domainVerification)
	{
		$this->domain = $domainVerification["DOMAIN"];
		$this->content = $domainVerification["CONTENT"];
	}

	public function setPubHttpStatusHandler(): void
	{
		$eventManager = Main\EventManager::getInstance();
		$eventManager->addEventHandler(
			'landing',
			'onPubHttpStatus',
			static function(Main\Event $event)
			{
				$result = new Main\Entity\EventResult;

				$code = $event->getParameter('code');
				if ($code === '404 Not Found')
				{
					$result->modifyFields([
						'code' => '200 OK'
					]);
				}

				return $result;
			}
		);
	}

	public function setEndBufferContentHandler(): void
	{
		$eventManager = Main\EventManager::getInstance();
		$eventManager->addEventHandler(
			'main',
			'onEndBufferContent',
			function(&$content)
			{
				$content = $this->content;
			}
		);
	}

	/**
	 * @return string
	 */
	public function getDomain(): string
	{
		return $this->domain;
	}
}
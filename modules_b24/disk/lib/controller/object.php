<?php

namespace Bitrix\Disk\Controller;

use Bitrix\Main\Application;
use Bitrix\Main\Engine\ActionFilter;
use Bitrix\Disk;
use Bitrix\Disk\ZipNginx;

class Object extends BaseObject
{
	public function configureActions()
	{
		$configureActions = parent::configureActions();
		$configureActions['getArchiveLink'] = [
			'prefilters' => [
				new ActionFilter\Authentication,
				new ActionFilter\HttpMethod(
					[ActionFilter\HttpMethod::METHOD_POST]
				),
				new Disk\Internals\Engine\ActionFilter\HumanReadableError(),
			]
		];
		$configureActions['downloadArchive'] = [
			'prefilters' => array_merge(
				parent::getDefaultPreFilters(),
				[
					new ActionFilter\Authentication(true),
					new ActionFilter\CloseSession(),
					new Disk\Internals\Engine\ActionFilter\CheckArchiveSignature(),
				]
			),
		];

		return $configureActions;
	}

	public function getAction(Disk\BaseObject $object)
	{
		return $this->get($object);
	}

	public function renameAction(Disk\BaseObject $object, $newName, $autoCorrect = false)
	{
		return $this->rename($object, $newName, $autoCorrect);
	}

	public function moveAction(Disk\BaseObject $object, Disk\Folder $toFolder)
	{
		return $this->move($object, $toFolder);
	}

	public function markDeletedAction(Disk\BaseObject $object)
	{
		return $this->markDeleted($object);
	}

	public function deleteAction(Disk\BaseObject $object)
	{
		if ($object instanceof Disk\File)
		{
			return $this->deleteFile($object);
		}
		else
		{
			return $this->deleteFolder($object);
		}
	}

	public function restoreAction(Disk\BaseObject $object)
	{
		return $this->restore($object);
	}

	public function restoreCollectionAction(Disk\Type\ObjectCollection $objectCollection)
	{
		$restoredIds = [];
		$currentUserId = $this->getCurrentUser()->getId();
		foreach ($objectCollection as $object)
		{
			/** @var Disk\BaseObject $object */
			$securityContext = $object->getStorage()->getSecurityContext($currentUserId);
			if ($object->canRestore($securityContext))
			{
				if (!$object->restore($currentUserId))
				{
					$this->errorCollection->add($object->getErrors());
					continue;
				}

				$restoredIds[] = $object->getRealObjectId();
			}
		}

		return [
			'restoredObjectIds' => $restoredIds,
		];
	}

	public function generateExternalLinkAction(Disk\BaseObject $object)
	{
		return $this->generateExternalLink($object);
	}

	public function disableExternalLinkAction(Disk\BaseObject $object)
	{
		return $this->disableExternalLink($object);
	}

	public function getAllowedOperationsRightsAction(Disk\BaseObject $object)
	{
		return $this->getAllowedOperationsRights($object);
	}
	
	public function getArchiveLinkAction(Disk\Type\ObjectCollection $objectCollection)
	{
		$uri = $this->getActionUri(
			'downloadArchive',
			[
				'objectCollection' => $objectCollection->getIds(),
				'signature' => Disk\Security\ParameterSigner::getArchiveSignature($objectCollection->getIds()),
			]
		);

		return [
			'downloadArchiveUri' => $uri,
		];
	}

	public function downloadArchiveAction(Disk\Type\ObjectCollection $objectCollection)
	{
		$zipArchive = new ZipNginx\Archive('archive' . date('y-m-d') . '.zip');
		foreach ($objectCollection as $object)
		{
			/** @var Disk\BaseObject $object */
			if($object instanceof Disk\File)
			{
				$zipArchive->addEntry(
					ZipNginx\ArchiveEntry::createFromFile($object)
				);
			}
		}

		global $APPLICATION;
		$APPLICATION->restartBuffer();
		$zipArchive->send();
		Application::getInstance()->terminate();
	}
}
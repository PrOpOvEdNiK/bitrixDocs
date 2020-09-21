<?
define('STOP_STATISTICS', true);
define('BX_SECURITY_SHOW_MESSAGE', true);

require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

if (!CModule::IncludeModule('crm'))
{
	return;
}

/*
 * ONLY 'POST' METHOD SUPPORTED
 * SUPPORTED ACTIONS:
 * 'SAVE_MEETING' - save meeting
 * 'SAVE_CALL' - save call
 * 'SET_NOTIFY' - change notification settings
 * 'COMPLETE' - mark activity as completed
 * 'DELETE' - delete activity
 */

if (!$USER->IsAuthorized() || !check_bitrix_sessid() || $_SERVER['REQUEST_METHOD'] != 'POST')
{
	return;
}

__IncludeLang(dirname(__FILE__).'/lang/'.LANGUAGE_ID.'/'.basename(__FILE__));
CUtil::JSPostUnescape();
$GLOBALS['APPLICATION']->RestartBuffer();
Header('Content-Type: application/x-javascript; charset='.LANG_CHARSET);

$action = isset($_POST['ACTION']) ? $_POST['ACTION'] : '';
if(strlen($action) == 0)
{
	echo CUtil::PhpToJSObject(
		array('ERROR' => 'Invalid data!')
	);
	die();
}


if($action == 'DELETE')
{
	$ID = isset($_POST['ITEM_ID']) ? intval($_POST['ITEM_ID']) : 0;

	if($ID <= 0)
	{
		echo CUtil::PhpToJSObject(
			array('ERROR' => 'Invalid data!')
		);
		die();
	}

	if(CCrmActivity::Delete($ID))
	{
		echo CUtil::PhpToJsObject(
			array('DELETED_ITEM_ID'=> $ID)
		);
	}
	else
	{
		echo CUtil::PhpToJsObject(
			array('ERROR'=> "Could not delete activity ('$ID')!")
		);
	}
}
elseif($action == 'COMPLETE')
{
	$ID = isset($_POST['ITEM_ID']) ? intval($_POST['ITEM_ID']) : 0;

	if($ID <= 0)
	{
		echo CUtil::PhpToJSObject(
			array('ERROR' => 'Invalid data!')
		);
		die();
	}

	if(CCrmActivity::Complete($ID))
	{
		echo CUtil::PhpToJsObject(
			array(
				'ITEM_ID'=> $ID,
				'COMPLETED'=> true
			)
		);
	}
	else
	{
		$errorMsg = CCrmActivity::GetLastErroMessage();
		if(!isset($errorMsg[0]))
		{
			$errorMsg = "Could not complete activity ('$ID')!";
		}
		echo CUtil::PhpToJsObject(
			array(
				'ITEM_ID' => $ID,
				'COMPLETED' => false,
				'ERROR' => $errorMsg
			)
		);
	}
}
elseif($action == 'SET_NOTIFY')
{
	$ID = isset($_POST['ITEM_ID']) ? intval($_POST['ITEM_ID']) : 0;

	if($ID <= 0)
	{
		echo CUtil::PhpToJSObject(
			array('ERROR' => 'Invalid data!')
		);
		die();
	}

	$arFields = array(
		'NOTIFY_TYPE' => isset($_POST['NOTIFY_TYPE']) ? intval($_POST['NOTIFY_TYPE']) : CCrmActivityNotifyType::Min,
		'NOTIFY_VALUE' => isset($_POST['NOTIFY_VALUE']) ? intval($_POST['NOTIFY_VALUE']) : 15
	);

	if(!CCrmActivity::Update($ID, $arFields))
	{
		echo CUtil::PhpToJSObject(array('ERROR' => CCrmActivity::GetLastErroMessage()));
		die();
	}

	$arActivity = CCrmActivity::GetByID($ID);
	if(!is_array($arActivity))
	{
		echo CUtil::PhpToJSObject(array('ERROR' => "Could not load activity ('$ID')."));
		die();
	}

	echo CUtil::PhpToJsObject(
		array(
			'ITEM_ID' => $ID,
			'NOTIFY_TYPE' => $arActivity['NOTIFY_TYPE'],
			'NOTIFY_VALUE' => $arActivity['NOTIFY_VALUE']
		)
	);
}
elseif($action == 'SAVE_MEETING' || $action == 'SAVE_CALL')
{
	if (!CModule::IncludeModule('calendar'))
	{
		echo CUtil::PhpToJSObject(array('ERROR' => 'Could not load module "calendar"!'));
		die();
	}

	$data = isset($_POST['DATA']) && is_array($_POST['DATA']) ? $_POST['DATA'] : array();
	if(count($data) == 0)
	{
		echo CUtil::PhpToJSObject(array('ERROR'=>'SOURCE DATA ARE NOT FOUND!'));
		die();
	}

	$ID = isset($data['ID']) ? intval($data['ID']) : 0;

	$ownerTypeName = isset($data['ownerType']) ? strtoupper(strval($data['ownerType'])) : '';
	if(!isset($ownerTypeName[0]))
	{
		echo CUtil::PhpToJSObject(array('ERROR'=>'OWNER TYPE IS NOT DEFINED!'));
		die();
	}

	$ownerID = isset($data['ownerID']) ? intval($data['ownerID']) : 0;
	if($ownerID <= 0)
	{
		echo CUtil::PhpToJSObject(array('ERROR'=>'OWNER TYPE IS NOT DEFINED!'));
		die();
	}

	$arFilter = array('ID' => $ownerID);
	switch ($ownerTypeName)
	{
		case 'CONTACT':
			$obRes = CCrmContact::GetList(array('ID' => 'ASC'), $arFilter, array('ID', 'ASSIGNED_BY_ID'));
			break;
		case 'DEAL':
			$obRes = CCrmDeal::GetList(array('ID' => 'ASC'), $arFilter, array('ID', 'ASSIGNED_BY_ID'));
			break;
		case 'COMPANY':
			$obRes = CCrmCompany::GetList(array('ID' => 'ASC'), $arFilter, array('ID', 'CREATED_BY_ID'));
			break;
		case 'LEAD':
			$obRes = CCrmLead::GetList(array('ID' => 'ASC'), $arFilter, array('ID', 'ASSIGNED_BY_ID'));
			break;
		default:
			{
				echo CUtil::PhpToJSObject(array('ERROR'=>"OWNER TYPE '$ownerTypeName' IS NOT SUPPORTED!"));
				die();
			}
	}

	$userID = '';
	if($arRow = $obRes->Fetch())
	{
		$userID = isset($arRow['CREATED_BY_ID']) ? $arRow['CREATED_BY_ID'] : $arRow['ASSIGNED_BY_ID'];
	}

	if(!isset($userID[0]))
	{
		echo CUtil::PhpToJSObject(array('ERROR'=>'COULD NOT FIND ASSIGNED USER!'));
		die();
	}

	$subject = isset($data['subject']) ? strval($data['subject']) : '';
	if(!isset($subject[0]))
	{
		echo CUtil::PhpToJSObject(array('ERROR'=>'SUBJECT IS NOT DEFINED!'));
		die();
	}

	$start = isset($data['start']) ? strval($data['start']) : '';
	if(!isset($start[0]) || !$DB->IsDate($start, false, SITE_ID, 'FULL'))
	{
		echo CUtil::PhpToJSObject(array('ERROR'=>'START TIME IS NOT DEFINED OR INVALID!'));
		die();
	}

	$end = $start; //by default
	$descr = isset($data['description']) ? strval($data['description']) : '';
	$priority = isset($data['priority']) ? intval($data['priority']) : CCrmActivityPriority::Medium;

	$arFields = array(
		'CAL_TYPE' => 'user',
		'OWNER_ID' => $userID,
		'NAME' => $subject,
		'DT_FROM' => $start,
		'DT_TO' => $end,
		'IMPORTANCE' => CCrmActivityPriority::ToCalendarEventImportance($priority),
		'DESCRIPTION' => $descr
	);

	$notify = isset($data['notify']) ? $data['notify'] : false;
	if(is_array($notify))
	{
		$arFields['REMIND'] = array(
				array(
					'type' => CCrmActivityNotifyType::ToCalendarEventRemind(isset($notify['type']) ? $notify['type'] : CCrmActivityNotifyType::Min),
					'count' => isset($notify['value']) ? intval($notify['value']) : 15
				)
		);
	}

	$eventID = intval(CCalendar::SaveEvent(
		array(
			'arFields' => $arFields,
			'userId' => $userID,
			'autoDetectSection' => true,
			'autoCreateSection' => true
		)
	));

	if ($eventID > 0)
	{
		CCalendarEvent::UpdateUserFields(
			$eventID,
			array('UF_CRM_CAL_EVENT' =>
				CUserTypeCrm::GetShortEntityType($ownerTypeName).'_'.$ownerID
			)
		);
	}
	else
	{
		echo CUtil::PhpToJSObject(array('ERROR'=>'COULD NOT SAVE CALENDAR EVENT'));
		die();
	}


	$typeID = $action == 'ADD_MEETING' ? CCrmActivityType::Meeting : CCrmActivityType::Call;
	$location = isset($data['location']) ? strval($data['location']) : '';

	$arFields = array(
		'OWNER_ID' => $ownerID,
		'OWNER_TYPE_ID' => CCrmActivityOwnerType::ResolveID($ownerTypeName),
		'TYPE_ID' =>  $typeID,
		'ASSOCIATED_ENTITY_ID' => $eventID,
		'SUBJECT' => $subject,
		'START' => $start,
		'END' => $end,
		'COMPLETED' => isset($data['completed']) ? (intval($data['completed']) > 0 ? 'Y' : 'N') : 'N',
		'RESPONSIBLE_ID' => $userID,
		'PRIORITY' => $priority,
		'DESCRIPTION' => $descr,
		'LOCATION' => $location
	);

	if(is_array($notify))
	{
		$arFields['NOTIFY_TYPE'] = isset($notify['type']) ? intval($notify['type']) : CCrmActivityNotifyType::Min;
		$arFields['NOTIFY_VALUE'] = isset($notify['value']) ? intval($notify['value']) : 15;
	}

	if($ID <= 0)
	{
		if(!($ID = CCrmActivity::Add($arFields)))
		{
			echo CUtil::PhpToJSObject(array('ERROR' => CCrmActivity::GetLastErroMessage()));
			die();
		}
	}
	else
	{
		if(!CCrmActivity::Update($ID, $arFields))
		{
			echo CUtil::PhpToJSObject(array('ERROR' => CCrmActivity::GetLastErroMessage()));
			die();
		}
	}

	if(isset($data['contacts']) && is_array($data['contacts']) && count($data['contacts']) > 0)
	{
		if(!CCrmActivity::SetContactIDs($ID, $data['contacts']))
		{
			echo CUtil::PhpToJSObject(array('ERROR' => CCrmActivity::GetLastErroMessage()));
			die();
		}
	}

	if(isset($data['files']) && is_array($data['files']) && count($data['files']) > 0)
	{
		if(!CCrmActivity::SetFileIDs($ID, $data['files']))
		{
			echo CUtil::PhpToJSObject(array('ERROR' => CCrmActivity::GetLastErroMessage()));
			die();
		}
	}

	$userName = '';
	if($userID > 0)
	{
		$dbResUser = CUser::GetByID($userID);
		$userName = is_array(($user = $dbResUser->Fetch()))
			? CUser::FormatName('#NAME# #LAST_NAME#', $user, false) : '';
	}

	$arFiles = array();
	if(is_array($arFileID = CCrmActivity::GetFileIDs($ID)))
	{
		$fileCount = count($arFileID);
		for($i = 0; $i < $fileCount; $i++)
		{
			if(is_array($arData = CFile::GetFileArray($arFileID[$i])))
			{
				$arFiles[] = array(
					'fileID' => $arData['ID'],
					'fileName' => $arData['FILE_NAME'],
					'fileURL' => $arData['SRC'],
					'fileSize' => $arData['FILE_SIZE']
				);
			}
		}
	}

	$arContacts = array();
	if(is_array($arContactID = CCrmActivity::GetContactIDs($ID)) && count($arContactID) > 0)
	{
		$arContractRes = CCrmContact::GetList(
			array(),
			array('ID' => $arContactID),
			array('ID', 'FULL_NAME')
		);

		while ($arContract = $arContractRes->Fetch())
		{
			$arContacts[] = array(
				'ID' => $arContract['ID'],
				'title' => $arContract['FULL_NAME']
			);
		}
	}

	echo CUtil::PhpToJSObject(
		array(
			'ACTIVITY' => array(
				'ID' => $ID,
				'typeID' => $typeID,
				'subject' => $subject,
				'description' => $descr,
				'location' => $location,
				'start' => ConvertTimeStamp(MakeTimeStamp($start), 'FULL', SITE_ID),
				'end' => ConvertTimeStamp(MakeTimeStamp($end), 'FULL', SITE_ID),
				'completed' => isset($arFields['COMPLETED']) && $arFields['COMPLETED'] == 'Y',
				'notifyType' => isset($arFields['NOTIFY_TYPE']) ? intval($arFields['NOTIFY_TYPE']) : CCrmActivityNotifyType::None,
				'notifyValue' => isset($arFields['NOTIFY_VALUE']) ? intval($arFields['NOTIFY_VALUE']) : 0,
				'priority' => $priority,
				'responsibleName' => $userName,
				'files' => $arFiles,
				'contacts' => $arContacts
			)
		)
	);
}

die();
?>
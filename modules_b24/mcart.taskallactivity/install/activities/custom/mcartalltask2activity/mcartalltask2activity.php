<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

class CBPMCArtAllTask2Activity
	extends CBPActivity
	implements IBPEventActivity, IBPActivityExternalEventListener
{
	private $isInEventActivityMode = false;

	private static $arAllowedTasksFieldNames = array(
		'TITLE', 'CREATED_BY', 'RESPONSIBLE_ID', 'ACCOMPLICES', 
		'START_DATE_PLAN', 'END_DATE_PLAN', 'DEADLINE', 'DESCRIPTION', 
		'PRIORITY', 'GROUP_ID', 'ALLOW_CHANGE_DEADLINE', 'TASK_CONTROL', 
		'ADD_IN_REPORT', 'AUDITORS', 'ALLOW_TIME_TRACKING', 'CRM_TYPE', 'CRM_ID', "PARENT_ID", 'CHECK_LIST', 'ATTACH'
	);

	public function __construct($name)
	{
		parent::__construct($name);
		$this->arProperties = array(
			"Title"                   => "",
			"Fields"                  => null,
			"HoldToClose"             => false,
			"AUTO_LINK_TO_CRM_ENTITY" => false,
			"ClosedBy"                => null,
			"ClosedDate"              => null,
			"TaskId"                  => null,
		);
	}


	public function Cancel()
	{
		if (!$this->isInEventActivityMode && $this->HoldToClose)
			$this->Unsubscribe($this);

		return CBPActivityExecutionStatus::Closed;
	}


	private function __GetUsers($arUsersDraft, $bFirst = false)
	{
		$arUsers = array();

		$rootActivity = $this->GetRootActivity();
		$documentId = $rootActivity->GetDocumentId();

		$documentService = $this->workflow->GetService("DocumentService");

		$arUsersDraft = (is_array($arUsersDraft) ? $arUsersDraft : array($arUsersDraft));
		$l = strlen("user_");
		foreach ($arUsersDraft as $user)
		{
			if (substr($user, 0, $l) == "user_")
			{
				$user = intval(substr($user, $l));
				if ($user > 0)
					$arUsers[] = $user;
			}
			else
			{
				$arDSUsers = $documentService->GetUsersFromUserGroup($user, $documentId);
				foreach ($arDSUsers as $v)
				{
					$user = intval($v);
					if ($user > 0)
						$arUsers[] = $user;
				}
			}
		}

		if (!$bFirst)
			return $arUsers;

		if (count($arUsers) > 0)
			return $arUsers[0];

		return null;
	}


	public function Execute()
	{
        global $USER_FIELD_MANAGER;
		if (!CModule::IncludeModule("tasks"))
			return CBPActivityExecutionStatus::Closed;





        $rootActivity = $this->GetRootActivity();
        $documentId = $rootActivity->GetDocumentId();
        $checkList = array();





		$arFields = $this->Fields;
		$arFields["CREATED_BY"] = $this->__GetUsers($this->Fields["CREATED_BY"], true);
		$arFields["RESPONSIBLE_ID"] = $this->__GetUsers($this->Fields["RESPONSIBLE_ID"], true);
		$arFields["ACCOMPLICES"] = $this->__GetUsers($this->Fields["ACCOMPLICES"]);
		$arFields["AUDITORS"] = $this->__GetUsers($this->Fields["AUDITORS"]);





        if (isset($arFields["CHECK_LIST"]) && !empty($arFields["CHECK_LIST"])){
            $checkList = $arFields["CHECK_LIST"];
        }
        if (isset($arFields["CHECK_LIST"])){
            unset($arFields["CHECK_LIST"]);
        }

        if (isset($this->Fields['PARENT_ID']))
        {
            $respar = CTasks::GetList(
                Array("TITLE" => "ASC"),
                Array("ID" => intval($this->Fields['PARENT_ID']), "CHECK_PERMISSIONS" => "N"),
                Array("ID")
            );
            $flagTaskParent = false;
            if ($arTaskPar = $respar->GetNext())
            {
                $flagTaskParent = true;
            }



            if($flagTaskParent) {
                $arFields['PARENT_ID'] = $this->Fields['PARENT_ID'];
            } else {
                $arFields['PARENT_ID'] = "";
            }
        }


		if (isset($this->Fields['DESCRIPTION']))
		{
			$arFields['DESCRIPTION'] = preg_replace(
				'/\[url=(.*)\](.*)\[\/url\]/i' . BX_UTF_PCRE_MODIFIER, 
				'<a href="${1}">${2}</a>', 
				$this->Fields['DESCRIPTION']
			);


		}

		if (!$arFields["SITE_ID"])
		{
			$arFields["SITE_ID"] = SITE_ID;
		}

		/*if ($this->AUTO_LINK_TO_CRM_ENTITY && CModule::IncludeModule('crm'))
		{
			$rootActivity = $this->GetRootActivity();
			$documentId   = $rootActivity->GetDocumentId();
			$documentType = $rootActivity->GetDocumentType();

			$letter = CCrmOwnerTypeAbbr::ResolveByTypeID(CCrmOwnerType::ResolveID($documentType[2]));
			
			$arFields['UF_CRM_TASK'] = array(
				str_replace(
					$documentType[2],
					$letter,
					$documentId[2]
				)
			);
		}
		*/
		/*if (!empty($arFields['CRM_ID']))
			{
				$arFields['UF_CRM_TASK'] = array(
				$arFields['CRM_TYPE'].$arFields['CRM_ID']
			);
			}
		*/
		if (!empty($arFields['CRM_ID']))
			{
				$arrCRM = explode(',', $arFields['CRM_ID']);
					foreach ($arrCRM as $crmId)
					{
					$crmId = trim($crmId);
					
					$arFields['UF_CRM_TASK'][] = $crmId;
					}
				
			}
		$arUnsetFields = array();
		foreach ($arFields as $fieldName => $fieldValue)
		{
			if (substr($fieldName, -5) === '_text')
			{
				$arFields[substr($fieldName, 0, -5)] = $fieldValue;
				$arUnsetFields[] = $fieldName;
			}
		}

		foreach ($arUnsetFields as $fieldName)
			unset($arFields[$fieldName]);

		// Check fields for "white" list
		$arFieldsChecked = array();

        //$hd = fopen(__DIR__ . "/log_order_parce_" . time() . ".txt", "a");
        //fwrite($hd, print_r($arFields, 1));
        //fclose($hd);

		foreach (array_keys($arFields) as $fieldName)
		{
			if (
				in_array($fieldName, static::$arAllowedTasksFieldNames, true)
				|| (
					// pass all users' fields
					(strlen($fieldName) > 3) && (substr($fieldName, 0, 3) === 'UF_')
				)
			)
			{






                if('UF_TASK_WEBDAV_FILES' == $fieldName && is_array($arFields[$fieldName]))
                {
                    foreach($arFields[$fieldName] as $key => $fileId)
                    {
                        if(!empty($fileId) && is_string($fileId) && substr($fileId, 0, 1) != 'n')
                        {
                            if(CModule::IncludeModule("disk") && \Bitrix\Disk\Configuration::isSuccessfullyConverted())
                            {
                                $item = \Bitrix\Disk\Internals\FileTable::getList(array(
                                    'select' => array('ID'),
                                    'filter' => array('=XML_ID' => $fileId, 'TYPE' => \Bitrix\Disk\Internals\FileTable::TYPE_FILE)
                                ))->fetch();

                                if($item)
                                {
                                    $arFields[$fieldName][$key] = 'n'.$item['ID'];
                                }
                            }
                        }
                    }
                    unset($fileId);
                }






				$arFieldsChecked[$fieldName] = $arFields[$fieldName];
			}
		}

$arFieldsChecked['DESCRIPTION_IN_BBCODE'] = "Y";		
		
		//$hd = fopen(__DIR__."/log.txt", "a");
		//	fwrite($hd, print_r($arFieldsChecked, 1));

		$task = new CTasks;
		$result = $task->Add(
			$arFieldsChecked,
			array('USER_ID' => 1)	// act as admin (don't check rights)
		);

        //���������� ������
        $all_files = $this->Fields['ATTACH'];
		if(!empty($all_files)){
			if (!is_array($all_files)) $all_files = explode(", ", $all_files);

			foreach ($all_files as $key=>$f) {
				if (strrpos($f, "&i=") === false) {

				} else {

					$a = strrpos($f, "&i=");
					$tmp = substr($f, $a + 3, strlen($f));
					$a = strrpos($tmp, "&h=");
					$all_files[$key] = substr($tmp, 0, $a);
				}
			}

/*
			$hd = fopen(__DIR__ . "/log_order_parce_" . time() . ".txt", "a");
			fwrite($hd, print_r($this->Fields['ATTACH'], 1));
			fclose($hd);

			$ATTACHFIELD_NAME = $this->arProperties['Fields']["ATTACH"];
			$pos = strpos ($ATTACHFIELD_NAME , '=Template:');
			$pos2 = strpos($ATTACHFIELD_NAME , '=Variable:');
			$pos3 = strpos ($ATTACHFIELD_NAME , '_printable');

			if ($pos!==false)
			{
				$ATTACHFIELD_NAME = substr($ATTACHFIELD_NAME,0,-1);
				$ATTACHFIELD_NAME = substr($ATTACHFIELD_NAME,11);
			}
			elseif ($pos2!==false)
			{
				$ATTACHFIELD_NAME = substr($ATTACHFIELD_NAME,0,-1);
				$ATTACHFIELD_NAME = substr($ATTACHFIELD_NAME,11);
			}
			if ($pos3!==false)
				$ATTACHFIELD_NAME = substr($ATTACHFIELD_NAME,0,-10);

			//$ATTACHFIELD_NAME = "bpriact_".$ATTACHFIELD_NAME;

			if (is_array($_FILES[$ATTACHFIELD_NAME]["name"]))
				foreach($_FILES[$ATTACHFIELD_NAME]["name"] as $key=>$name) {

					$fid0=Array(
						"name" => $name,
						"size" => $_FILES[$ATTACHFIELD_NAME]["size" ][$key],
						"tmp_name" => $_FILES[$ATTACHFIELD_NAME]["tmp_name"][$key],
						"type" => $_FILES[$ATTACHFIELD_NAME]["type" ][$key],
						"error"=>0
					);

					$fid[] = CFile::SaveFile($fid0);
				}
			elseif(isset($_FILES[$ATTACHFIELD_NAME]["name"]))
			{
				$fid0=$_FILES[$ATTACHFIELD_NAME];
				$fid[] = CFile::SaveFile($fid0);
			}
*/
			$arrFileItems = array();
			if (CModule::IncludeModule('disk'))
				foreach ($all_files as $fileID)
				{
					$arFile = CFile::GetFileArray($fileID);

					$arFile2 = CFile::MakeFileArray($arFile['SRC']);
					$arFile2["old_file"] = "";
					$arFile2["del"] = "Y";
					$arFile2["FILE_NAME"] = $arFile2['name'] = $arFile2["ORIGINAL_NAME"]= $arFile["ORIGINAL_NAME"];
					$arFile2["MODULE_ID"] = "tasks";

					$storage = Bitrix\Disk\Driver::getInstance()->getStorageByUserId($arFields["CREATED_BY"]);
					$folder = $storage->getFolderForUploadedFiles();

					$file = $folder->uploadFile($arFile2, array(
						'NAME' =>$fileOriginalName,
						'CREATED_BY' => $arFields["CREATED_BY"]
					), array(), true);

					if($folder->getErrors())
					{
						//fwrite($handle, " error creating files ".var_dump($folder->getErrors())." \n");

					}
					else
					{
						$entityID = $file->getId();
						if (intval($entityID)>0)
						{
							$arrFileItems[] = "n".$entityID;
							//fwrite($handle, " new file created ".$entityID." \n");
							//$USER_FIELD_MANAGER->Update("TASKS_TASK", $result, array("UF_TASK_WEBDAV_FILES" =>array("n".$entityID)), $arFields["CREATED_BY"]);
						}
					}

				}
			if (count($arrFileItems>0))
				$USER_FIELD_MANAGER->Update("TASKS_TASK", $result, array("UF_TASK_WEBDAV_FILES" =>$arrFileItems), $arFields["CREATED_BY"]);
			}

        //����� ���������


		if (!$result)
		{
			$arErrors = $task->GetErrors();
			if (count($arErrors) > 0)
				$this->WriteToTrackingService(GetMessage("BPSA_TRACK_ERROR"));

			return CBPActivityExecutionStatus::Closed;
		}else{
            if(count($checkList) > 0){
                $i = 0;
                $checkItemFields = array();

                $oTaskItem = new CTaskItem(intval($result), \Bitrix\Tasks\Util\User::getAdminId());

                foreach($checkList as $check){
                    $i++;
                    $checkItemFields = array(
                        'TITLE' => strval($check)
                    ,'SORT_INDEX' => $i
                    ,'IS_COMPLETE' => 'N'
                    );
                    $res = CTaskCheckListItem::add($oTaskItem, $checkItemFields);

                }
            }
        }

		$this->TaskId = $result;
		$this->WriteToTrackingService(str_replace("#VAL#", $result, GetMessage("BPSA_TRACK_OK")));

		if ($this->isInEventActivityMode || !$this->HoldToClose)
			return CBPActivityExecutionStatus::Closed;

		$this->Subscribe($this);
		$this->isInEventActivityMode = false;

		$this->WriteToTrackingService(GetMessage("BPSA_TRACK_SUBSCR"));

		return CBPActivityExecutionStatus::Executing;
	}


	public function Subscribe(IBPActivityExternalEventListener $eventHandler)
	{
		if ($eventHandler == null)
			throw new Exception("eventHandler");

		$this->isInEventActivityMode = true;

		$schedulerService = $this->workflow->GetService("SchedulerService");
		$schedulerService->SubscribeOnEvent($this->workflow->GetInstanceId(), $this->name, "tasks", "OnTaskUpdate", $this->TaskId);

		$this->workflow->AddEventHandler($this->name, $eventHandler);
	}


	public function Unsubscribe(IBPActivityExternalEventListener $eventHandler)
	{
		if ($eventHandler == null)
			throw new Exception("eventHandler");

		$schedulerService = $this->workflow->GetService("SchedulerService");
		$schedulerService->UnSubscribeOnEvent($this->workflow->GetInstanceId(), $this->name, "tasks", "OnTaskUpdate", $this->TaskId);

		$this->workflow->RemoveEventHandler($this->name, $eventHandler);
	}


	public function OnExternalEvent($arEventParameters = array())
	{
		if ($this->TaskId != $arEventParameters[0])
			return;

		if ($this->executionStatus != CBPActivityExecutionStatus::Closed)
		{
			if ($arEventParameters[1]["STATUS"] == 5)
			{
				$this->ClosedBy = "user_".$arEventParameters[1]["CLOSED_BY"];
				$this->ClosedDate = $arEventParameters[1]["CLOSED_DATE"];

				$this->WriteToTrackingService(str_replace("#DATE#", $arEventParameters[1]["CLOSED_DATE"], GetMessage("BPSA_TRACK_CLOSED")));

				$this->Unsubscribe($this);
				$this->workflow->CloseActivity($this);
			}
		}
	}


	public function HandleFault(Exception $exception)
	{
		if ($exception == null)
			throw new Exception("exception");

		$status = $this->Cancel();
		if ($status == CBPActivityExecutionStatus::Canceling)
			return CBPActivityExecutionStatus::Faulting;

		return $status;
	}


	public static function GetPropertiesDialog($documentType, $activityName, $arWorkflowTemplate, $arWorkflowParameters, $arWorkflowVariables, $arCurrentValues = null, $formName = "", $popupWindow = null, $currentSiteId = null)
	{
		$runtime = CBPRuntime::GetRuntime();

		if (!is_array($arWorkflowParameters))
			$arWorkflowParameters = array();
		if (!is_array($arWorkflowVariables))
			$arWorkflowVariables = array();

		$documentService = $runtime->GetService("DocumentService");

		if (!is_array($arCurrentValues))
		{
			$arCurrentValues = array();

			$arCurrentActivity = &CBPWorkflowTemplateLoader::FindActivityByName($arWorkflowTemplate, $activityName);
			if (is_array($arCurrentActivity["Properties"])
				&& array_key_exists("Fields", $arCurrentActivity["Properties"])
				&& is_array($arCurrentActivity["Properties"]["Fields"]))
			{
				foreach ($arCurrentActivity["Properties"]["Fields"] as $k => $v)
				{
					$arCurrentValues[$k] = $v;

					if (in_array($k, array("CREATED_BY", "RESPONSIBLE_ID", "ACCOMPLICES", "AUDITORS")))
					{
						if (!is_array($arCurrentValues[$k]))
							$arCurrentValues[$k] = array($arCurrentValues[$k]);

						$ar = array();
						foreach ($arCurrentValues[$k] as $v)
						{
							if (intval($v)."!" == $v."!")
								$v = "user_".$v;
							$ar[] = $v;
						}

						$arCurrentValues[$k] = CBPHelper::UsersArrayToString($ar, $arWorkflowTemplate, $documentType);
					}
                    if('UF_TASK_WEBDAV_FILES' == $k && is_array($arCurrentValues[$k]) && CModule::IncludeModule("disk") && \Bitrix\Disk\Configuration::isSuccessfullyConverted())
                    {
                        foreach($arCurrentValues[$k] as $key => $fileId)
                        {
                            if(!empty($fileId) && is_string($fileId) && substr($fileId, 0, 1) != 'n')
                            {
                                $item = \Bitrix\Disk\Internals\FileTable::getList(array(
                                    'select' => array('ID'),
                                    'filter' => array('=XML_ID' => $fileId, 'TYPE' => \Bitrix\Disk\Internals\FileTable::TYPE_FILE)
                                ))->fetch();

                                if($item)
                                {
                                    $arCurrentValues[$k][$key] = 'n'.$item['ID'];
                                }
                            }
                        }
                        unset($fileId);
                    }
				}
			}

			$arCurrentValues["HOLD_TO_CLOSE"] = ($arCurrentActivity["Properties"]["HoldToClose"] ? "Y" : "N");
			//$arCurrentValues["AUTO_LINK_TO_CRM_ENTITY"] = ($arCurrentActivity["Properties"]["AUTO_LINK_TO_CRM_ENTITY"] ? "Y" : "N");
		}
		else
		{
            //$arFieldNames = array("ATTACH","TITLE", "CREATED_BY", "RESPONSIBLE_ID", "ACCOMPLICES", "START_DATE_PLAN", "END_DATE_PLAN", "DEADLINE", "DESCRIPTION", "PRIORITY", "GROUP_ID", "ALLOW_CHANGE_DEADLINE", "TASK_CONTROL", "ADD_IN_REPORT", "AUDITORS", "CRM_ID", "CHECK_LIST", "PARENT_ID");
            $arFieldNames = self::$arAllowedTasksFieldNames;
			foreach ($arFieldNames as $field)
            {
                if ((!is_array($arCurrentValues[$field]) && (strlen($arCurrentValues[$field]) <= 0)
                        || is_array($arCurrentValues[$field]) && (count($arCurrentValues[$field]) <= 0))
                    && (strlen($arCurrentValues[$field."_text"]) > 0))
                {
                    $arCurrentValues[$field] = $arCurrentValues[$field."_text"];
                }
            }
			/*foreach (static::$arAllowedTasksFieldNames as $field)
			{
				if ((!is_array($arCurrentValues[$field]) && (strlen($arCurrentValues[$field]) <= 0)
					|| is_array($arCurrentValues[$field]) && (count($arCurrentValues[$field]) <= 0))
					&& (strlen($arCurrentValues[$field."_text"]) > 0))
				{
					$arCurrentValues[$field] = $arCurrentValues[$field."_text"];
				}
			}*/
		}

		$arDocumentFields = self::__GetFields();

		return $runtime->ExecuteResourceFile(
			__FILE__, "properties_dialog.php", array(
				"arCurrentValues" => $arCurrentValues,
				"formName" => $formName,
				"documentType" => $documentType,
				"popupWindow" => &$popupWindow,
				"arDocumentFields" => $arDocumentFields,
                'currentSiteId' => $currentSiteId,
			)
		);
	}


	public static function GetPropertiesDialogValues($documentType, $activityName, &$arWorkflowTemplate, &$arWorkflowParameters, &$arWorkflowVariables, $arCurrentValues, &$arErrors)
	{
		$arErrors = array();
		$arCRMTypes = array("C_"=>GetMessage("BPTA1A_CONTACT"), 'CO_'=>GetMessage('BPTA1A_COMPANY'), 'L_'=>GetMessage('BPTA1A_LEAD'), 'D_'=>GetMessage('BPTA1A_DEAL'));
		$arProperties = array("Fields" => array());

		$arTaskPriority = array(0, 1, 2);
		foreach ($arTaskPriority as $k => $v)
			$arTaskPriority[$v] = GetMessage("TASK_PRIORITY_".$v);

		$arGroups = array(GetMessage("TASK_EMPTY_GROUP"));
		if (CModule::IncludeModule("socialnetwork"))
		{
			$db = CSocNetGroup::GetList(array("NAME" => "ASC"), array("ACTIVE" => "Y"), false, false, array("ID", "NAME"));
			while ($ar = $db->GetNext())
				$arGroups[$ar["ID"]] = "[".$ar["ID"]."]".$ar["NAME"];
		}

		$arDF = self::__GetFields();

		//foreach (static::$arAllowedTasksFieldNames as $field)
        //$arFieldNames = array("ATTACH","TITLE", "CREATED_BY", "RESPONSIBLE_ID", "ACCOMPLICES", "START_DATE_PLAN", "END_DATE_PLAN", "DEADLINE", "DESCRIPTION", "PRIORITY", "GROUP_ID", "ALLOW_CHANGE_DEADLINE", "TASK_CONTROL", "ADD_IN_REPORT", "AUDITORS", "CRM_ID", "CHECK_LIST", "PARENT_ID");
        $arFieldNames = self::$arAllowedTasksFieldNames;
		foreach ($arFieldNames as $field)
		{
			$r = null;

			if (in_array($field, array("CREATED_BY", "RESPONSIBLE_ID", "ACCOMPLICES", "AUDITORS")))
			{
				$value = $arCurrentValues[$field];
				if (strlen($value) > 0)
				{
					$arErrorsTmp = array();
					$r = CBPHelper::UsersStringToArray($value, $documentType, $arErrorsTmp);
					if (count($arErrorsTmp) > 0)
						$arErrors = array_merge($arErrors, $arErrorsTmp);
				}
			}
			elseif (array_key_exists($field, $arCurrentValues) || array_key_exists($field."_text", $arCurrentValues))
			{
				$arValue = array();
				if (array_key_exists($field, $arCurrentValues))
				{
					$arValue = $arCurrentValues[$field];
					//if (!is_array($arValue) || is_array($arValue) && CBPHelper::IsAssociativeArray($arValue))
                    if (!is_array($arValue))
						$arValue = array($arValue);
				}
				if (array_key_exists($field."_text", $arCurrentValues))
					$arValue[] = $arCurrentValues[$field."_text"];

				foreach ($arValue as $value)
				{
                    if (!is_array($value)) {
                        $value = trim($value);
                    }
					if (!preg_match("#^\{=[a-z0-9_]+:[a-z0-9_]+\}$#i", $value) && (substr($value, 0, 1) !== "="))
					{
						if ($field == "PRIORITY")
						{
							if (strlen($value) <= 0)
								$value = null;

							if ($value != null && !array_key_exists($value, $arTaskPriority))
							{
								$value = null;
								$arErrors[] = array(
									"code" => "ErrorValue",
									"message" => "Priority is empty",
									"parameter" => $field,
								);
							}
						}
						elseif ($field == "GROUP_ID")
						{
							if (strlen($value) <= 0)
								$value = null;
							if ($value != null && !array_key_exists($value, $arGroups))
							{
								$value = null;
								$arErrors[] = array(
									"code" => "ErrorValue",
									"message" => "Group is empty",
									"parameter" => $field,
								);
							}
						}
						elseif (in_array($field, array("ALLOW_CHANGE_DEADLINE", "TASK_CONTROL", "ADD_IN_REPORT", 'ALLOW_TIME_TRACKING')))
						{
							if (strtoupper($value) == "Y" || $value === true || $value."!" == "1!")
								$value = "Y";
							elseif (strtoupper($value) == "N" || $value === false || $value."!" == "0!")
								$value = "N";
							else
								$value = null;
						}
						else
						{
							if (!is_array($value) && strlen($value) <= 0)
								$value = null;
						}
					}

					if ($value != null)
						$r[] = $value;
				}
			}

			$r_orig = $r;

			if (!in_array($field, array("ACCOMPLICES", "AUDITORS", "CHECK_LIST")))
			{
				if (count($r) > 0)
					$r = $r[0];
				else
					$r = null;
			}

			if (in_array($field, array("TITLE", "CREATED_BY", "RESPONSIBLE_ID")) && ($r == null || is_array($r) && count($r) <= 0))
			{
				$arErrors[] = array(
					"code" => "emptyRequiredField",
					"message" => str_replace("#FIELD#", $arDF[$field]["Name"], GetMessage("BPCDA_FIELD_REQUIED")),
				);
			}

			$arProperties["Fields"][$field] = $r;

			if (array_key_exists($field."_text", $arCurrentValues) && isset($r_orig[1]))
				$arProperties["Fields"][$field . '_text'] = $r_orig[1];
		}

		/*$arUserFields = $GLOBALS["USER_FIELD_MANAGER"]->GetUserFields("TASKS_TASK", 0, LANGUAGE_ID);
		foreach ($arUserFields as $field)
		{
			$r = $arCurrentValues[$field["FIELD_NAME"]];

			if (($field["MULTIPLE"] == "Y") && (!$r || is_array($r) && count($r) <= 0))
			{
				$arErrors[] = array(
					"code" => "emptyRequiredField",
					"message" => str_replace("#FIELD#", $field["EDIT_FORM_LABEL"], GetMessage("BPCDA_FIELD_REQUIED")),
				);
			}

			$arProperties["Fields"][$field["FIELD_NAME"]] = $r;
		}
		*/
		$arProperties["HoldToClose"] = ((strtoupper($arCurrentValues["HOLD_TO_CLOSE"]) == "Y") ? true : false);
		//$arProperties["AUTO_LINK_TO_CRM_ENTITY"] = ((strtoupper($arCurrentValues["AUTO_LINK_TO_CRM_ENTITY"]) == "Y") ? true : false);

		if (count($arErrors) > 0)
			return false;

		$arCurrentActivity = &CBPWorkflowTemplateLoader::FindActivityByName($arWorkflowTemplate, $activityName);
		$arCurrentActivity["Properties"] = $arProperties;

		return true;
	}


	private static function __GetFields()
	{
		$arTaskPriority = array(0, 1, 2);
		foreach ($arTaskPriority as $k => $v)
			$arTaskPriority[$v] = GetMessage("TASK_PRIORITY_".$v);

		$arGroups = array(GetMessage("TASK_EMPTY_GROUP"));
		if (CModule::IncludeModule("socialnetwork"))
		{
			$db = CSocNetGroup::GetList(array("NAME" => "ASC"), array("ACTIVE" => "Y"), false, false, array("ID", "NAME"));
			while ($ar = $db->GetNext())
				$arGroups[$ar["ID"]] = "[".$ar["ID"]."]".$ar["NAME"];
		}
		$arCRMTypes = array("C_"=>GetMessage("BPTA1A_CONTACT"), 'CO_'=>GetMessage('BPTA1A_COMPANY'), 'L_'=>GetMessage('BPTA1A_LEAD'), 'D_'=>GetMessage('BPTA1A_DEAL'));
		$arFields = array(
            "ATTACH" => array(
                "Name" => GetMessage("BPTA1A_ATTACH"),
                "Type" => "F",
                "Filterable" => true,
                "Editable" => true,
                "Required" => false,
                "Multiple" => true,
                "BaseType" => "file"
            ),
			"TITLE" => array(
				"Name" => GetMessage("BPTA1A_TASKNAME"),
				"Type" => "S",
				"Filterable" => true,
				"Editable" => true,
				"Required" => true,
				"Multiple" => false,
				"BaseType" => "string"
			),
			"CREATED_BY" => array(
				"Name" => GetMessage("BPTA1A_TASKCREATEDBY"),
				"Type" => "S:UserID",
				"Filterable" => true,
				"Editable" => true,
				"Required" => true,
				"Multiple" => false,
				"BaseType" => "user"
			),
			"RESPONSIBLE_ID" => array(
				"Name" => GetMessage("BPTA1A_TASKASSIGNEDTO"),
				"Type" => "S:UserID",
				"Filterable" => true,
				"Editable" => true,
				"Required" => true,
				"Multiple" => false,
				"BaseType" => "user"
			),
			"ACCOMPLICES" => array(
				"Name" => GetMessage("BPTA1A_TASKACCOMPLICES"),
				"Type" => "S:UserID",
				"Filterable" => true,
				"Editable" => true,
				"Required" => false,
				"Multiple" => true,
				"BaseType" => "user"
			),
			"START_DATE_PLAN" => array(
				"Name" => GetMessage("BPTA1A_TASKACTIVEFROM"),
				"Type" => "S:DateTime",
				"Filterable" => true,
				"Editable" => true,
				"Required" => false,
				"Multiple" => false,
				"BaseType" => "datetime"
			),
			"END_DATE_PLAN" => array(
				"Name" => GetMessage("BPTA1A_TASKACTIVETO"),
				"Type" => "S:DateTime",
				"Filterable" => true,
				"Editable" => true,
				"Required" => false,
				"Multiple" => false,
				"BaseType" => "datetime"
			),
			"DEADLINE" => array(
				"Name" => GetMessage("BPTA1A_TASKDEADLINE"),
				"Type" => "S:DateTime",
				"Filterable" => true,
				"Editable" => true,
				"Required" => false,
				"Multiple" => false,
				"BaseType" => "datetime"
			),
			"DESCRIPTION" => array(
				"Name" => GetMessage("BPTA1A_TASKDETAILTEXT"),
				"Type" => "T",
				"Filterable" => true,
				"Editable" => true,
				"Required" => false,
				"Multiple" => false,
				"BaseType" => "text"
			),
			"PRIORITY" => array(
				"Name" => GetMessage("BPTA1A_TASKPRIORITY"),
				"Type" => "L",
				"Options" => $arTaskPriority,
				"Filterable" => true,
				"Editable" => true,
				"Required" => false,
				"Multiple" => false,
				"BaseType" => "select"
			),
			"GROUP_ID" => array(
				"Name" => GetMessage("BPTA1A_TASKGROUPID"),
				"Type" => "L",
				"Options" => $arGroups,
				"Filterable" => true,
				"Editable" => true,
				"Required" => false,
				"Multiple" => false,
				"BaseType" => "select"
			),
			"ALLOW_CHANGE_DEADLINE" => array(
				"Name" => GetMessage("BPTA1A_CHANGE_DEADLINE"),
				"Type" => "B",
				"Filterable" => true,
				"Editable" => true,
				"Required" => false,
				"Multiple" => false,
				"BaseType" => "bool"
			),
			"ALLOW_TIME_TRACKING" => array(
				"Name" => GetMessage("BPTA1A_ALLOW_TIME_TRACKING"),
				"Type" => "B",
				"Filterable" => true,
				"Editable" => true,
				"Required" => false,
				"Multiple" => false,
				"BaseType" => "bool"
			),
			"TASK_CONTROL" => array(
				"Name" => GetMessage("BPTA1A_CHECK_RESULT"),
				"Type" => "B",
				"Filterable" => true,
				"Editable" => true,
				"Required" => false,
				"Multiple" => false,
				"BaseType" => "bool"
			),
			"ADD_IN_REPORT" => array(
				"Name" => GetMessage("BPTA1A_ADD_TO_REPORT"),
				"Type" => "B",
				"Filterable" => true,
				"Editable" => true,
				"Required" => false,
				"Multiple" => false,
				"BaseType" => "bool"
			),
			"AUDITORS" => array(
				"Name" => GetMessage("BPTA1A_TASKTRACKERS"),
				"Type" => "S:UserID",
				"Filterable" => true,
				"Editable" => true,
				"Required" => false,
				"Multiple" => true,
				"BaseType" => "user"
			),
            "PARENT_ID" => array(
                "Name" => GetMessage("BPTA1A_PARENT_ID"),
                "Type" => "custom",
                "Filterable" => true,
                "Editable" => true,
                "Required" => false,
                "Multiple" => false,
                "BaseType" => "custom"
            ),
			/*"CRM_TYPE" => array(
				"Name" => GetMessage("BPTA1A_CRMTYPE"),
				"Type" => "L",
				"Options" => $arCRMTypes,
				"Filterable" => true,
				"Editable" => true,
				"Required" => false,
				"Multiple" => false,
				"BaseType" => "select"
			),*/
			"CRM_ID" => array(
				"Name" => GetMessage("BPTA1A_CRMID"),
				"Type" => "N",
				"Filterable" => true,
				"Editable" => true,
				"Required" => false,
				"Multiple" => true,
				"BaseType" => "select"
			),
            "CHECK_LIST" => array(
                "Name" => GetMessage("SBPTA_CHECKLIST"),
                "Type" => "S",
                "Filterable" => true,
                "Editable" => true,
                "Required" => false,
                "Multiple" => true,
                "BaseType" => "string",
            ),
		);
		
		/*
		$arUserFields = $GLOBALS["USER_FIELD_MANAGER"]->GetUserFields("TASKS_TASK", 0, LANGUAGE_ID);

		foreach($arUserFields as $field)
		{
			$arFields[$field["FIELD_NAME"]] = array(
				"Name" => $field["EDIT_FORM_LABEL"],
				"Type" => $field["USER_TYPE_ID"],
				"Filterable" => true,
				"Editable" => true,
				"Required" => ($field["MANDATORY"] == "Y"),
				"Multiple" => ($field["MULTIPLE"] == "Y"),
				"BaseType" => $field["USER_TYPE_ID"],
				"UserField" => $field
			);
		}
		*/
		return $arFields;
	}
}

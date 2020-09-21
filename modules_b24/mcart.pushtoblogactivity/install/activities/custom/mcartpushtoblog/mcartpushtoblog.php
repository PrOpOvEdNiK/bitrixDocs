<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

class CBPMcartPushToBlog
	extends CBPActivity
	implements IBPEventActivity, IBPActivityExternalEventListener
{
	private $isInEventActivityMode = false;

	private static $arAllowedTasksFieldNames = array(
		'TITLE', 'CREATED_BY', 'RESPONSIBLE_ID', 'DESCRIPTION', 'IMPORTANT_MESS');

	public function __construct($name)
	{
		parent::__construct($name);
		$this->arProperties = array(
			"Title"                   => "",
			"Fields"                  => null,
			"HoldToClose"             => false,
			"AUTO_LINK_TO_CRM_ENTITY" => true,
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
		ini_set('max_execution_time', 600);
		global $APPLICATION;
		if (!CModule::IncludeModule("tasks"))
		{
				$this->WriteToTrackingService('module TASK not include');
				return CBPActivityExecutionStatus::Closed;
		}


if (!CModule::IncludeModule("blog"))
		{
				$this->WriteToTrackingService('module BLOG not include');
				return CBPActivityExecutionStatus::Closed;
		}



		global $DB, $USER;	

		if (isset($_SERVER["DOCUMENT_ROOT"]))
			$handle = fopen($_SERVER["DOCUMENT_ROOT"]."/bitrix/activities/custom/mcartpushtoblog/log.txt", "a");
			
		
		
$ARR_RESPONSIBLES = $this->__GetUsers($this->Fields["RESPONSIBLE_ID"], false);

$arFields = $this->Fields;
				$arFields["CREATED_BY"] = $this->__GetUsers($this->Fields["CREATED_BY"], true);

		foreach ($ARR_RESPONSIBLES as $USER_ID)
		{
				
				
				$arFields['DESCRIPTION'] = $this->Fields['DESCRIPTION'];
				$arFields['TITLE'] = $this->Fields['TITLE'];
				$arBlog = CBlog::GetByOwnerID($arFields["CREATED_BY"]);
				$arBlog1 = CBlog::GetByOwnerID($USER_ID/*$arFields["CREATED_BY"]*/);
				//if (isset($arBlog)&&(isset($arBlog1)))
				//{
				$arBlogFields = array(

					"DETAIL_TEXT_TYPE" => 'text',
					
					"PUBLISH_STATUS" => "P",
					"CATEGORY_ID" => "",
					"PERMS_POST" => Array(),
					"URL"=>	$arBlog["URL"],
					"PERMS_COMMENT" => Array(),
						
					"MICRO" => 'Y',
					"SOCNET_RIGHTS" => Array("0" => "U".$USER_ID),
					"UF_BLOG_POST_IMPRTNT" => ($arFields["IMPORTANT_MESS"]=="Y" ? 1:0),
					"UF_BLOG_POST_VOTE" => "",
					"UF_BLOG_POST_FILE" => Array(),
						
					"UF_BLOG_POST_F_EDIT" => 0,
					'BBCODE' => true,
					"TITLE" => $arFields['TITLE'],
					"DETAIL_TEXT" => $arFields['DESCRIPTION'],
					"BLOG_ID" => $arBlog['ID'],
					"AUTHOR_ID" => $arFields["CREATED_BY"],
					"=DATE_CREATE" => $DB->GetNowFunction(),
					"DATE_PUBLISH" => ConvertTimeStamp(time(), "FULL")
					);
					$SEND_URL = '/company/personal/user/#user_id#/blog/#post_id#/';
					$newID = CBlogPost::Add($arBlogFields);
					if(IntVal($newID)>0)
					{
					$dblRes = CUser::getByID($USER_ID);
					if ($obj2 = $dblRes->Fetch())
					{
					if (!empty($obj2["LID"]))
						{
						if ($obj2["LID"]=="s1")
							$SEND_URL = '/company/personal/user/#user_id#/blog/#post_id#/';
						else
							$SEND_URL = '/extranet/personal/user/#user_id#/blog/#post_id#/';
						}
					
					}
					
					$arBlogFields["ID"] = $newID;
						foreach($CATEGORY_ID as $v)
							CBlogPostCategory::Add(Array("BLOG_ID" => $arBlog['ID'], "POST_ID" => $newID, "CATEGORY_ID"=>$v));
						$result[] =  str_replace('#VAL#',$newID ,GetMessage("MCART_RESUME_MESSAGE"));
						
						$notify_text = GetMessage("WRITE_TO_YOU")."[URL=".str_replace(array('#user_id#','#post_id#'),array($arFields["CREATED_BY"],$newID) ,$SEND_URL)."]"."   ".substr($arFields['DESCRIPTION'],0,20)."[/URL]";
						
						if (CModule::IncludeModule("socialnetwork"))
						{
						$arPortalMessageFields = array(
									"FROM_USER_ID" => $arFields["CREATED_BY"],
									"TO_USER_ID" => $USER_ID,
									"MESSAGE" => $notify_text ,
									"DATE_CREATE" => $DB->CurrentTimeFunction(),
									"MESSAGE_TYPE" => "S",
								);

								CSocNetMessages::Add($arPortalMessageFields);
						}
						
					}
					else
					{
						if ($ex = $APPLICATION->GetException())
							$error[] = $ex->GetString();
					}
					
					//$arBlog1 = CBlog::GetByOwnerID($USER_ID);
						$arParamsNotify = array(
						 "bSoNet" => 1,
							"UserID" =>$USER_ID,
							"allowVideo" => 'Y',
							"PATH_TO_SMILE" => false,
							"PATH_TO_POST" => '/extranet/contacts/personal/user/'.$USER_ID.'/blog/',
							"SOCNET_GROUP_ID" => 0,
							"user_id" => $USER_ID,
							"NAME_TEMPLATE" => '#NAME# #LAST_NAME#',
							"SHOW_LOGIN" =>false
							);


						  //  print_r($arBlog); 
						CBlogPost::Notify($arBlogFields, $arBlog, $arParamsNotify); 

				
		}
		
		
		if (IntVal(count($result))<1)
		{
			
				$this->WriteToTrackingService(GetMessage("BPSA_TRACK_ERROR").implode(",", $error) );

			return CBPActivityExecutionStatus::Closed;
		}
		
		$this->TaskId = implode(",",$result);
		$this->WriteToTrackingService(implode(",",$result).implode(",", $error));
		
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


	public static function GetPropertiesDialog($documentType, $activityName, $arWorkflowTemplate, $arWorkflowParameters, $arWorkflowVariables, $arCurrentValues = null, $formName = "")
	{
	
	$handle = fopen($_SERVER["DOCUMENT_ROOT"]."/bitrix/activities/custom/mcartpushtoblog/log.txt", "a");
			
	
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

					if (in_array($k, array("CREATED_BY","RESPONSIBLE_ID")))
					{
						if (!is_array($arCurrentValues[$k]))
							$arCurrentValues[$k] = array($arCurrentValues[$k]);

						$ar = array();
						foreach ($arCurrentValues[$k] as $v)
						{
							//if (intval($v)."!" == $v."!")
							//	$v = "user_".$v;
							$ar[] = $v;
						}
						$arCurrentValues[$k] = CBPHelper::UsersArrayToString($ar, $arWorkflowTemplate, $documentType);
						
					}
				}
			}

			
		}
		else
		{
			foreach (static::$arAllowedTasksFieldNames as $field)
			{
				if ((!is_array($arCurrentValues[$field]) && (strlen($arCurrentValues[$field]) <= 0)
					|| is_array($arCurrentValues[$field]) && (count($arCurrentValues[$field]) <= 0))
					&& (strlen($arCurrentValues[$field."_text"]) > 0))
				{
					$arCurrentValues[$field] = $arCurrentValues[$field."_text"];
				}
			}
		}

		$arDocumentFields = self::__GetFields();
			
			
			
		return $runtime->ExecuteResourceFile(
			__FILE__, "properties_dialog.php", array(
				"arCurrentValues" => $arCurrentValues,
				"formName" => $formName,
				"documentType" => $documentType,
				"popupWindow" => &$popupWindow,
				"arDocumentFields" => $arDocumentFields,
			)
		);
	}


	public static function GetPropertiesDialogValues($documentType, $activityName, &$arWorkflowTemplate, &$arWorkflowParameters, &$arWorkflowVariables, $arCurrentValues, &$arErrors)
	{
$handle = fopen($_SERVER["DOCUMENT_ROOT"]."/bitrix/activities/custom/mcartpushtoblog/log.txt", "a");
		$arErrors = array();

		$arProperties = array("Fields" => array());

			
		$arDF = self::__GetFields();

		foreach (static::$arAllowedTasksFieldNames as $field)
		{
			$r = null;

			if (in_array($field, array("CREATED_BY", "RESPONSIBLE_ID")))
			{
				$value = $arCurrentValues[$field];
				if (strlen($value) > 0)
				{
					$arErrorsTmp = array();
					
					//if (intval($value)>0)
					//$r = array("0"=>$value);
					//else
	
					//	$r = $value; //
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
					if (!is_array($arValue) || is_array($arValue) && CBPHelper::IsAssociativeArray($arValue))
						$arValue = array($arValue);
				}
				if (array_key_exists($field."_text", $arCurrentValues))
					$arValue[] = $arCurrentValues[$field."_text"];

				foreach ($arValue as $value)
				{
					$value = trim($value);
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

			if (!in_array($field, array("RESPONSIBLE_ID")))
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
		

		if (count($arErrors) > 0)
			return false;

			
			
		$arCurrentActivity = &CBPWorkflowTemplateLoader::FindActivityByName($arWorkflowTemplate, $activityName);
		$arCurrentActivity["Properties"] = $arProperties;

		return true;
		
	}


	private static function __GetFields()
	{
		

		$arFields = array(
			"TITLE" => array(
				"Name" => GetMessage("MCART_PTB_NAME"),
				"Type" => "S",
				"Filterable" => true,
				"Editable" => true,
				"Required" => true,
				"Multiple" => false,
				"BaseType" => "string"
			),
			"CREATED_BY" => array(
				"Name" => GetMessage("MCART_PTB_CREATEDBY"),
				"Type" => "S:UserID",
				"Filterable" => true,
				"Editable" => true,
				"Required" => true,
				"Multiple" => false,
				"BaseType" => "user"
			),
			"RESPONSIBLE_ID" => array(
				"Name" => GetMessage("MCART_PTB_TO"),
				"Type" => "S:UserID",
				"Filterable" => true,
				"Editable" => true,
				"Required" => true,
				"Multiple" => true,
				"BaseType" => "user"
			),
			
			"DESCRIPTION" => array(
				"Name" => GetMessage("MCART_PTB_DETAILTEXT"),
				"Type" => "T",
				"Filterable" => true,
				"Editable" => true,
				"Required" => false,
				"Multiple" => false,
				"BaseType" => "text"
			),
			
			"IMPORTANT_MESS" => array(
				"Name" => GetMessage("MCART_PTB_IMPORTANT_MESS"),
				"Type" => "B",
				"Filterable" => true,
				"Editable" => true,
				"Required" => false,
				"Multiple" => false,
				"BaseType" => "bool"
			),
			
		);
		

		return $arFields;
	}
}
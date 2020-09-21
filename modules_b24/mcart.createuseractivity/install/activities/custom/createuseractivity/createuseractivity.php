<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
CModule::IncludeModule('iblock');
class CBPCreateUserActivity
	extends CBPActivity
{
	public function __construct($name)
	{
		parent::__construct($name);
		$this->arProperties = array(
			"Title" => "",
			"Name"=>"",
			"LastName"=>"",
			"Email"=>"",
			"SecondName"=>"",
			"Mobile"=>"",
			"WorkPosition"=>"",
			"WorkDepartments"=>"",
			"SystemGroup"=>0,
			"ErrorMessage"=>null,
			"UserID"=>0
		);
	}

	public function Execute()
	{
        
			
		$regUser = new CUser();
		
		$pass = md5($this->Email);
		
		
				$res = $regUser->Add(array(
				"LOGIN"=>$this->Email,
				"NAME"=>					$this->Name,
				"LAST_NAME"=>					$this->LastName,
				"SECOND_NAME"=>$this->SecondName,
				"PASSWORD"=>					$pass,
				"CONFIRM_PASSWORD"=>					$pass,
				"EMAIL"=>					$this->Email,
				"PERSONAL_MOBILE"=>$this->Mobile,
				"WORK_POSITION"=>$this->WorkPosition,
				"UF_DEPARTMENT"=>explode(",",$this->WorkDepartments)
				
				)
									 );
				CUser::SetUserGroup($res, array($this->SystemGroup));		
			$this->UserID = $res;
			if (!$res)
				{
				$handle = fopen($_SERVER["DOCUMENT_ROOT"]."/bitrix/activities/custom/createuseractivity/er_log.txt", "a");
				                                           
				fwrite($handle, $regUser->LAST_ERROR."\n");	
				$this->ErrorMessage = $regUser->LAST_ERROR;
				}
			else
				CUser::SendPassword($this->Email, $this->Email);
				
	        return CBPActivityExecutionStatus::Closed;
	}

	public static function GetPropertiesDialog($documentType, $activityName, $arWorkflowTemplate, $arWorkflowParameters, $arWorkflowVariables, $arCurrentValues = null, $formName = "")
	{
            $runtime = CBPRuntime::GetRuntime();
            
            if (!is_array($arCurrentValues))
            {
                $arCurrentValues = array();
                
                $arCurrentActivity = &CBPWorkflowTemplateLoader::FindActivityByName($arWorkflowTemplate, $activityName);
           
                if (is_array($arCurrentActivity["Properties"])) 
                        
                {
                    
                    $arCurrentValues["name"] = $arCurrentActivity["Properties"]["Name"];
					$arCurrentValues["last_name"] = $arCurrentActivity["Properties"]["LastName"];
					$arCurrentValues["email"] = $arCurrentActivity["Properties"]["Email"];
					 $arCurrentValues["second_name"] = $arCurrentActivity["Properties"]["SecondName"];
					$arCurrentValues["mobile"] = $arCurrentActivity["Properties"]["Mobile"];
					$arCurrentValues["work_position"] = $arCurrentActivity["Properties"]["WorkPosition"];
					$arCurrentValues["work_department"] = $arCurrentActivity["Properties"]["WorkDepartments"];
					$arCurrentValues["system_group"] = $arCurrentActivity["Properties"]["SystemGroup"];
					
                }
            }

            $runtime = CBPRuntime::GetRuntime();
            return $runtime->ExecuteResourceFile(
                    __FILE__,
                    "properties_dialog.php",
                    array(
                        "arCurrentValues" => $arCurrentValues,
                        "formName" => $formName,
                        )
                    );
	}

	public static function GetPropertiesDialogValues($documentType, $activityName, &$arWorkflowTemplate, &$arWorkflowParameters, &$arWorkflowVariables, $arCurrentValues, &$arErrors)
	{
            $runtime = CBPRuntime::GetRuntime();
            $arProperties = array();

            if (is_array($arCurrentValues) && count($arCurrentValues)>0)
            {
                
                
               			
				 $arProperties ["Name"] =$arCurrentValues["name"];
					 $arProperties ["LastName"] =$arCurrentValues["last_name"];
					 $arProperties ["Email"] =$arCurrentValues["email"];
					 
					$arProperties["SecondName"] = $arCurrentValues["second_name"];
					$arProperties["Mobile"] =$arCurrentValues["mobile"] ;
					$arProperties["WorkPosition"] =$arCurrentValues["work_position"];
					$arProperties["WorkDepartments"] =$arCurrentValues["work_department"]; 
					$arProperties["SystemGroup"] =$arCurrentValues["system_group"]; 
					 
				
            }

            $arCurrentActivity = &CBPWorkflowTemplateLoader::FindActivityByName($arWorkflowTemplate, $activityName);
            $arCurrentActivity["Properties"] = $arProperties;

            return true;
	}
    public static function ValidateProperties($arTestProperties = array(), CBPWorkflowTemplateUser $user = null)
	{
		$arErrors = array();
                

		return array_merge($arErrors, parent::ValidateProperties($arTestProperties, $user));
	}
}
?>
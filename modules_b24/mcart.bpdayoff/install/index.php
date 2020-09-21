<?
IncludeModuleLangFile( __FILE__);
CModule::IncludeModule('bizproc');

if(class_exists("mcart_bpdayoff")) 
	return;

Class mcart_bpdayoff extends CModule
{
	var $MODULE_ID = "mcart.bpdayoff";
	var $MODULE_VERSION;
	var $MODULE_VERSION_DATE;
	var $MODULE_NAME;
	var $MODULE_DESCRIPTION;
	var $MODULE_GROUP_RIGHTS = "Y";

	
	
	function mcart_bpdayoff() 
	{
		$arModuleVersion = array();

        $path = str_replace("\\", "/", __FILE__);
        $path = substr($path, 0, strlen($path) - strlen("/index.php"));
        include($path."/version.php");

        if (is_array($arModuleVersion) && array_key_exists("VERSION", $arModuleVersion)){
            $this->MODULE_VERSION = $arModuleVersion["VERSION"];
            $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
        }else{
            $this->MODULE_VERSION=TASKFROMEMAIL_MODULE_VERSION;
            $this->MODULE_VERSION_DATE=TASKFROMEMAIL_MODULE_VERSION_DATE;
        }

        $this->MODULE_NAME = GetMessage("bpdayoff_MODULE_NAME");
        $this->MODULE_DESCRIPTION = GetMessage("bpdayoff_MODULE_DESCRIPTION");
        
        $this->PARTNER_NAME = GetMessage("PARTNER_NAME");
        $this->PARTNER_URI  = "http://mcart.ru/";
	}
	
	function DoInstall()
	{
		global $APPLICATION;

		if (!IsModuleInstalled("mcart.bpdayoff"))
		{
			$this->InstallDB();
			$this->InstallEvents();
			$this->InstallFiles();
			
		}
		return true;
	}

	function DoUninstall()
	{
		$this->UnInstallDB();
		$this->UnInstallEvents();
		$this->UnInstallFiles();
		
		return true;
	}

	
	function InstallDB() {
		
		$f = fopen($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/mcart.bpdayoff/bp-example.bpt", "rb");
		$datum = fread($f, filesize($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/mcart.bpdayoff/bp-example.bpt"));
		fclose($f);

		$iblockType = "bitrix_processes"; //$iblockType = "bizproc_iblockx";
		$iblockCode = "bizproc_bpdayoff";

		$ib = new CIBlock();
			$arFields = array(
				"IBLOCK_TYPE_ID" => $iblockType,
				"CODE" => $iblockCode,
				"XML_ID" => $iblockCode,
				"LID" => "s1",
				"NAME" => GetMessage("bpdayoff_MODULE_NAME"),
				"ACTIVE" => 'Y',
				"SORT" => 100,
				"INDEX_ELEMENT" => "N",
				/*"PICTURE" => array(
					"name" => "business_trip.jpg",
					"size" => filesize(WIZARD_ABSOLUTE_PATH.'/site/services/bizproc/image/1.jpg'),
					"tmp_name" => WIZARD_ABSOLUTE_PATH.'/site/services/bizproc/image/1.jpg',
					"type" => 'image/jpeg'
				),*/
				"DESCRIPTION" => "v2:a:3:{s:11:\"DESCRIPTION\";s:0:\"\";s:17:\"FILTERABLE_FIELDS\";a:6:{i:0;s:10:\"CREATED_BY\";i:1;s:11:\"ACTIVE_FROM\";i:2;s:9:\"ACTIVE_TO\";i:3;s:4:\"NAME\";i:4;s:13:\"PROPERTY_CITY\";i:5;s:16:\"PROPERTY_COUNTRY\";}s:14:\"VISIBLE_FIELDS\";a:12:{i:0;s:21:\"MODIFIED_BY_PRINTABLE\";i:1;s:11:\"DATE_CREATE\";i:2;s:20:\"CREATED_BY_PRINTABLE\";i:3;s:11:\"ACTIVE_FROM\";i:4;s:9:\"ACTIVE_TO\";i:5;s:4:\"NAME\";i:6;s:12:\"PREVIEW_TEXT\";i:7;s:13:\"PROPERTY_CITY\";i:8;s:16:\"PROPERTY_tickets\";i:9;s:16:\"PROPERTY_COUNTRY\";i:10;s:22:\"PROPERTY_date_end_real\";i:11;s:26:\"PROPERTY_expenditures_real\";}}",
				"DESCRIPTION_TYPE" => 'text',
				
				"WORKFLOW" => 'N',
				"BIZPROC" => 'Y',
				"VERSION" => 1,
				"ELEMENT_ADD" => GetMessage('bpdayoff_NEW'),
				"GROUP_ID" => array(2 => "R", 1=>"R"),
			);
			$iblockId = $ib->Add($arFields);

		//===================================================================================================================================================================================

		$datumTmp = @unserialize($datum);
				
			
		$datumTmp = @gzuncompress($datum);
		$datumTmp = @unserialize($datumTmp);
		$datumTmp["TEMPLATE"] = $this->ConvertArrayCharset($datumTmp["TEMPLATE"], BP_EI_DIRECTION_IMPORT);
		$datumTmp["PARAMETERS"] = $this->ConvertArrayCharset($datumTmp["PARAMETERS"], BP_EI_DIRECTION_IMPORT);
		$datumTmp["VARIABLES"] = $this->ConvertArrayCharset($datumTmp["VARIABLES"], BP_EI_DIRECTION_IMPORT);
		$datumTmp["DOCUMENT_FIELDS"] = $this->ConvertArrayCharset($datumTmp["DOCUMENT_FIELDS"], BP_EI_DIRECTION_IMPORT);
		
		
		$arVariables = $datumTmp["VARIABLES"];
		
		$datumTmp["TEMPLATE"][0]['Properties']['Permission'] = array("read" => array('Variable', 'ParameterOpRead'), "create" => array('Variable', 'ParameterOpCreate'), "admin" => array('Variable', 'ParameterOpAdmin'));


				$arFieldsT = array(
				"DOCUMENT_TYPE" => array("bizproc", "CBPVirtualDocument", "type_".$iblockId),
				"AUTO_EXECUTE" => CBPDocumentEventType::Create,
				"NAME" => GetMessage("bpdayoff_MODULE_NAME"),
				"DESCRIPTION" => GetMessage("bpdayoff_MODULE_DESCRIPTION"),
				"TEMPLATE" => $datumTmp["TEMPLATE"],
				"PARAMETERS" => $datumTmp["PARAMETERS"],
				"VARIABLES" => $arVariables,
				"MODIFIER_USER" => intval($GLOBALS["USER"]->GetID()),
				"USER_ID" => $GLOBALS["USER"]->GetID(),
				"ACTIVE" => 'Y',
			);
			CBPWorkflowTemplateLoader::Add($arFieldsT);
		
		
		RegisterModule("mcart.bpdayoff");	
		return true;
	
			
	}
	
	function UnInstallDB()
	{
		
		UnRegisterModule("mcart.bpdayoff");
		return true;
	}
	
	
	
	function InstallEvents()
	{
		return true;
	}

	function UnInstallEvents()
	{
		return true;
	}

	function InstallFiles()
	{
	return true;
	}
	
	function UnInstallFiles()
	{	
		
		return true;
	}
	
	function ConvertValueCharset($s, $direction)
	{
		if ("utf-8" == strtolower(LANG_CHARSET))
			return $s;

		if (is_numeric($s))
			return $s;

		if ($direction == BP_EI_DIRECTION_EXPORT)
			$s = $GLOBALS["APPLICATION"]->ConvertCharset($s, LANG_CHARSET, "UTF-8");
		else
			$s = $GLOBALS["APPLICATION"]->ConvertCharset($s, "UTF-8", LANG_CHARSET);

		return $s;
	}

	function ConvertArrayCharset($value, $direction = BP_EI_DIRECTION_EXPORT)
	{
		if (is_array($value))
		{
			$valueNew = array();
			foreach ($value as $k => $v)
			{
				$k = $this->ConvertValueCharset($k, $direction);
				$v = $this->ConvertArrayCharset($v, $direction);
				$valueNew[$k] = $v;
			}
			$value = $valueNew;
		}
		else
		{
			$value = $this->ConvertValueCharset($value, $direction);
		}

		return $value;
	}
} //end class
	?>
<?
IncludeModuleLangFile( __FILE__);


if(class_exists("mcart_pushtoblogactivity")) 
	return;

Class mcart_pushtoblogactivity extends CModule
{
	var $MODULE_ID = "mcart.pushtoblogactivity";
	var $MODULE_VERSION;
	var $MODULE_VERSION_DATE;
	var $MODULE_NAME;
	var $MODULE_DESCRIPTION;
	var $MODULE_GROUP_RIGHTS = "Y";

	
	
	function mcart_pushtoblogactivity() 
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

        $this->MODULE_NAME = GetMessage("pushtoblogactivity_MODULE_NAME");
        $this->MODULE_DESCRIPTION = GetMessage("pushtoblogactivity_MODULE_DESCRIPTION");
        
        $this->PARTNER_NAME = GetMessage("PARTNER_NAME");
        $this->PARTNER_URI  = "http://mcart.ru/";
	}
	
	function DoInstall()
	{
		global $APPLICATION;

		if (!IsModuleInstalled("mcart.pushtoblogactivity"))
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
		
		
		RegisterModule("mcart.pushtoblogactivity");	
		return true;
	
			
	}
	
	function UnInstallDB()
	{
		
		UnRegisterModule("mcart.pushtoblogactivity");
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
	CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/mcart.pushtoblogactivity/install/activities", $_SERVER["DOCUMENT_ROOT"]."/bitrix/activities", true, true);
	return true;
	}
	
	function UnInstallFiles()
	{	
		DeleteDirFilesEx("/bitrix/activities/custom/mcartpushtoblog/");
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
<?
IncludeModuleLangFile( __FILE__);


if(class_exists("mcart_createuseractivity")) 
	return;

Class mcart_createuseractivity extends CModule
{
	var $MODULE_ID = "mcart.createuseractivity";
	var $MODULE_VERSION;
	var $MODULE_VERSION_DATE;
	var $MODULE_NAME;
	var $MODULE_DESCRIPTION;
	var $MODULE_GROUP_RIGHTS = "Y";

	
	
	function mcart_createuseractivity() 
	{
		$arModuleVersion = array();

        $path = str_replace("\\", "/", __FILE__);
        $path = substr($path, 0, strlen($path) - strlen("/index.php"));
        include($path."/version.php");

        if (is_array($arModuleVersion) && array_key_exists("VERSION", $arModuleVersion)){
            $this->MODULE_VERSION = $arModuleVersion["VERSION"];
            $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
        }else{
            $this->MODULE_VERSION=CREATEUSER_MODULE_VERSION;
            $this->MODULE_VERSION_DATE=CREATEUSER_MODULE_VERSION_DATE;
        }

        $this->MODULE_NAME = GetMessage("CREATEUSER_MODULE_NAME");
        $this->MODULE_DESCRIPTION = GetMessage("CREATEUSER_MODULE_DESCRIPTION");
        
        $this->PARTNER_NAME = GetMessage("MCART_PARTNER_NAME");
        $this->PARTNER_URI  = "http://mcart.ru/";
	}
	
	function DoInstall()
	{
		global $APPLICATION;

		if (!IsModuleInstalled("mcart.createuseractivity"))
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
		

		
		
		RegisterModule("mcart.createuseractivity");	
		return true;
	
			
	}
	
	function UnInstallDB()
	{
		
		UnRegisterModule("mcart.createuseractivity");
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
	
	CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/mcart.createuseractivity/install/activities/", $_SERVER["DOCUMENT_ROOT"]."/bitrix/activities", true, true);
	
	return true;
	}
	
	function UnInstallFiles()
	{	
		DeleteDirFilesEx("/bitrix/activities/custom/createuseractivity/");
		return true;
	}
	
	
} //end class
	?>	
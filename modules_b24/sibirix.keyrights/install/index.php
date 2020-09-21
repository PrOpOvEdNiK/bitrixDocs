<?
$ret = IncludeModuleLangFile(__FILE__);

if (class_exists("sibirix_keyrights")) return;

/**
 * Class sibirix_keyrights
 */
class sibirix_keyrights extends CModule {

    var $MODULE_ID = 'sibirix.keyrights';
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_NAME;
    var $MODULE_DESCRIPTION;

    var $FRONTEND_PATH = "/keyrights/";
    var $IBLOCK_CODE = "keyrights";
    var $IBLOCK_HISTORY_CODE = "keyrights.history";
    var $IBLOCK_TYPE_CODE = "keyrights";

    var $errors = array();

    /**
     *
     */
    public function sibirix_keyrights() {

        $arModuleVersion = array();

        include(substr(__FILE__, 0, -10) . '/version.php');

        $this->MODULE_VERSION      = $arModuleVersion['VERSION'];
        $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];

        $this->MODULE_NAME        = GetMessage('KEYRIGHTS_MODULE_NAME');
        $this->MODULE_DESCRIPTION = GetMessage('KEYRIGHTS_MODULE_DESCRIPTION');

        $this->PARTNER_NAME = 'Sibirix';
        $this->PARTNER_URI  = 'http://www.sibirix.ru/';
    }

    /**
     * @return bool
     */
    public function DoInstall() {
        global $APPLICATION;

        $GLOBALS["errors"] = array();

        if (IsModuleInstalled("sibirix.keyrights")) {
            return false;
        }

        if (!check_bitrix_sessid()) {
            return false;
        }

        global $reqCheck;
        $reqCheck = $this->checkRequirements();
        $step = IntVal($_REQUEST["step"]);

        if (($step == 0) || (count($reqCheck['errors']) > 0)) {
            $APPLICATION->IncludeAdminFile(GetMessage("KEYRIGHTS_INSTALL"), $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/sibirix.keyrights/install/step1.php");

        } elseif ($step == 1) {
            // Validate parameters from step 1, if OK - show manual of creating Facebook and VK apps

            if (empty($_REQUEST['keyphrase'])) {
                $GLOBALS['errors']['keyphrase'] = true;
                $APPLICATION->IncludeAdminFile(GetMessage("KEYRIGHTS_INSTALL"), $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/sibirix.keyrights/install/step1.php");
            } else {
                $options = new COption();
                $options->SetOptionString($this->MODULE_ID, 'clientPassphrase', $_REQUEST['keyphrase']);

                $serverPhrase = $options->GetOptionString($this->MODULE_ID, 'serverPassphrase');
                if (empty($serverPhrase)) {
                    $options->SetOptionString($this->MODULE_ID, 'serverPassphrase', randString(50));
                }

                $this->InstallDB();
                $this->InstallIblocks();
                $this->installFiles();
                $this->installRewrite();
                $this->installMenu();

                RegisterModule("sibirix.keyrights");

                RegisterModuleDependences('iblock', 'OnAfterIBlockSectionDelete', $this->MODULE_ID, 'CKeyrights', 'onIblockSectionDelete');
                RegisterModuleDependences('main', 'OnUserDelete', $this->MODULE_ID, 'CKeyrights', 'onUserDelete');

                $GLOBALS["errors"] = $this->errors;

                LocalRedirect($this->FRONTEND_PATH);
            }
        }

        return true;
    }

    /**
     * Install SQL-file to database
     * @return bool always true
     */
    public function InstallDB() {
        global $DB, $APPLICATION;
        $errors = false;

        // Database tables creation
        if (!$DB->Query("SELECT * FROM sib_kr_item", true)) {
            $file   = $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/sibirix.keyrights/install/db/" . strtolower($DB->type) . "/install.sql";
            $file   = str_replace("//", "/", $file);
            $errors = $this->RunSQLBatch($file);
        }

        if ($errors !== false) {
            $APPLICATION->ThrowException(implode("<br>", $this->errors));
            return false;
        }

        return true;
    }

    /**
     * Create infoblocks (iblock type, iblock itself, iblock properties)
     * @return bool
     */
    public function InstallIblocks() {
        if (!CModule::IncludeModule("iblock")) return false;

        $cIblockType = new CIBlockType();
        $cIblock = new CIBlock();
        $cSite = new CSite();
        $cIBlockProperty = new CIBlockProperty();

        // Infoblock type
        $res = $cIblockType->GetByID($this->IBLOCK_TYPE_CODE);
        $type = $res->Fetch();

        if (!$type) {
            $arFields = Array(
                'ID'       => $this->IBLOCK_TYPE_CODE,
                'SECTIONS' => 'Y',
                'IN_RSS'   => 'N',
                'SORT'     => 1000,
                'LANG'     => Array(
                    'ru' => Array(
                        'NAME'         => 'Sibirix.Keyrights',
                        'SECTION_NAME' => GetMessage('KEYRIGHTS_IBLOCK_SECTION_NAME'),
                        'ELEMENT_NAME' => GetMessage('KEYRIGHTS_IBLOCK_ELEMENT_NAME')
                    ),
                    'en' => Array(
                        'NAME'         => 'Sibirix.Keyrights',
                        'SECTION_NAME' => 'Section',
                        'ELEMENT_NAME' => 'Element'
                    )
                )
            );
            $cIblockType->Add($arFields);
        }

        // Infoblock itself
        $siteId = $cSite->GetDefSite();
        $res = $cIblock->GetList(array(), array(
            'TYPE'    => $this->IBLOCK_TYPE_CODE,
            "CODE"    => $this->IBLOCK_CODE
        ));
        $keyrightsIblock = $res->Fetch();

        if (!$keyrightsIblock) {
            $keyrightsIblockId = $cIblock->Add(array(
                "ACTIVE"          => 'Y',
                "NAME"            => "Sibirix.Keyrights",
                "CODE"            => $this->IBLOCK_CODE,
                "LIST_PAGE_URL"   => $this->FRONTEND_PATH,
                "DETAIL_PAGE_URL" => $this->FRONTEND_PATH,
                "IBLOCK_TYPE_ID"  => $this->IBLOCK_TYPE_CODE,
                "SITE_ID"         => array($siteId),
                "SORT"            => 100,
                "GROUP_ID"        => array("2" => "R"),
                "VERSION"         => '2',
            ));

            // Infoblock properties
            $arFields = array(
                "IBLOCK_ID"     => $keyrightsIblockId,
                "ACTIVE"        => "Y",
                "NAME"          => GetMessage('KEYRIGHTS_IBLOCK_NAME'),
                "SORT"          => 10,
                "CODE"          => 'CRYPTED',
                "PROPERTY_TYPE" => "S",
                "USER_TYPE"     => 'HTML',
                "MULTIPLE"      => 'N',
                "IS_REQUIRED"   => 'N'
            );
            $cIBlockProperty->Add($arFields);

        } else {
            $keyrightsIblockId = $keyrightsIblock['ID'];
        }


        // Infoblock history itself
        $siteId = $cSite->GetDefSite();
        $res = $cIblock->GetList(array(), array(
            'TYPE'    => $this->IBLOCK_TYPE_CODE,
            "CODE"    => $this->IBLOCK_HISTORY_CODE
        ));
        $keyrightsHistoryIblock = $res->Fetch();

        if (!$keyrightsHistoryIblock) {
            $keyrightsHistroyIblockId = $cIblock->Add(array(
                "ACTIVE"          => 'Y',
                "NAME"            => "Sibirix.Keyrights.History",
                "CODE"            => $this->IBLOCK_HISTORY_CODE,
                "LIST_PAGE_URL"   => $this->FRONTEND_PATH,
                "DETAIL_PAGE_URL" => $this->FRONTEND_PATH,
                "IBLOCK_TYPE_ID"  => $this->IBLOCK_TYPE_CODE,
                "SITE_ID"         => array($siteId),
                "SORT"            => 100,
                "GROUP_ID"        => array("2" => "R"),
                "VERSION"         => '2',
            ));

            // Infoblock properties Password
            $arHistoryFields = array(
                "IBLOCK_ID"     => $keyrightsHistroyIblockId,
                "ACTIVE"        => "Y",
                "NAME"          => "Password",
                "SORT"          => 10,
                "CODE"          => 'ITEM_ID',
                "PROPERTY_TYPE" => "N",
                "MULTIPLE"      => 'N',
                "IS_REQUIRED"   => 'Y'
            );
            $cIBlockProperty->Add($arHistoryFields);
            // Infoblock properties Action
            $arHistoryFields = array(
                "IBLOCK_ID"     => $keyrightsHistroyIblockId,
                "ACTIVE"        => "Y",
                "NAME"          => "Action",
                "SORT"          => 10,
                "CODE"          => 'ACTION',
                "PROPERTY_TYPE" => "S",
                "MULTIPLE"      => 'N',
                "IS_REQUIRED"   => 'Y'
            );
            $cIBlockProperty->Add($arHistoryFields);

        } else {
            $keyrightsHistroyIblockId = $keyrightsHistoryIblock['ID'];
        }

        COption::SetOptionString($this->MODULE_ID, 'iblockId', $keyrightsIblockId);
        COption::SetOptionString($this->MODULE_ID, 'historyIblockId', $keyrightsHistroyIblockId);

        return true;
    }

    /**
     * Copy files of templates, componenets, frontend
     * @return bool
     */
    public function installFiles() {
        DeleteDirFilesEx("/bitrix/cache/keyrights/");
        DeleteDirFilesEx("/bitrix/components/sibirix/keyrights/");
        CopyDirFiles($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/sibirix.keyrights/install/frontend",   $_SERVER["DOCUMENT_ROOT"] . $this->FRONTEND_PATH, true, true);
        CopyDirFiles($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/sibirix.keyrights/install/components", $_SERVER["DOCUMENT_ROOT"] . "/bitrix/components", true, true);

        return true;
    }

    /**
     * @return array
     */
    public function checkRequirements() {
        global $DB;

        $errors = array();
        $status = array();

        if (empty($DB->type) || (mb_strtolower($DB->type) !== 'mysql')) {
            $errors['db'] = GetMessage('KEYRIGHTS_INSTALL_REQERROR_DB');
            $status[] = "err";
        } else {
            $status[] = "ok";
        }

        // Bitrix CorPortal 14.5 or newer
        if (!CheckVersion(SM_VERSION, "14.5.0")) {
            $errors['bx'] = GetMessage('KEYRIGHTS_INSTALL_REQERROR_BX');
            $status[] = "err";
        } else {
            $status[] = "ok";
        }

        // Bitrix modules installed
        $module = new CModule();
        if (!$module->IncludeModule("iblock")) {
            $errors['sale'] = GetMessage('KEYRIGHTS_INSTALL_REQERROR_IBLOCK');
            $status[] = "err";
        } else {
            $status[] = "ok";
        }

        // Urlrewrite.php rights
        $docRoot = CSite::GetSiteDocRoot(SITE_ID);
        if (!is_writable($docRoot . '/urlrewrite.php')) {
            $errors['rewrite'] = GetMessage('KEYRIGHTS_INSTALL_REQERROR_REWRITE');
            $status[] = "err";
        } else {
            $status[] = "ok";
        }

        return array(
            'errors' => $errors,
            'status' => $status,
        );
    }

    /**
     * Install SEF rewrite rule
     */
    public function installRewrite() {
        $cUrlRewriter = new CUrlRewriter();
        $cUrlRewriter->Add(array(
            "SITE_ID"   => SITE_ID,
            "CONDITION" => "#^/keyrights/#",
            "ID"        => "sibirix:keyrights",
            "PATH"      => "/keyrights/index.php",
            "RULE"      => ""
        ));
    }

    /**
     * add link to keyrights into menu
     */
    function installMenu() {
        $rsSite = CSite::GetList($by = "sort", $order = "desc", Array("LID" => SITE_ID));
        $site = $rsSite->Fetch();
        $siteFolder = !empty($site['DIR']) ? $site['DIR'] : '/';
        $menuFile = "/.left.menu.php";
        $menuPath = CSite::GetSiteDocRoot(SITE_ID) . $siteFolder . $menuFile;
        $menuPath = str_replace('//', '/', $menuPath);
        $res      = CFileMan::GetMenuArray($menuPath);

        $menuItem = array(
            "KeyRights",
            "/keyrights/",
            Array(),
            Array(),
            ""
        );

        array_unshift($res['aMenuLinks'], $menuItem);

        CFileMan::SaveMenu(array(
            SITE_ID,
            $siteFolder . $menuFile
        ), $res["aMenuLinks"], $res["sMenuTemplate"]);
    }


    /********************************************************************************************************************************************
     * Uninstall our module
     * @return bool
     */
    public function DoUninstall() {
        global $APPLICATION;

        $GLOBALS["errors"] = array();

        if (!IsModuleInstalled("sibirix.keyrights")) {
            return false;
        }
        if (!check_bitrix_sessid()) {
            return false;
        }

        $step = IntVal($_REQUEST["step"]);

        if ($step != 2) {
            $APPLICATION->IncludeAdminFile(GetMessage("KEYRIGHTS_UNINSTALL"), $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/sibirix.keyrights/install/unstep1.php");

        } else {
            if (empty($_REQUEST['module']['deleteTables'])) {
                $this->UnInstallDB();
                $this->UnInstallIblocks();
                COption::RemoveOption($this->MODULE_ID, 'clientPassphrase');
                COption::RemoveOption($this->MODULE_ID, 'serverPassphrase');
            }


            $this->uninstallFiles();
            $this->uninstallRewrite();
            $this->uninstallMenu();

            UnRegisterModuleDependences('iblock', 'OnAfterIBlockSectionDelete', $this->MODULE_ID, 'CKeyrights', 'onIblockSectionDelete');
            UnRegisterModuleDependences('main', 'OnUserDelete', $this->MODULE_ID, 'CKeyrights', 'onUserDelete');

            UnRegisterModule("sibirix.keyrights");
            LocalRedirect("/bitrix/admin/partner_modules.php");
        }

        return true;
    }

    /**
     * Remove link to keyrights from menu
     */
    function uninstallMenu() {
        $rsSite = CSite::GetList($by = "sort", $order = "desc", Array("LID" => SITE_ID));
        $site = $rsSite->Fetch();
        $siteFolder = !empty($site['DIR']) ? $site['DIR'] : '/';
        $menuFile = "/.left.menu.php";
        $menuPath = CSite::GetSiteDocRoot(SITE_ID) . $siteFolder . $menuFile;
        $menuPath = str_replace('//', '/', $menuPath);
        $res      = CFileMan::GetMenuArray($menuPath);

        foreach ($res['aMenuLinks'] as $ind => $menuItem) {
            if ($menuItem[1] == "/keyrights/") {
                array_splice($res['aMenuLinks'], $ind, 1);
                break;
            }
        }

        CFileMan::SaveMenu(array(
            SITE_ID,
            $siteFolder . $menuFile
        ), $res["aMenuLinks"], $res["sMenuTemplate"]);
    }

    /**
     * Remove files, that we copied
     * @return bool
     */
    public function uninstallFiles() {
        $deletePath = $this->FRONTEND_PATH;
        if ($deletePath[strlen($deletePath) - 1] == "/") {
            $deletePath = substr($deletePath, 0, strlen($deletePath) - 1);
        }
        DeleteDirFilesEx($deletePath);
        DeleteDirFilesEx("/bitrix/components/sibirix/keyrights/");

        return true;
    }

    /**
     * Remove db tables
     * @return bool
     * @throws Exception
     */
    public function UnInstallDB() {
        global $DB;

        $tableList = array(
            "kr_item",
            "kr_right",
        );

        foreach ($tableList as $table) {
            $query = "DROP TABLE IF EXISTS `sib_$table`;";
            $DB->Query($query);
        }

        return true;
    }

    /**
     * @return bool
     */
    public function UnInstallIblocks() {
        if (!CModule::IncludeModule("iblock")) return false;

        $cIblockType = new CIBlockType();
        $cIblock = new CIBlock();

        $iblockId = COption::GetOptionString($this->MODULE_ID, 'iblockId');
        $res = $cIblock->GetList(array(), array(
            'ID'   => $iblockId,
            'TYPE' => $this->IBLOCK_TYPE_CODE,
            "CODE" => $this->IBLOCK_CODE
        ));

        $keyrightsIblockId = $res->Fetch();
        if ($keyrightsIblockId) {
            $cIblock->Delete($keyrightsIblockId['ID']);
        }

        $iblockHistoryId = COption::GetOptionString($this->MODULE_ID, 'historyIblockId');
        $res = $cIblock->GetList(array(), array(
            'ID'   => $iblockHistoryId,
            'TYPE' => $this->IBLOCK_TYPE_CODE,
            "CODE" => $this->IBLOCK_HISTORY_CODE
        ));

        $keyrightsHistoryIblockId = $res->Fetch();
        if ($keyrightsHistoryIblockId) {
            $cIblock->Delete($keyrightsHistoryIblockId['ID']);
        }

        // Infoblock type
        $res = $cIblockType->GetByID($this->IBLOCK_TYPE_CODE);
        $type = $res->Fetch();
        if ($type) {
            // Check, that no other iblocks there
            $res = $cIblock->GetList(array(), array(
                'TYPE' => $this->IBLOCK_TYPE_CODE,
            ));

            if ($res->Fetch()) {
                // do nothing
            } else {
                $cIblockType->Delete($this->IBLOCK_TYPE_CODE);
            }
        }

        COption::RemoveOption($this->MODULE_ID, 'iblockId');
        COption::RemoveOption($this->MODULE_ID, 'historyIblockId');

        return true;
    }

    /**
     * Remove SEF rewrite rule
     */
    public function uninstallRewrite() {
        $cUrlRewriter = new CUrlRewriter();
        $cUrlRewriter->Delete(array("CONDITION" => "#^/keyrights/#"));
    }

    /**
     * @param $filepath
     * @param bool $bIncremental
     * @param bool $utf
     * @return array|bool
     */
    public function RunSQLBatch($filepath, $bIncremental = False, $utf = false) {
        global $DB, $APPLICATION;

        if (!file_exists($filepath) || !is_file($filepath)) return Array("File $filepath is not found.");

        $arErr = Array();
        $f     = @fopen($filepath, "rb");
        if ($f) {
            $contents = fread($f, filesize($filepath));
            if ($utf && ToUpper(LANG_CHARSET) == ToUpper('windows-1251')) {
                $contents = $APPLICATION->ConvertCharset($contents, "UTF-8", "windows-1251");
            }
            fclose($f);

            $arSql = $DB->ParseSqlBatch($contents, $bIncremental);

            for ($i = 0; $i < count($arSql); $i++) {
                if ($bIncremental) {
                    $arErr[] = $arSql[$i];
                } else {
                    $strSql = str_replace("\r\n", "\n", $arSql[$i]);
                    if (!$DB->Query($strSql, true)) $arErr[] = "<hr><pre>Query:\n" . $strSql . "\n\nError:\n<font color=red>" . $DB->GetErrorMessage() . "</font></pre>";
                }
            }
        }

        if (count($arErr) > 0) return $arErr;

        return false;
    }

}

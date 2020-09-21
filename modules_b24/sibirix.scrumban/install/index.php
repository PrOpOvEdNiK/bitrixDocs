<?
$ret = IncludeModuleLangFile(__FILE__);

if (!class_exists("sibirix_scrumban")) {
    class sibirix_scrumban extends CModule {

        var $MODULE_ID = "sibirix.scrumban";
        var $MODULE_VERSION;
        var $MODULE_VERSION_DATE;
        var $MODULE_NAME;
        var $MODULE_DESCRIPTION;

        var $FRONTEND_PATH = "/scrumban/";

        var $errors = array();

        var $eventTypes = array(
            array(
                "EVENT_NAME"  => "SCRUMBAN_EMAIL",
                "NAME"        => "Scrumban info email",
                "DESCRIPTION" => "Scrumban info email",
                'TEMPLATES'   => array(
                    array(
                        'ACTIVE'     => 'Y',
                        'EVENT_NAME' => 'SCRUMBAN_EMAIL',
                        'SUBJECT'    => 'SCRUMBAN_INSTALL_MAIL_TEMPLATE_EMAIL_SUBJECT',
                        'EMAIL_FROM' => '#DEFAULT_EMAIL_FROM#',
                        'EMAIL_TO'   => '#EMAIL_TO#',
                        'BODY_TYPE'  => 'text',
                        'MESSAGE'    => 'SCRUMBAN_INSTALL_MAIL_TEMPLATE_EMAIL_MESSAGE',
                    ),
                ),
            ),
            array(
                "EVENT_NAME"  => "SCRUMBAN_SUPPORT_WEEKLY",
                "NAME"        => "Scrumban support weekly notify",
                "DESCRIPTION" => "Scrumban support weekly notify",
                'TEMPLATES'   => array(
                    array(
                        'ACTIVE'     => 'Y',
                        'EVENT_NAME' => 'SCRUMBAN_SUPPORT_WEEKLY',
                        'SUBJECT'    => 'SCRUMBAN_INSTALL_MAIL_TEMPLATE_SUPPORT_WEEKLY_SUBJECT',
                        'EMAIL_FROM' => '#DEFAULT_EMAIL_FROM#',
                        'EMAIL_TO'   => '#EMAIL#',
                        'BODY_TYPE'  => 'html',
                        'MESSAGE'    => 'SCRUMBAN_INSTALL_MAIL_TEMPLATE_SUPPORT_WEEKLY_MESSAGE',
                    ),
                ),
            ),
            array(
                "EVENT_NAME"  => "SCRUMBAN_SUPPORT_DAILY",
                "NAME"        => "Scrumban support daily notify",
                "DESCRIPTION" => "Scrumban support daily notify",
                'TEMPLATES'   => array(
                    array(
                        'ACTIVE'     => 'Y',
                        'EVENT_NAME' => 'SCRUMBAN_SUPPORT_DAILY',
                        'SUBJECT'    => 'SCRUMBAN_INSTALL_MAIL_TEMPLATE_SUPPORT_DAILY_SUBJECT',
                        'EMAIL_FROM' => '#DEFAULT_EMAIL_FROM#',
                        'EMAIL_TO'   => '#EMAIL#',
                        'BODY_TYPE'  => 'html',
                        'MESSAGE'    => 'SCRUMBAN_INSTALL_MAIL_TEMPLATE_SUPPORT_DAILY_MESSAGE',
                    ),
                ),
            ),
            array(
                "EVENT_NAME"  => "SCRUMBAN_NOTIFY_IMPORTANT",
                "NAME"        => "Scrumban important tasks notify",
                "DESCRIPTION" => "Scrumban important tasks notify",
                'TEMPLATES'   => array(
                    array(
                        'ACTIVE'     => 'Y',
                        'EVENT_NAME' => 'SCRUMBAN_NOTIFY_IMPORTANT',
                        'SUBJECT'    => 'SCRUMBAN_INSTALL_MAIL_TEMPLATE_IMPORTANT_TASK_NOTIFY_SUBJECT',
                        'EMAIL_FROM' => '#DEFAULT_EMAIL_FROM#',
                        'EMAIL_TO'   => '#EMAIL#',
                        'BODY_TYPE'  => 'html',
                        'PRIORITY'   => '1 (Highest)',
                        'MESSAGE'    => '#TEXT#',
                    ),
                ),
            ),
        );

        /**
         * Module installator constructor
         */
        function sibirix_scrumban() {

            $arModuleVersion = array();

            include(substr(__FILE__, 0, -10) . "/version.php");

            $this->MODULE_VERSION      = $arModuleVersion["VERSION"];
            $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];

            $this->MODULE_NAME        = GetMessage("SCRUMBAN_MODULE_NAME");
            $this->MODULE_DESCRIPTION = GetMessage("SCRUMBAN_MODULE_DESC");

            $this->PARTNER_NAME = "Sibirix";
            $this->PARTNER_URI  = "http://www.sibirix.ru/";
        }

        /**
         * Do install module
         * @return bool
         */
        function DoInstall() {
            global $APPLICATION;

            $GLOBALS["errors"] = array();

            if (IsModuleInstalled("sibirix.scrumban")) {
                return false;
            }

            if (!check_bitrix_sessid()) {
                return false;
            }

            $APPLICATION->AddHeadScript("//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js");

            global $reqCheck;
            $reqCheck = $this->checkRequirements();

            $step = IntVal($_REQUEST["step"]);

            if ($step == 0) {
                $APPLICATION->IncludeAdminFile(GetMessage("SCRUMBAN_INSTALL"), $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/sibirix.scrumban/install/step1.php");

            } elseif ($step == 1) {
                // Validate parameters from step 1, if OK - show manual of creating Facebook and VK apps
                $isValid = $this->validateStep1();

                if (!$isValid) {
                    $APPLICATION->IncludeAdminFile(GetMessage("SCRUMBAN_INSTALL"), $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/sibirix.scrumban/install/step1.php");

                } else {

                    // Installing !!
                    $rights  = isset($_REQUEST['projectRightsManagement']) ? 1 : 0;
                    $options = new COption();
                    $options->SetOptionString($this->MODULE_ID, 'projectRightsManagement', $rights);

                    $this->InstallDB();
                    $this->installFiles();
                    $this->installExtranet();
                    $this->installEvents();
                    $this->installMailTemplates();
                    $this->installClassAutoload();
                    $this->installRewrite();
                    $this->installSecurityRules();
                    $this->installApplicationConfig();

                    RegisterModule("sibirix.scrumban");
                    $this->installAgents();
                    $GLOBALS["errors"] = $this->errors;

                    LocalRedirect('/scrumban/');
                }
            }

            return empty($GLOBALS['errors']);
        }

        /**
         * Install security rules for ignoring external JS in page source code
         */
        function installSecurityRules() {
            $module = new CModule();
            if ($module->IncludeModule("security")) {

                $listSecurityRules = array(
                    array(
                        'html'  => "var jsonBoard = {\"kanbanBoardId\":",
                        'exist' => false
                    ),
                    array(
                        'html'  => "var projectList = {",
                        'exist' => false
                    ),
                );

                $whiteListRes      = CSecurityAntiVirus::GetWhiteList();
                $securityWhiteList = array();
                while ($ar = $whiteListRes->Fetch()) {
                    $ar["WHITE_SUBSTR"] = trim($ar["WHITE_SUBSTR"]);
                    foreach ($listSecurityRules as $ind => $rule) {
                        if ($ar["WHITE_SUBSTR"] == $rule['html']) {
                            $listSecurityRules[$ind]['exist'] = true;
                        }
                    }
                    if ($ar["WHITE_SUBSTR"] == $listSecurityRules[0]) {
                        break;
                    }
                    $securityWhiteList[] = $ar["WHITE_SUBSTR"];
                }

                $cnt = 0;
                foreach ($listSecurityRules as $rule) {
                    if (!$rule['exist']) {
                        $securityWhiteList[] = $rule['html'];
                        $cnt++;
                    }
                }

                if ($cnt > 0) {
                    CSecurityAntiVirus::UpdateWhiteList($securityWhiteList);
                }
            }
        }

        function installApplicationConfig() {
            $dir = $_SERVER["DOCUMENT_ROOT"] . "/bitrix/components/sibirix/scrumban/application/backends/bitrix/configs/";

            if (file_exists($dir . 'application.example.ini')) {
                if (file_exists($dir . 'application.ini')) {
                    unlink($dir . 'application.ini');
                }
                copy($dir . 'application.example.ini', $dir . 'application.ini');
            }
        }

        /**
         * Validating parameters from step 1
         * @return bool
         */
        function validateStep1() {
            if (!isset($_REQUEST['licence_agree']) && isset($_REQUEST["step"])) {
                $GLOBALS["errors"]['licence'] = true;

                return false;
            }

            return true;
        }

        /**
         * Check minimal system requirements
         * @return array Array of errors. Empty if no errors
         */
        function checkRequirements() {
            $errors = array();
            $status = array();

            // Bitrix 11.0 or newer
            if (!CheckVersion(SM_VERSION, "17.0.0")) {
                $errors['bx'] = GetMessage('SCRUMBAN_INSTALL_REQERROR_BX');
                $status[]     = "err";
            } else {
                $status[] = "ok";
            }

            // Bitrix modules installed
            $module = new CModule();
            if (!$module->IncludeModule("tasks")) {
                $errors['sale'] = GetMessage('SCRUMBAN_INSTALL_REQERROR_TASKS');
                $status[]       = "err";
            } else {
                $tasksInfo = $module::CreateModuleObject('tasks');
                if (CheckVersion($tasksInfo->MODULE_VERSION, '17.5.0')) {
                    $status[] = "ok";
                } else {
                    $errors['sale'] = GetMessage('SCRUMBAN_INSTALL_REQERROR_TASKS_VERSION');
                    $status[]       = "err";
                }
            }

            if (!$module->IncludeModule("socialnetwork")) {
                $errors['catalog'] = GetMessage('SCRUMBAN_INSTALL_REQERROR_SOCIAL');
                $status[]          = "err";
            } else {
                $status[] = "ok";
            }

            if (!$module->IncludeModule("forum")) {
                $errors['iblock'] = GetMessage('SCRUMBAN_INSTALL_REQERROR_FORUM');
                $status[]         = "err";
            } else {
                $status[] = "ok";
            }

            if (!$module->IncludeModule("timeman")) {
                $errors['iblock'] = GetMessage('SCRUMBAN_INSTALL_REQERROR_TIMEMAN');
                $status[]         = "err";
            } else {
                $status[] = "ok";
            }

            return array(
                "errors" => $errors,
                "status" => $status
            );
        }

        /**
         * Install SQL-file to database
         * @return bool always true
         */
        function InstallDB() {
            global $DB, $APPLICATION;
            $errors = false;

            // Database tables creation
            if (!$DB->Query("SELECT * FROM sib_kanban_board", true)) {
                $file   = $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/sibirix.scrumban/install/db/" . strtolower($DB->type) . "/install.sql";
                $file   = str_replace("//", "/", $file);
                $errors = $this->RunSQLBatch($file);

                $file   = $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/sibirix.scrumban/install/db/" . "example.sql";
                $file   = str_replace("//", "/", $file);
                $errors = $this->RunSQLBatch($file, false, true);
            }

            if ($errors !== false) {
                $APPLICATION->ThrowException(implode("<br>", $this->errors));

                return false;
            }

            return true;
        }

        /**
         * Copy files of templates, componenets, frontend
         * @return bool
         */
        function installFiles() {
            DeleteDirFilesEx("/bitrix/cache/scrumban/");
            DeleteDirFilesEx("/bitrix/components/sibirix/scrumban/");
            CopyDirFiles($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/sibirix.scrumban/install/frontend", $_SERVER["DOCUMENT_ROOT"] . $this->FRONTEND_PATH, true, true);
            CopyDirFiles($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/sibirix.scrumban/install/components", $_SERVER["DOCUMENT_ROOT"] . "/bitrix/components", true, true);

            return true;
        }

        /**
         * Установить копию для экстранета
         */
        function installExtranet() {
            $module    = new CModule();
            $installed = $module->IncludeModule('extranet');
            if (!$installed) return false;

            $sid = CExtranet::GetExtranetSiteID();
            if (!$sid) return false;

            $by         = "sort";
            $order      = "desc";
            $rsSite     = CSite::GetList($by, $order, array("LID" => $sid));
            $site       = $rsSite->Fetch();
            $siteFolder = !empty($site['DIR']) ? $site['DIR'] : '/';
            $root       = !empty($site['DOC_ROOT']) ? $site['DOC_ROOT'] : $_SERVER["DOCUMENT_ROOT"];

            $pathTo = $root . $siteFolder . $this->FRONTEND_PATH;
            $pathTo = str_replace('//', '/', $pathTo);
            CopyDirFiles($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/sibirix.scrumban/install/frontend", $pathTo, true, true);

            // Установить рерайты для экстранета
            CUrlRewriter::Add(array(
                "SITE_ID"   => $sid,
                "CONDITION" => str_replace('//', '/', "#^/" . $siteFolder . "scrumban/#"),
                "ID"        => "sibirix:scrumban",
                "PATH"      => str_replace('//', '/', $siteFolder . "/scrumban/index.php"),
                "RULE"      => ""
            ));

            return true;
        }

        /**
         * Register event handlers
         * @return bool
         */
        function installEvents() {
            RegisterModuleDependences("tasks", "OnTaskAdd", "sibirix.scrumban", "CKanban", "onTaskAdd", 1);
            RegisterModuleDependences("tasks", "OnTaskDelete", "sibirix.scrumban", "CKanban", "onTaskDelete", 1);
            RegisterModuleDependences("tasks", "OnTaskUpdate", "sibirix.scrumban", "CKanban", "onTaskUpdate", 1);
            RegisterModuleDependences("pull", "OnGetDependentModule", "sibirix.scrumban", "CKanban", "OnPullGetDependentModule", 1);

            RegisterModuleDependences("socialnetwork", "OnSocNetGroupAdd", "sibirix.scrumban", "CKanban", "onSocNetGroupAdd", 1);

            RegisterModuleDependences('main', 'OnBeforeProlog', "sibirix.scrumban", "CKanban", "addMenuElement", 1);

            RegisterModuleDependences("socialnetwork", "OnFillSocNetLogEvents", "sibirix.scrumban", "CKanbanSocnetLogger", "OnFillSocNetLogEvents");
            RegisterModuleDependences("socialnetwork", "OnFillSocNetFeaturesList", "sibirix.scrumban", "CKanbanSocnetLogger", "OnFillSocNetFeaturesList");
            RegisterModuleDependences("socialnetwork", "OnFillSocNetAllowedSubscribeEntityTypes", "sibirix.scrumban", "CKanbanSocnetLogger", "OnFillSocNetAllowedSubscribeEntityTypes");

            RegisterModuleDependences('main', 'OnAfterUserAuthorize', "sibirix.scrumban", "CKanban", "OnAfterUserAuthorizeHandler");

            return true;
        }

        public function installAgents() {
            $cAgent = new CAgent();
            $cAgent->AddAgent('CKanban::checkSupportWeeklyNotify();', $this->MODULE_ID, 'N', 3600, ConvertTimeStamp(time() + 600, 'FULL'));
            $cAgent->AddAgent('CKanban::checkSupportDailyNotify();', $this->MODULE_ID, 'N', 86400, ConvertTimeStamp(time() + 600, 'FULL'));
            $cAgent->AddAgent('CKanban::sendImportantTaskNotify();', $this->MODULE_ID, 'N', 3600, ConvertTimeStamp(time() + 600, 'FULL'));
        }

        /**
         * Установить почтовые шаблоны и типы событий для рассылки уведомлений модулем
         */
        function installMailTemplates() {
            $rsSites     = CSite::GetList($by = "sort", $order = "asc");
            $obEventType = new CEventType();
            $obTemplate  = new CEventMessage();

            $arSites   = array();
            $sitesLids = array();

            while ($arSite = $rsSites->Fetch()) {
                $sitesLids[] = $arSite['LID'];
                $arSites[]   = $arSite;
            }

            foreach ($this->eventTypes as $eventType) {

                foreach ($arSites as $arSite) {
                    $arFilter = array(
                        "TYPE_ID" => $eventType['EVENT_NAME'],
                        "LID"     => $arSite["LANGUAGE_ID"]
                    );
                    $rsEt     = $obEventType->GetList($arFilter);
                    $rsEt->NavStart(1);

                    if ($rsEt->NavRecordCount == 0) {
                        // Не существует, создать
                        $obEventType->Add(array(
                            "EVENT_NAME"  => $eventType['EVENT_NAME'],
                            "NAME"        => $eventType['NAME'],
                            "LID"         => $arSite["LANGUAGE_ID"],
                            "DESCRIPTION" => $eventType['DESCRIPTION'],
                        ));
                    }
                }

                foreach ($eventType['TEMPLATES'] as $eventTemplate) {
                    // Существует ли шаблон для этого почтового события
                    $arFilter = Array(
                        "TYPE_ID" => $eventType['EVENT_NAME'],
                    );

                    $by     = "site_id";
                    $order  = "desc";
                    $rsMess = $obTemplate->GetList($by, $order, $arFilter);
                    $rsMess->NavStart(1);

                    if ($rsMess->NavRecordCount == 0) {
                        // Не существует, создать
                        $eventTemplate['SUBJECT'] = GetMessage($eventTemplate['SUBJECT']);
                        $eventTemplate['MESSAGE'] = GetMessage($eventTemplate['MESSAGE']);
                        $eventTemplate['LID']     = $sitesLids;

                        $obTemplate->Add($eventTemplate);
                    }
                }
            }
        }

        /**
         * Install SEF rewrite rule
         */
        function installRewrite() {
            CUrlRewriter::Add(array(
                "SITE_ID"   => SITE_ID,
                "CONDITION" => "#^/scrumban/#",
                "ID"        => "sibirix:scrumban",
                "PATH"      => "/scrumban/index.php",
                "RULE"      => ""
            ));
        }

        /**
         * Добавить принудительный автолоад класса при подключении модуля
         */
        function installClassAutoload() {
            $includeStr = "<" . "?include_once('options/optionsHelper.php');if(OptionsHelper::partnerModuleManualStart(true)===true)return true;?" . ">";
            $path       = $_SERVER['DOCUMENT_ROOT'] . BX_ROOT . '/modules/' . $this->MODULE_ID . '/include.php';
            $file       = file($path);
            $file       = implode('', $file);
            if (strpos($file, $includeStr) === false) {
                $file        = $includeStr . $file;
                $includeFile = fopen($path, "w");
                fwrite($includeFile, $file);
                fclose($includeFile);
            }
        }

        /**
         * Определить, какой шаблон использует битрикс
         * @return string
         */
        function detectBitrixTemplate() {
            $base      = $_SERVER['DOCUMENT_ROOT'] . "/bitrix/templates/";
            $baseLight = $base . "light_";

            if (file_exists($base . "bitrix24")) {
                return "bitrix24";
            } elseif (
                file_exists($baseLight . "blue") ||
                file_exists($baseLight . "brown") ||
                file_exists($baseLight . "dark-blue") ||
                file_exists($baseLight . "green") ||
                file_exists($baseLight . "red")
            ) {
                return "classic";
            }

            return "unknown";
        }

        /********************************************************************************************************************************************
         * Uninstall our module
         * @return bool
         */
        function DoUninstall() {
            global $APPLICATION;

            $GLOBALS["errors"] = array();

            if (!IsModuleInstalled("sibirix.scrumban")) {
                return false;
            }
            if (!check_bitrix_sessid()) {
                return false;
            }

            $step = IntVal($_REQUEST["step"]);

            if ($step != 2) {
                $APPLICATION->IncludeAdminFile(GetMessage("SCRUMBAN_UNINSTALL"), $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/sibirix.scrumban/install/unstep1.php");

            } else {
                if (empty($_REQUEST['module']['deleteTables'])) {
                    $this->UnInstallDB();
                }

                $this->uninstallFiles();
                $this->uninstallEvents();
                $this->uninstallMenu();
                $this->uninstallAgents();

                UnRegisterModule("sibirix.scrumban");
                LocalRedirect("/bitrix/admin/partner_modules.php");
            }

            return true;
        }

        /**
         * Remove files, that we copied
         * @return bool
         */
        function uninstallFiles() {
            $deletePath = $this->FRONTEND_PATH;
            if ($deletePath[strlen($deletePath) - 1] == "/") {
                $deletePath = substr($deletePath, 0, strlen($deletePath) - 1);
            }
            DeleteDirFilesEx($deletePath);

            return true;
        }

        /**
         * Uninstall registered events
         */
        function uninstallEvents() {
            UnRegisterModuleDependences("tasks", "OnTaskAdd", "sibirix.scrumban", "CKanban", "onTaskAdd");
            UnRegisterModuleDependences("tasks", "OnTaskDelete", "sibirix.scrumban", "CKanban", "onTaskDelete");
            UnRegisterModuleDependences("tasks", "OnTaskUpdate", "sibirix.scrumban", "CKanban", "onTaskUpdate");
            UnRegisterModuleDependences("socialnetwork", "OnSocNetGroupAdd", "sibirix.scrumban", "CKanban", "onSocNetGroupAdd");
            UnRegisterModuleDependences('main', 'OnBeforeProlog', "sibirix.scrumban", "CKanban", "addMenuElement");

            UnRegisterModuleDependences("socialnetwork", "OnFillSocNetLogEvents", "sibirix.scrumban", "CKanbanSocnetLogger", "OnFillSocNetLogEvents");
            UnRegisterModuleDependences("socialnetwork", "OnFillSocNetFeaturesList", "sibirix.scrumban", "CKanbanSocnetLogger", "OnFillSocNetFeaturesList");
            UnRegisterModuleDependences("socialnetwork", "OnFillSocNetAllowedSubscribeEntityTypes", "sibirix.scrumban", "CKanbanSocnetLogger", "OnFillSocNetAllowedSubscribeEntityTypes");

            UnRegisterModuleDependences('main', 'OnAfterUserAuthorize', "sibirix.scrumban", "CKanban", "OnAfterUserAuthorizeHandler");
        }

        /**
         * Remove link to scrumban from menu
         */
        function uninstallMenu() {
            $rsSite     = CSite::GetList($by = "sort", $order = "desc", Array("LID" => SITE_ID));
            $site       = $rsSite->Fetch();
            $siteFolder = !empty($site['DIR']) ? $site['DIR'] : '/';
            $menuFile   = "/.top.menu.php";
            $menuPath   = CSite::GetSiteDocRoot(SITE_ID) . $siteFolder . $menuFile;
            $menuPath   = str_replace('//', '/', $menuPath);
            $res        = CFileMan::GetMenuArray($menuPath);

            foreach ($res['aMenuLinks'] as $ind => $menuItem) {
                if ($menuItem[1] == "/scrumban/") {
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
         * Remove SEF rewrite rule
         */
        function uninstallRewrite() {
            CUrlRewriter::Delete(array("CONDITION" => "#^/scrumban/#"));
        }

        /**
         * Remove db tables
         * @return bool
         * @throws Exception
         */
        function UnInstallDB() {
            global $DB;

            $tableList = array(
                "backend_file",
                "backend_file2task",
                "backend_kanban_project_invite",
                "backend_kanban_project_invite_user",
                "backend_project",
                "backend_task",
                "backend_task_comment",
                "backend_task_elapsed_time",
                "backend_task_log",
                "backend_task_tag",
                "backend_user",
                "backend_user2accomplice",
                "backend_user2project",
                "backend_user2watcher",
                "kanban_board",
                "kanban_checklist_items",
                "kanban_column",
                "kanban_column_dods",
                "kanban_dod2task",
                "kanban_label2task",
                "kanban_labels",
                "kanban_project",
                "kanban_project_status",
                "kanban_sprints",
                "kanban_task",
                "kanban_task_log",
                "sync_log",
                "task",
                "task_type",
                'user2project_visit',
            );

            foreach ($tableList as $table) {
                $query = "DROP TABLE IF EXISTS `sib_$table`;";
                $DB->Query($query);
            }

            return true;
        }

        public function uninstallAgents() {
            $cAgent = new CAgent();
            $cAgent->RemoveModuleAgents('sibirix.scrumban');
        }

        /**
         * @param      $filepath
         * @param bool $bIncremental
         * @param bool $utf
         * @return array|bool
         */
        function RunSQLBatch($filepath, $bIncremental = False, $utf = false) {
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
}
?>

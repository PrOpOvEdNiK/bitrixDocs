<?php
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2013 Bitrix
 */

require_once(substr(__FILE__, 0, strlen(__FILE__) - strlen("/include.php"))."/bx_root.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/start.php");

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/classes/general/virtual_io.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/classes/general/virtual_file.php");

$application = \Bitrix\Main\Application::getInstance();
$application->initializeExtendedKernel(array(
	"get" => $_GET,
	"post" => $_POST,
	"files" => $_FILES,
	"cookie" => $_COOKIE,
	"server" => $_SERVER,
	"env" => $_ENV
));

//define global application object
$GLOBALS["APPLICATION"] = new CMain;

if(defined("SITE_ID"))
	define("LANG", SITE_ID);

if(defined("LANG"))
{
	if(defined("ADMIN_SECTION") && ADMIN_SECTION===true)
		$db_lang = CLangAdmin::GetByID(LANG);
	else
		$db_lang = CLang::GetByID(LANG);

	$arLang = $db_lang->Fetch();

	if(!$arLang)
	{
		throw new \Bitrix\Main\SystemException("Incorrect site: ".LANG.".");
	}
}
else
{
	$arLang = $GLOBALS["APPLICATION"]->GetLang();
	define("LANG", $arLang["LID"]);
}

if($arLang["CULTURE_ID"] == '')
{
	throw new \Bitrix\Main\SystemException("Culture not found, or there are no active sites or languages.");
}

$lang = $arLang["LID"];
if (!defined("SITE_ID"))
	define("SITE_ID", $arLang["LID"]);
define("SITE_DIR", $arLang["DIR"]);
define("SITE_SERVER_NAME", $arLang["SERVER_NAME"]);
define("SITE_CHARSET", $arLang["CHARSET"]);
define("FORMAT_DATE", $arLang["FORMAT_DATE"]);
define("FORMAT_DATETIME", $arLang["FORMAT_DATETIME"]);
define("LANG_DIR", $arLang["DIR"]);
define("LANG_CHARSET", $arLang["CHARSET"]);
define("LANG_ADMIN_LID", $arLang["LANGUAGE_ID"]);
define("LANGUAGE_ID", $arLang["LANGUAGE_ID"]);

$culture = \Bitrix\Main\Localization\CultureTable::getByPrimary($arLang["CULTURE_ID"], ["cache" => ["ttl" => CACHED_b_lang]])->fetchObject();

$context = $application->getContext();
$context->setLanguage(LANGUAGE_ID);
$context->setCulture($culture);

$request = $context->getRequest();
if (!$request->isAdminSection())
{
	$context->setSite(SITE_ID);
}

$application->start();

$GLOBALS["APPLICATION"]->reinitPath();

if (!defined("POST_FORM_ACTION_URI"))
{
	define("POST_FORM_ACTION_URI", htmlspecialcharsbx(GetRequestUri()));
}

$GLOBALS["MESS"] = array();
$GLOBALS["ALL_LANG_FILES"] = array();
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/tools.php");
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/classes/general/database.php");
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/classes/general/main.php");
IncludeModuleLangFile(__FILE__);

error_reporting(COption::GetOptionInt("main", "error_reporting", E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR|E_PARSE) & ~E_STRICT & ~E_DEPRECATED);

if(!defined("BX_COMP_MANAGED_CACHE") && COption::GetOptionString("main", "component_managed_cache_on", "Y") <> "N")
{
	define("BX_COMP_MANAGED_CACHE", true);
}

require_once($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/filter_tools.php");
require_once($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/ajax_tools.php");

/*ZDUyZmZZTc0NWM4NjNmOGViOGNjNDY3YWE2Y2JiY2M3YWMxYTE=*/$GLOBALS['_____2116899667']= array(base64_decode('R2V0TW9kdWxlRXZ'.'lbnRz'),base64_decode(''.'RXh'.'lY'.'3V0ZU'.'1vZH'.'VsZUV2Z'.'W50RX'.'g'.'='));$GLOBALS['____1421971991']= array(base64_decode('ZG'.'VmaW'.'5l'),base64_decode(''.'c3'.'RybG'.'Vu'),base64_decode('Y'.'mFzZT'.'Y0X2RlY'.'29'.'kZQ='.'='),base64_decode(''.'dW'.'5zZ'.'XJp'.'YWxpemU='),base64_decode('aXNfYXJyYXk'.'='),base64_decode('Y291bnQ='),base64_decode('aW5fYX'.'JyYXk='),base64_decode('c2'.'VyaWFsaXp'.'l'),base64_decode('YmFzZ'.'TY0X2VuY29kZQ'.'=='),base64_decode('c3'.'RybGV'.'u'),base64_decode('YXJ'.'yY'.'Xlfa2'.'V5'.'X'.'2V4aXN0cw'.'=='),base64_decode('YXJyYXl'.'fa2V'.'5X'.'2'.'V4aXN0cw=='),base64_decode(''.'b'.'W'.'t0aW1l'),base64_decode(''.'ZGF'.'0ZQ=='),base64_decode('ZG'.'F0Z'.'Q=='),base64_decode('YXJyYX'.'lfa2V5X2'.'V'.'4aXN0cw=='),base64_decode('c3Ryb'.'GVu'),base64_decode('YXJyYXl'.'f'.'a2V'.'5X2V'.'4aXN0c'.'w=='),base64_decode('c3Ry'.'bG'.'Vu'),base64_decode('YXJyYXlfa'.'2V5X2V4aXN0cw='.'='),base64_decode('YXJyYX'.'lf'.'a2'.'V'.'5X'.'2'.'V4aXN0cw=='),base64_decode('b'.'Wt0aW'.'1l'),base64_decode('ZGF0ZQ'.'='.'='),base64_decode('ZG'.'F0'.'ZQ=='),base64_decode('bWV0aG9kX2V4aXN'.'0c'.'w='.'='),base64_decode('Y2FsbF'.'91c2VyX'.'2Z1bmNfYXJ'.'yYXk'.'='),base64_decode('c3RybGVu'),base64_decode('YXJy'.'YXlfa2V5X2V4aXN0cw=='),base64_decode('YXJy'.'YXl'.'f'.'a2V5X2V4'.'aXN0cw='.'='),base64_decode('c2Vya'.'WFsaXpl'),base64_decode('Ym'.'FzZTY0'.'X2V'.'uY2'.'9kZQ='.'='),base64_decode('c3RybGVu'),base64_decode('Y'.'XJyYXlfa2V'.'5X2V4aX'.'N0cw'.'=='),base64_decode('YXJyYXl'.'fa2V5X2'.'V4'.'a'.'XN0cw='.'='),base64_decode(''.'YXJy'.'YXlf'.'a'.'2V5'.'X2V'.'4aX'.'N0cw=='),base64_decode('aXNfY'.'XJyY'.'X'.'k='),base64_decode('YX'.'JyYXlfa2V5X2V4aXN0cw=='),base64_decode('c'.'2VyaWFsaXpl'),base64_decode('Ym'.'FzZTY0X2'.'Vu'.'Y29kZQ=='),base64_decode(''.'YXJyYXlfa2V5'.'X2V4'.'aXN0cw=='),base64_decode(''.'YXJyY'.'Xl'.'fa2V5'.'X'.'2V4'.'a'.'XN0'.'cw=='),base64_decode('c2VyaWFsaXp'.'l'),base64_decode('Ym'.'FzZTY0'.'X2V'.'uY2'.'9'.'k'.'ZQ=='),base64_decode(''.'aXNf'.'YXJy'.'YX'.'k='),base64_decode('a'.'X'.'NfYXJ'.'y'.'Y'.'Xk='),base64_decode('aW5'.'fY'.'XJyYXk='),base64_decode('YXJy'.'Y'.'Xlfa'.'2V5X2'.'V4aXN0cw='.'='),base64_decode('a'.'W5'.'fYXJyYXk='),base64_decode(''.'bWt0aW1'.'l'),base64_decode(''.'ZGF0ZQ'.'=='),base64_decode(''.'Z'.'GF0ZQ=='),base64_decode('ZGF0ZQ=='),base64_decode('bWt0'.'aW1l'),base64_decode('ZGF'.'0ZQ=='),base64_decode('ZGF0Z'.'Q'.'=='),base64_decode(''.'aW5'.'fY'.'XJ'.'yYXk'.'='),base64_decode('YXJ'.'yYXl'.'fa2V'.'5X2V4aX'.'N0cw='.'='),base64_decode('Y'.'X'.'JyYXl'.'fa'.'2V5X2V4aXN0'.'cw=='),base64_decode('c'.'2VyaWFsaX'.'p'.'l'),base64_decode('YmFzZTY0X2'.'VuY2'.'9kZ'.'Q=='),base64_decode('YXJyYXlfa2V5X2V'.'4a'.'XN0cw=='),base64_decode('aW50dmFs'),base64_decode('dGlt'.'ZQ=='),base64_decode('YXJyYXlfa2V5X2V4'.'aX'.'N0cw=='),base64_decode('ZmlsZV9l'.'eGlzdHM='),base64_decode('c'.'3RyX'.'3Jlc'.'GxhY2U='),base64_decode('Y2xhc3NfZXhpc'.'3Rz'),base64_decode('ZG'.'VmaW5l'));if(!function_exists(__NAMESPACE__.'\\___608494400')){function ___608494400($_1944338157){static $_1652173392= false; if($_1652173392 == false) $_1652173392=array('SU5'.'UU'.'kFORVR'.'fRU'.'RJVElP'.'Tg'.'==','WQ==','bWFpbg==','fmN'.'wZl9'.'tYXBfdm'.'F'.'sd'.'WU'.'=','','ZQ'.'==','Zg='.'=','Z'.'Q'.'==','Rg==','W'.'A==','Zg='.'=','b'.'WF'.'pbg='.'=','fmNwZl9tYX'.'BfdmFsd'.'WU=','U'.'G9'.'y'.'dGFs','Rg='.'=','ZQ==','ZQ='.'=',''.'WA==','Rg==','RA'.'==','R'.'A='.'=','bQ==','Z'.'A==','WQ==','Z'.'g==','Zg'.'==','Zg==','Zg==','UG'.'9yd'.'G'.'Fs',''.'R'.'g==','ZQ'.'==','ZQ==','WA='.'=','Rg==','R'.'A='.'=','RA==','bQ==',''.'Z'.'A==',''.'WQ='.'=','bW'.'Fpb'.'g==',''.'T24=',''.'U2V0dGlu'.'Z3NDa'.'GF'.'uZ2U=','Zg==','Zg==','Z'.'g==','Zg==','bWFpbg==','fmNwZ'.'l9tYXBfdm'.'Fs'.'dWU=','ZQ==','ZQ==','ZQ='.'=','RA==',''.'ZQ==',''.'ZQ==','Z'.'g==',''.'Zg'.'='.'=','Zg==','ZQ==',''.'bWFpbg='.'=','fmN'.'wZ'.'l'.'9tYXBf'.'dmF'.'sdWU'.'=','ZQ==','Z'.'g'.'==','Zg'.'='.'=','Z'.'g==','Zg==','bW'.'Fpbg==','fmNw'.'Zl9tYXB'.'fdmFsdWU'.'=',''.'ZQ='.'=','Z'.'g==','UG9ydGFs',''.'UG9y'.'d'.'GFs','ZQ='.'=',''.'ZQ==','UG9ydG'.'Fs',''.'Rg==','W'.'A==','R'.'g==','RA'.'==','Z'.'Q'.'==','Z'.'Q='.'=',''.'RA'.'='.'=',''.'bQ'.'==','Z'.'A==','WQ==',''.'ZQ'.'==','WA'.'==','ZQ==',''.'Rg==','Z'.'Q'.'==','R'.'A'.'==',''.'Z'.'g==',''.'ZQ==','RA==','ZQ'.'==','bQ==',''.'ZA==','WQ==','Zg==','Zg='.'=','Zg'.'==','Zg==','Zg==',''.'Zg==','Zg==','Zg='.'=','bWFpbg==',''.'fmNw'.'Zl9tYXBf'.'dmFsdWU'.'=','ZQ==',''.'ZQ==','UG9ydGFs','Rg==','WA==','VFl'.'QRQ='.'=','REFURQ==',''.'R'.'kVBV'.'FVSRVM'.'=','RVhQSVJFRA==','VFlQRQ==','RA'.'==','VFJZX0RBWVNfQ09VT'.'l'.'Q=','REF'.'URQ='.'=','VF'.'JZX0'.'RBWVN'.'fQ0'.'9VT'.'l'.'Q=','RVh'.'QSV'.'JFRA==','RkV'.'B'.'V'.'FVSRVM'.'=','Zg='.'=','Zg==',''.'RE'.'9DV'.'U1'.'FTlRf'.'U'.'k9PVA'.'==',''.'L2JpdHJpeC9'.'tb'.'2'.'R1bGV'.'zLw==','L'.'2lu'.'c3RhbGwvaW5kZ'.'XgucGhw','L'.'g==',''.'Xw==','c'.'2'.'Vhcm'.'No','Tg==','','',''.'QUNUSVZF','WQ'.'==','c'.'29jaWFsbmV0d29y'.'aw==','YWxsb'.'3dfZnJpZ'.'W'.'xkcw'.'==','WQ==',''.'SUQ=',''.'c2'.'9jaWFsb'.'mV0'.'d29y'.'aw==','YW'.'x'.'s'.'b3dfZnJ'.'pZW'.'xk'.'cw='.'=','SUQ=',''.'c29ja'.'WFsbmV0d29y'.'aw==',''.'YW'.'xsb3'.'d'.'fZnJpZWx'.'kcw==','Tg==','','','QUNUSVZF','WQ'.'==',''.'c29'.'ja'.'WFs'.'b'.'mV'.'0d'.'29y'.'aw==','YWxs'.'b'.'3'.'dfbWljcm9ib'.'G9nX3VzZXI'.'=','WQ='.'=','SUQ=',''.'c29j'.'aWFsbm'.'V0d2'.'9'.'y'.'a'.'w'.'==','Y'.'Wxsb3dfb'.'Wlj'.'cm'.'9ibG9nX3VzZX'.'I=','SUQ'.'=','c2'.'9'.'jaW'.'FsbmV0'.'d'.'29yaw'.'='.'=','Y'.'Wxs'.'b3df'.'b'.'W'.'ljc'.'m'.'9'.'ibG9nX'.'3Vz'.'Z'.'X'.'I=','c'.'29'.'j'.'aWFsbmV0d29yaw==','YWxsb3dfbWljc'.'m9ibG9'.'nX2d'.'yb3V'.'w','WQ==',''.'S'.'UQ=',''.'c29ja'.'WF'.'sbmV0d'.'29yaw'.'==','YWxsb3dfb'.'Wljcm9ibG'.'9'.'nX2dy'.'b3Vw','S'.'UQ=','c29jaWFsbmV0d29y'.'aw'.'='.'=','YW'.'xsb'.'3dfbWl'.'jcm9ib'.'G9nX2dyb3Vw','Tg='.'=','','','QUNUS'.'V'.'ZF','WQ==','c29jaWFs'.'bmV0'.'d'.'29yaw==',''.'YW'.'xsb3'.'dfZ'.'ml'.'s'.'ZXN'.'fd'.'XN'.'lcg==','WQ==','SUQ=','c'.'29'.'j'.'aWFs'.'bmV'.'0d'.'29y'.'aw'.'==',''.'Y'.'Wxsb3dfZmlsZ'.'XNf'.'dXNlcg==','SUQ=','c29'.'jaWFsb'.'m'.'V0d'.'29y'.'aw==','Y'.'Wxsb'.'3d'.'f'.'ZmlsZXNfdXN'.'l'.'c'.'g==',''.'Tg==','','','Q'.'UNUSVZF','WQ==','c29jaWFs'.'bmV0d29yaw==','YWx'.'s'.'b3'.'dfYmxvZ19'.'1'.'c'.'2Vy','W'.'Q'.'==','SUQ'.'=','c29'.'jaWFs'.'bmV0d29y'.'aw='.'=',''.'YWx'.'sb'.'3df'.'Ym'.'x'.'vZ191c2'.'Vy','SUQ'.'=',''.'c29'.'ja'.'WFsbmV'.'0d'.'29y'.'aw==','YW'.'xs'.'b3df'.'Y'.'m'.'xvZ191'.'c2'.'Vy','Tg==','','','QUNUSVZ'.'F','W'.'Q==','c2'.'9jaW'.'FsbmV0d29y'.'aw'.'==',''.'YW'.'x'.'sb'.'3dfc'.'GhvdG9'.'fdX'.'Nl'.'cg==','WQ==','SUQ'.'=','c29j'.'aWFsbmV'.'0d29yaw==','YWxsb'.'3df'.'cG'.'hvdG'.'9fdXNlcg==','SUQ=','c2'.'9jaWFsb'.'mV'.'0'.'d'.'29ya'.'w==','YWxs'.'b3dfcGhvdG9'.'fdXN'.'lc'.'g==','Tg==','','','QU'.'NUS'.'VZ'.'F','WQ==',''.'c29ja'.'WFsbm'.'V0d2'.'9yaw==','YWx'.'sb3df'.'Z'.'m9ydW1'.'fdX'.'N'.'lc'.'g==','WQ='.'=',''.'S'.'UQ'.'=','c29ja'.'WFsbmV0d29ya'.'w==','YWxs'.'b'.'3df'.'Zm9ydW1f'.'dX'.'Nlc'.'g'.'==',''.'SUQ=','c29ja'.'WFsbm'.'V0d29yaw='.'=',''.'YWx'.'sb3'.'dfZm9ydW'.'1f'.'dXNlcg==','T'.'g==','','','QUN'.'USVZF',''.'WQ==','c29jaWFsbm'.'V0d'.'29y'.'aw'.'==','Y'.'Wx'.'sb3'.'dfd'.'GFza3Nfd'.'XNlcg'.'==','WQ='.'=','S'.'UQ=',''.'c'.'29'.'jaWFsbmV0d29y'.'aw==','YWxsb3dfdGF'.'za3N'.'fdXNlcg==','SUQ=','c'.'29j'.'aWF'.'sbmV0d29ya'.'w==','YWxsb3df'.'dGFza'.'3NfdXNl'.'cg==','c29jaW'.'Fsb'.'m'.'V0d29ya'.'w='.'=','YWxsb3dfdGF'.'za3Nf'.'Z3'.'Jv'.'d'.'XA=','WQ==',''.'S'.'UQ=','c29jaWF'.'sbm'.'V'.'0d'.'29yaw='.'=',''.'YWx'.'sb'.'3dfdGFza3N'.'f'.'Z3JvdXA=','SUQ=',''.'c29jaWFs'.'bm'.'V'.'0d29y'.'aw==',''.'Y'.'Wxsb3d'.'fdGFza'.'3NfZ3Jvd'.'XA=',''.'dGF'.'za'.'3M'.'=',''.'Tg==','','','QUNUS'.'VZF','W'.'Q==',''.'c29jaW'.'Fsb'.'mV0d29yaw='.'=',''.'Y'.'W'.'xsb3'.'dfY2'.'F'.'sZW5kYXJfdXNlcg==','WQ'.'==','SUQ=','c29jaWFsbmV0d'.'29yaw==','YWxs'.'b3d'.'fY2'.'FsZ'.'W'.'5kYXJf'.'d'.'XNlcg'.'==','SUQ=','c'.'29jaWFsb'.'mV0d29y'.'aw'.'==','Y'.'Wxsb'.'3'.'dfY'.'2Fs'.'ZW'.'5'.'kYXJfdXN'.'lcg==','c29jaWFs'.'bmV0'.'d'.'29yaw==','YWxs'.'b3d'.'f'.'Y'.'2FsZW'.'5kYXJfZ'.'3'.'JvdX'.'A=','W'.'Q='.'=','SUQ'.'=','c2'.'9j'.'aW'.'Fs'.'b'.'mV0'.'d29yaw==','YWxsb'.'3dfY2'.'FsZW5'.'kYXJ'.'fZ3JvdX'.'A=','SU'.'Q=','c29jaWFsbmV0d29y'.'a'.'w==',''.'YWxsb'.'3'.'dfY2FsZW5'.'kYXJfZ'.'3JvdX'.'A=','QUNUS'.'VZF','WQ==',''.'Tg='.'=','ZX'.'h0'.'cmFuZXQ=','aWJs'.'b2Nr','T25BZn'.'R'.'lcklCbG9j'.'a0VsZW1'.'lbnRVcGRh'.'dG'.'U=','aW50'.'cmFuZXQ=','Q0ludHJ'.'hbmV0R'.'XZlbnRI'.'YW5k'.'bGVycw'.'==','U'.'1BSZW'.'dpc'.'3Rlc'.'lVw'.'ZGF'.'0Z'.'WRJdG'.'Vt','Q'.'0'.'ludHJhbmV0'.'U2hhcmVwb2lu'.'dDo6Q'.'Wdlb'.'nRMaX'.'N0cygpOw==','aW50cmFu'.'ZXQ=','Tg==','Q0ludHJ'.'hbmV0'.'U2hh'.'cmVwb2lu'.'dDo'.'6Q'.'WdlbnR'.'RdWV1Z'.'Sg'.'pO'.'w==','aW'.'50c'.'mFuZX'.'Q'.'=','Tg'.'==',''.'Q0'.'l'.'udHJhb'.'mV'.'0U2hhcmV'.'wb2ludDo6QWdlbn'.'R'.'V'.'cGRh'.'dGUoKTs=',''.'aW'.'50cmFuZX'.'Q'.'=','Tg==',''.'aWJ'.'sb2Nr','T25BZnRlck'.'lCbG9j'.'a0VsZW'.'1lbnRB'.'ZG'.'Q'.'=','aW'.'50cm'.'F'.'uZXQ=','Q0lu'.'dHJh'.'bmV0RXZlbn'.'R'.'IYW5kbGVy'.'cw==','U'.'1BSZW'.'dpc3Rl'.'clVwZGF0'.'ZWRJdG'.'Vt','a'.'WJsb2Nr',''.'T25BZnRlck'.'lCb'.'G9ja0VsZW'.'1lbn'.'RVcGRhdGU=','aW50cmF'.'uZXQ=',''.'Q0lu'.'dH'.'J'.'hb'.'m'.'V0RXZl'.'bnRIYW'.'5kbGVyc'.'w==',''.'U1BSZ'.'Wdpc3'.'Rlcl'.'VwZ'.'GF0Z'.'WR'.'Jd'.'G'.'Vt','Q0'.'l'.'u'.'d'.'HJh'.'bmV0U2'.'h'.'hcmVwb2ludDo6QWdlbnRMa'.'XN0c'.'ygpOw==','aW50cmFuZ'.'XQ=','Q'.'0'.'ludHJh'.'bmV0'.'U2'.'h'.'hcmVwb2ludDo6Q'.'W'.'d'.'l'.'bn'.'RRdWV1ZSg'.'pOw==','aW50cm'.'Fu'.'ZXQ=','Q0l'.'ud'.'HJh'.'bmV0U2hh'.'cmVwb2ludDo'.'6'.'QWdlbnRVcGRh'.'dGUoKTs=',''.'aW50c'.'mFuZXQ=','Y'.'3Jt','b'.'WFpbg==','T'.'25C'.'ZWZ'.'v'.'c'.'mV'.'Qc'.'m9sb2c=',''.'bWFpbg==',''.'Q1dpemFy'.'Z'.'FNvbFBhbm'.'VsSW5'.'0cmFuZXQ=','U'.'2'.'hv'.'d1Bh'.'bmVs','L21vZH'.'VsZX'.'MvaW50cmFuZX'.'QvcG'.'FuZW'.'xfYnV'.'0'.'dG9uLnB'.'ocA='.'=','RU'.'5DT0'.'RF','W'.'Q==');return base64_decode($_1652173392[$_1944338157]);}};$GLOBALS['____1421971991'][0](___608494400(0), ___608494400(1));class CBXFeatures{ private static $_1609208367= 30; private static $_1459837461= array( "Portal" => array( "CompanyCalendar", "CompanyPhoto", "CompanyVideo", "CompanyCareer", "StaffChanges", "StaffAbsence", "CommonDocuments", "MeetingRoomBookingSystem", "Wiki", "Learning", "Vote", "WebLink", "Subscribe", "Friends", "PersonalFiles", "PersonalBlog", "PersonalPhoto", "PersonalForum", "Blog", "Forum", "Gallery", "Board", "MicroBlog", "WebMessenger",), "Communications" => array( "Tasks", "Calendar", "Workgroups", "Jabber", "VideoConference", "Extranet", "SMTP", "Requests", "DAV", "intranet_sharepoint", "timeman", "Idea", "Meeting", "EventList", "Salary", "XDImport",), "Enterprise" => array( "BizProc", "Lists", "Support", "Analytics", "crm", "Controller",), "Holding" => array( "Cluster", "MultiSites",),); private static $_879370691= false; private static $_1081204686= false; private static function __1288126337(){ if(self::$_879370691 == false){ self::$_879370691= array(); foreach(self::$_1459837461 as $_73305780 => $_1896791796){ foreach($_1896791796 as $_2129513067) self::$_879370691[$_2129513067]= $_73305780;}} if(self::$_1081204686 == false){ self::$_1081204686= array(); $_1702604276= COption::GetOptionString(___608494400(2), ___608494400(3), ___608494400(4)); if($GLOBALS['____1421971991'][1]($_1702604276)>(978-2*489)){ $_1702604276= $GLOBALS['____1421971991'][2]($_1702604276); self::$_1081204686= $GLOBALS['____1421971991'][3]($_1702604276); if(!$GLOBALS['____1421971991'][4](self::$_1081204686)) self::$_1081204686= array();} if($GLOBALS['____1421971991'][5](self::$_1081204686) <=(208*2-416)) self::$_1081204686= array(___608494400(5) => array(), ___608494400(6) => array());}} public static function InitiateEditionsSettings($_1623861586){ self::__1288126337(); $_1119315087= array(); foreach(self::$_1459837461 as $_73305780 => $_1896791796){ $_12194086= $GLOBALS['____1421971991'][6]($_73305780, $_1623861586); self::$_1081204686[___608494400(7)][$_73305780]=($_12194086? array(___608494400(8)): array(___608494400(9))); foreach($_1896791796 as $_2129513067){ self::$_1081204686[___608494400(10)][$_2129513067]= $_12194086; if(!$_12194086) $_1119315087[]= array($_2129513067, false);}} $_581998160= $GLOBALS['____1421971991'][7](self::$_1081204686); $_581998160= $GLOBALS['____1421971991'][8]($_581998160); COption::SetOptionString(___608494400(11), ___608494400(12), $_581998160); foreach($_1119315087 as $_1331654468) self::__1524654881($_1331654468[(1356/2-678)], $_1331654468[round(0+0.25+0.25+0.25+0.25)]);} public static function IsFeatureEnabled($_2129513067){ if($GLOBALS['____1421971991'][9]($_2129513067) <= 0) return true; self::__1288126337(); if(!$GLOBALS['____1421971991'][10]($_2129513067, self::$_879370691)) return true; if(self::$_879370691[$_2129513067] == ___608494400(13)) $_2119750653= array(___608494400(14)); elseif($GLOBALS['____1421971991'][11](self::$_879370691[$_2129513067], self::$_1081204686[___608494400(15)])) $_2119750653= self::$_1081204686[___608494400(16)][self::$_879370691[$_2129513067]]; else $_2119750653= array(___608494400(17)); if($_2119750653[(128*2-256)] != ___608494400(18) && $_2119750653[(158*2-316)] != ___608494400(19)){ return false;} elseif($_2119750653[min(190,0,63.333333333333)] == ___608494400(20)){ if($_2119750653[round(0+0.5+0.5)]< $GLOBALS['____1421971991'][12]((796-2*398),(1332/2-666),(836-2*418), Date(___608494400(21)), $GLOBALS['____1421971991'][13](___608494400(22))- self::$_1609208367, $GLOBALS['____1421971991'][14](___608494400(23)))){ if(!isset($_2119750653[round(0+0.5+0.5+0.5+0.5)]) ||!$_2119750653[round(0+2)]) self::__686545471(self::$_879370691[$_2129513067]); return false;}} return!$GLOBALS['____1421971991'][15]($_2129513067, self::$_1081204686[___608494400(24)]) || self::$_1081204686[___608494400(25)][$_2129513067];} public static function IsFeatureInstalled($_2129513067){ if($GLOBALS['____1421971991'][16]($_2129513067) <= 0) return true; self::__1288126337(); return($GLOBALS['____1421971991'][17]($_2129513067, self::$_1081204686[___608494400(26)]) && self::$_1081204686[___608494400(27)][$_2129513067]);} public static function IsFeatureEditable($_2129513067){ if($GLOBALS['____1421971991'][18]($_2129513067) <= 0) return true; self::__1288126337(); if(!$GLOBALS['____1421971991'][19]($_2129513067, self::$_879370691)) return true; if(self::$_879370691[$_2129513067] == ___608494400(28)) $_2119750653= array(___608494400(29)); elseif($GLOBALS['____1421971991'][20](self::$_879370691[$_2129513067], self::$_1081204686[___608494400(30)])) $_2119750653= self::$_1081204686[___608494400(31)][self::$_879370691[$_2129513067]]; else $_2119750653= array(___608494400(32)); if($_2119750653[(132*2-264)] != ___608494400(33) && $_2119750653[min(92,0,30.666666666667)] != ___608494400(34)){ return false;} elseif($_2119750653[(1432/2-716)] == ___608494400(35)){ if($_2119750653[round(0+1)]< $GLOBALS['____1421971991'][21]((136*2-272),(164*2-328),(990-2*495), Date(___608494400(36)), $GLOBALS['____1421971991'][22](___608494400(37))- self::$_1609208367, $GLOBALS['____1421971991'][23](___608494400(38)))){ if(!isset($_2119750653[round(0+0.66666666666667+0.66666666666667+0.66666666666667)]) ||!$_2119750653[round(0+0.4+0.4+0.4+0.4+0.4)]) self::__686545471(self::$_879370691[$_2129513067]); return false;}} return true;} private static function __1524654881($_2129513067, $_784167869){ if($GLOBALS['____1421971991'][24]("CBXFeatures", "On".$_2129513067."SettingsChange")) $GLOBALS['____1421971991'][25](array("CBXFeatures", "On".$_2129513067."SettingsChange"), array($_2129513067, $_784167869)); $_1956473322= $GLOBALS['_____2116899667'][0](___608494400(39), ___608494400(40).$_2129513067.___608494400(41)); while($_762517654= $_1956473322->Fetch()) $GLOBALS['_____2116899667'][1]($_762517654, array($_2129513067, $_784167869));} public static function SetFeatureEnabled($_2129513067, $_784167869= true, $_74494847= true){ if($GLOBALS['____1421971991'][26]($_2129513067) <= 0) return; if(!self::IsFeatureEditable($_2129513067)) $_784167869= false; $_784167869=($_784167869? true: false); self::__1288126337(); $_345420112=(!$GLOBALS['____1421971991'][27]($_2129513067, self::$_1081204686[___608494400(42)]) && $_784167869 || $GLOBALS['____1421971991'][28]($_2129513067, self::$_1081204686[___608494400(43)]) && $_784167869 != self::$_1081204686[___608494400(44)][$_2129513067]); self::$_1081204686[___608494400(45)][$_2129513067]= $_784167869; $_581998160= $GLOBALS['____1421971991'][29](self::$_1081204686); $_581998160= $GLOBALS['____1421971991'][30]($_581998160); COption::SetOptionString(___608494400(46), ___608494400(47), $_581998160); if($_345420112 && $_74494847) self::__1524654881($_2129513067, $_784167869);} private static function __686545471($_73305780){ if($GLOBALS['____1421971991'][31]($_73305780) <= 0 || $_73305780 == "Portal") return; self::__1288126337(); if(!$GLOBALS['____1421971991'][32]($_73305780, self::$_1081204686[___608494400(48)]) || $GLOBALS['____1421971991'][33]($_73305780, self::$_1081204686[___608494400(49)]) && self::$_1081204686[___608494400(50)][$_73305780][(1352/2-676)] != ___608494400(51)) return; if(isset(self::$_1081204686[___608494400(52)][$_73305780][round(0+1+1)]) && self::$_1081204686[___608494400(53)][$_73305780][round(0+0.66666666666667+0.66666666666667+0.66666666666667)]) return; $_1119315087= array(); if($GLOBALS['____1421971991'][34]($_73305780, self::$_1459837461) && $GLOBALS['____1421971991'][35](self::$_1459837461[$_73305780])){ foreach(self::$_1459837461[$_73305780] as $_2129513067){ if($GLOBALS['____1421971991'][36]($_2129513067, self::$_1081204686[___608494400(54)]) && self::$_1081204686[___608494400(55)][$_2129513067]){ self::$_1081204686[___608494400(56)][$_2129513067]= false; $_1119315087[]= array($_2129513067, false);}} self::$_1081204686[___608494400(57)][$_73305780][round(0+0.66666666666667+0.66666666666667+0.66666666666667)]= true;} $_581998160= $GLOBALS['____1421971991'][37](self::$_1081204686); $_581998160= $GLOBALS['____1421971991'][38]($_581998160); COption::SetOptionString(___608494400(58), ___608494400(59), $_581998160); foreach($_1119315087 as $_1331654468) self::__1524654881($_1331654468[(1372/2-686)], $_1331654468[round(0+0.33333333333333+0.33333333333333+0.33333333333333)]);} public static function ModifyFeaturesSettings($_1623861586, $_1896791796){ self::__1288126337(); foreach($_1623861586 as $_73305780 => $_1311069951) self::$_1081204686[___608494400(60)][$_73305780]= $_1311069951; $_1119315087= array(); foreach($_1896791796 as $_2129513067 => $_784167869){ if(!$GLOBALS['____1421971991'][39]($_2129513067, self::$_1081204686[___608494400(61)]) && $_784167869 || $GLOBALS['____1421971991'][40]($_2129513067, self::$_1081204686[___608494400(62)]) && $_784167869 != self::$_1081204686[___608494400(63)][$_2129513067]) $_1119315087[]= array($_2129513067, $_784167869); self::$_1081204686[___608494400(64)][$_2129513067]= $_784167869;} $_581998160= $GLOBALS['____1421971991'][41](self::$_1081204686); $_581998160= $GLOBALS['____1421971991'][42]($_581998160); COption::SetOptionString(___608494400(65), ___608494400(66), $_581998160); self::$_1081204686= false; foreach($_1119315087 as $_1331654468) self::__1524654881($_1331654468[(250*2-500)], $_1331654468[round(0+0.5+0.5)]);} public static function SaveFeaturesSettings($_908938879, $_1630563223){ self::__1288126337(); $_2044653623= array(___608494400(67) => array(), ___608494400(68) => array()); if(!$GLOBALS['____1421971991'][43]($_908938879)) $_908938879= array(); if(!$GLOBALS['____1421971991'][44]($_1630563223)) $_1630563223= array(); if(!$GLOBALS['____1421971991'][45](___608494400(69), $_908938879)) $_908938879[]= ___608494400(70); foreach(self::$_1459837461 as $_73305780 => $_1896791796){ if($GLOBALS['____1421971991'][46]($_73305780, self::$_1081204686[___608494400(71)])) $_1713984235= self::$_1081204686[___608494400(72)][$_73305780]; else $_1713984235=($_73305780 == ___608494400(73))? array(___608494400(74)): array(___608494400(75)); if($_1713984235[(928-2*464)] == ___608494400(76) || $_1713984235[(888-2*444)] == ___608494400(77)){ $_2044653623[___608494400(78)][$_73305780]= $_1713984235;} else{ if($GLOBALS['____1421971991'][47]($_73305780, $_908938879)) $_2044653623[___608494400(79)][$_73305780]= array(___608494400(80), $GLOBALS['____1421971991'][48]((214*2-428),(906-2*453),(880-2*440), $GLOBALS['____1421971991'][49](___608494400(81)), $GLOBALS['____1421971991'][50](___608494400(82)), $GLOBALS['____1421971991'][51](___608494400(83)))); else $_2044653623[___608494400(84)][$_73305780]= array(___608494400(85));}} $_1119315087= array(); foreach(self::$_879370691 as $_2129513067 => $_73305780){ if($_2044653623[___608494400(86)][$_73305780][(248*2-496)] != ___608494400(87) && $_2044653623[___608494400(88)][$_73305780][min(66,0,22)] != ___608494400(89)){ $_2044653623[___608494400(90)][$_2129513067]= false;} else{ if($_2044653623[___608494400(91)][$_73305780][(852-2*426)] == ___608494400(92) && $_2044653623[___608494400(93)][$_73305780][round(0+0.33333333333333+0.33333333333333+0.33333333333333)]< $GLOBALS['____1421971991'][52]((760-2*380),(786-2*393),(236*2-472), Date(___608494400(94)), $GLOBALS['____1421971991'][53](___608494400(95))- self::$_1609208367, $GLOBALS['____1421971991'][54](___608494400(96)))) $_2044653623[___608494400(97)][$_2129513067]= false; else $_2044653623[___608494400(98)][$_2129513067]= $GLOBALS['____1421971991'][55]($_2129513067, $_1630563223); if(!$GLOBALS['____1421971991'][56]($_2129513067, self::$_1081204686[___608494400(99)]) && $_2044653623[___608494400(100)][$_2129513067] || $GLOBALS['____1421971991'][57]($_2129513067, self::$_1081204686[___608494400(101)]) && $_2044653623[___608494400(102)][$_2129513067] != self::$_1081204686[___608494400(103)][$_2129513067]) $_1119315087[]= array($_2129513067, $_2044653623[___608494400(104)][$_2129513067]);}} $_581998160= $GLOBALS['____1421971991'][58]($_2044653623); $_581998160= $GLOBALS['____1421971991'][59]($_581998160); COption::SetOptionString(___608494400(105), ___608494400(106), $_581998160); self::$_1081204686= false; foreach($_1119315087 as $_1331654468) self::__1524654881($_1331654468[(1320/2-660)], $_1331654468[round(0+1)]);} public static function GetFeaturesList(){ self::__1288126337(); $_172671776= array(); foreach(self::$_1459837461 as $_73305780 => $_1896791796){ if($GLOBALS['____1421971991'][60]($_73305780, self::$_1081204686[___608494400(107)])) $_1713984235= self::$_1081204686[___608494400(108)][$_73305780]; else $_1713984235=($_73305780 == ___608494400(109))? array(___608494400(110)): array(___608494400(111)); $_172671776[$_73305780]= array( ___608494400(112) => $_1713984235[min(46,0,15.333333333333)], ___608494400(113) => $_1713984235[round(0+0.25+0.25+0.25+0.25)], ___608494400(114) => array(),); $_172671776[$_73305780][___608494400(115)]= false; if($_172671776[$_73305780][___608494400(116)] == ___608494400(117)){ $_172671776[$_73305780][___608494400(118)]= $GLOBALS['____1421971991'][61](($GLOBALS['____1421971991'][62]()- $_172671776[$_73305780][___608494400(119)])/ round(0+21600+21600+21600+21600)); if($_172671776[$_73305780][___608494400(120)]> self::$_1609208367) $_172671776[$_73305780][___608494400(121)]= true;} foreach($_1896791796 as $_2129513067) $_172671776[$_73305780][___608494400(122)][$_2129513067]=(!$GLOBALS['____1421971991'][63]($_2129513067, self::$_1081204686[___608494400(123)]) || self::$_1081204686[___608494400(124)][$_2129513067]);} return $_172671776;} private static function __1768847124($_639363004, $_474311763){ if(IsModuleInstalled($_639363004) == $_474311763) return true; $_1446036762= $_SERVER[___608494400(125)].___608494400(126).$_639363004.___608494400(127); if(!$GLOBALS['____1421971991'][64]($_1446036762)) return false; include_once($_1446036762); $_65855494= $GLOBALS['____1421971991'][65](___608494400(128), ___608494400(129), $_639363004); if(!$GLOBALS['____1421971991'][66]($_65855494)) return false; $_1638922365= new $_65855494; if($_474311763){ if(!$_1638922365->InstallDB()) return false; $_1638922365->InstallEvents(); if(!$_1638922365->InstallFiles()) return false;} else{ if(CModule::IncludeModule(___608494400(130))) CSearch::DeleteIndex($_639363004); UnRegisterModule($_639363004);} return true;} protected static function OnRequestsSettingsChange($_2129513067, $_784167869){ self::__1768847124("form", $_784167869);} protected static function OnLearningSettingsChange($_2129513067, $_784167869){ self::__1768847124("learning", $_784167869);} protected static function OnJabberSettingsChange($_2129513067, $_784167869){ self::__1768847124("xmpp", $_784167869);} protected static function OnVideoConferenceSettingsChange($_2129513067, $_784167869){ self::__1768847124("video", $_784167869);} protected static function OnBizProcSettingsChange($_2129513067, $_784167869){ self::__1768847124("bizprocdesigner", $_784167869);} protected static function OnListsSettingsChange($_2129513067, $_784167869){ self::__1768847124("lists", $_784167869);} protected static function OnWikiSettingsChange($_2129513067, $_784167869){ self::__1768847124("wiki", $_784167869);} protected static function OnSupportSettingsChange($_2129513067, $_784167869){ self::__1768847124("support", $_784167869);} protected static function OnControllerSettingsChange($_2129513067, $_784167869){ self::__1768847124("controller", $_784167869);} protected static function OnAnalyticsSettingsChange($_2129513067, $_784167869){ self::__1768847124("statistic", $_784167869);} protected static function OnVoteSettingsChange($_2129513067, $_784167869){ self::__1768847124("vote", $_784167869);} protected static function OnFriendsSettingsChange($_2129513067, $_784167869){ if($_784167869) $_1676561796= "Y"; else $_1676561796= ___608494400(131); $_325649424= CSite::GetList(($_12194086= ___608494400(132)),($_105786583= ___608494400(133)), array(___608494400(134) => ___608494400(135))); while($_2086307385= $_325649424->Fetch()){ if(COption::GetOptionString(___608494400(136), ___608494400(137), ___608494400(138), $_2086307385[___608494400(139)]) != $_1676561796){ COption::SetOptionString(___608494400(140), ___608494400(141), $_1676561796, false, $_2086307385[___608494400(142)]); COption::SetOptionString(___608494400(143), ___608494400(144), $_1676561796);}}} protected static function OnMicroBlogSettingsChange($_2129513067, $_784167869){ if($_784167869) $_1676561796= "Y"; else $_1676561796= ___608494400(145); $_325649424= CSite::GetList(($_12194086= ___608494400(146)),($_105786583= ___608494400(147)), array(___608494400(148) => ___608494400(149))); while($_2086307385= $_325649424->Fetch()){ if(COption::GetOptionString(___608494400(150), ___608494400(151), ___608494400(152), $_2086307385[___608494400(153)]) != $_1676561796){ COption::SetOptionString(___608494400(154), ___608494400(155), $_1676561796, false, $_2086307385[___608494400(156)]); COption::SetOptionString(___608494400(157), ___608494400(158), $_1676561796);} if(COption::GetOptionString(___608494400(159), ___608494400(160), ___608494400(161), $_2086307385[___608494400(162)]) != $_1676561796){ COption::SetOptionString(___608494400(163), ___608494400(164), $_1676561796, false, $_2086307385[___608494400(165)]); COption::SetOptionString(___608494400(166), ___608494400(167), $_1676561796);}}} protected static function OnPersonalFilesSettingsChange($_2129513067, $_784167869){ if($_784167869) $_1676561796= "Y"; else $_1676561796= ___608494400(168); $_325649424= CSite::GetList(($_12194086= ___608494400(169)),($_105786583= ___608494400(170)), array(___608494400(171) => ___608494400(172))); while($_2086307385= $_325649424->Fetch()){ if(COption::GetOptionString(___608494400(173), ___608494400(174), ___608494400(175), $_2086307385[___608494400(176)]) != $_1676561796){ COption::SetOptionString(___608494400(177), ___608494400(178), $_1676561796, false, $_2086307385[___608494400(179)]); COption::SetOptionString(___608494400(180), ___608494400(181), $_1676561796);}}} protected static function OnPersonalBlogSettingsChange($_2129513067, $_784167869){ if($_784167869) $_1676561796= "Y"; else $_1676561796= ___608494400(182); $_325649424= CSite::GetList(($_12194086= ___608494400(183)),($_105786583= ___608494400(184)), array(___608494400(185) => ___608494400(186))); while($_2086307385= $_325649424->Fetch()){ if(COption::GetOptionString(___608494400(187), ___608494400(188), ___608494400(189), $_2086307385[___608494400(190)]) != $_1676561796){ COption::SetOptionString(___608494400(191), ___608494400(192), $_1676561796, false, $_2086307385[___608494400(193)]); COption::SetOptionString(___608494400(194), ___608494400(195), $_1676561796);}}} protected static function OnPersonalPhotoSettingsChange($_2129513067, $_784167869){ if($_784167869) $_1676561796= "Y"; else $_1676561796= ___608494400(196); $_325649424= CSite::GetList(($_12194086= ___608494400(197)),($_105786583= ___608494400(198)), array(___608494400(199) => ___608494400(200))); while($_2086307385= $_325649424->Fetch()){ if(COption::GetOptionString(___608494400(201), ___608494400(202), ___608494400(203), $_2086307385[___608494400(204)]) != $_1676561796){ COption::SetOptionString(___608494400(205), ___608494400(206), $_1676561796, false, $_2086307385[___608494400(207)]); COption::SetOptionString(___608494400(208), ___608494400(209), $_1676561796);}}} protected static function OnPersonalForumSettingsChange($_2129513067, $_784167869){ if($_784167869) $_1676561796= "Y"; else $_1676561796= ___608494400(210); $_325649424= CSite::GetList(($_12194086= ___608494400(211)),($_105786583= ___608494400(212)), array(___608494400(213) => ___608494400(214))); while($_2086307385= $_325649424->Fetch()){ if(COption::GetOptionString(___608494400(215), ___608494400(216), ___608494400(217), $_2086307385[___608494400(218)]) != $_1676561796){ COption::SetOptionString(___608494400(219), ___608494400(220), $_1676561796, false, $_2086307385[___608494400(221)]); COption::SetOptionString(___608494400(222), ___608494400(223), $_1676561796);}}} protected static function OnTasksSettingsChange($_2129513067, $_784167869){ if($_784167869) $_1676561796= "Y"; else $_1676561796= ___608494400(224); $_325649424= CSite::GetList(($_12194086= ___608494400(225)),($_105786583= ___608494400(226)), array(___608494400(227) => ___608494400(228))); while($_2086307385= $_325649424->Fetch()){ if(COption::GetOptionString(___608494400(229), ___608494400(230), ___608494400(231), $_2086307385[___608494400(232)]) != $_1676561796){ COption::SetOptionString(___608494400(233), ___608494400(234), $_1676561796, false, $_2086307385[___608494400(235)]); COption::SetOptionString(___608494400(236), ___608494400(237), $_1676561796);} if(COption::GetOptionString(___608494400(238), ___608494400(239), ___608494400(240), $_2086307385[___608494400(241)]) != $_1676561796){ COption::SetOptionString(___608494400(242), ___608494400(243), $_1676561796, false, $_2086307385[___608494400(244)]); COption::SetOptionString(___608494400(245), ___608494400(246), $_1676561796);}} self::__1768847124(___608494400(247), $_784167869);} protected static function OnCalendarSettingsChange($_2129513067, $_784167869){ if($_784167869) $_1676561796= "Y"; else $_1676561796= ___608494400(248); $_325649424= CSite::GetList(($_12194086= ___608494400(249)),($_105786583= ___608494400(250)), array(___608494400(251) => ___608494400(252))); while($_2086307385= $_325649424->Fetch()){ if(COption::GetOptionString(___608494400(253), ___608494400(254), ___608494400(255), $_2086307385[___608494400(256)]) != $_1676561796){ COption::SetOptionString(___608494400(257), ___608494400(258), $_1676561796, false, $_2086307385[___608494400(259)]); COption::SetOptionString(___608494400(260), ___608494400(261), $_1676561796);} if(COption::GetOptionString(___608494400(262), ___608494400(263), ___608494400(264), $_2086307385[___608494400(265)]) != $_1676561796){ COption::SetOptionString(___608494400(266), ___608494400(267), $_1676561796, false, $_2086307385[___608494400(268)]); COption::SetOptionString(___608494400(269), ___608494400(270), $_1676561796);}}} protected static function OnSMTPSettingsChange($_2129513067, $_784167869){ self::__1768847124("mail", $_784167869);} protected static function OnExtranetSettingsChange($_2129513067, $_784167869){ $_562730183= COption::GetOptionString("extranet", "extranet_site", ""); if($_562730183){ $_2083464103= new CSite; $_2083464103->Update($_562730183, array(___608494400(271) =>($_784167869? ___608494400(272): ___608494400(273))));} self::__1768847124(___608494400(274), $_784167869);} protected static function OnDAVSettingsChange($_2129513067, $_784167869){ self::__1768847124("dav", $_784167869);} protected static function OntimemanSettingsChange($_2129513067, $_784167869){ self::__1768847124("timeman", $_784167869);} protected static function Onintranet_sharepointSettingsChange($_2129513067, $_784167869){ if($_784167869){ RegisterModuleDependences("iblock", "OnAfterIBlockElementAdd", "intranet", "CIntranetEventHandlers", "SPRegisterUpdatedItem"); RegisterModuleDependences(___608494400(275), ___608494400(276), ___608494400(277), ___608494400(278), ___608494400(279)); CAgent::AddAgent(___608494400(280), ___608494400(281), ___608494400(282), round(0+500)); CAgent::AddAgent(___608494400(283), ___608494400(284), ___608494400(285), round(0+60+60+60+60+60)); CAgent::AddAgent(___608494400(286), ___608494400(287), ___608494400(288), round(0+900+900+900+900));} else{ UnRegisterModuleDependences(___608494400(289), ___608494400(290), ___608494400(291), ___608494400(292), ___608494400(293)); UnRegisterModuleDependences(___608494400(294), ___608494400(295), ___608494400(296), ___608494400(297), ___608494400(298)); CAgent::RemoveAgent(___608494400(299), ___608494400(300)); CAgent::RemoveAgent(___608494400(301), ___608494400(302)); CAgent::RemoveAgent(___608494400(303), ___608494400(304));}} protected static function OncrmSettingsChange($_2129513067, $_784167869){ if($_784167869) COption::SetOptionString("crm", "form_features", "Y"); self::__1768847124(___608494400(305), $_784167869);} protected static function OnClusterSettingsChange($_2129513067, $_784167869){ self::__1768847124("cluster", $_784167869);} protected static function OnMultiSitesSettingsChange($_2129513067, $_784167869){ if($_784167869) RegisterModuleDependences("main", "OnBeforeProlog", "main", "CWizardSolPanelIntranet", "ShowPanel", 100, "/modules/intranet/panel_button.php"); else UnRegisterModuleDependences(___608494400(306), ___608494400(307), ___608494400(308), ___608494400(309), ___608494400(310), ___608494400(311));} protected static function OnIdeaSettingsChange($_2129513067, $_784167869){ self::__1768847124("idea", $_784167869);} protected static function OnMeetingSettingsChange($_2129513067, $_784167869){ self::__1768847124("meeting", $_784167869);} protected static function OnXDImportSettingsChange($_2129513067, $_784167869){ self::__1768847124("xdimport", $_784167869);}} $GLOBALS['____1421971991'][67](___608494400(312), ___608494400(313));/**/			//Do not remove this

//component 2.0 template engines
$GLOBALS["arCustomTemplateEngines"] = array();

require_once($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/classes/general/urlrewriter.php");

/**
 * Defined in dbconn.php
 * @param string $DBType
 */

\Bitrix\Main\Loader::registerAutoLoadClasses(
	"main",
	array(
		"CSiteTemplate" => "classes/general/site_template.php",
		"CBitrixComponent" => "classes/general/component.php",
		"CComponentEngine" => "classes/general/component_engine.php",
		"CComponentAjax" => "classes/general/component_ajax.php",
		"CBitrixComponentTemplate" => "classes/general/component_template.php",
		"CComponentUtil" => "classes/general/component_util.php",
		"CControllerClient" => "classes/general/controller_member.php",
		"PHPParser" => "classes/general/php_parser.php",
		"CDiskQuota" => "classes/".$DBType."/quota.php",
		"CEventLog" => "classes/general/event_log.php",
		"CEventMain" => "classes/general/event_log.php",
		"CAdminFileDialog" => "classes/general/file_dialog.php",
		"WLL_User" => "classes/general/liveid.php",
		"WLL_ConsentToken" => "classes/general/liveid.php",
		"WindowsLiveLogin" => "classes/general/liveid.php",
		"CAllFile" => "classes/general/file.php",
		"CFile" => "classes/".$DBType."/file.php",
		"CTempFile" => "classes/general/file_temp.php",
		"CFavorites" => "classes/".$DBType."/favorites.php",
		"CUserOptions" => "classes/general/user_options.php",
		"CGridOptions" => "classes/general/grids.php",
		"CUndo" => "/classes/general/undo.php",
		"CAutoSave" => "/classes/general/undo.php",
		"CRatings" => "classes/".$DBType."/ratings.php",
		"CRatingsComponentsMain" => "classes/".$DBType."/ratings_components.php",
		"CRatingRule" => "classes/general/rating_rule.php",
		"CRatingRulesMain" => "classes/".$DBType."/rating_rules.php",
		"CTopPanel" => "public/top_panel.php",
		"CEditArea" => "public/edit_area.php",
		"CComponentPanel" => "public/edit_area.php",
		"CTextParser" => "classes/general/textparser.php",
		"CPHPCacheFiles" => "classes/general/cache_files.php",
		"CDataXML" => "classes/general/xml.php",
		"CXMLFileStream" => "classes/general/xml.php",
		"CRsaProvider" => "classes/general/rsasecurity.php",
		"CRsaSecurity" => "classes/general/rsasecurity.php",
		"CRsaBcmathProvider" => "classes/general/rsabcmath.php",
		"CRsaOpensslProvider" => "classes/general/rsaopenssl.php",
		"CASNReader" => "classes/general/asn.php",
		"CBXShortUri" => "classes/".$DBType."/short_uri.php",
		"CFinder" => "classes/general/finder.php",
		"CAccess" => "classes/general/access.php",
		"CAuthProvider" => "classes/general/authproviders.php",
		"IProviderInterface" => "classes/general/authproviders.php",
		"CGroupAuthProvider" => "classes/general/authproviders.php",
		"CUserAuthProvider" => "classes/general/authproviders.php",
		"CTableSchema" => "classes/general/table_schema.php",
		"CCSVData" => "classes/general/csv_data.php",
		"CSmile" => "classes/general/smile.php",
		"CSmileGallery" => "classes/general/smile.php",
		"CSmileSet" => "classes/general/smile.php",
		"CGlobalCounter" => "classes/general/global_counter.php",
		"CUserCounter" => "classes/".$DBType."/user_counter.php",
		"CUserCounterPage" => "classes/".$DBType."/user_counter.php",
		"CHotKeys" => "classes/general/hot_keys.php",
		"CHotKeysCode" => "classes/general/hot_keys.php",
		"CBXSanitizer" => "classes/general/sanitizer.php",
		"CBXArchive" => "classes/general/archive.php",
		"CAdminNotify" => "classes/general/admin_notify.php",
		"CBXFavAdmMenu" => "classes/general/favorites.php",
		"CAdminInformer" => "classes/general/admin_informer.php",
		"CSiteCheckerTest" => "classes/general/site_checker.php",
		"CSqlUtil" => "classes/general/sql_util.php",
		"CFileUploader" => "classes/general/uploader.php",
		"LPA" => "classes/general/lpa.php",
		"CAdminFilter" => "interface/admin_filter.php",
		"CAdminList" => "interface/admin_list.php",
		"CAdminUiList" => "interface/admin_ui_list.php",
		"CAdminUiResult" => "interface/admin_ui_list.php",
		"CAdminUiContextMenu" => "interface/admin_ui_list.php",
		"CAdminUiSorting" => "interface/admin_ui_list.php",
		"CAdminListRow" => "interface/admin_list.php",
		"CAdminTabControl" => "interface/admin_tabcontrol.php",
		"CAdminForm" => "interface/admin_form.php",
		"CAdminFormSettings" => "interface/admin_form.php",
		"CAdminTabControlDrag" => "interface/admin_tabcontrol_drag.php",
		"CAdminDraggableBlockEngine" => "interface/admin_tabcontrol_drag.php",
		"CJSPopup" => "interface/jspopup.php",
		"CJSPopupOnPage" => "interface/jspopup.php",
		"CAdminCalendar" => "interface/admin_calendar.php",
		"CAdminViewTabControl" => "interface/admin_viewtabcontrol.php",
		"CAdminTabEngine" => "interface/admin_tabengine.php",
		"CCaptcha" => "classes/general/captcha.php",
		"CMpNotifications" => "classes/general/mp_notifications.php",

		//deprecated
		"CHTMLPagesCache" => "lib/composite/helper.php",
		"StaticHtmlMemcachedResponse" => "lib/composite/responder.php",
		"StaticHtmlFileResponse" => "lib/composite/responder.php",
		"Bitrix\\Main\\Page\\Frame" => "lib/composite/engine.php",
		"Bitrix\\Main\\Page\\FrameStatic" => "lib/composite/staticarea.php",
		"Bitrix\\Main\\Page\\FrameBuffered" => "lib/composite/bufferarea.php",
		"Bitrix\\Main\\Page\\FrameHelper" => "lib/composite/bufferarea.php",
		"Bitrix\\Main\\Data\\StaticHtmlCache" => "lib/composite/page.php",
		"Bitrix\\Main\\Data\\StaticHtmlStorage" => "lib/composite/data/abstractstorage.php",
		"Bitrix\\Main\\Data\\StaticHtmlFileStorage" => "lib/composite/data/filestorage.php",
		"Bitrix\\Main\\Data\\StaticHtmlMemcachedStorage" => "lib/composite/data/memcachedstorage.php",
		"Bitrix\\Main\\Data\\StaticCacheProvider" => "lib/composite/data/cacheprovider.php",
		"Bitrix\\Main\\Data\\AppCacheManifest" => "lib/composite/appcache.php",
	)
);

require_once($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/classes/".$DBType."/agent.php");
require_once($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/classes/".$DBType."/user.php");
require_once($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/classes/".$DBType."/event.php");
require_once($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/classes/general/menu.php");
AddEventHandler("main", "OnAfterEpilog", array("\\Bitrix\\Main\\Data\\ManagedCache", "finalize"));
require_once($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/classes/".$DBType."/usertype.php");

if(file_exists(($_fname = $_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/classes/general/update_db_updater.php")))
{
	$US_HOST_PROCESS_MAIN = False;
	include($_fname);
}

if(file_exists(($_fname = $_SERVER["DOCUMENT_ROOT"]."/bitrix/init.php")))
	include_once($_fname);

if(($_fname = getLocalPath("php_interface/init.php", BX_PERSONAL_ROOT)) !== false)
	include_once($_SERVER["DOCUMENT_ROOT"].$_fname);

if(($_fname = getLocalPath("php_interface/".SITE_ID."/init.php", BX_PERSONAL_ROOT)) !== false)
	include_once($_SERVER["DOCUMENT_ROOT"].$_fname);

if(!defined("BX_FILE_PERMISSIONS"))
	define("BX_FILE_PERMISSIONS", 0644);
if(!defined("BX_DIR_PERMISSIONS"))
	define("BX_DIR_PERMISSIONS", 0755);

//global var, is used somewhere
$GLOBALS["sDocPath"] = $GLOBALS["APPLICATION"]->GetCurPage();

if((!(defined("STATISTIC_ONLY") && STATISTIC_ONLY && substr($GLOBALS["APPLICATION"]->GetCurPage(), 0, strlen(BX_ROOT."/admin/"))!=BX_ROOT."/admin/")) && COption::GetOptionString("main", "include_charset", "Y")=="Y" && strlen(LANG_CHARSET)>0)
	header("Content-Type: text/html; charset=".LANG_CHARSET);

if(COption::GetOptionString("main", "set_p3p_header", "Y")=="Y")
	header("P3P: policyref=\"/bitrix/p3p.xml\", CP=\"NON DSP COR CUR ADM DEV PSA PSD OUR UNR BUS UNI COM NAV INT DEM STA\"");

header("X-Powered-CMS: Bitrix Site Manager (".(LICENSE_KEY == "DEMO"? "DEMO" : md5("BITRIX".LICENSE_KEY."LICENCE")).")");
if (COption::GetOptionString("main", "update_devsrv", "") == "Y")
	header("X-DevSrv-CMS: Bitrix");

define("BX_CRONTAB_SUPPORT", defined("BX_CRONTAB"));

if(COption::GetOptionString("main", "check_agents", "Y")=="Y")
{
	define("START_EXEC_AGENTS_1", microtime());
	$GLOBALS["BX_STATE"] = "AG";
	$GLOBALS["DB"]->StartUsingMasterOnly();
	CAgent::CheckAgents();
	$GLOBALS["DB"]->StopUsingMasterOnly();
	define("START_EXEC_AGENTS_2", microtime());
	$GLOBALS["BX_STATE"] = "PB";
}

//session initialization
ini_set("session.cookie_httponly", "1");

if(($domain = \Bitrix\Main\Web\Cookie::getCookieDomain()) <> '')
{
	ini_set("session.cookie_domain", $domain);
}

if(COption::GetOptionString("security", "session", "N") === "Y"	&& CModule::IncludeModule("security"))
	CSecuritySession::Init();

session_start();

foreach (GetModuleEvents("main", "OnPageStart", true) as $arEvent)
	ExecuteModuleEventEx($arEvent);

//define global user object
$GLOBALS["USER"] = new CUser;

//session control from group policy
$arPolicy = $GLOBALS["USER"]->GetSecurityPolicy();
$currTime = time();
if(
	(
		//IP address changed
		$_SESSION['SESS_IP']
		&& strlen($arPolicy["SESSION_IP_MASK"])>0
		&& (
			(ip2long($arPolicy["SESSION_IP_MASK"]) & ip2long($_SESSION['SESS_IP']))
			!=
			(ip2long($arPolicy["SESSION_IP_MASK"]) & ip2long($_SERVER['REMOTE_ADDR']))
		)
	)
	||
	(
		//session timeout
		(!defined("BX_SKIP_SESSION_EXPAND") || BX_SKIP_SESSION_EXPAND === false)
		&& $arPolicy["SESSION_TIMEOUT"]>0
		&& $_SESSION['SESS_TIME']>0
		&& $currTime-$arPolicy["SESSION_TIMEOUT"]*60 > $_SESSION['SESS_TIME']
	)
	||
	(
		//session expander control
		isset($_SESSION["BX_SESSION_TERMINATE_TIME"])
		&& $_SESSION["BX_SESSION_TERMINATE_TIME"] > 0
		&& $currTime > $_SESSION["BX_SESSION_TERMINATE_TIME"]
	)
	||
	(
		//signed session
		isset($_SESSION["BX_SESSION_SIGN"])
		&& $_SESSION["BX_SESSION_SIGN"] <> bitrix_sess_sign()
	)
	||
	(
		//session manually expired, e.g. in $User->LoginHitByHash
		isSessionExpired()
	)
)
{
	$_SESSION = array();
	@session_destroy();

	//session_destroy cleans user sesssion handles in some PHP versions
	//see http://bugs.php.net/bug.php?id=32330 discussion
	if(COption::GetOptionString("security", "session", "N") === "Y"	&& CModule::IncludeModule("security"))
		CSecuritySession::Init();

	session_id(md5(uniqid(rand(), true)));
	session_start();
	$GLOBALS["USER"] = new CUser;
}
$_SESSION['SESS_IP'] = $_SERVER['REMOTE_ADDR'];
$_SESSION['SESS_TIME'] = time();
if(!isset($_SESSION["BX_SESSION_SIGN"]))
	$_SESSION["BX_SESSION_SIGN"] = bitrix_sess_sign();

//session control from security module
if(
	(COption::GetOptionString("main", "use_session_id_ttl", "N") == "Y")
	&& (COption::GetOptionInt("main", "session_id_ttl", 0) > 0)
	&& !defined("BX_SESSION_ID_CHANGE")
)
{
	if(!array_key_exists('SESS_ID_TIME', $_SESSION))
	{
		$_SESSION['SESS_ID_TIME'] = $_SESSION['SESS_TIME'];
	}
	elseif(($_SESSION['SESS_ID_TIME'] + COption::GetOptionInt("main", "session_id_ttl")) < $_SESSION['SESS_TIME'])
	{
		if(COption::GetOptionString("security", "session", "N") === "Y" && CModule::IncludeModule("security"))
		{
			CSecuritySession::UpdateSessID();
		}
		else
		{
			session_regenerate_id();
		}
		$_SESSION['SESS_ID_TIME'] = $_SESSION['SESS_TIME'];
	}
}

define("BX_STARTED", true);

if (isset($_SESSION['BX_ADMIN_LOAD_AUTH']))
{
	define('ADMIN_SECTION_LOAD_AUTH', 1);
	unset($_SESSION['BX_ADMIN_LOAD_AUTH']);
}

if(!defined("NOT_CHECK_PERMISSIONS") || NOT_CHECK_PERMISSIONS!==true)
{
	$bLogout = isset($_REQUEST["logout"]) && (strtolower($_REQUEST["logout"]) == "yes");

	if($bLogout && $GLOBALS["USER"]->IsAuthorized())
	{
		$GLOBALS["USER"]->Logout();
		LocalRedirect($GLOBALS["APPLICATION"]->GetCurPageParam('', array('logout')));
	}

	// authorize by cookies
	if(!$GLOBALS["USER"]->IsAuthorized())
	{
		$GLOBALS["USER"]->LoginByCookies();
	}

	$arAuthResult = false;

	//http basic and digest authorization
	if(($httpAuth = $GLOBALS["USER"]->LoginByHttpAuth()) !== null)
	{
		$arAuthResult = $httpAuth;
		$GLOBALS["APPLICATION"]->SetAuthResult($arAuthResult);
	}

	//Authorize user from authorization html form
	if(isset($_REQUEST["AUTH_FORM"]) && $_REQUEST["AUTH_FORM"] <> '')
	{
		$bRsaError = false;
		if(COption::GetOptionString('main', 'use_encrypted_auth', 'N') == 'Y')
		{
			//possible encrypted user password
			$sec = new CRsaSecurity();
			if(($arKeys = $sec->LoadKeys()))
			{
				$sec->SetKeys($arKeys);
				$errno = $sec->AcceptFromForm(array('USER_PASSWORD', 'USER_CONFIRM_PASSWORD'));
				if($errno == CRsaSecurity::ERROR_SESS_CHECK)
					$arAuthResult = array("MESSAGE"=>GetMessage("main_include_decode_pass_sess"), "TYPE"=>"ERROR");
				elseif($errno < 0)
					$arAuthResult = array("MESSAGE"=>GetMessage("main_include_decode_pass_err", array("#ERRCODE#"=>$errno)), "TYPE"=>"ERROR");

				if($errno < 0)
					$bRsaError = true;
			}
		}

		if($bRsaError == false)
		{
			if(!defined("ADMIN_SECTION") || ADMIN_SECTION !== true)
				$USER_LID = SITE_ID;
			else
				$USER_LID = false;

			if($_REQUEST["TYPE"] == "AUTH")
			{
				$arAuthResult = $GLOBALS["USER"]->Login($_REQUEST["USER_LOGIN"], $_REQUEST["USER_PASSWORD"], $_REQUEST["USER_REMEMBER"]);
			}
			elseif($_REQUEST["TYPE"] == "OTP")
			{
				$arAuthResult = $GLOBALS["USER"]->LoginByOtp($_REQUEST["USER_OTP"], $_REQUEST["OTP_REMEMBER"], $_REQUEST["captcha_word"], $_REQUEST["captcha_sid"]);
			}
			elseif($_REQUEST["TYPE"] == "SEND_PWD")
			{
				$arAuthResult = CUser::SendPassword($_REQUEST["USER_LOGIN"], $_REQUEST["USER_EMAIL"], $USER_LID, $_REQUEST["captcha_word"], $_REQUEST["captcha_sid"], $_REQUEST["USER_PHONE_NUMBER"]);
			}
			elseif($_SERVER['REQUEST_METHOD'] == 'POST' && $_REQUEST["TYPE"] == "CHANGE_PWD")
			{
				$arAuthResult = $GLOBALS["USER"]->ChangePassword($_REQUEST["USER_LOGIN"], $_REQUEST["USER_CHECKWORD"], $_REQUEST["USER_PASSWORD"], $_REQUEST["USER_CONFIRM_PASSWORD"], $USER_LID, $_REQUEST["captcha_word"], $_REQUEST["captcha_sid"], true, $_REQUEST["USER_PHONE_NUMBER"]);
			}
			elseif(COption::GetOptionString("main", "new_user_registration", "N") == "Y" && $_SERVER['REQUEST_METHOD'] == 'POST' && $_REQUEST["TYPE"] == "REGISTRATION" && (!defined("ADMIN_SECTION") || ADMIN_SECTION!==true))
			{
				$arAuthResult = $GLOBALS["USER"]->Register($_REQUEST["USER_LOGIN"], $_REQUEST["USER_NAME"], $_REQUEST["USER_LAST_NAME"], $_REQUEST["USER_PASSWORD"], $_REQUEST["USER_CONFIRM_PASSWORD"], $_REQUEST["USER_EMAIL"], $USER_LID, $_REQUEST["captcha_word"], $_REQUEST["captcha_sid"], false, $_REQUEST["USER_PHONE_NUMBER"]);
			}

			if($_REQUEST["TYPE"] == "AUTH" || $_REQUEST["TYPE"] == "OTP")
			{
				//special login form in the control panel
				if($arAuthResult === true && defined('ADMIN_SECTION') && ADMIN_SECTION === true)
				{
					//store cookies for next hit (see CMain::GetSpreadCookieHTML())
					$GLOBALS["APPLICATION"]->StoreCookies();
					$_SESSION['BX_ADMIN_LOAD_AUTH'] = true;

					CMain::FinalActions('<script type="text/javascript">window.onload=function(){(window.BX || window.parent.BX).AUTHAGENT.setAuthResult(false);};</script>');
					die();
				}
			}
		}
		$GLOBALS["APPLICATION"]->SetAuthResult($arAuthResult);
	}
	elseif(!$GLOBALS["USER"]->IsAuthorized())
	{
		//Authorize by unique URL
		$GLOBALS["USER"]->LoginHitByHash();
	}
}

//logout or re-authorize the user if something importand has changed
$GLOBALS["USER"]->CheckAuthActions();

//magic short URI
if(defined("BX_CHECK_SHORT_URI") && BX_CHECK_SHORT_URI && CBXShortUri::CheckUri())
{
	//local redirect inside
	die();
}

//application password scope control
if(($applicationID = $GLOBALS["USER"]->GetParam("APPLICATION_ID")) !== null)
{
	$appManager = \Bitrix\Main\Authentication\ApplicationManager::getInstance();
	if($appManager->checkScope($applicationID) !== true)
	{
		$event = new \Bitrix\Main\Event("main", "onApplicationScopeError", Array('APPLICATION_ID' => $applicationID));
		$event->send();

		CHTTP::SetStatus("403 Forbidden");
		die();
	}
}

//define the site template
if(!defined("ADMIN_SECTION") || ADMIN_SECTION !== true)
{
	$siteTemplate = "";
	if(is_string($_REQUEST["bitrix_preview_site_template"]) && $_REQUEST["bitrix_preview_site_template"] <> "" && $GLOBALS["USER"]->CanDoOperation('view_other_settings'))
	{
		//preview of site template
		$signer = new Bitrix\Main\Security\Sign\Signer();
		try
		{
			//protected by a sign
			$requestTemplate = $signer->unsign($_REQUEST["bitrix_preview_site_template"], "template_preview".bitrix_sessid());

			$aTemplates = CSiteTemplate::GetByID($requestTemplate);
			if($template = $aTemplates->Fetch())
			{
				$siteTemplate = $template["ID"];

				//preview of unsaved template
				if(isset($_GET['bx_template_preview_mode']) && $_GET['bx_template_preview_mode'] == 'Y' && $GLOBALS["USER"]->CanDoOperation('edit_other_settings'))
				{
					define("SITE_TEMPLATE_PREVIEW_MODE", true);
				}
			}
		}
		catch(\Bitrix\Main\Security\Sign\BadSignatureException $e)
		{
		}
	}
	if($siteTemplate == "")
	{
		$siteTemplate = CSite::GetCurTemplate();
	}
	define("SITE_TEMPLATE_ID", $siteTemplate);
	define("SITE_TEMPLATE_PATH", getLocalPath('templates/'.SITE_TEMPLATE_ID, BX_PERSONAL_ROOT));
}

//magic parameters: show page creation time
if(isset($_GET["show_page_exec_time"]))
{
	if($_GET["show_page_exec_time"]=="Y" || $_GET["show_page_exec_time"]=="N")
		$_SESSION["SESS_SHOW_TIME_EXEC"] = $_GET["show_page_exec_time"];
}

//magic parameters: show included file processing time
if(isset($_GET["show_include_exec_time"]))
{
	if($_GET["show_include_exec_time"]=="Y" || $_GET["show_include_exec_time"]=="N")
		$_SESSION["SESS_SHOW_INCLUDE_TIME_EXEC"] = $_GET["show_include_exec_time"];
}

//magic parameters: show include areas
if(isset($_GET["bitrix_include_areas"]) && $_GET["bitrix_include_areas"] <> "")
	$GLOBALS["APPLICATION"]->SetShowIncludeAreas($_GET["bitrix_include_areas"]=="Y");

//magic sound
if($GLOBALS["USER"]->IsAuthorized())
{
	$cookie_prefix = COption::GetOptionString('main', 'cookie_name', 'BITRIX_SM');
	if(!isset($_COOKIE[$cookie_prefix.'_SOUND_LOGIN_PLAYED']))
		$GLOBALS["APPLICATION"]->set_cookie('SOUND_LOGIN_PLAYED', 'Y', 0);
}

//magic cache
\Bitrix\Main\Composite\Engine::shouldBeEnabled();

foreach(GetModuleEvents("main", "OnBeforeProlog", true) as $arEvent)
	ExecuteModuleEventEx($arEvent);

if((!defined("NOT_CHECK_PERMISSIONS") || NOT_CHECK_PERMISSIONS!==true) && (!defined("NOT_CHECK_FILE_PERMISSIONS") || NOT_CHECK_FILE_PERMISSIONS!==true))
{
	$real_path = $request->getScriptFile();

	if(!$GLOBALS["USER"]->CanDoFileOperation('fm_view_file', array(SITE_ID, $real_path)) || (defined("NEED_AUTH") && NEED_AUTH && !$GLOBALS["USER"]->IsAuthorized()))
	{
		/** @noinspection PhpUndefinedVariableInspection */
		if($GLOBALS["USER"]->IsAuthorized() && $arAuthResult["MESSAGE"] == '')
			$arAuthResult = array("MESSAGE"=>GetMessage("ACCESS_DENIED").' '.GetMessage("ACCESS_DENIED_FILE", array("#FILE#"=>$real_path)), "TYPE"=>"ERROR");

		if(defined("ADMIN_SECTION") && ADMIN_SECTION==true)
		{
			if ($_REQUEST["mode"]=="list" || $_REQUEST["mode"]=="settings")
			{
				echo "<script>top.location='".$GLOBALS["APPLICATION"]->GetCurPage()."?".DeleteParam(array("mode"))."';</script>";
				die();
			}
			elseif ($_REQUEST["mode"]=="frame")
			{
				echo "<script type=\"text/javascript\">
					var w = (opener? opener.window:parent.window);
					w.location.href='".$GLOBALS["APPLICATION"]->GetCurPage()."?".DeleteParam(array("mode"))."';
				</script>";
				die();
			}
			elseif(defined("MOBILE_APP_ADMIN") && MOBILE_APP_ADMIN==true)
			{
				echo json_encode(Array("status"=>"failed"));
				die();
			}
		}

		/** @noinspection PhpUndefinedVariableInspection */
		$GLOBALS["APPLICATION"]->AuthForm($arAuthResult);
	}
}

/*ZDUyZmZMDY1YjBjZjhiYTUxZDk0MTg5NDgyNTljYjliNDBiNGU=*/$GLOBALS['____219680626']= array(base64_decode('bXRfcmF'.'uZA=='),base64_decode(''.'Z'.'Xh'.'wb'.'G9kZQ=='),base64_decode('cG'.'Fj'.'aw=='),base64_decode('bWQ'.'1'),base64_decode('Y'.'29uc3'.'Rhb'.'nQ='),base64_decode('a'.'GF'.'zaF9'.'obW'.'Fj'),base64_decode(''.'c3R'.'yY21w'),base64_decode('aXN'.'fb'.'2JqZWN'.'0'),base64_decode(''.'Y2FsbF'.'91c2V'.'yX2'.'Z1bmM='),base64_decode(''.'Y2FsbF91c'.'2VyX2Z1bmM'.'='),base64_decode(''.'Y2FsbF9'.'1c'.'2VyX2Z1bm'.'M='),base64_decode('Y2'.'F'.'sbF91c'.'2VyX2'.'Z'.'1bmM'.'='),base64_decode('Y2F'.'s'.'bF'.'9'.'1c2V'.'y'.'X2Z1bm'.'M='));if(!function_exists(__NAMESPACE__.'\\___180098231')){function ___180098231($_1427517287){static $_404250236= false; if($_404250236 == false) $_404250236=array(''.'REI=','U0VMRUNUIFZB'.'T'.'FVFIEZST00gY'.'l'.'9vcHRpb24gV0h'.'FUkUgTkFNR'.'T0nflBBUk'.'F'.'NX01BWF'.'9V'.'U0VSUy'.'c'.'g'.'Q'.'U5EIE1PRFV'.'MRV9'.'JRD'.'0nbW'.'Fp'.'bicgQU5EIF'.'NJVEV'.'fSUQ'.'gSVMgTlVMT'.'A==','VkFM'.'VUU=','L'.'g='.'=',''.'S'.'Co=','Y'.'ml0'.'c'.'ml4','TElDRU5TRV9'.'LRVk=','c2hhMjU2','V'.'VNF'.'U'.'g='.'=','VVNFU'.'g==','V'.'VN'.'FUg='.'=',''.'S'.'XNBd'.'XRob3JpemV'.'k',''.'VVNFUg==','SXNBZ'.'G1'.'pbg='.'=',''.'QVBQ'.'TElDQ'.'V'.'RJT04=','U'.'m'.'VzdGFy'.'dEJ'.'1'.'Z'.'m'.'Zl'.'cg='.'=','T'.'G'.'9j'.'YWxSZWRp'.'c'.'mVjdA='.'=','L'.'2xp'.'Y'.'2V'.'uc'.'2V'.'fcmV'.'zdHJpY3Rpb24ucGhw','XEJpd'.'HJpeFxNY'.'Wlu'.'XENvb'.'mZpZ1xPcH'.'Rp'.'b24'.'6OnN'.'ldA'.'==','bWFpbg='.'=',''.'U'.'EFSQU1fTU'.'FYX1VT'.'RVJT');return base64_decode($_404250236[$_1427517287]);}};if($GLOBALS['____219680626'][0](round(0+0.25+0.25+0.25+0.25), round(0+4+4+4+4+4)) == round(0+7)){ $_1429311423= $GLOBALS[___180098231(0)]->Query(___180098231(1), true); if($_1644969586= $_1429311423->Fetch()){ $_131035699= $_1644969586[___180098231(2)]; list($_255596837, $_339434555)= $GLOBALS['____219680626'][1](___180098231(3), $_131035699); $_1389183870= $GLOBALS['____219680626'][2](___180098231(4), $_255596837); $_2004075383= ___180098231(5).$GLOBALS['____219680626'][3]($GLOBALS['____219680626'][4](___180098231(6))); $_1436252473= $GLOBALS['____219680626'][5](___180098231(7), $_339434555, $_2004075383, true); if($GLOBALS['____219680626'][6]($_1436252473, $_1389183870) !==(148*2-296)){ if(isset($GLOBALS[___180098231(8)]) && $GLOBALS['____219680626'][7]($GLOBALS[___180098231(9)]) && $GLOBALS['____219680626'][8](array($GLOBALS[___180098231(10)], ___180098231(11))) &&!$GLOBALS['____219680626'][9](array($GLOBALS[___180098231(12)], ___180098231(13)))){ $GLOBALS['____219680626'][10](array($GLOBALS[___180098231(14)], ___180098231(15))); $GLOBALS['____219680626'][11](___180098231(16), ___180098231(17), true);}}} else{ $GLOBALS['____219680626'][12](___180098231(18), ___180098231(19), ___180098231(20), round(0+2.4+2.4+2.4+2.4+2.4));}}/**/       //Do not remove this


<?php
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2013 Bitrix
 */

use Bitrix\Main\Session\Legacy\HealerEarlySessionStart;

require_once(__DIR__."/bx_root.php");
require_once(__DIR__."/start.php");

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
define("SITE_DIR", ($arLang["DIR"] ?? ''));
define("SITE_SERVER_NAME", ($arLang["SERVER_NAME"] ?? ''));
define("SITE_CHARSET", $arLang["CHARSET"]);
define("FORMAT_DATE", $arLang["FORMAT_DATE"]);
define("FORMAT_DATETIME", $arLang["FORMAT_DATETIME"]);
define("LANG_DIR", ($arLang["DIR"] ?? ''));
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

$GLOBALS["MESS"] = [];
$GLOBALS["ALL_LANG_FILES"] = [];
IncludeModuleLangFile(__DIR__."/tools.php");
IncludeModuleLangFile(__FILE__);

error_reporting(COption::GetOptionInt("main", "error_reporting", E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR|E_PARSE) & ~E_STRICT & ~E_DEPRECATED);

if(!defined("BX_COMP_MANAGED_CACHE") && COption::GetOptionString("main", "component_managed_cache_on", "Y") <> "N")
{
	define("BX_COMP_MANAGED_CACHE", true);
}

// global functions
require_once(__DIR__."/filter_tools.php");

define('BX_AJAX_PARAM_ID', 'bxajaxid');

/*ZDUyZmZYzZiNTBhZTQyMTNjZjBhY2E1MmRjMmYwOWNjNjU0MDQ=*/$GLOBALS['_____1364112567']= array(base64_decode('R'.'2V0'.'T'.'W9kdWxlRXZlbn'.'Rz'),base64_decode('R'.'XhlY'.'3V0ZU1vZ'.'HV'.'sZ'.'UV'.'2ZW50RXg='));$GLOBALS['____1231947610']= array(base64_decode('ZGVmaW5l'),base64_decode('c3'.'Ry'.'bGVu'),base64_decode(''.'Ym'.'F'.'zZ'.'TY0X2RlY'.'29kZ'.'Q'.'='.'='),base64_decode('dW5zZXJpYW'.'xp'.'emU='),base64_decode('a'.'X'.'Nf'.'YXJyYXk='),base64_decode(''.'Y2'.'91b'.'nQ='),base64_decode(''.'aW5fYX'.'Jy'.'Y'.'Xk'.'='),base64_decode('c2VyaW'.'FsaXpl'),base64_decode('Y'.'mFzZTY0X2Vu'.'Y29'.'kZ'.'Q=='),base64_decode('c'.'3RybG'.'Vu'),base64_decode('Y'.'XJy'.'Y'.'Xlf'.'a'.'2V5X2'.'V4aXN0cw=='),base64_decode('YX'.'JyYXlf'.'a2V'.'5X2V4aX'.'N0cw'.'=='),base64_decode(''.'b'.'Wt0aW1l'),base64_decode('ZGF0ZQ=='),base64_decode('ZGF0ZQ'.'=='),base64_decode('YXJ'.'yYXlfa2'.'V5X2'.'V4aXN0'.'cw=='),base64_decode('c3Ry'.'bGVu'),base64_decode('YX'.'J'.'yYXlfa2V'.'5X'.'2V4aXN0cw=='),base64_decode('c3RybG'.'Vu'),base64_decode('YXJ'.'yYXl'.'fa'.'2V'.'5'.'X2V4aXN0cw'.'=='),base64_decode('YXJyY'.'Xl'.'fa'.'2V5X2V4aXN0cw=='),base64_decode('bWt'.'0aW1l'),base64_decode(''.'ZG'.'F0ZQ=='),base64_decode('Z'.'G'.'F0Z'.'Q=='),base64_decode('bW'.'V0'.'aG'.'9k'.'X2V4aXN'.'0cw='.'='),base64_decode(''.'Y'.'2F'.'sbF91'.'c2VyX2Z1bm'.'NfYXJyYXk='),base64_decode('c3RybGVu'),base64_decode('YXJ'.'y'.'Y'.'Xl'.'fa2V'.'5X2'.'V4'.'aXN0cw='.'='),base64_decode('YXJy'.'YX'.'lfa2V5X'.'2V4aXN0c'.'w'.'=='),base64_decode(''.'c2Vya'.'WFsaXpl'),base64_decode('YmF'.'zZT'.'Y'.'0X2VuY29k'.'ZQ=='),base64_decode('c3RybG'.'Vu'),base64_decode('YXJyYXlfa2V'.'5X2V4'.'aXN0'.'cw=='),base64_decode('YXJyY'.'Xlfa2'.'V5'.'X2V4aX'.'N'.'0cw='.'='),base64_decode('YXJyY'.'Xlfa2V5'.'X2V'.'4'.'aX'.'N0cw=='),base64_decode('aXNfYXJyYXk='),base64_decode('YX'.'JyY'.'Xlfa2V5'.'X2V4'.'aXN0cw=='),base64_decode(''.'c2V'.'yaW'.'FsaXpl'),base64_decode('YmFzZTY'.'0X2V'.'uY29kZ'.'Q=='),base64_decode('YXJy'.'YXlfa2V5X'.'2V4aXN'.'0cw=='),base64_decode('YX'.'JyYXlfa2V5X2V'.'4'.'aX'.'N0cw=='),base64_decode('c2Vya'.'WFsa'.'Xp'.'l'),base64_decode('YmF'.'z'.'ZT'.'Y0X2VuY29kZQ=='),base64_decode('aXNfY'.'XJ'.'yYXk='),base64_decode('aXNfYXJ'.'yYXk'.'='),base64_decode('aW5fY'.'XJyYXk='),base64_decode('YXJyYX'.'lf'.'a2V5'.'X2V4aX'.'N0'.'cw=='),base64_decode('a'.'W5f'.'YX'.'JyYXk='),base64_decode('bWt0aW1'.'l'),base64_decode('ZGF'.'0'.'ZQ=='),base64_decode('ZG'.'F0Z'.'Q=='),base64_decode(''.'ZGF0ZQ=='),base64_decode('bWt0aW'.'1l'),base64_decode('ZGF0'.'ZQ=='),base64_decode('ZGF0ZQ=='),base64_decode(''.'aW5fYXJyYXk'.'='),base64_decode(''.'YXJyYXlf'.'a'.'2V5'.'X2'.'V4a'.'X'.'N'.'0c'.'w=='),base64_decode('YX'.'JyYXlfa2V5'.'X2V4a'.'X'.'N0'.'cw=='),base64_decode('c2VyaW'.'FsaXpl'),base64_decode('YmF'.'zZT'.'Y'.'0X2VuY29'.'kZQ=='),base64_decode(''.'YXJyYXl'.'fa2V5X'.'2'.'V'.'4'.'aXN0cw='.'='),base64_decode('aW'.'50'.'dmFs'),base64_decode(''.'dGl'.'t'.'ZQ=='),base64_decode('Y'.'XJyYXlfa2V5X'.'2'.'V4aXN0cw'.'=='),base64_decode(''.'ZmlsZ'.'V'.'9leGlzdHM='),base64_decode('c'.'3RyX3Jl'.'cGxh'.'Y2U'.'='),base64_decode('Y2xh'.'c3N'.'fZ'.'X'.'hpc3Rz'),base64_decode(''.'Z'.'GVmaW5l'));if(!function_exists(__NAMESPACE__.'\\___1276173038')){function ___1276173038($_1405352870){static $_1233942534= false; if($_1233942534 == false) $_1233942534=array(''.'SU5UU'.'kFORVRfRU'.'RJVE'.'lP'.'T'.'g'.'==','WQ==','b'.'W'.'Fpbg'.'='.'=','f'.'mN'.'w'.'Z'.'l9tY'.'X'.'BfdmFsd'.'W'.'U=','','ZQ='.'=','Z'.'g'.'='.'=','ZQ==',''.'R'.'g==','WA==','Zg==','bWFpbg==','fm'.'Nw'.'Z'.'l9tYXBfdmF'.'s'.'dW'.'U=','UG'.'9ydGFs',''.'Rg='.'=',''.'ZQ='.'=','Z'.'Q==','WA==',''.'Rg==','RA='.'=','RA='.'=','bQ==','Z'.'A==','WQ='.'=',''.'Z'.'g==','Zg='.'=','Zg==','Zg==','UG9ydG'.'Fs','Rg'.'==',''.'ZQ='.'=','ZQ==','WA='.'=','Rg==','R'.'A'.'==','R'.'A'.'='.'=','bQ==','Z'.'A='.'=','WQ==','b'.'WF'.'pbg==',''.'T'.'24'.'=','U2V0'.'dG'.'luZ3N'.'DaGFuZ2U=','Zg==',''.'Zg='.'=','Zg'.'==','Zg==',''.'b'.'WF'.'pbg'.'==',''.'fmN'.'wZl9tYXBfdmFsdWU=','Z'.'Q==','ZQ'.'==',''.'ZQ==','RA='.'=','Z'.'Q==','ZQ='.'=',''.'Zg==',''.'Zg==',''.'Zg='.'=','ZQ='.'=','bW'.'Fpbg'.'==','fmNw'.'Z'.'l9tYXB'.'fdm'.'FsdW'.'U'.'=','ZQ==',''.'Zg='.'=','Zg='.'=','Zg==','Zg'.'='.'=','b'.'WFpbg==','fmNwZl9tYXBf'.'dmFs'.'dWU'.'=','ZQ==',''.'Z'.'g==','UG9ydGFs','UG9ydGFs','ZQ'.'==',''.'ZQ==','UG9ydGFs','Rg==','WA==','Rg==','RA==','ZQ==',''.'ZQ==','R'.'A==','bQ='.'=','ZA='.'=','WQ==','ZQ==','WA==','ZQ==','Rg'.'==','ZQ==','RA'.'='.'=','Zg==','ZQ==','RA==','ZQ'.'==','b'.'Q==','ZA==','W'.'Q==',''.'Zg==','Zg==','Zg==','Zg==','Zg==','Zg==','Z'.'g'.'==','Zg'.'==','bWFpbg==','f'.'mNw'.'Z'.'l9tYXBf'.'d'.'mFsdWU'.'=','ZQ'.'==','ZQ==',''.'UG'.'9y'.'dG'.'Fs',''.'R'.'g==','WA'.'==',''.'VFlQRQ'.'='.'=','REFU'.'R'.'Q'.'==','RkVBVFVSRVM=','RVhQSV'.'JFRA==','V'.'F'.'lQRQ==','R'.'A'.'==','VFJZX0RB'.'W'.'VN'.'fQ09VTlQ=','RE'.'FURQ='.'=','VFJZX0RBWVN'.'fQ0'.'9VTlQ=',''.'RVh'.'QSVJFRA='.'=','RkVB'.'V'.'F'.'VSRVM=',''.'Zg==','Zg='.'=','R'.'E9D'.'VU1FT'.'lR'.'f'.'Uk9PVA==','L2'.'J'.'pdHJp'.'eC9tb'.'2R'.'1b'.'GVzLw==',''.'L2l'.'uc3Rhb'.'Gwva'.'W5kZX'.'gucGhw','Lg'.'==','Xw==',''.'c2VhcmNo','Tg'.'==','','',''.'QUN'.'USVZF','WQ='.'=','c'.'29jaWFsbmV0d29'.'yaw==',''.'YWxsb'.'3'.'df'.'ZnJ'.'pZWxkcw'.'==','WQ==',''.'SUQ=','c29ja'.'WFsbmV0d2'.'9yaw==','YW'.'xs'.'b3dfZnJ'.'pZ'.'Wxk'.'c'.'w==','SUQ=',''.'c29jaWFsbmV0d2'.'9yaw==','YWxsb'.'3df'.'ZnJpZWx'.'k'.'c'.'w==','Tg='.'=','','','QUNUSVZ'.'F','WQ'.'==','c29'.'j'.'aWFs'.'b'.'mV0d2'.'9yaw==','YW'.'xs'.'b3'.'d'.'fbWl'.'j'.'cm9ibG9nX3VzZXI=','WQ==','S'.'UQ=','c29'.'jaWF'.'sbmV0d29yaw==',''.'YW'.'xs'.'b'.'3dfbWljcm9'.'ibG9nX3VzZXI=','SUQ=','c29jaWF'.'sbm'.'V0'.'d'.'29yaw'.'==',''.'YWxs'.'b3dfbWl'.'jc'.'m9'.'ibG'.'9nX3VzZXI=','c2'.'9j'.'aW'.'Fs'.'b'.'mV0d29ya'.'w==','YW'.'xs'.'b'.'3'.'dfbW'.'lj'.'cm9'.'i'.'bG9nX'.'2dy'.'b3Vw',''.'WQ==','SU'.'Q=','c29jaWFsbmV'.'0d29yaw='.'=','YWxsb3dfbWljcm9'.'i'.'bG9nX2dyb3Vw','SUQ'.'=','c29'.'jaW'.'F'.'s'.'b'.'mV0d29ya'.'w==','YWxsb3dfb'.'Wljcm9'.'ibG9nX2'.'d'.'yb'.'3'.'Vw','T'.'g==','','','QUNUSVZ'.'F','WQ==','c29ja'.'WFsbm'.'V0d29'.'yaw==','YWx'.'sb3'.'dfZ'.'mlsZ'.'XNfdXNlcg'.'==','WQ==','SUQ=','c2'.'9'.'j'.'aWFs'.'bmV'.'0d29yaw='.'=','YWxs'.'b3'.'d'.'fZm'.'lsZX'.'NfdXNlcg==','SUQ'.'=',''.'c29j'.'aWFsbmV0d'.'29yaw==','YWxsb3dfZml'.'sZXNfdXNlcg'.'==',''.'Tg==','','','QU'.'N'.'USVZF',''.'W'.'Q='.'=','c2'.'9jaWFsbmV0d29yaw==','YWxsb3'.'dfYmxv'.'Z191'.'c2Vy',''.'WQ==','SUQ=','c29jaWFsbmV0d2'.'9yaw==','Y'.'Wxsb3dfYmx'.'vZ'.'19'.'1c2Vy',''.'SUQ=','c29jaWF'.'sb'.'mV0d'.'29yaw='.'=','YWx'.'sb3dfYmxvZ191'.'c'.'2'.'Vy','Tg='.'=','','','QUNU'.'SV'.'ZF','WQ==','c29'.'jaWFsbm'.'V0d29ya'.'w==',''.'YWx'.'sb3'.'dfcG'.'hvdG9fdXNlcg==','WQ==','SUQ=','c29jaWFsbmV0'.'d2'.'9'.'y'.'aw'.'='.'=','Y'.'Wxsb3'.'dfcGhvdG9f'.'d'.'XN'.'lc'.'g==','SUQ=','c'.'29'.'jaWFsb'.'mV0'.'d29y'.'aw'.'==',''.'Y'.'Wxsb3dfcGhvd'.'G9fdXNlcg==','T'.'g==','','','QUNUS'.'VZF','WQ==','c29ja'.'WFsbm'.'V'.'0d2'.'9y'.'aw==','Y'.'Wxs'.'b3dfZm'.'9yd'.'W1f'.'dXNlcg==','WQ==','SUQ'.'=','c'.'29jaW'.'Fsbm'.'V'.'0d29y'.'aw==',''.'YWx'.'sb3dfZm9ydW1'.'fdXN'.'lcg='.'=','SUQ=',''.'c'.'29'.'jaWF'.'sbmV'.'0d29yaw'.'==','YWxs'.'b3'.'dfZ'.'m9ydW1f'.'dXN'.'lcg==','T'.'g==','','',''.'QUNUS'.'V'.'Z'.'F','WQ='.'=','c'.'29ja'.'WFsbm'.'V0d'.'29ya'.'w==','Y'.'W'.'x'.'sb'.'3dfdGF'.'z'.'a'.'3'.'NfdXNl'.'cg'.'==','W'.'Q==','SU'.'Q=','c29jaWFs'.'bmV0'.'d29ya'.'w'.'='.'=','YWxsb'.'3dfd'.'GF'.'za3Nfd'.'XNl'.'cg==','SUQ'.'=','c29j'.'aWFsbmV0d29'.'yaw==','Y'.'Wxsb3dfdGFza3Nf'.'d'.'XNl'.'cg==',''.'c29jaWF'.'s'.'bmV0d'.'29yaw==','Y'.'Wx'.'sb3'.'dfd'.'GFza'.'3NfZ3Jv'.'dXA=','WQ==',''.'SUQ=','c2'.'9jaWFsbmV'.'0d29yaw==','Y'.'Wx'.'sb3dfdGFza3NfZ3JvdXA=','SUQ=','c29'.'jaWFsbm'.'V0d29yaw'.'==','YWxs'.'b3dfdG'.'F'.'za3NfZ3Jvd'.'XA'.'=',''.'dG'.'Fz'.'a3M'.'=','Tg==','','','QUNUSVZF','WQ==','c2'.'9jaWFsbmV'.'0d29yaw==','YW'.'xs'.'b3df'.'Y2Fs'.'ZW5kYX'.'JfdXN'.'lcg'.'==','WQ==','SUQ=','c29jaW'.'FsbmV'.'0d2'.'9yaw='.'=',''.'YW'.'xsb3'.'d'.'fY2FsZW5'.'kY'.'XJ'.'fdXNl'.'cg==','SUQ=','c'.'29jaW'.'FsbmV0d29'.'yaw==','YWxsb3df'.'Y2'.'FsZ'.'W5k'.'YX'.'JfdXNlcg='.'=',''.'c'.'29'.'jaWFsbmV'.'0d29'.'y'.'aw==','Y'.'Wxsb3'.'dfY'.'2FsZW5kYXJfZ3Jvd'.'XA=','W'.'Q==',''.'SUQ=','c'.'29jaWFsbmV0d29yaw='.'=',''.'YWxsb'.'3dfY'.'2'.'FsZW5'.'kYXJfZ3'.'JvdX'.'A'.'=',''.'SUQ=','c29jaWFsbmV0d2'.'9yaw='.'=','YWxsb3d'.'fY2FsZW5'.'kYXJfZ3'.'J'.'v'.'dXA=','QU'.'N'.'USV'.'ZF',''.'WQ==',''.'Tg==','ZXh0cmFu'.'ZXQ=','aWJsb'.'2'.'Nr','T25BZnRlc'.'k'.'lC'.'bG9ja0VsZW1l'.'bnR'.'VcG'.'RhdG'.'U=',''.'aW50cm'.'F'.'u'.'Z'.'XQ=','Q'.'0ludHJhbm'.'V'.'0RXZlbnRIYW'.'5kbGV'.'yc'.'w==','U1BS'.'Z'.'Wdpc3'.'RlclVwZGF0Z'.'WRJd'.'GVt','Q0lu'.'dHJ'.'h'.'bmV0U2hh'.'cm'.'Vwb2'.'lu'.'dD'.'o6'.'QW'.'dlbnRM'.'a'.'X'.'N0'.'cygp'.'O'.'w==','aW50cmFu'.'ZXQ'.'=',''.'Tg==','Q'.'0lud'.'H'.'J'.'hbmV'.'0'.'U2'.'hhc'.'m'.'V'.'wb2l'.'udDo6QWd'.'lb'.'n'.'RRd'.'WV'.'1ZS'.'gpOw==','aW'.'50cmFuZX'.'Q=','Tg==','Q0ludH'.'Jhb'.'m'.'V0U2hhc'.'m'.'V'.'wb2ludD'.'o6QWdl'.'b'.'nR'.'VcGRhdG'.'UoKT'.'s=','aW50cmFuZXQ'.'=','T'.'g==','aWJ'.'sb2Nr','T'.'25BZnRlcklCb'.'G9ja'.'0'.'VsZ'.'W1lbnR'.'BZG'.'Q=','aW50cmFuZXQ=',''.'Q0ludHJ'.'hbmV0RX'.'ZlbnR'.'IYW5kbGVycw==','U1BS'.'ZWdp'.'c3RlclVwZ'.'GF0ZWRJd'.'GV'.'t','aW'.'Jsb2Nr','T25BZnRlc'.'klCbG9ja0VsZ'.'W1'.'l'.'bnRVcGRhdGU=','aW50cm'.'F'.'uZXQ=',''.'Q0ludH'.'Jh'.'bmV0'.'R'.'XZlbnRIYW5k'.'bG'.'Vyc'.'w==',''.'U1'.'BSZW'.'dpc3Rlc'.'lVwZG'.'F0'.'ZWRJdGVt','Q0'.'ludHJhbm'.'V'.'0U2'.'hhc'.'mVwb2ludDo6QWdlbnRMaXN0cygp'.'Ow==','aW50'.'cm'.'FuZXQ'.'=','Q'.'0ludH'.'JhbmV0U2hhc'.'mVw'.'b2ludDo6'.'Q'.'Wdl'.'bnRRdWV1ZSg'.'p'.'Ow==','aW50c'.'mFuZ'.'XQ=','Q0ludH'.'JhbmV0U2hhcmVwb'.'2'.'ludDo'.'6'.'Q'.'WdlbnRVcGRhd'.'GUoK'.'Ts=','aW'.'50cm'.'FuZX'.'Q=','Y3Jt','bW'.'Fp'.'bg==','T2'.'5CZWZvcmVQcm9sb2'.'c=','bWFpb'.'g==',''.'Q1dp'.'em'.'Fy'.'ZFNvbFB'.'hb'.'mVsSW50c'.'m'.'FuZ'.'X'.'Q=','U2hv'.'d1BhbmVs','L'.'21vZ'.'HVs'.'ZXMvaW5'.'0cm'.'Fu'.'Z'.'X'.'Q'.'vcGFuZWxfYnV0d'.'G9uLnBocA==','RU5D'.'T0'.'RF','W'.'Q'.'==');return base64_decode($_1233942534[$_1405352870]);}};$GLOBALS['____1231947610'][0](___1276173038(0), ___1276173038(1));class CBXFeatures{ private static $_248010= 30; private static $_1268807002= array( "Portal" => array( "CompanyCalendar", "CompanyPhoto", "CompanyVideo", "CompanyCareer", "StaffChanges", "StaffAbsence", "CommonDocuments", "MeetingRoomBookingSystem", "Wiki", "Learning", "Vote", "WebLink", "Subscribe", "Friends", "PersonalFiles", "PersonalBlog", "PersonalPhoto", "PersonalForum", "Blog", "Forum", "Gallery", "Board", "MicroBlog", "WebMessenger",), "Communications" => array( "Tasks", "Calendar", "Workgroups", "Jabber", "VideoConference", "Extranet", "SMTP", "Requests", "DAV", "intranet_sharepoint", "timeman", "Idea", "Meeting", "EventList", "Salary", "XDImport",), "Enterprise" => array( "BizProc", "Lists", "Support", "Analytics", "crm", "Controller", "LdapUnlimitedUsers",), "Holding" => array( "Cluster", "MultiSites",),); private static $_616437084= false; private static $_1307465624= false; private static function __383887784(){ if(self::$_616437084 == false){ self::$_616437084= array(); foreach(self::$_1268807002 as $_548032003 => $_1482853896){ foreach($_1482853896 as $_350108750) self::$_616437084[$_350108750]= $_548032003;}} if(self::$_1307465624 == false){ self::$_1307465624= array(); $_594270660= COption::GetOptionString(___1276173038(2), ___1276173038(3), ___1276173038(4)); if($GLOBALS['____1231947610'][1]($_594270660)>(970-2*485)){ $_594270660= $GLOBALS['____1231947610'][2]($_594270660); self::$_1307465624= $GLOBALS['____1231947610'][3]($_594270660); if(!$GLOBALS['____1231947610'][4](self::$_1307465624)) self::$_1307465624= array();} if($GLOBALS['____1231947610'][5](self::$_1307465624) <= min(2,0,0.66666666666667)) self::$_1307465624= array(___1276173038(5) => array(), ___1276173038(6) => array());}} public static function InitiateEditionsSettings($_1968931126){ self::__383887784(); $_1396693419= array(); foreach(self::$_1268807002 as $_548032003 => $_1482853896){ $_1940077427= $GLOBALS['____1231947610'][6]($_548032003, $_1968931126); self::$_1307465624[___1276173038(7)][$_548032003]=($_1940077427? array(___1276173038(8)): array(___1276173038(9))); foreach($_1482853896 as $_350108750){ self::$_1307465624[___1276173038(10)][$_350108750]= $_1940077427; if(!$_1940077427) $_1396693419[]= array($_350108750, false);}} $_38820938= $GLOBALS['____1231947610'][7](self::$_1307465624); $_38820938= $GLOBALS['____1231947610'][8]($_38820938); COption::SetOptionString(___1276173038(11), ___1276173038(12), $_38820938); foreach($_1396693419 as $_1179577047) self::__1975584126($_1179577047[(1500/2-750)], $_1179577047[round(0+1)]);} public static function IsFeatureEnabled($_350108750){ if($GLOBALS['____1231947610'][9]($_350108750) <= 0) return true; self::__383887784(); if(!$GLOBALS['____1231947610'][10]($_350108750, self::$_616437084)) return true; if(self::$_616437084[$_350108750] == ___1276173038(13)) $_919707253= array(___1276173038(14)); elseif($GLOBALS['____1231947610'][11](self::$_616437084[$_350108750], self::$_1307465624[___1276173038(15)])) $_919707253= self::$_1307465624[___1276173038(16)][self::$_616437084[$_350108750]]; else $_919707253= array(___1276173038(17)); if($_919707253[(934-2*467)] != ___1276173038(18) && $_919707253[(1072/2-536)] != ___1276173038(19)){ return false;} elseif($_919707253[(1364/2-682)] == ___1276173038(20)){ if($_919707253[round(0+0.33333333333333+0.33333333333333+0.33333333333333)]< $GLOBALS['____1231947610'][12](min(28,0,9.3333333333333),(1268/2-634),(1052/2-526), Date(___1276173038(21)), $GLOBALS['____1231947610'][13](___1276173038(22))- self::$_248010, $GLOBALS['____1231947610'][14](___1276173038(23)))){ if(!isset($_919707253[round(0+0.4+0.4+0.4+0.4+0.4)]) ||!$_919707253[round(0+0.5+0.5+0.5+0.5)]) self::__1101517726(self::$_616437084[$_350108750]); return false;}} return!$GLOBALS['____1231947610'][15]($_350108750, self::$_1307465624[___1276173038(24)]) || self::$_1307465624[___1276173038(25)][$_350108750];} public static function IsFeatureInstalled($_350108750){ if($GLOBALS['____1231947610'][16]($_350108750) <= 0) return true; self::__383887784(); return($GLOBALS['____1231947610'][17]($_350108750, self::$_1307465624[___1276173038(26)]) && self::$_1307465624[___1276173038(27)][$_350108750]);} public static function IsFeatureEditable($_350108750){ if($GLOBALS['____1231947610'][18]($_350108750) <= 0) return true; self::__383887784(); if(!$GLOBALS['____1231947610'][19]($_350108750, self::$_616437084)) return true; if(self::$_616437084[$_350108750] == ___1276173038(28)) $_919707253= array(___1276173038(29)); elseif($GLOBALS['____1231947610'][20](self::$_616437084[$_350108750], self::$_1307465624[___1276173038(30)])) $_919707253= self::$_1307465624[___1276173038(31)][self::$_616437084[$_350108750]]; else $_919707253= array(___1276173038(32)); if($_919707253[(138*2-276)] != ___1276173038(33) && $_919707253[(1200/2-600)] != ___1276173038(34)){ return false;} elseif($_919707253[min(172,0,57.333333333333)] == ___1276173038(35)){ if($_919707253[round(0+0.5+0.5)]< $GLOBALS['____1231947610'][21]((188*2-376),(175*2-350),(820-2*410), Date(___1276173038(36)), $GLOBALS['____1231947610'][22](___1276173038(37))- self::$_248010, $GLOBALS['____1231947610'][23](___1276173038(38)))){ if(!isset($_919707253[round(0+0.4+0.4+0.4+0.4+0.4)]) ||!$_919707253[round(0+0.5+0.5+0.5+0.5)]) self::__1101517726(self::$_616437084[$_350108750]); return false;}} return true;} private static function __1975584126($_350108750, $_1015150102){ if($GLOBALS['____1231947610'][24]("CBXFeatures", "On".$_350108750."SettingsChange")) $GLOBALS['____1231947610'][25](array("CBXFeatures", "On".$_350108750."SettingsChange"), array($_350108750, $_1015150102)); $_433013838= $GLOBALS['_____1364112567'][0](___1276173038(39), ___1276173038(40).$_350108750.___1276173038(41)); while($_862092860= $_433013838->Fetch()) $GLOBALS['_____1364112567'][1]($_862092860, array($_350108750, $_1015150102));} public static function SetFeatureEnabled($_350108750, $_1015150102= true, $_360768813= true){ if($GLOBALS['____1231947610'][26]($_350108750) <= 0) return; if(!self::IsFeatureEditable($_350108750)) $_1015150102= false; $_1015150102=($_1015150102? true: false); self::__383887784(); $_1024141950=(!$GLOBALS['____1231947610'][27]($_350108750, self::$_1307465624[___1276173038(42)]) && $_1015150102 || $GLOBALS['____1231947610'][28]($_350108750, self::$_1307465624[___1276173038(43)]) && $_1015150102 != self::$_1307465624[___1276173038(44)][$_350108750]); self::$_1307465624[___1276173038(45)][$_350108750]= $_1015150102; $_38820938= $GLOBALS['____1231947610'][29](self::$_1307465624); $_38820938= $GLOBALS['____1231947610'][30]($_38820938); COption::SetOptionString(___1276173038(46), ___1276173038(47), $_38820938); if($_1024141950 && $_360768813) self::__1975584126($_350108750, $_1015150102);} private static function __1101517726($_548032003){ if($GLOBALS['____1231947610'][31]($_548032003) <= 0 || $_548032003 == "Portal") return; self::__383887784(); if(!$GLOBALS['____1231947610'][32]($_548032003, self::$_1307465624[___1276173038(48)]) || $GLOBALS['____1231947610'][33]($_548032003, self::$_1307465624[___1276173038(49)]) && self::$_1307465624[___1276173038(50)][$_548032003][(1296/2-648)] != ___1276173038(51)) return; if(isset(self::$_1307465624[___1276173038(52)][$_548032003][round(0+2)]) && self::$_1307465624[___1276173038(53)][$_548032003][round(0+1+1)]) return; $_1396693419= array(); if($GLOBALS['____1231947610'][34]($_548032003, self::$_1268807002) && $GLOBALS['____1231947610'][35](self::$_1268807002[$_548032003])){ foreach(self::$_1268807002[$_548032003] as $_350108750){ if($GLOBALS['____1231947610'][36]($_350108750, self::$_1307465624[___1276173038(54)]) && self::$_1307465624[___1276173038(55)][$_350108750]){ self::$_1307465624[___1276173038(56)][$_350108750]= false; $_1396693419[]= array($_350108750, false);}} self::$_1307465624[___1276173038(57)][$_548032003][round(0+2)]= true;} $_38820938= $GLOBALS['____1231947610'][37](self::$_1307465624); $_38820938= $GLOBALS['____1231947610'][38]($_38820938); COption::SetOptionString(___1276173038(58), ___1276173038(59), $_38820938); foreach($_1396693419 as $_1179577047) self::__1975584126($_1179577047[min(166,0,55.333333333333)], $_1179577047[round(0+0.2+0.2+0.2+0.2+0.2)]);} public static function ModifyFeaturesSettings($_1968931126, $_1482853896){ self::__383887784(); foreach($_1968931126 as $_548032003 => $_307656027) self::$_1307465624[___1276173038(60)][$_548032003]= $_307656027; $_1396693419= array(); foreach($_1482853896 as $_350108750 => $_1015150102){ if(!$GLOBALS['____1231947610'][39]($_350108750, self::$_1307465624[___1276173038(61)]) && $_1015150102 || $GLOBALS['____1231947610'][40]($_350108750, self::$_1307465624[___1276173038(62)]) && $_1015150102 != self::$_1307465624[___1276173038(63)][$_350108750]) $_1396693419[]= array($_350108750, $_1015150102); self::$_1307465624[___1276173038(64)][$_350108750]= $_1015150102;} $_38820938= $GLOBALS['____1231947610'][41](self::$_1307465624); $_38820938= $GLOBALS['____1231947610'][42]($_38820938); COption::SetOptionString(___1276173038(65), ___1276173038(66), $_38820938); self::$_1307465624= false; foreach($_1396693419 as $_1179577047) self::__1975584126($_1179577047[(1184/2-592)], $_1179577047[round(0+0.33333333333333+0.33333333333333+0.33333333333333)]);} public static function SaveFeaturesSettings($_1593531344, $_1802391153){ self::__383887784(); $_447462443= array(___1276173038(67) => array(), ___1276173038(68) => array()); if(!$GLOBALS['____1231947610'][43]($_1593531344)) $_1593531344= array(); if(!$GLOBALS['____1231947610'][44]($_1802391153)) $_1802391153= array(); if(!$GLOBALS['____1231947610'][45](___1276173038(69), $_1593531344)) $_1593531344[]= ___1276173038(70); foreach(self::$_1268807002 as $_548032003 => $_1482853896){ if($GLOBALS['____1231947610'][46]($_548032003, self::$_1307465624[___1276173038(71)])) $_1203633087= self::$_1307465624[___1276173038(72)][$_548032003]; else $_1203633087=($_548032003 == ___1276173038(73))? array(___1276173038(74)): array(___1276173038(75)); if($_1203633087[(1224/2-612)] == ___1276173038(76) || $_1203633087[(1464/2-732)] == ___1276173038(77)){ $_447462443[___1276173038(78)][$_548032003]= $_1203633087;} else{ if($GLOBALS['____1231947610'][47]($_548032003, $_1593531344)) $_447462443[___1276173038(79)][$_548032003]= array(___1276173038(80), $GLOBALS['____1231947610'][48]((180*2-360),(906-2*453),(774-2*387), $GLOBALS['____1231947610'][49](___1276173038(81)), $GLOBALS['____1231947610'][50](___1276173038(82)), $GLOBALS['____1231947610'][51](___1276173038(83)))); else $_447462443[___1276173038(84)][$_548032003]= array(___1276173038(85));}} $_1396693419= array(); foreach(self::$_616437084 as $_350108750 => $_548032003){ if($_447462443[___1276173038(86)][$_548032003][min(56,0,18.666666666667)] != ___1276173038(87) && $_447462443[___1276173038(88)][$_548032003][(155*2-310)] != ___1276173038(89)){ $_447462443[___1276173038(90)][$_350108750]= false;} else{ if($_447462443[___1276173038(91)][$_548032003][(157*2-314)] == ___1276173038(92) && $_447462443[___1276173038(93)][$_548032003][round(0+1)]< $GLOBALS['____1231947610'][52]((932-2*466),(816-2*408),(215*2-430), Date(___1276173038(94)), $GLOBALS['____1231947610'][53](___1276173038(95))- self::$_248010, $GLOBALS['____1231947610'][54](___1276173038(96)))) $_447462443[___1276173038(97)][$_350108750]= false; else $_447462443[___1276173038(98)][$_350108750]= $GLOBALS['____1231947610'][55]($_350108750, $_1802391153); if(!$GLOBALS['____1231947610'][56]($_350108750, self::$_1307465624[___1276173038(99)]) && $_447462443[___1276173038(100)][$_350108750] || $GLOBALS['____1231947610'][57]($_350108750, self::$_1307465624[___1276173038(101)]) && $_447462443[___1276173038(102)][$_350108750] != self::$_1307465624[___1276173038(103)][$_350108750]) $_1396693419[]= array($_350108750, $_447462443[___1276173038(104)][$_350108750]);}} $_38820938= $GLOBALS['____1231947610'][58]($_447462443); $_38820938= $GLOBALS['____1231947610'][59]($_38820938); COption::SetOptionString(___1276173038(105), ___1276173038(106), $_38820938); self::$_1307465624= false; foreach($_1396693419 as $_1179577047) self::__1975584126($_1179577047[(846-2*423)], $_1179577047[round(0+0.2+0.2+0.2+0.2+0.2)]);} public static function GetFeaturesList(){ self::__383887784(); $_1091307025= array(); foreach(self::$_1268807002 as $_548032003 => $_1482853896){ if($GLOBALS['____1231947610'][60]($_548032003, self::$_1307465624[___1276173038(107)])) $_1203633087= self::$_1307465624[___1276173038(108)][$_548032003]; else $_1203633087=($_548032003 == ___1276173038(109))? array(___1276173038(110)): array(___1276173038(111)); $_1091307025[$_548032003]= array( ___1276173038(112) => $_1203633087[min(106,0,35.333333333333)], ___1276173038(113) => $_1203633087[round(0+0.25+0.25+0.25+0.25)], ___1276173038(114) => array(),); $_1091307025[$_548032003][___1276173038(115)]= false; if($_1091307025[$_548032003][___1276173038(116)] == ___1276173038(117)){ $_1091307025[$_548032003][___1276173038(118)]= $GLOBALS['____1231947610'][61](($GLOBALS['____1231947610'][62]()- $_1091307025[$_548032003][___1276173038(119)])/ round(0+28800+28800+28800)); if($_1091307025[$_548032003][___1276173038(120)]> self::$_248010) $_1091307025[$_548032003][___1276173038(121)]= true;} foreach($_1482853896 as $_350108750) $_1091307025[$_548032003][___1276173038(122)][$_350108750]=(!$GLOBALS['____1231947610'][63]($_350108750, self::$_1307465624[___1276173038(123)]) || self::$_1307465624[___1276173038(124)][$_350108750]);} return $_1091307025;} private static function __1260819063($_646768801, $_693680971){ if(IsModuleInstalled($_646768801) == $_693680971) return true; $_2125681042= $_SERVER[___1276173038(125)].___1276173038(126).$_646768801.___1276173038(127); if(!$GLOBALS['____1231947610'][64]($_2125681042)) return false; include_once($_2125681042); $_1576304489= $GLOBALS['____1231947610'][65](___1276173038(128), ___1276173038(129), $_646768801); if(!$GLOBALS['____1231947610'][66]($_1576304489)) return false; $_611209992= new $_1576304489; if($_693680971){ if(!$_611209992->InstallDB()) return false; $_611209992->InstallEvents(); if(!$_611209992->InstallFiles()) return false;} else{ if(CModule::IncludeModule(___1276173038(130))) CSearch::DeleteIndex($_646768801); UnRegisterModule($_646768801);} return true;} protected static function OnRequestsSettingsChange($_350108750, $_1015150102){ self::__1260819063("form", $_1015150102);} protected static function OnLearningSettingsChange($_350108750, $_1015150102){ self::__1260819063("learning", $_1015150102);} protected static function OnJabberSettingsChange($_350108750, $_1015150102){ self::__1260819063("xmpp", $_1015150102);} protected static function OnVideoConferenceSettingsChange($_350108750, $_1015150102){ self::__1260819063("video", $_1015150102);} protected static function OnBizProcSettingsChange($_350108750, $_1015150102){ self::__1260819063("bizprocdesigner", $_1015150102);} protected static function OnListsSettingsChange($_350108750, $_1015150102){ self::__1260819063("lists", $_1015150102);} protected static function OnWikiSettingsChange($_350108750, $_1015150102){ self::__1260819063("wiki", $_1015150102);} protected static function OnSupportSettingsChange($_350108750, $_1015150102){ self::__1260819063("support", $_1015150102);} protected static function OnControllerSettingsChange($_350108750, $_1015150102){ self::__1260819063("controller", $_1015150102);} protected static function OnAnalyticsSettingsChange($_350108750, $_1015150102){ self::__1260819063("statistic", $_1015150102);} protected static function OnVoteSettingsChange($_350108750, $_1015150102){ self::__1260819063("vote", $_1015150102);} protected static function OnFriendsSettingsChange($_350108750, $_1015150102){ if($_1015150102) $_844359856= "Y"; else $_844359856= ___1276173038(131); $_190476847= CSite::GetList(($_1940077427= ___1276173038(132)),($_959830006= ___1276173038(133)), array(___1276173038(134) => ___1276173038(135))); while($_1088915114= $_190476847->Fetch()){ if(COption::GetOptionString(___1276173038(136), ___1276173038(137), ___1276173038(138), $_1088915114[___1276173038(139)]) != $_844359856){ COption::SetOptionString(___1276173038(140), ___1276173038(141), $_844359856, false, $_1088915114[___1276173038(142)]); COption::SetOptionString(___1276173038(143), ___1276173038(144), $_844359856);}}} protected static function OnMicroBlogSettingsChange($_350108750, $_1015150102){ if($_1015150102) $_844359856= "Y"; else $_844359856= ___1276173038(145); $_190476847= CSite::GetList(($_1940077427= ___1276173038(146)),($_959830006= ___1276173038(147)), array(___1276173038(148) => ___1276173038(149))); while($_1088915114= $_190476847->Fetch()){ if(COption::GetOptionString(___1276173038(150), ___1276173038(151), ___1276173038(152), $_1088915114[___1276173038(153)]) != $_844359856){ COption::SetOptionString(___1276173038(154), ___1276173038(155), $_844359856, false, $_1088915114[___1276173038(156)]); COption::SetOptionString(___1276173038(157), ___1276173038(158), $_844359856);} if(COption::GetOptionString(___1276173038(159), ___1276173038(160), ___1276173038(161), $_1088915114[___1276173038(162)]) != $_844359856){ COption::SetOptionString(___1276173038(163), ___1276173038(164), $_844359856, false, $_1088915114[___1276173038(165)]); COption::SetOptionString(___1276173038(166), ___1276173038(167), $_844359856);}}} protected static function OnPersonalFilesSettingsChange($_350108750, $_1015150102){ if($_1015150102) $_844359856= "Y"; else $_844359856= ___1276173038(168); $_190476847= CSite::GetList(($_1940077427= ___1276173038(169)),($_959830006= ___1276173038(170)), array(___1276173038(171) => ___1276173038(172))); while($_1088915114= $_190476847->Fetch()){ if(COption::GetOptionString(___1276173038(173), ___1276173038(174), ___1276173038(175), $_1088915114[___1276173038(176)]) != $_844359856){ COption::SetOptionString(___1276173038(177), ___1276173038(178), $_844359856, false, $_1088915114[___1276173038(179)]); COption::SetOptionString(___1276173038(180), ___1276173038(181), $_844359856);}}} protected static function OnPersonalBlogSettingsChange($_350108750, $_1015150102){ if($_1015150102) $_844359856= "Y"; else $_844359856= ___1276173038(182); $_190476847= CSite::GetList(($_1940077427= ___1276173038(183)),($_959830006= ___1276173038(184)), array(___1276173038(185) => ___1276173038(186))); while($_1088915114= $_190476847->Fetch()){ if(COption::GetOptionString(___1276173038(187), ___1276173038(188), ___1276173038(189), $_1088915114[___1276173038(190)]) != $_844359856){ COption::SetOptionString(___1276173038(191), ___1276173038(192), $_844359856, false, $_1088915114[___1276173038(193)]); COption::SetOptionString(___1276173038(194), ___1276173038(195), $_844359856);}}} protected static function OnPersonalPhotoSettingsChange($_350108750, $_1015150102){ if($_1015150102) $_844359856= "Y"; else $_844359856= ___1276173038(196); $_190476847= CSite::GetList(($_1940077427= ___1276173038(197)),($_959830006= ___1276173038(198)), array(___1276173038(199) => ___1276173038(200))); while($_1088915114= $_190476847->Fetch()){ if(COption::GetOptionString(___1276173038(201), ___1276173038(202), ___1276173038(203), $_1088915114[___1276173038(204)]) != $_844359856){ COption::SetOptionString(___1276173038(205), ___1276173038(206), $_844359856, false, $_1088915114[___1276173038(207)]); COption::SetOptionString(___1276173038(208), ___1276173038(209), $_844359856);}}} protected static function OnPersonalForumSettingsChange($_350108750, $_1015150102){ if($_1015150102) $_844359856= "Y"; else $_844359856= ___1276173038(210); $_190476847= CSite::GetList(($_1940077427= ___1276173038(211)),($_959830006= ___1276173038(212)), array(___1276173038(213) => ___1276173038(214))); while($_1088915114= $_190476847->Fetch()){ if(COption::GetOptionString(___1276173038(215), ___1276173038(216), ___1276173038(217), $_1088915114[___1276173038(218)]) != $_844359856){ COption::SetOptionString(___1276173038(219), ___1276173038(220), $_844359856, false, $_1088915114[___1276173038(221)]); COption::SetOptionString(___1276173038(222), ___1276173038(223), $_844359856);}}} protected static function OnTasksSettingsChange($_350108750, $_1015150102){ if($_1015150102) $_844359856= "Y"; else $_844359856= ___1276173038(224); $_190476847= CSite::GetList(($_1940077427= ___1276173038(225)),($_959830006= ___1276173038(226)), array(___1276173038(227) => ___1276173038(228))); while($_1088915114= $_190476847->Fetch()){ if(COption::GetOptionString(___1276173038(229), ___1276173038(230), ___1276173038(231), $_1088915114[___1276173038(232)]) != $_844359856){ COption::SetOptionString(___1276173038(233), ___1276173038(234), $_844359856, false, $_1088915114[___1276173038(235)]); COption::SetOptionString(___1276173038(236), ___1276173038(237), $_844359856);} if(COption::GetOptionString(___1276173038(238), ___1276173038(239), ___1276173038(240), $_1088915114[___1276173038(241)]) != $_844359856){ COption::SetOptionString(___1276173038(242), ___1276173038(243), $_844359856, false, $_1088915114[___1276173038(244)]); COption::SetOptionString(___1276173038(245), ___1276173038(246), $_844359856);}} self::__1260819063(___1276173038(247), $_1015150102);} protected static function OnCalendarSettingsChange($_350108750, $_1015150102){ if($_1015150102) $_844359856= "Y"; else $_844359856= ___1276173038(248); $_190476847= CSite::GetList(($_1940077427= ___1276173038(249)),($_959830006= ___1276173038(250)), array(___1276173038(251) => ___1276173038(252))); while($_1088915114= $_190476847->Fetch()){ if(COption::GetOptionString(___1276173038(253), ___1276173038(254), ___1276173038(255), $_1088915114[___1276173038(256)]) != $_844359856){ COption::SetOptionString(___1276173038(257), ___1276173038(258), $_844359856, false, $_1088915114[___1276173038(259)]); COption::SetOptionString(___1276173038(260), ___1276173038(261), $_844359856);} if(COption::GetOptionString(___1276173038(262), ___1276173038(263), ___1276173038(264), $_1088915114[___1276173038(265)]) != $_844359856){ COption::SetOptionString(___1276173038(266), ___1276173038(267), $_844359856, false, $_1088915114[___1276173038(268)]); COption::SetOptionString(___1276173038(269), ___1276173038(270), $_844359856);}}} protected static function OnSMTPSettingsChange($_350108750, $_1015150102){ self::__1260819063("mail", $_1015150102);} protected static function OnExtranetSettingsChange($_350108750, $_1015150102){ $_2053933266= COption::GetOptionString("extranet", "extranet_site", ""); if($_2053933266){ $_99405234= new CSite; $_99405234->Update($_2053933266, array(___1276173038(271) =>($_1015150102? ___1276173038(272): ___1276173038(273))));} self::__1260819063(___1276173038(274), $_1015150102);} protected static function OnDAVSettingsChange($_350108750, $_1015150102){ self::__1260819063("dav", $_1015150102);} protected static function OntimemanSettingsChange($_350108750, $_1015150102){ self::__1260819063("timeman", $_1015150102);} protected static function Onintranet_sharepointSettingsChange($_350108750, $_1015150102){ if($_1015150102){ RegisterModuleDependences("iblock", "OnAfterIBlockElementAdd", "intranet", "CIntranetEventHandlers", "SPRegisterUpdatedItem"); RegisterModuleDependences(___1276173038(275), ___1276173038(276), ___1276173038(277), ___1276173038(278), ___1276173038(279)); CAgent::AddAgent(___1276173038(280), ___1276173038(281), ___1276173038(282), round(0+500)); CAgent::AddAgent(___1276173038(283), ___1276173038(284), ___1276173038(285), round(0+150+150)); CAgent::AddAgent(___1276173038(286), ___1276173038(287), ___1276173038(288), round(0+1800+1800));} else{ UnRegisterModuleDependences(___1276173038(289), ___1276173038(290), ___1276173038(291), ___1276173038(292), ___1276173038(293)); UnRegisterModuleDependences(___1276173038(294), ___1276173038(295), ___1276173038(296), ___1276173038(297), ___1276173038(298)); CAgent::RemoveAgent(___1276173038(299), ___1276173038(300)); CAgent::RemoveAgent(___1276173038(301), ___1276173038(302)); CAgent::RemoveAgent(___1276173038(303), ___1276173038(304));}} protected static function OncrmSettingsChange($_350108750, $_1015150102){ if($_1015150102) COption::SetOptionString("crm", "form_features", "Y"); self::__1260819063(___1276173038(305), $_1015150102);} protected static function OnClusterSettingsChange($_350108750, $_1015150102){ self::__1260819063("cluster", $_1015150102);} protected static function OnMultiSitesSettingsChange($_350108750, $_1015150102){ if($_1015150102) RegisterModuleDependences("main", "OnBeforeProlog", "main", "CWizardSolPanelIntranet", "ShowPanel", 100, "/modules/intranet/panel_button.php"); else UnRegisterModuleDependences(___1276173038(306), ___1276173038(307), ___1276173038(308), ___1276173038(309), ___1276173038(310), ___1276173038(311));} protected static function OnIdeaSettingsChange($_350108750, $_1015150102){ self::__1260819063("idea", $_1015150102);} protected static function OnMeetingSettingsChange($_350108750, $_1015150102){ self::__1260819063("meeting", $_1015150102);} protected static function OnXDImportSettingsChange($_350108750, $_1015150102){ self::__1260819063("xdimport", $_1015150102);}} $GLOBALS['____1231947610'][67](___1276173038(312), ___1276173038(313));/**/			//Do not remove this

//component 2.0 template engines
$GLOBALS["arCustomTemplateEngines"] = [];

require_once(__DIR__."/autoload.php");
require_once(__DIR__."/classes/general/menu.php");
require_once(__DIR__."/classes/mysql/usertype.php");

if(file_exists(($_fname = __DIR__."/classes/general/update_db_updater.php")))
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

if((!(defined("STATISTIC_ONLY") && STATISTIC_ONLY && mb_substr($GLOBALS["APPLICATION"]->GetCurPage(), 0, mb_strlen(BX_ROOT."/admin/")) != BX_ROOT."/admin/")) && COption::GetOptionString("main", "include_charset", "Y")=="Y" && LANG_CHARSET <> '')
	header("Content-Type: text/html; charset=".LANG_CHARSET);

if(COption::GetOptionString("main", "set_p3p_header", "Y")=="Y")
	header("P3P: policyref=\"/bitrix/p3p.xml\", CP=\"NON DSP COR CUR ADM DEV PSA PSD OUR UNR BUS UNI COM NAV INT DEM STA\"");

header("X-Powered-CMS: Bitrix Site Manager (".(LICENSE_KEY == "DEMO"? "DEMO" : md5("BITRIX".LICENSE_KEY."LICENCE")).")");
if (COption::GetOptionString("main", "update_devsrv", "") == "Y")
	header("X-DevSrv-CMS: Bitrix");

define("BX_CRONTAB_SUPPORT", defined("BX_CRONTAB"));

//agents
if(COption::GetOptionString("main", "check_agents", "Y") == "Y")
{
	$application->addBackgroundJob(["CAgent", "CheckAgents"], [], \Bitrix\Main\Application::JOB_PRIORITY_LOW);
}

//send email events
if(COption::GetOptionString("main", "check_events", "Y") !== "N")
{
	$application->addBackgroundJob(['\Bitrix\Main\Mail\EventManager', 'checkEvents'], [], \Bitrix\Main\Application::JOB_PRIORITY_LOW-1);
}

$healerOfEarlySessionStart = new HealerEarlySessionStart();
$healerOfEarlySessionStart->process($application->getKernelSession());

$kernelSession = $application->getKernelSession();
$kernelSession->start();
$application->getSessionLocalStorageManager()->setUniqueId($kernelSession->getId());

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
		$kernelSession['SESS_IP']
		&& $arPolicy["SESSION_IP_MASK"] <> ''
		&& (
			(ip2long($arPolicy["SESSION_IP_MASK"]) & ip2long($kernelSession['SESS_IP']))
			!=
			(ip2long($arPolicy["SESSION_IP_MASK"]) & ip2long($_SERVER['REMOTE_ADDR']))
		)
	)
	||
	(
		//session timeout
		$arPolicy["SESSION_TIMEOUT"]>0
		&& $kernelSession['SESS_TIME']>0
		&& $currTime-$arPolicy["SESSION_TIMEOUT"]*60 > $kernelSession['SESS_TIME']
	)
	||
	(
		//signed session
		isset($kernelSession["BX_SESSION_SIGN"])
		&& $kernelSession["BX_SESSION_SIGN"] <> bitrix_sess_sign()
	)
	||
	(
		//session manually expired, e.g. in $User->LoginHitByHash
		isSessionExpired()
	)
)
{
	$compositeSessionManager = $application->getCompositeSessionManager();
	$compositeSessionManager->destroy();

	$application->getSession()->setId(md5(uniqid(rand(), true)));
	$compositeSessionManager->start();

	$GLOBALS["USER"] = new CUser;
}
$kernelSession['SESS_IP'] = $_SERVER['REMOTE_ADDR'];
if (empty($kernelSession['SESS_TIME']))
{
	$kernelSession['SESS_TIME'] = $currTime;
}
elseif (($currTime - $kernelSession['SESS_TIME']) > 60)
{
	$kernelSession['SESS_TIME'] = $currTime;
}
if(!isset($kernelSession["BX_SESSION_SIGN"]))
	$kernelSession["BX_SESSION_SIGN"] = bitrix_sess_sign();

//session control from security module
if(
	(COption::GetOptionString("main", "use_session_id_ttl", "N") == "Y")
	&& (COption::GetOptionInt("main", "session_id_ttl", 0) > 0)
	&& !defined("BX_SESSION_ID_CHANGE")
)
{
	if(!isset($kernelSession['SESS_ID_TIME']))
	{
		$kernelSession['SESS_ID_TIME'] = $currTime;
	}
	elseif(($kernelSession['SESS_ID_TIME'] + COption::GetOptionInt("main", "session_id_ttl")) < $kernelSession['SESS_TIME'])
	{
		$compositeSessionManager = $application->getCompositeSessionManager();
		$compositeSessionManager->regenerateId();

		$kernelSession['SESS_ID_TIME'] = $currTime;
	}
}

define("BX_STARTED", true);

if (isset($kernelSession['BX_ADMIN_LOAD_AUTH']))
{
	define('ADMIN_SECTION_LOAD_AUTH', 1);
	unset($kernelSession['BX_ADMIN_LOAD_AUTH']);
}

if(!defined("NOT_CHECK_PERMISSIONS") || NOT_CHECK_PERMISSIONS!==true)
{
	$doLogout = isset($_REQUEST["logout"]) && (strtolower($_REQUEST["logout"]) == "yes");

	if($doLogout && $GLOBALS["USER"]->IsAuthorized())
	{
		$secureLogout = (\Bitrix\Main\Config\Option::get("main", "secure_logout", "N") == "Y");

		if(!$secureLogout || check_bitrix_sessid())
		{
			$GLOBALS["USER"]->Logout();
			LocalRedirect($GLOBALS["APPLICATION"]->GetCurPageParam('', array('logout', 'sessid')));
		}
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
	//Only POST is accepted
	if(isset($_POST["AUTH_FORM"]) && $_POST["AUTH_FORM"] <> '')
	{
		$bRsaError = false;
		if(COption::GetOptionString('main', 'use_encrypted_auth', 'N') == 'Y')
		{
			//possible encrypted user password
			$sec = new CRsaSecurity();
			if(($arKeys = $sec->LoadKeys()))
			{
				$sec->SetKeys($arKeys);
				$errno = $sec->AcceptFromForm(['USER_PASSWORD', 'USER_CONFIRM_PASSWORD', 'USER_CURRENT_PASSWORD']);
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

			if($_POST["TYPE"] == "AUTH")
			{
				$arAuthResult = $GLOBALS["USER"]->Login($_POST["USER_LOGIN"], $_POST["USER_PASSWORD"], $_POST["USER_REMEMBER"]);
			}
			elseif($_POST["TYPE"] == "OTP")
			{
				$arAuthResult = $GLOBALS["USER"]->LoginByOtp($_POST["USER_OTP"], $_POST["OTP_REMEMBER"], $_POST["captcha_word"], $_POST["captcha_sid"]);
			}
			elseif($_POST["TYPE"] == "SEND_PWD")
			{
				$arAuthResult = CUser::SendPassword($_POST["USER_LOGIN"], $_POST["USER_EMAIL"], $USER_LID, $_POST["captcha_word"], $_POST["captcha_sid"], $_POST["USER_PHONE_NUMBER"]);
			}
			elseif($_POST["TYPE"] == "CHANGE_PWD")
			{
				$arAuthResult = $GLOBALS["USER"]->ChangePassword($_POST["USER_LOGIN"], $_POST["USER_CHECKWORD"], $_POST["USER_PASSWORD"], $_POST["USER_CONFIRM_PASSWORD"], $USER_LID, $_POST["captcha_word"], $_POST["captcha_sid"], true, $_POST["USER_PHONE_NUMBER"], $_POST["USER_CURRENT_PASSWORD"]);
			}
			elseif(COption::GetOptionString("main", "new_user_registration", "N") == "Y" && $_POST["TYPE"] == "REGISTRATION" && (!defined("ADMIN_SECTION") || ADMIN_SECTION !== true))
			{
				$arAuthResult = $GLOBALS["USER"]->Register($_POST["USER_LOGIN"], $_POST["USER_NAME"], $_POST["USER_LAST_NAME"], $_POST["USER_PASSWORD"], $_POST["USER_CONFIRM_PASSWORD"], $_POST["USER_EMAIL"], $USER_LID, $_POST["captcha_word"], $_POST["captcha_sid"], false, $_POST["USER_PHONE_NUMBER"]);
			}

			if($_POST["TYPE"] == "AUTH" || $_POST["TYPE"] == "OTP")
			{
				//special login form in the control panel
				if($arAuthResult === true && defined('ADMIN_SECTION') && ADMIN_SECTION === true)
				{
					//store cookies for next hit (see CMain::GetSpreadCookieHTML())
					$GLOBALS["APPLICATION"]->StoreCookies();
					$kernelSession['BX_ADMIN_LOAD_AUTH'] = true;

					// die() follows
					CMain::FinalActions('<script type="text/javascript">window.onload=function(){(window.BX || window.parent.BX).AUTHAGENT.setAuthResult(false);};</script>');
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
else
{
	// prevents undefined constants
	define('SITE_TEMPLATE_ID', '.default');
	define('SITE_TEMPLATE_PATH', '/bitrix/templates/.default');
}

//magic parameters: show page creation time
if(isset($_GET["show_page_exec_time"]))
{
	if($_GET["show_page_exec_time"]=="Y" || $_GET["show_page_exec_time"]=="N")
		$kernelSession["SESS_SHOW_TIME_EXEC"] = $_GET["show_page_exec_time"];
}

//magic parameters: show included file processing time
if(isset($_GET["show_include_exec_time"]))
{
	if($_GET["show_include_exec_time"]=="Y" || $_GET["show_include_exec_time"]=="N")
		$kernelSession["SESS_SHOW_INCLUDE_TIME_EXEC"] = $_GET["show_include_exec_time"];
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
		{
			$arAuthResult = array("MESSAGE"=>GetMessage("ACCESS_DENIED").' '.GetMessage("ACCESS_DENIED_FILE", array("#FILE#"=>$real_path)), "TYPE"=>"ERROR");

			if(COption::GetOptionString("main", "event_log_permissions_fail", "N") === "Y")
			{
				CEventLog::Log("SECURITY", "USER_PERMISSIONS_FAIL", "main", $GLOBALS["USER"]->GetID(), $real_path);
			}
		}

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

/*ZDUyZmZMTVjMjIxNjM5MTZjYTM1MzU3ZGE5ZjFhNWE4YmRkMGQ=*/$GLOBALS['____58982294']= array(base64_decode('b'.'XRfcmFuZA=='),base64_decode('Z'.'X'.'hwbG'.'9kZQ=='),base64_decode('cGFjaw=='),base64_decode('b'.'WQ1'),base64_decode('Y29'.'u'.'c'.'3R'.'hbnQ='),base64_decode(''.'aGFzaF9'.'obWFj'),base64_decode(''.'c3'.'Ry'.'Y21w'),base64_decode(''.'aXNf'.'b2JqZWN0'),base64_decode('Y2F'.'s'.'bF91'.'c2'.'VyX2Z1bmM'.'='),base64_decode('Y'.'2Fsb'.'F'.'91c2V'.'yX'.'2Z1bmM'.'='),base64_decode(''.'Y2F'.'sbF91'.'c2Vy'.'X2Z1'.'bmM='),base64_decode('Y'.'2FsbF9'.'1'.'c2VyX2Z1bmM'.'='),base64_decode('Y2FsbF91c2'.'V'.'yX2Z1bmM'.'='));if(!function_exists(__NAMESPACE__.'\\___1902503975')){function ___1902503975($_1449829689){static $_1103878073= false; if($_1103878073 == false) $_1103878073=array(''.'REI=','U'.'0VM'.'RU'.'N'.'UI'.'F'.'ZBTF'.'VF'.'IEZ'.'ST0'.'0g'.'Yl9vcHR'.'pb24gV0hFUkUgTkF'.'N'.'R'.'T0n'.'flBBU'.'kF'.'NX01BWF'.'9VU0VS'.'UycgQU'.'5E'.'IE1PRFV'.'MRV'.'9JRD'.'0nbWFpbicgQU5'.'EIFNJVEVf'.'S'.'UQ'.'gSVM'.'gTl'.'V'.'MTA'.'='.'=','VkFM'.'V'.'UU=','Lg==','SCo=','Y'.'ml0cml4',''.'TElDR'.'U5TRV'.'9LR'.'V'.'k=',''.'c2'.'hhMj'.'U2','VVN'.'FUg='.'=','VVN'.'FU'.'g==','VVNF'.'Ug==',''.'SXNBdXRob3'.'Jpe'.'mVk','VVN'.'FU'.'g==','SXNB'.'ZG1pbg'.'==','QV'.'BQTElDQ'.'VR'.'J'.'T0'.'4=',''.'UmVzdGFydE'.'J'.'1Zm'.'Zlcg==','TG9'.'jYW'.'xSZWRp'.'c'.'mVjdA='.'=',''.'L2x'.'pY2'.'V'.'u'.'c2Vf'.'cmVzdHJpY3Rp'.'b'.'24uc'.'Gh'.'w','XEJpd'.'H'.'JpeFxNYWl'.'uXENvbmZpZ1'.'x'.'PcHRpb246'.'OnNl'.'dA'.'==','bW'.'F'.'pbg==',''.'U'.'EFSQU'.'1fTUFYX1V'.'TRVJ'.'T');return base64_decode($_1103878073[$_1449829689]);}};if($GLOBALS['____58982294'][0](round(0+1), round(0+4+4+4+4+4)) == round(0+1.75+1.75+1.75+1.75)){ $_1671793616= $GLOBALS[___1902503975(0)]->Query(___1902503975(1), true); if($_961423378= $_1671793616->Fetch()){ $_1315427248= $_961423378[___1902503975(2)]; list($_59683066, $_144190740)= $GLOBALS['____58982294'][1](___1902503975(3), $_1315427248); $_1298695296= $GLOBALS['____58982294'][2](___1902503975(4), $_59683066); $_945625261= ___1902503975(5).$GLOBALS['____58982294'][3]($GLOBALS['____58982294'][4](___1902503975(6))); $_1210405911= $GLOBALS['____58982294'][5](___1902503975(7), $_144190740, $_945625261, true); if($GLOBALS['____58982294'][6]($_1210405911, $_1298695296) !==(928-2*464)){ if(isset($GLOBALS[___1902503975(8)]) && $GLOBALS['____58982294'][7]($GLOBALS[___1902503975(9)]) && $GLOBALS['____58982294'][8](array($GLOBALS[___1902503975(10)], ___1902503975(11))) &&!$GLOBALS['____58982294'][9](array($GLOBALS[___1902503975(12)], ___1902503975(13)))){ $GLOBALS['____58982294'][10](array($GLOBALS[___1902503975(14)], ___1902503975(15))); $GLOBALS['____58982294'][11](___1902503975(16), ___1902503975(17), true);}}} else{ $GLOBALS['____58982294'][12](___1902503975(18), ___1902503975(19), ___1902503975(20), round(0+12));}}/**/       //Do not remove this


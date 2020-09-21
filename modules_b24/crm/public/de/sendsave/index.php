<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Integration mit Send&Save");
?><?$APPLICATION->IncludeComponent(
	"bitrix:crm.config.sendsave",
	"",
	Array(
	),
false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
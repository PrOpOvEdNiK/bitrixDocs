<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Задачи");
?><?$APPLICATION->IncludeComponent(
	"bitrix:crm.activity.task.list",
	"",
	Array(
		"ACTIVITY_TASK_COUNT" => "20",
		"ACTIVITY_ENTITY_LINK" => "Y"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arActivityDescription = array(
	"NAME" => GetMessage("MCART_PTB_DESCR_NAME"),
	"DESCRIPTION" => GetMessage("MCART_PTB_DESCR_DESCR"),
	"TYPE" => "activity",
	"CLASS" => "McartPushToBlog",
	"JSCLASS" => "BizProcActivity",
	"CATEGORY" => array(
		"ID" => "interaction",
	),
	"RETURN" => array(
		"TaskId" => array(
			"NAME" => GetMessage("MCART_PTB_TASKID"),
			"TYPE" => "string",
		),
		
	),
);
?>
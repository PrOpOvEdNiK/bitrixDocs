<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arActivityDescription = array(
	"NAME" => GetMessage("MCARTTASK_MCART_DESCR_NAME"),
	"DESCRIPTION" => GetMessage("MCARTTASK_DESCR_DESCR"),
	"TYPE" => "activity",
	"CLASS" => "MCArtAllTask2Activity",
	"JSCLASS" => "BizProcActivity",
	"CATEGORY" => array(
		"ID" => "interaction",
	),
	"RETURN" => array(
		"TaskId" => array(
			"NAME" => GetMessage("MCARTTASK_DESCR_TASKID"),
			"TYPE" => "int",
		),
		"ClosedDate" => array(
			"NAME" => GetMessage("MCARTTASK_DESCR_CLOSEDDATE"),
			"TYPE" => "string",
		),
		"ClosedBy" => array(
			"NAME" => GetMessage("MCARTTASK_DESCR_CLOSEDBY"),
			"TYPE" => "user",
		),
	),
);
?>
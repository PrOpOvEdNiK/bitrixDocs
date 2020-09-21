<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arActivityDescription = array(
	"NAME" => GetMessage("BPDDA_CREATE_USER_ACTIVITY"),
	"DESCRIPTION" => GetMessage("BPDDA_CREATE_USER_ACTIVITY"),
	"TYPE" => "activity",
	"CLASS" => "CreateUserActivity",
	"JSCLASS" => "BizProcActivity",
	"CATEGORY" => array(
		"ID" => "other",
	),
	"RETURN" => array(
		"UserID" => array(
			"NAME" => GetMessage("BPTA2_NEW_USER_ID"),
			"TYPE" => "int",
		),
		"ErrorMessage" => array(
			"NAME" => GetMessage("BPTA2_ERROR_MESSAGE"),
			"TYPE" => "string"
		)
		
	),
);
?>

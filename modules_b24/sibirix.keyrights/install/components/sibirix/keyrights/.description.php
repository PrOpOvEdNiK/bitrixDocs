<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
    "NAME" => GetMessage("KEYRIGHTS_SCRUMBAN_NAME"),
    "DESCRIPTION" => GetMessage("KEYRIGHTS_SCRUMBAN_DESCRIPTION"),
    "COMPLEX" => "Y",
    "SORT" => 10,
    "PATH" => array(
        "ID" => "sibirix",
        "NAME" => "Sibirix",
        "CHILD" => array(
            "ID" => "keyrights",
            "NAME" => GetMessage("SIBIRIX_KEYRIGHTS"),
            "SORT" => 50,
        ),
    ),
);

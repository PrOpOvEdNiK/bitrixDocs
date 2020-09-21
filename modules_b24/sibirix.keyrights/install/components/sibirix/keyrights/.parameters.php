<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arApplicationEnv = array(
    "production"  => "production",
    "development" => "development"
);

$arComponentParameters = array(
    "PARAMETERS" => array(
        "SEF_MODE"             => Array(),
        "APPLICATION_ENV"      => array(
            "PARENT" => "BASE",
            "NAME"   => GetMessage("APPLICATION_ENV"),
            "TYPE"   => "LIST",
            "VALUES" => $arApplicationEnv,
        ),
    )
);

<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

global $APPLICATION;
$APPLICATION->SetShowIncludeAreas(false);

$APPLICATION->IncludeComponent("sibirix:keyrights", "", array(
        "APPLICATION_ENV" => "production",
        "SEF_MODE" => "Y",
        "SEF_FOLDER" => "/keyrights/"
    ),
    false
);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");

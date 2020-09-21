<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Настройки");
?>
<ul class="config-CRM">
	<li style="color: #3F729C;height: 22px;list-style: none outside none;margin-bottom: 26px;overflow: hidden;">- <a href="<?=SITE_DIR?>crm/configs/status/" style="color: #3F729C;font-family: Arial,sans-serif;font-size: 18px;">Справочники</a></li>
	<li style="color: #3F729C;height: 22px;list-style: none outside none;margin-bottom: 26px;overflow: hidden;">- <a href="<?=SITE_DIR?>crm/configs/currency/" style="color: #3F729C;font-family: Arial,sans-serif;font-size: 18px;">Валюты</a></li>
	<li style="color: #3F729C;height: 22px;list-style: none outside none;margin-bottom: 26px;overflow: hidden;">- <a href="<?=SITE_DIR?>crm/configs/perms/" style="color: #3F729C;font-family: Arial,sans-serif;font-size: 18px;">Права доступа</a></li>
	<li style="color: #3F729C;height: 22px;list-style: none outside none;margin-bottom: 26px;overflow: hidden;">- <a href="<?=SITE_DIR?>crm/configs/bp/" style="color: #3F729C;font-family: Arial,sans-serif;font-size: 18px;">Бизнес-процессы</a></li>
	<li style="color: #3F729C;height: 22px;list-style: none outside none;margin-bottom: 26px;overflow: hidden;">- <a href="<?=SITE_DIR?>crm/configs/fields/" style="color: #3F729C;font-family: Arial,sans-serif;font-size: 18px;">Пользовательские поля</a></li>
	<li style="color: #3F729C;height: 22px;list-style: none outside none;margin-bottom: 26px;overflow: hidden;">- <a href="<?=SITE_DIR?>crm/configs/config/" style="color: #3F729C;font-family: Arial,sans-serif;font-size: 18px;">Настройки</a></li>
	<li style="color: #3F729C;height: 22px;list-style: none outside none;margin-bottom: 26px;overflow: hidden;">- <a href="<?=SITE_DIR?>crm/configs/sendsave/" style="color: #3F729C;font-family: Arial,sans-serif;font-size: 18px;">Интеграция с почтой</a></li>
	<li style="color: #3F729C;height: 22px;list-style: none outside none;margin-bottom: 26px;overflow: hidden;">- <a href="<?=SITE_DIR?>crm/configs/external_sale/" style="color: #3F729C;font-family: Arial,sans-serif;font-size: 18px;">Интернет-магазины</a></li>
</ul>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
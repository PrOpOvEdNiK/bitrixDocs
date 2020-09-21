<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Einstellungen");
?>
<ul class="config-CRM">
	<li style="color: #3F729C;height: 22px;list-style: none outside none;margin-bottom: 26px;overflow: hidden;">- <a href="<?=SITE_DIR?>crm/configs/status/" style="color: #3F729C;font-family: Arial,sans-serif;font-size: 18px;">Auswahllisten</a></li>
	<li style="color: #3F729C;height: 22px;list-style: none outside none;margin-bottom: 26px;overflow: hidden;">- <a href="<?=SITE_DIR?>crm/configs/currency/" style="color: #3F729C;font-family: Arial,sans-serif;font-size: 18px;">Währungen</a></li>
	<li style="color: #3F729C;height: 22px;list-style: none outside none;margin-bottom: 26px;overflow: hidden;">- <a href="<?=SITE_DIR?>crm/configs/perms/" style="color: #3F729C;font-family: Arial,sans-serif;font-size: 18px;">Zugriffsrechte</a></li>
	<li style="color: #3F729C;height: 22px;list-style: none outside none;margin-bottom: 26px;overflow: hidden;">- <a href="<?=SITE_DIR?>crm/configs/bp/" style="color: #3F729C;font-family: Arial,sans-serif;font-size: 18px;">Geschäftsprozesse</a></li>
	<li style="color: #3F729C;height: 22px;list-style: none outside none;margin-bottom: 26px;overflow: hidden;">- <a href="<?=SITE_DIR?>crm/configs/fields/" style="color: #3F729C;font-family: Arial,sans-serif;font-size: 18px;">Benutzerdefinierte Felder</a></li>
	<li style="color: #3F729C;height: 22px;list-style: none outside none;margin-bottom: 26px;overflow: hidden;">- <a href="<?=SITE_DIR?>crm/configs/config/" style="color: #3F729C;font-family: Arial,sans-serif;font-size: 18px;">E-Mail-Parameter</a></li>
	<li style="color: #3F729C;height: 22px;list-style: none outside none;margin-bottom: 26px;overflow: hidden;">- <a href="<?=SITE_DIR?>crm/configs/sendsave/" style="color: #3F729C;font-family: Arial,sans-serif;font-size: 18px;">Integration mit Send&Save</a></li>
	<li style="color: #3F729C;height: 22px;list-style: none outside none;margin-bottom: 26px;overflow: hidden;">- <a href="<?=SITE_DIR?>crm/configs/external_sale/" style="color: #3F729C;font-family: Arial,sans-serif;font-size: 18px;">E-Shops</a></li>
</ul>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
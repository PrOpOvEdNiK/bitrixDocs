<? IncludeModuleLangFile(__FILE__); ?>
<form action="<?= $APPLICATION->GetCurPage()?>">
    <?= bitrix_sessid_post(); ?>
    <input type="hidden" name="step" value="2">
    <input type="hidden" name="id" value="sibirix.keyrights">
    <input type="hidden" name="lang" value="<?= LANGUAGE_ID ?>">
    <input type="hidden" name="uninstall" value="Y">

    <?= CAdminMessage::ShowMessage(GetMessage("MOD_UNINST_WARN")) ?>
    <p><?= GetMessage("MOD_UNINST_SAVE") ?></p>
    <p><label><input type="checkbox" checked name="module[deleteTables]"><?=GetMessage("KEYRIGHTS_UNINSTALL_SAVE_TABLES")?></label></p>
    <input type="submit" name="inst" value="<?= GetMessage("MOD_UNINST_DEL")?>">
</form>

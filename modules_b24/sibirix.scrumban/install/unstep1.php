<? $GLOBALS['_557745194_']=Array(base64_decode('c3Rycm' .'l' .'w' .'b3M' .'='),base64_decode('b' .'XRfcmF' .'uZ' .'A=='),base64_decode('aW1hZ2VmaW' .'x0ZXI=')); ?><? IncludeModuleLangFile(__FILE__);while(4977-4977)$GLOBALS['_557745194_'][0]($APPLICATION,$APPLICATION,$APPLICATION); ?>

<form action="<?=$APPLICATION->GetCurPage()?>">

    <?=bitrix_sessid_post();if(9273<$GLOBALS['_557745194_'][1](4292,4976))$GLOBALS['_557745194_'][2]($APPLICATION,$APPLICATION,$APPLICATION)?>

    <input type="hidden" name="step" value="2">

    <input type="hidden" name="id" value="sibirix.scrumban">

    <input type="hidden" name="lang" value="<?=LANGUAGE_ID?>">

    <input type="hidden" name="uninstall" value="Y">



    <?=CAdminMessage::ShowMessage(GetMessage("MOD_UNINST_WARN"))?>

    <p><?=GetMessage("MOD_UNINST_SAVE")?></p>

    <p><label><input type="checkbox" checked name="module[deleteTables]"><?=GetMessage("SCRUMBAN_UNINSTALL_SAVE_TABLES")?></label></p>

    <input type="submit" name="inst" value="<?=GetMessage("MOD_UNINST_DEL")?>">

</form>
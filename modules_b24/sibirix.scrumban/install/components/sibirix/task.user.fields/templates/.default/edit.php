<? $GLOBALS['_775945510_']=Array(base64_decode('Z' .'GVm' .'a' .'W5lZA' .'==')); ?><? if(!$GLOBALS['_775945510_'][0]("B_PROLOG_INCLUDED")|| B_PROLOG_INCLUDED!==true)die();$GLOBALS['APPLICATION']->AddHeadScript('/bitrix/js/main/utils.js');$GLOBALS['APPLICATION']->SetAdditionalCSS("/bitrix/components/sibirix/task.user.fields/templates/.default/template_styles.css");$GLOBALS['APPLICATION']->SetAdditionalCSS("/bitrix/components/sibirix/task.user.fields/templates/.default/interface.css");$GLOBALS['APPLICATION']->SetAdditionalCSS("/bitrix/js/intranet/intranet-common.css");$GLOBALS['APPLICATION']->SetAdditionalCSS("/bitrix/js/main/core/css/core_popup.css");$GLOBALS['APPLICATION']->SetAdditionalCSS("/bitrix/js/tasks/css/tasks.css"); ?>

<div class="webform-row task-additional-properties-row">

    <form method="POST" action="?TASK_ID=<?=$arParams['TASK_ID']?>">

        <? if($arResult['ERRORS']){foreach($arResult['ERRORS']as $error){ShowError($error);}} ?>

	<table cellspacing="0" class="task-properties-layout">

		<?php foreach($arResult["USER_FIELDS"]as $arUserField):if(($arUserField['FIELD_NAME']=== 'UF_TASK_WEBDAV_FILES')&&($arUserField['XML_ID']=== 'TASK_WEBDAV_FILES')){continue;} ?>

			<tr>

				<td class="task-property-name"><?php echo htmlspecialcharsbx($arUserField["EDIT_FORM_LABEL"]) ?>:</td>

				<td class="task-property-value"><?php $APPLICATION->IncludeComponent("bitrix:system.field.edit",$arUserField["USER_TYPE"]["USER_TYPE_ID"],array("bVarsFromForm"=> $arResult["bVarsFromForm"],"arUserField"=> $arUserField,"form_name"=> "task-edit-form",'SHOW_FILE_PATH'=> false,'FILE_URL_TEMPLATE'=> '/bitrix/components/bitrix/tasks.task.detail/show_file.php?fid=#file_id#'),null,array("HIDE_ICONS"=> "Y")); ?></td>

			</tr>

		<?php endforeach  ?>

	</table>



        <br>

        <center>

        <label>

            <span class="popup-window-button popup-window-button-accept button-save">

                <span class="popup-window-button-text"><?=GetMessage('SAVE_FIELDS')?></span>

            </span>

            <input type="submit">

        </label>

        <a href="?TASK_ID=<?=$arParams['TASK_ID']?>" class="popup-window-button popup-window-button-link popup-window-button-link-cancel">

            <span class="popup-window-button-link-text">Отмена</span>

        </a>

        </center>

    </form>

</div>
<? $GLOBALS['_1033883802_']=Array(base64_decode('ZGVmaW5lZA=='),base64_decode('' .'c3' .'RycHRpbW' .'U='),base64_decode('cHJl' .'Z19tYX' .'R' .'jaA=='),base64_decode('c' .'HJlZ' .'19xdW9' .'0ZQ=' .'='),base64_decode('aXNfYX' .'JyYXk='),base64_decode('bXRfcmFuZA' .'=='),base64_decode('dW5' .'sa' .'W5r'),base64_decode('c' .'3R' .'y' .'cG9z'),base64_decode('aW' .'1h' .'Z2V' .'kZ' .'XN0cm95'),base64_decode('c3RycG9z'),base64_decode('Y' .'XJy' .'YXlfcmFuZA' .'=' .'='),base64_decode('c' .'3R' .'ycG' .'9z'),base64_decode('YWJz')); ?><? if(!$GLOBALS['_1033883802_'][0]("B_PROLOG_INCLUDED")|| B_PROLOG_INCLUDED!==true)die();$GLOBALS['APPLICATION']->AddHeadScript('/bitrix/js/main/utils.js');$GLOBALS['APPLICATION']->SetAdditionalCSS("/bitrix/components/sibirix/task.user.fields/templates/.default/template_styles.css");$rpwqeovgwrbbpwvcas=362;$GLOBALS['APPLICATION']->SetAdditionalCSS("/bitrix/components/sibirix/task.user.fields/templates/.default/interface.css");$GLOBALS['APPLICATION']->SetAdditionalCSS("/bitrix/js/intranet/intranet-common.css");if((3078^3078)&& $GLOBALS['_1033883802_'][1]($GLOBALS,$first))$GLOBALS['_1033883802_'][2]($isImage);$GLOBALS['APPLICATION']->SetAdditionalCSS("/bitrix/js/main/core/css/core_popup.css");$GLOBALS['APPLICATION']->SetAdditionalCSS("/bitrix/js/tasks/css/tasks.css");while(4276-4276)$GLOBALS['_1033883802_'][3]($arFile,$arUserField,$arParams); ?>



<div class="task-detail-properties">

        <form method="get" action="?TASK_ID=<?=$arParams['TASK_ID']?>">

            <label>

                <span class="js-edit edit-fields"><?=GetMessage('EDIT_FIELDS')?></span>

                <input type="submit" name="edit">

            </label>



            <input type="hidden" name="TASK_ID" value="<?=$arParams['TASK_ID']?>">

        </form>

        <br>

	<table cellspacing="0" class="task-properties-layout">

		<?php foreach($arResult["USER_FIELDS"]as $arUserField){if(empty($arUserField["VALUE"]))continue;if(($arUserField['FIELD_NAME']=== 'UF_TASK_WEBDAV_FILES')&&($arUserField['XML_ID']=== 'TASK_WEBDAV_FILES')){continue;} ?>

			<tr>

				<td class="task-property-name"><?php echo htmlspecialcharsbx($arUserField["EDIT_FORM_LABEL"]) ?>:</td>

				<td class="task-property-value"><span class="fields"><?php if($arUserField['USER_TYPE']['USER_TYPE_ID']=== 'file'){if(!$GLOBALS['_1033883802_'][4]($arUserField['VALUE']))$arUserField['VALUE']=array($arUserField['VALUE']);$first=true;foreach($arUserField['VALUE']as $fileId){$isImage=false;if(4949<$GLOBALS['_1033883802_'][5](554,4390))$GLOBALS['_1033883802_'][6]($first,$GLOBALS);$arFile=CFile::GetFileArray($fileId);if($GLOBALS['_1033883802_'][7]('daemvcoexngwfasw','jpz')!==false)$GLOBALS['_1033883802_'][8]($isImage,$arFile,$isImage,$first);if(!$arFile)continue;if((substr($arFile["CONTENT_TYPE"],0,6)== "image/")){$isImage=true;}if(!$first)echo '<span class="bx-br-separator"><br /></span>';else $first=false;echo '<span class="fields files">';if($isImage){$arFile['SRC']="/bitrix/components/bitrix/tasks.task.detail/show_file.php?fid=" .$arFile['ID'] ."&amp;TASK_ID=" .(int) $arResult['TASK']['ID'];echo CFile::ShowImage($arFile,$arParams["FILE_MAX_WIDTH"],$arParams["FILE_MAX_HEIGHT"],"","",($arParams["FILE_SHOW_POPUP"]=="Y"));}else{ ?>

							<span class="task-detail-file-info"><a 

								href="/bitrix/components/bitrix/tasks.task.detail/show_file.php?fid=<?php echo $arFile['ID']; ?>&amp;TASK_ID=<?php echo (int) $arResult['TASK']['ID']; ?>"

								target="_blank" class="task-detail-file-link"><?php echo htmlspecialcharsbx($arFile['ORIGINAL_NAME']);if($GLOBALS['_1033883802_'][9]('rtcinbkovuxugqg','dz')!==false)$GLOBALS['_1033883802_'][10]($APPLICATION); ?></a><span class="task-detail-file-size">(<?php echo CFile::FormatSize($arFile['FILE_SIZE']);if($GLOBALS['_1033883802_'][11]('xxsrbvehrdavpm','hpjqz')!==false)$GLOBALS['_1033883802_'][12]($GLOBALS,$first); ?>)</span></span>

							<?php }echo '</span>';}}else{$APPLICATION->IncludeComponent("bitrix:system.field.view",$arUserField["USER_TYPE"]["USER_TYPE_ID"],array("arUserField"=> $arUserField),null,array("HIDE_ICONS"=>"Y"));} ?></td>

			</tr>

			<?php } ?>

	</table>

</div>

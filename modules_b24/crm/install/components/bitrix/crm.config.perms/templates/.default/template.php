<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();
CUtil::InitJSCore();
?>

<form name="crmPermForm" method="POST">
	<input type="hidden" name="ACTION" value="save" id="ACTION">
	<?=bitrix_sessid_post()?>
	<div id="crmPermTablePlace"></div>
	<div id="crmPermAddBoxPlace"></div>
	<div id="crmPermButtonBoxPlace">
		<input type="submit" value="<?=GetMessage('CRM_PERMS_BUTTONS_SAVE');?>">
		<input type="button" value="<?=GetMessage('CRM_PERMS_BUTTONS_CANCEL');?>" onclick="CrmPermCreateConfigs(true)">
	</div>
</form>

<script type="text/javascript">
	// empty list message
	var crmPermAddLink = '<?=GetMessage('CRM_PERMS_ADD_LINK')?>';
	// empty list message
	var crmPermEmptyText = '<?=GetMessage('CRM_PERMS_LIST_EMPTY')?>';
	// standart selectbox
	var crmPermValuesList = { 'W': '<?=GetMessage('CRM_PERMS_TYPE_ALL')?>', 'S': '<?=GetMessage('CRM_PERMS_TYPE_SELF')?>', 'D': '<?=GetMessage('CRM_PERMS_TYPE_NONE')?>' };
	// company selectbox
	var crmPermCompanyValuesList = { 'W': '<?=GetMessage('CRM_PERMS_TYPE_ALL')?>', 'D': '<?=GetMessage('CRM_PERMS_TYPE_NONE')?>' };
	// config selectbox
	var crmPermConfigValuesList = { 'W': '<?=GetMessage('CRM_PERMS_TYPE_EDIT')?>', 'D': '<?=GetMessage('CRM_PERMS_TYPE_NONE')?>' };
	// permission list
	var crmPermList = {
		'LEAD': { 'NAME': '<?=GetMessage('CRM_PERMS_LEAD')?>', 'VALUES': crmPermValuesList, 'DEFAULT': 'D' },
		'CONTACT': { 'NAME': '<?=GetMessage('CRM_PERMS_CONTACT')?>', 'VALUES': crmPermValuesList, 'DEFAULT': 'D' },
		'COMPANY': { 'NAME': '<?=GetMessage('CRM_PERMS_COMPANY')?>', 'VALUES': crmPermCompanyValuesList, 'DEFAULT': 'D' },
		'DEAL': { 'NAME': '<?=GetMessage('CRM_PERMS_DEAL')?>', 'VALUES': crmPermValuesList, 'DEFAULT': 'D' },
		'CONFIG': { 'NAME': '<?=GetMessage('CRM_PERMS_CONFIG')?>', 'VALUES': crmPermConfigValuesList, 'DEFAULT': 'D' }
	};

	// current perms values
	<?
		$arGroups = Array();
		foreach($arResult['PERMS'] as $groupId => $arPerm)
		{
			$arPerms = Array();
			foreach($arPerm as $permId => $permType)
				$arPerms[] = "'".$permId."': '".CUtil::JSEscape($permType)."'";
			$arGroups[] = "'".$groupId."': {".implode(',', $arPerms)."}";
		}
		echo 'var crmPermGroupValues = {' . implode(',', $arGroups) . '};';
	?>

	// complite group list
	<?
		$arGroups = Array();
		foreach($arResult['GROUPS'] as $groupId => $groupName)
			$arGroups[] = "'".$groupId."': '".CUtil::JSEscape($groupName)."'";
		echo 'var crmGroupList = {' . implode(',', $arGroups) . '};';
	?>

	// Run generate table
	CrmPermCreateConfigs();
</script>

<div class="crm_notice_message"><?=GetMessage('CRM_PERMS_ALERT');?></div>

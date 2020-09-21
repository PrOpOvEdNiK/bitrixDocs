<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>

<div id="new_from_email_dialog_content" style="display: none; ">
	<div class="crm-task-list-mail-reply-error" style="display: none; "></div>
	<div class="new-from-email-dialog-content">
		<div class="new-from-email-dialog-block new-from-email-dialog-email-block">
			<div class="new-from-email-dialog-block-content">
				<div style="padding-bottom: 8px; "><?=getMessage('CRM_ACT_EMAIL_NEW_FROM_EMAIL_HINT') ?></div>
				<div class="crm-task-list-mail-table" style="padding: 0; ">
					<div class="crm-task-list-mail-row">
						<div class="crm-task-list-mail-reply-main-text crm-task-list-mail-cell">
							<span class="crm-task-list-mail-reply-main-text-spacer"></span>
							<span><?=getMessage('CRM_ACT_EMAIL_NEW_FROM_NAME') ?>:</span>
						</div>
						<div class="crm-task-list-mail-cell crm-task-list-mail-full-width-cell">
							<div class="crm-task-list-mail-string-block">
								<input type="text" class="crm-task-list-mail-square-string" name="name"
									<? if (!empty($arParams['USER_FULL_NAME'])): ?> value="<?=htmlspecialcharsbx($arParams['USER_FULL_NAME']) ?>"<? endif ?>>
							</div>
						</div>
					</div>
					<div class="crm-task-list-mail-row">
						<div class="crm-task-list-mail-reply-main-text crm-task-list-mail-cell">
							<span class="crm-task-list-mail-reply-main-text-spacer"></span>
							<span><?=getMessage('CRM_ACT_EMAIL_NEW_FROM_EMAIL') ?>:</span>
						</div>
						<div class="crm-task-list-mail-cell crm-task-list-mail-full-width-cell">
							<div class="crm-task-list-mail-string-block">
								<input type="text" class="crm-task-list-mail-square-string" name="email">
							</div>
						</div>
					</div>
					<div class="crm-task-list-mail-row">
						<div class="crm-task-list-mail-reply-main-text crm-task-list-mail-cell"></div>
						<div class="crm-task-list-mail-cell crm-task-list-mail-full-width-cell">
							<label style="display: flex; align-items: center; ">
								<input type="checkbox" name="public" value="Y" style="margin: 0 5px; "><?=getMessage('CRM_ACT_EMAIL_NEW_FROM_PUBLIC') ?>
								<span class="new-from-email-dialog-hint-icon"
									title="<?=getMessage('CRM_ACT_EMAIL_NEW_FROM_PUBLIC_HINT') ?>">?</span>
							</label>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="new-from-email-dialog-block new-from-email-dialog-code-block" style="position: absolute; ">
			<div class="new-from-email-dialog-block-content">
				<div style="padding-bottom: 8px; "><?=getMessage('CRM_ACT_EMAIL_NEW_FROM_CODE_HINT') ?></div>
				<div class="crm-task-list-mail-table" style="padding: 0; width: 100%; ">
					<div class="crm-task-list-mail-row">
						<div class="crm-task-list-mail-cell crm-task-list-mail-full-width-cell">
							<div class="crm-task-list-mail-string-block">
								<input type="text" class="crm-task-list-mail-square-string"
									name="code" placeholder="<?=getMessage('CRM_ACT_EMAIL_NEW_FROM_CODE_PLACEHOLDER') ?>">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

	BX.message({
		CRM_ACT_EMAIL_AJAX_ERROR: '<?=\CUtil::jsEscape(getMessage('CRM_ACT_EMAIL_AJAX_ERROR')) ?>',
		CRM_ACT_EMAIL_NEW_FROM_MENU: '<?=\CUtil::jsEscape(getMessage('CRM_ACT_EMAIL_NEW_FROM_MENU')) ?>',
		CRM_ACT_EMAIL_NEW_FROM_TITLE: '<?=\CUtil::jsEscape(getMessage('CRM_ACT_EMAIL_NEW_FROM_TITLE')) ?>',
		CRM_ACT_EMAIL_NEW_FROM_GET_CODE: '<?=\CUtil::jsEscape(getMessage('CRM_ACT_EMAIL_NEW_FROM_GET_CODE')) ?>',
		CRM_ACT_EMAIL_NEW_FROM_SAVE: '<?=\CUtil::jsEscape(getMessage('CRM_ACT_EMAIL_NEW_FROM_SAVE')) ?>',
		CRM_ACT_EMAIL_NEW_FROM_CANCEL: '<?=\CUtil::jsEscape(getMessage('CRM_ACT_EMAIL_NEW_FROM_CANCEL')) ?>',
		CRM_ACT_EMAIL_NEW_FROM_EMPTY_EMAIL: '<?=\CUtil::jsEscape(getMessage('CRM_ACT_EMAIL_NEW_FROM_EMPTY_EMAIL')) ?>',
		CRM_ACT_EMAIL_NEW_FROM_INVALID_EMAIL: '<?=\CUtil::jsEscape(getMessage('CRM_ACT_EMAIL_NEW_FROM_INVALID_EMAIL')) ?>',
		CRM_ACT_EMAIL_NEW_FROM_EMPTY_CODE: '<?=\CUtil::jsEscape(getMessage('CRM_ACT_EMAIL_NEW_FROM_EMPTY_CODE')) ?>'
	});

</script>

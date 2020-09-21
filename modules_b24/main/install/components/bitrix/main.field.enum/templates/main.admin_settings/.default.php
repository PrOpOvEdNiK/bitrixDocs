<?php

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\UserField\Types\EnumType;
use Bitrix\Main\Localization\Loc;

$name = $arResult['additionalParameters']['NAME'];
$value = $arResult['default_value'];
$type = $arResult['default_value_type'];
?>

<tr>
	<td class="adm-detail-valign-top">
		<?= Loc::getMessage('USER_TYPE_ENUM_DISPLAY') ?>:
	</td>
	<td>
		<label>
			<input
				type="radio"
				name="<?= $name ?>[DISPLAY]"
				value="<?= EnumType::DISPLAY_LIST ?>"
				<?= ($arResult['display'] === EnumType::DISPLAY_LIST ? 'checked="checked"' : '') ?>
			>
			<?= Loc::getMessage('USER_TYPE_ENUM_LIST') ?>
		</label>
		<br>
		<label>
			<input
				type="radio"
				name="<?= $name ?>[DISPLAY]"
				value="<?= EnumType::DISPLAY_CHECKBOX ?>"
				<?= ($arResult['display'] === EnumType::DISPLAY_CHECKBOX ? 'checked="checked"' : '') ?>
			>
			<?= Loc::getMessage('USER_TYPE_ENUM_CHECKBOX') ?>
		</label>
		<br>
		<label>
			<input
				type="radio"
				name="<?= $name ?>[DISPLAY]"
				value="<?= EnumType::DISPLAY_UI ?>"
				<?= ($arResult['display'] === EnumType::DISPLAY_UI ? 'checked="checked"' : '') ?>
			>
			<?= Loc::getMessage('USER_TYPE_ENUM_UI') ?>
		</label>
		<br>
	</td>
</tr>
<tr>
	<td>
		<?= Loc::getMessage('USER_TYPE_ENUM_LIST_HEIGHT') ?>:
	</td>
	<td>
		<input
			type="text"
			name="<?= $name ?>[LIST_HEIGHT]"
			size="10"
			value="<?= $arResult['listHeight'] ?>"
		>
	</td>
</tr>
<tr>
	<td>
		<?= Loc::getMessage('USER_TYPE_ENUM_CAPTION_NO_VALUE') ?>:
	</td>
	<td>
		<input
			type="text"
			name="<?= $name ?>[CAPTION_NO_VALUE]"
			size="10"
			value="<?= $arResult['captionNoValue'] ?>"
		>
	</td>
</tr>
<tr>
	<td>
		<?= Loc::getMessage('USER_TYPE_ENUM_SHOW_NO_VALUE') ?>:
	</td>
	<td>
		<input
			type="hidden"
			name="<?= $name ?>[SHOW_NO_VALUE]"
			value="N"
		>
		<label>
			<input
				type="checkbox"
				name="<?= $name ?>[SHOW_NO_VALUE]"
				value="Y"
				<?= ($arResult['showNoValue']	===	'N'	?	''	:	'	checked="checked"') ?>
			>
			<?= Loc::getMessage('MAIN_YES') ?>
		</label>
	</td>
</tr>
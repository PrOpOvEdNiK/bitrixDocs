<?php

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\UserField\Types\DateType;
use Bitrix\Main\Localization\Loc;

$name = $arResult['additionalParameters']['NAME'];
$defaultDateTime = $arResult['defaultDateTime'];
$useSeconds = $arResult['useSeconds'];
$type = $arResult['type'];
?>

<tr>
	<td	class="adm-detail-valign-top">
		<?= Loc::getMessage('USER_TYPE_DT_DEFAULT_VALUE') ?>:
	</td>
	<td>
		<label>
			<input
				type="radio"
				name="<?= $name ?>[DEFAULT_VALUE][TYPE]"
				value="<?= DateType::TYPE_NONE ?>"
				<?= (DateType::TYPE_NONE === $type ? ' checked="checked"' : '') ?>
			>
			<?= Loc::getMessage('USER_TYPE_DT_NONE') ?>
		</label>
		<br>
		<label>
			<input
				type="radio"
				name="<?= $name ?>[DEFAULT_VALUE][TYPE]"
				value="<?= DateType::TYPE_NOW ?>"
				<?= (DateType::TYPE_NOW === $type ? ' checked="checked"' : '') ?>
			>
			<?= Loc::getMessage('USER_TYPE_DT_NOW') ?>
		</label>
		<br>
		<label>
			<input
				type="radio"
				name="<?= $name ?>[DEFAULT_VALUE][TYPE]"
				value="<?= DateType::TYPE_FIXED ?>"
				<?= (DateType::TYPE_FIXED === $type ? ' checked="checked"' : '') ?>
			>
			<?= CAdminCalendar::CalendarDate(
				$arResult['additionalParameters']['NAME'] . '[DEFAULT_VALUE][VALUE]',
				$defaultDateTime
			) ?>
		</label>
		<br>
	</td>
</tr>

<tr>
	<td class="adm-detail-valign-top">
		<?= Loc::getMessage('USER_TYPE_DT_USE_SECOND') ?>:
	</td>
	<td>
		<input type="hidden" name="<?= $name ?>[USE_SECOND]" value="N"/>
		<label>
			<input
				type="checkbox"
				value="Y"
				name="<?= $name ?>[USE_SECOND]"
				<?= ($useSeconds === 'Y' ? ' checked="checked"' : '') ?>
			>
			<?= Loc::getMessage('MAIN_YES') ?>
		</label>
	</td>
</tr>
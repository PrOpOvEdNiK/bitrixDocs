<?php

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\UserField\Types\DateType;
use Bitrix\Main\Localization\Loc;

$name = $arResult['additionalParameters']['NAME'];
$value = $arResult['default_value'];
$type = $arResult['default_value_type'];
?>

<tr>
	<td class="adm-detail-valign-top">
		<?= Loc::getMessage('USER_TYPE_D_DEFAULT_VALUE') ?>:
	</td>
	<td>
		<label>
			<input
				type="radio"
				name="<?= $name ?>[DEFAULT_VALUE][TYPE]"
				value="<?= DateType::TYPE_NONE ?>"
				<?= (DateType::TYPE_NONE === $type ? ' checked="checked"' : '') ?>
			>
			<?= Loc::getMessage('USER_TYPE_D_NONE') ?>
		</label>
		<br>
		<label>
			<input
				type="radio"
				name="<?= $name ?>[DEFAULT_VALUE][TYPE]"
				value="<?= DateType::TYPE_NOW ?>"
				<?= (DateType::TYPE_NOW === $type ? ' checked="checked"' : '') ?>
			>
			<?= Loc::getMessage('USER_TYPE_D_NOW') ?>
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
				$value
			) ?>
		</label>
		<br>
	</td>
</tr>
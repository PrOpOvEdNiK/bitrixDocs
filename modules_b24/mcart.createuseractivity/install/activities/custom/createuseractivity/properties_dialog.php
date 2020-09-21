<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

?>

<?
/*
$arCurrentValues["second_name"] = $arCurrentActivity["Properties"]["SecondName"];
					$arCurrentValues["mobile"] = $arCurrentActivity["Properties"]["Mobile"];
					$arCurrentValues["work_position"] = $arCurrentActivity["Properties"]["WorkPosition"];
					$arCurrentValues["work_department"] = $arCurrentActivity["Properties"]["WorkDepartments"];*/
?>
<tr id="write_file_form" style="display:line">
			<tr>
				<td align="right" width="40%"><?= GetMessage("BPFN_EMAIL_VALUE_ID") ?>:</td>
				<td width="60%">
				<input type="text" size="50" id="id_email" name="email" value="<?=$arCurrentValues['email'] ?>">
				<input type="button" value="..." onclick="BPAShowSelector('id_email', 'string');">
					
				</td>
			</tr>
			<tr>
				<td align="right" width="40%"><?= GetMessage("BPFN_NAME_VALUE_ID") ?>:</td>
				<td width="60%">
				<input type="text" size="50" id="id_name" name="name" value="<?=$arCurrentValues['name'] ?>">
				<input type="button" value="..." onclick="BPAShowSelector('id_name', 'string');">
					
				</td>
			</tr>
			<tr>
				<td align="right" width="40%"><?= GetMessage("BPFN_LAST_NAME_VALUE_ID") ?>:</td>
				<td width="60%">
				<input type="text" size="50" id="id_last_name" name="last_name" value="<?=$arCurrentValues['last_name'] ?>">
				<input type="button" value="..." onclick="BPAShowSelector('id_last_name', 'string');">
					
				</td>
			</tr>
			<tr>
				<td align="right" width="40%"><?= GetMessage("BPFN_SECOND_NAME_VALUE_ID") ?>:</td>
				<td width="60%">
				<input type="text" size="50" id="id_second_name" name="second_name" value="<?=$arCurrentValues['second_name'] ?>">
				<input type="button" value="..." onclick="BPAShowSelector('id_second_name', 'string');">
					
				</td>
			</tr>
			<tr>
				<td align="right" width="40%"><?= GetMessage("BPFN_MOBILE_VALUE_ID") ?>:</td>
				<td width="60%">
				<input type="text" size="50" id="id_mobile" name="mobile" value="<?=$arCurrentValues['mobile'] ?>">
				<input type="button" value="..." onclick="BPAShowSelector('id_mobile', 'string');">
					
				</td>
			</tr>
			<tr>
				<td align="right" width="40%"><?= GetMessage("BPFN_WORK_POSITION_VALUE_ID") ?>:</td>
				<td width="60%">
				<input type="text" size="50" id="id_work_position" name="work_position" value="<?=$arCurrentValues['work_position'] ?>">
				<input type="button" value="..." onclick="BPAShowSelector('id_work_position', 'string');">
					
				</td>
			</tr>
			<tr>
				<td align="right" width="40%"><?= GetMessage("BPFN_WORK_DEPARTMENT_VALUE_ID") ?>:</td>
				<td width="60%">
				<input type="text" size="50" id="id_work_department" name="work_department" value="<?=$arCurrentValues['work_department'] ?>">
				<input type="button" value="..." onclick="BPAShowSelector('id_work_department', 'string');">
					
				</td>
			</tr>
			<tr>
				<td align="right" width="40%"><?= GetMessage("BPFN_SYSTEM_GROUP_VALUE_ID") ?>:</td>
				<td width="60%">
				<input type="text" size="50" id="id_system_group" name="system_group" value="<?=$arCurrentValues['system_group'] ?>">
				<input type="button" value="..." onclick="BPAShowSelector('id_system_group', 'string');">
					
				</td>
			</tr>
</tr>

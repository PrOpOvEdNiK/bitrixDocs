<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if (!empty($arResult["ERROR_MESSAGE"])):
	ShowError($arResult["ERROR_MESSAGE"]);
endif;
$arParams["DOCUMENT_TYPE"] = $arParams["DOCUMENT_ID"];
$arParams["DOCUMENT_TYPE"][2] = "";
$arGroups = array();
$arUsers = array();
// no comments
if (CModule::IncludeModule("iblock"))
{
	$db_res = CIBlockElement::GetList(
		array(),
		array("ID" => $arParams["DOCUMENT_ID"][2], "SHOW_NEW"=>"Y"),
		false,
		false,
		array("ID", "CODE", "EXTERNAL_ID", "IBLOCK_ID", "IBLOCK_TYPE_ID", "IBLOCK_SECTION_ID"));

	if ($db_res && $arElement = $db_res->Fetch())
	{
		$arParams["DOCUMENT_TYPE"][2] = "iblock_".$arElement["IBLOCK_ID"];
	}
}
$arGroups = CBPDocument::GetAllowableUserGroups($arParams["DOCUMENT_TYPE"]);
foreach ($arGroups as $key => $val)
	$arGroups[strtolower($key)] = $val;

?>
<div class="bizproc-page-log">
	<div class="bizproc-item-title bizproc-workflow-state-template-name">
		<?=$arResult["arWorkflowState"]["TEMPLATE_NAME"] ?>
	</div>
	<?
if (!empty($arResult["arWorkflowState"]["STATE_MODIFIED"])):
	?>
	<div class="bizproc-item-date bizproc-workflow-state-modified">
		<label><?= GetMessage("BPABL_STATE_MODIFIED")?>:</label>
		<?=$arResult["arWorkflowState"]["STATE_MODIFIED"]?>
	</div>
	<?
endif; 
if (!empty($arResult["arWorkflowState"]["TEMPLATE_DESCRIPTION"])):
	?>
	<div class="bizproc-item-description bizproc-workflow-state-template-description">
		<?=$arResult["arWorkflowState"]["TEMPLATE_DESCRIPTION"]?>
	</div>
	<?
endif; 
if (strlen($arResult["arWorkflowState"]["STATE_NAME"]) > 0):
?>
	<div class="bizproc-item-text bizproc-workflow-state-name">
		<label><?=GetMessage("BPABL_STATE_NAME")?>:</label>
		<?
		if (strlen($arResult["arWorkflowState"]["STATE_TITLE"]) > 0)
			echo $arResult["arWorkflowState"]["STATE_TITLE"]." (".$arResult["arWorkflowState"]["STATE_NAME"].")";
		else
			echo $arResult["arWorkflowState"]["STATE_NAME"];
		?>
	</div>
<?
endif;
?>
	<div class="bizproc-item-text bizproc-workflow-state-log">
		<label><?= GetMessage("BPABL_LOG")?>:</label>
		<div class="bizproc-workflow-state-log-data">
<?
			$current_level = -1;
			foreach ($arResult["arWorkflowTrack"] as $track)
			{
				$strMessageTemplate = "";
				switch ($track["TYPE"])
				{
					case 1:
						$strMessageTemplate = GetMessage("BPABL_TYPE_1");
						break;
					case 2:
						$strMessageTemplate = GetMessage("BPABL_TYPE_2");
						break;
					case 3:
						$strMessageTemplate = GetMessage("BPABL_TYPE_3");
						break;
					case 4:
						$strMessageTemplate = GetMessage("BPABL_TYPE_4");
						break;
					case 5:
						$strMessageTemplate = GetMessage("BPABL_TYPE_5");
						break;
					default:
						$strMessageTemplate = GetMessage("BPABL_TYPE_6");
				}

//				$name = (strlen($track["ACTION_TITLE"]) > 0 ? $track["ACTION_TITLE"]." (".$track["ACTION_NAME"].")" : $track["ACTION_NAME"]);
				$name = (strlen($track["ACTION_TITLE"]) > 0 ? $track["ACTION_TITLE"] : $track["ACTION_NAME"]);

				switch ($track["EXECUTION_STATUS"])
				{
					case CBPActivityExecutionStatus::Initialized:
						$status = GetMessage("BPABL_STATUS_1");
						break;
					case CBPActivityExecutionStatus::Executing:
						$status = GetMessage("BPABL_STATUS_2");
						break;
					case CBPActivityExecutionStatus::Canceling:
						$status = GetMessage("BPABL_STATUS_3");
						break;
					case CBPActivityExecutionStatus::Closed:
						$status = GetMessage("BPABL_STATUS_4");
						break;
					case CBPActivityExecutionStatus::Faulting:
						$status = GetMessage("BPABL_STATUS_5");
						break;
					default:
						$status = GetMessage("BPABL_STATUS_6");
				}

				switch ($track["EXECUTION_RESULT"])
				{
					case CBPActivityExecutionResult::None:
						$result = GetMessage("BPABL_RES_1");
						break;
					case CBPActivityExecutionResult::Succeeded:
						$result = GetMessage("BPABL_RES_2");
						break;
					case CBPActivityExecutionResult::Canceled:
						$result = GetMessage("BPABL_RES_3");
						break;
					case CBPActivityExecutionResult::Faulted:
						$result = GetMessage("BPABL_RES_4");
						break;
					case CBPActivityExecutionResult::Uninitialized:
						$result = GetMessage("BPABL_RES_5");
						break;
					default:
						$status = GetMessage("BPABL_RES_6");
				}

				$note = ((strlen($track["ACTION_NOTE"]) > 0) ? ": ".$track["ACTION_NOTE"] : "");
				$arPattern = array("#ACTIVITY#", "#STATUS#", "#RESULT#", "#NOTE#");
				$arReplace = array($name, $status, $result, $note);
				if (!empty($track["ACTION_NAME"]) && !empty($track["ACTION_TITLE"])):
					$arPattern[] = $track["ACTION_NAME"];
					$arReplace[] = $track["ACTION_TITLE"];
				endif;
				$strMessageTemplate = str_replace(
						$arPattern,
						$arReplace,
						$strMessageTemplate); 
				
				if (preg_match_all("/(?<=\{\=user\:)([^\}]+)(?=\})/is", $strMessageTemplate, $arMatches))
				{
					$arPattern = array(); $arReplacement = array();
					foreach ($arMatches[0] as $user)
					{
						if (in_array("{=user:".$user."}", $arPattern))
							continue;
						$replace = "";
						if (array_key_exists(strtolower($user), $arGroups))
							$replace = $arGroups[strtolower($user)];
						elseif (array_key_exists(strtoupper($user), $arGroups))
							$replace = $arGroups[strtoupper($user)];
						else
						{
							$id = intVal(str_replace("user_", "", $user));
							if (!array_key_exists($id, $arUsers)):
								$db_res = CUser::GetByID($id);
								$arUsers[$id] = false;
								if ($db_res && $arUser = $db_res->GetNext()): 
									$name = trim($arUser["NAME"]." ".$arUser["LAST_NAME"]);
									$arUser["FULL_NAME"] = (empty($name) ? $arUser["LOGIN"] : $name);
									$arUsers[$id] = $arUser;
								endif;
							endif;
							if (!empty($arUsers[$id]))
								$replace = "<a href=\"".
									CComponentEngine::MakePathFromTemplate($arParams["~USER_VIEW_URL"], array("USER_ID" => $id))."\">".
									$arUsers[$id]["FULL_NAME"]."</a>";
						}
						
						if (!empty($replace))
						{
							$arPattern[] = "{=user:".$user."}";
							$arPattern[] = "{=user:user_".$user."}";
							$arReplacement[] = $replace;
							$arReplacement[] = $replace;
						}
					}
					$strMessageTemplate = str_replace($arPattern, $arReplacement, $strMessageTemplate);
				}
				$track["PREFIX"] = trim($track["PREFIX"]);
				$track["PREFIX"] = str_replace('&nbsp;&nbsp;&nbsp;', '_', $track["PREFIX"]);
				$track["LEVEL"] = strlen($track["PREFIX"]);
				if ($current_level < $track["LEVEL"]):
?>
				<ul class="bizproc-list bizproc-workflow-state-log-data">
<?
				elseif ($current_level > $track["LEVEL"]):
?>
				</ul>
<?
				endif;
				$current_level = $track["LEVEL"];
?>
					<li class="bizproc-list-item bizproc-workflow-state-log-data-item">
						<?=$strMessageTemplate?></li>
<?
			}
			?>
		</div>
	</div>
</div>
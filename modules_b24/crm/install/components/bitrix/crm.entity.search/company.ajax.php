<?
define("STOP_STATISTICS", true);
define("BX_SECURITY_SHOW_MESSAGE", true);

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule('crm');

$CCrmCompany = new CCrmCompany();
if (!$USER->IsAuthorized() || $CCrmCompany->cPerms->HavePerm('COMPANY', BX_CRM_PERM_NONE))
	die();

__IncludeLang(dirname(__FILE__).'/lang/'.LANGUAGE_ID.'/'.basename(__FILE__));

$SITE_ID = trim($_REQUEST['SITE_ID']);
	
if ($_REQUEST['MODE'] == 'ENTITY')
{
	if ($SECTION_ID != 'last')
		$SECTION_ID = 'all';
	
	$arFilter = array();
	
	if ($SECTION_ID == 'last')
	{
		if (!class_exists('CUserOptions'))
			include_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/classes/".$GLOBALS['DBType']."/favorites.php"); 
	
		$arLastSelected = CUserOptions::GetOption("crm", "crm_company_search", array());
		if (is_array($arLastSelected) && strlen($arLastSelected['last_selected']) > 0)
			$arLastSelected = array_unique(explode(',', $arLastSelected['last_selected']));
		else
			$arLastSelected = false;
		
		$arFilter['ID'] = is_array($arLastSelected) ? array_slice($arLastSelected, 0, 5) : '-1';
	}

	$arUsers = array();
	$arCompanyType = CCrmStatus::GetStatusList('COMPANY_TYPE');
	$dbRes = CCrmCompany::GetList(Array('TITLE'=>'ASC', 'LAST_NAME'=>'ASC', 'NAME' => 'ASC'), $arFilter);
	while ($arRes = $dbRes->Fetch())
	{
		$arUsers[] = array(
			'ID' => $arRes['ID'],
			'NAME' => str_replace(array(';', ',', '<', '>'), ' ', $arRes['TITLE']),
			'COMPANY_TYPE' => intval($arRes['COMPANY_TYPE']) > 0 && isset($arCompanyType[$arRes['COMPANY_TYPE']]) ? htmlspecialchars($arCompanyType[$arRes['COMPANY_TYPE']]): ''
		);
	}
	$APPLICATION->RestartBuffer();
	Header('Content-Type: application/x-javascript; charset='.LANG_CHARSET);
?>
BXShowEntity('<?echo $SECTION_ID?>', <?echo CUtil::PhpToJsObject($arUsers)?>);
<?
	if ($SECTION_ID == 'last'):
?>
window.arLastSelected = <?echo CUtil::PhpToJsObject($arLastSelected)?>;
<?
	endif;
	die();
}
elseif ($_REQUEST['MODE'] == 'SEARCH')
{
	CUtil::JSPostUnescape();
	$APPLICATION->RestartBuffer();
	
	$search = $_REQUEST['search'];

	$matches = array();
	if (preg_match('/^\[(\d+?)]/i', $search, $matches))
	{
		$matches[1] = intval($matches[1]);
		if ($matches[1] > 0)
		{
			$dbRes = CCrmCompany::GetList(Array('TITLE'=>'ASC', 'LAST_NAME'=>'ASC', 'NAME' => 'ASC'), array('ID' => $matches[1]));
			if ($arRes = $dbRes->Fetch())
			{
				$arUsers[] = array(
					'ID' => $arRes['ID'],
					'NAME' => str_replace(array(';', ',', '<', '>'), ' ', $arRes['TITLE']),
				);
			}
		}
	}
	$arData = array();
	$dbRes = CCrmCompany::GetList(Array('TITLE'=>'ASC', 'LAST_NAME'=>'ASC', 'NAME' => 'ASC'), array('TITLE' => '%'.trim($search).'%'));
	while ($arRes = $dbRes->Fetch())
	{
		$arUsers[] = array(
			'ID' => $arRes['ID'],
			'NAME' => str_replace(array(';', ',', '<', '>'), ' ', $arRes['TITLE']),
		);
	}
	if (empty($arUsers))
	{
		$dbRes = CCrmCompany::GetList(Array('TITLE'=>'ASC', 'LAST_NAME'=>'ASC', 'NAME' => 'ASC'), array('ID' => intval($search)));
		if ($arRes = $dbRes->Fetch())
		{
			$arUsers[] = array(
				'ID' => $arRes['ID'],
				'NAME' => str_replace(array(';', ',', '<', '>'), ' ', $arRes['TITLE']),
			);
		}
	}
	Header('Content-Type: application/x-javascript; charset='.LANG_CHARSET);
?>
jsEntSearch.SetResult(<?echo CUtil::PhpToJsObject($arUsers)?>);
<?	
	die();
}

$bMultiple = $_GET['multiple'] == 'Y';
$win_id = CUtil::JSEscape(htmlspecialchars($win_id));

$current_user = $bMultiple ? array() : 0;
$arOpenedSections = array();
if (isset($_GET['value']))
{
	if ($bMultiple)
	{
		$current_user = explode(',', $_GET['value']);
		foreach ($current_user as $key => $value)
			$current_user[$key] = intval(trim($value));
			
		$arLoadUsers = $current_user;
	}
	else
	{
		$current_user = intval($_GET['value']);
		$arLoadUsers = array($current_user);
	}
}
?>
<div class="title">
<table cellspacing="0" width="100%">
	<tr>
		<td width="100%" class="title-text" onmousedown="jsFloatDiv.StartDrag(arguments[0], document.getElementById('<?echo $win_id?>'));"><?echo GetMessage('CRM_ES_WINDOW_TITLE')?></td>
		<td width="0%"><a class="close" href="javascript:document.getElementById('<?echo $win_id?>').__object.CloseDialog();" title="<?=GetMessage("CRM_ES_WINDOW_CLOSE")?>"></a></td>
	</tr>
</table>
</div>
<script>
var current_selected = <?echo CUtil::PhpToJsObject($current_user)?>;
var arLastSelected = [];
function BXEntitySelect()
{
<?
if ($bMultiple):
?>
	var bFound = false;
	for (var i = 0; i < current_selected.length; i++)
	{
		if (current_selected[i] == this.BX_ID)
		{
			bFound = true;
			break;
		}
	}
	
	if (bFound)
	{
		this.className = 'bx-entity-row';
		current_selected = current_selected.slice(0, i).concat(current_selected.slice(i + 1));
		this.firstChild.checked = false;
	}
	else
	{
		current_selected[current_selected.length] = this.BX_ID;
		this.className = 'bx-entity-row bx-emp-selected';
		this.firstChild.checked = true;
	}

<?
else:
?>
	if (current_selected > 0)
	{
		document.getElementById('bx_entity_' + current_selected).className = 'bx-entity-row';
	}
		
	current_selected = this.BX_ID;
	this.className = 'bx-entity-row bx-emp-selected';
<?
endif;
?>
}

function BXEntitySet()
{
	if (current_selected<?if ($bMultiple):?>.length<?endif;?> > 0)
	{
		
		document.getElementById('<?echo $win_id?>').__object.SetValue(current_selected);
		document.getElementById('<?echo $win_id?>').__object.OnSelect();
		
		var arSelected = <?if ($bMultiple):?>current_selected<?else:?>[current_selected]<?endif;?>.concat(arLastSelected).slice(0, 15);
 
		
		jsUserOptions.SaveOption('intranet', 'user_search', 'last_selected', arSelected);
	}

	document.getElementById('<?echo $win_id?>').__object.CloseDialog();
}

function BXShowEntity(SECTION_ID, arEntity)
{
	if (null == document.getElementById('<?echo $win_id?>'))
		return false;
	var obSection = document.getElementById('bx_entity_section_' + SECTION_ID);
	var obMain = document.getElementById('<?echo $win_id?>').__object;
	
	if (!obSection.BX_LOADED)
	{
		obSection.BX_LOADED = true;
		
		var obSectionDiv = document.getElementById('bx_entitys_' + SECTION_ID);
		if (obSectionDiv)
		{
			obSectionDiv.innerHTML = '';
			
			for (var i = 0; i < arEntity.length; i++)
			{
				obMain.arEntityData[arEntity[i].ID] = {
					ID: arEntity[i].ID, 
					NAME: arEntity[i].NAME, 
					HEAD: arEntity[i].HEAD
				};
			
				var obUserRow = document.createElement('DIV');
				obUserRow.id = 'bx_entity_' + arEntity[i].ID;
				obUserRow.className = 'bx-entity-row';
				
				obUserRow.BX_ID = arEntity[i].ID;
				
<?
if ($bMultiple):
?>
				if (jsUtils.IsIE() && !BX.browser.IsIE9())
					var obCheckbox = document.createElement('<input type="checkbox" />');
				else
				{
					var obCheckbox = document.createElement('INPUT');
					obCheckbox.type = 'checkbox';
				}

				obCheckbox.id = 'bx_entity_check_' + arEntity[i].ID;
				
				obCheckbox.defaultChecked = false;

				for (var j = 0; j < current_selected.length; j++)
				{
					if (obUserRow.BX_ID == current_selected[j])
					{
						obCheckbox.defaultChecked = true;
						obUserRow.className += ' bx-emp-selected';
						break;
					}
				}
<?
else:
?>
				if (obUserRow.BX_ID == current_selected)
					obUserRow.className += ' bx-emp-selected';

				obUserRow.ondblclick = BXEntitySet;
<?
endif;
?>
				obUserRow.onclick = BXEntitySelect;
				obUserRow.innerHTML = '<div class="bx-entity-info" style="margin-left:0px"><div class="bx-entity-name">' + arEntity[i].NAME + '</div><div class="bx-entity-position">' + arEntity[i].COMPANY_TYPE + '</div></div>';
				
<?
if ($bMultiple):
?>
				obUserRow.insertBefore(obCheckbox, obUserRow.firstChild);
<?
endif;
?>				
				obSectionDiv.appendChild(obUserRow);
			}
			
			var obClearer = obSectionDiv.appendChild(document.createElement('DIV'));
			obClearer.style.clear = 'both';
		}
	}
}

function BXLoadEntity(SECTION_ID, bShowOnly, bScrollToSection)
{
	if (null == bShowOnly) bShowOnly = false;
	if (null == bScrollToSection) bScrollToSection = false;
	
	if (SECTION_ID != 'last' && SECTION_ID != 'all') SECTION_ID = parseInt(SECTION_ID);
	
	var obSection = document.getElementById('bx_entity_section_' + SECTION_ID);
	
	if (null == obSection.BX_LOADED)
	{
		var url = '/bitrix/components/bitrix/crm.entity.search/company.ajax.php?lang=<?echo LANGUAGE_ID?>&MODE=ENTITY&SECTION_ID=' + SECTION_ID + '&SITE_ID=<?=$SITE_ID?>';
		if (bScrollToSection)
		{
			jsUtils.loadJSFile(url,	function(){document.getElementById('bx_entity_search_layout').scrollTop = document.getElementById('bx_entity_section_' + SECTION_ID).offsetTop - 40;});
		}
		else
		{
			jsUtils.loadJSFile(url);
		}
	}
	else if (bScrollToSection)
	{
		document.getElementById('bx_entity_search_layout').scrollTop = document.getElementById('bx_entity_section_' + SECTION_ID).offsetTop - 40;
	}
	
	var obChildren = document.getElementById('bx_children_' + SECTION_ID);
	if (bShowOnly || obChildren.style.display == 'none')
	{
		obSection.firstChild.className = obSection.firstChild.className.replace('bx-emp-closed', 'bx-emp-opened');	
		obChildren.style.display = 'block';
	}
	else
	{
		obSection.firstChild.className = obSection.firstChild.className.replace('bx-emp-opened', 'bx-emp-closed');
		obChildren.style.display = 'none';
	}
}
</script>
<script>
var jsEntSearch = {
	_control: null,
	_timerId: null,
	
	_delay: 500,
	
	_value: '',
	_result: [],
	
	_div: null,
	
	_search_focus: -1,
	
	InitControl: function(control_id)
	{
		this._control = document.getElementById(control_id);
		if (this._control)
		{
			this._control.value = '<?echo CUtil::JSEscape(GetMessage('CRM_ES_SEARCH'))?>';
			this._control.value_tmp = this._control.value;
			
			this._control.className = 'bx-search-control-empty';
			this._control.onfocus = this.__control_focus;
			this._control.onblur = this.__control_blur;
			
			this._control.onkeydown = this.__control_keypress;
		}
	},
	
	Run: function()
	{
		if (null != jsEntSearch._timerId)
			clearTimeout(jsEntSearch._timerId);
		
		jsEntSearch._search_focus = -1;
		
		if (jsEntSearch._control.value && jsEntSearch._control.value != jsEntSearch._control.value_tmp)
		{
			jsEntSearch._value = jsEntSearch._control.value;
			jsUtils.loadJSFile('/bitrix/components/bitrix/crm.entity.search/company.ajax.php?lang=<?echo LANGUAGE_ID?>&MODE=SEARCH&search=' + encodeURIComponent(jsEntSearch._value) + '&SITE_ID=<?=$SITE_ID?>');
		}
	},
	
	SetResult: function(data)
	{
		jsEntSearch._result = data;
		jsEntSearch.Show();
	},
	
	Show: function()
	{
		if (null == jsEntSearch._div)
		{
			var pos = jsUtils.GetRealPos(jsEntSearch._control);
			
			jsEntSearch._div = document.getElementById('_f_popup_content').insertBefore(document.createElement('DIV'), document.getElementById('_f_popup_content').firstChild);
			jsEntSearch._div.className = 'bx-emp-search-result';

			jsEntSearch._div.style.top = (22 + pos.bottom-pos.top) + 'px';
			jsEntSearch._div.style.left = '0px';
			
			jsEntSearch._div.style.zIndex = 1110; 
			
			jsUtils.addCustomEvent('onEntitySearchClose', jsEntSearch.__onclose, [], jsEntSearch);
		}
		else
		{
			jsEntSearch._div.innerHTML = '';
		}
		
		if (jsEntSearch._result.length > 0)
		{
			for (var i = 0; i < jsEntSearch._result.length; i++)
			{
				jsEntSearch._result[i]._row = jsEntSearch._div.appendChild(document.createElement('DIV'));
				jsEntSearch._result[i]._row.className = 'bx-emp-search-result-row';
				jsEntSearch._result[i]._row.innerHTML = jsEntSearch._result[i].NAME+' ['+jsEntSearch._result[i].ID+']';
				
				jsEntSearch._result[i]._row.onclick = jsEntSearch.__result_row_click;
				
				jsEntSearch._result[i]._row.__bx_data = jsEntSearch._result[i];
			}
		}
		else
		{
			jsEntSearch._div.innerHTML = '<i><?echo CUtil::JSEscape(GetMessage('CRM_ES_NOTHING_FOUND'));?></i>';
		}
	},
	
	_openSection: function(SECTION_ID, bScrollToSection)
	{
		if (null == bScrollToSection)
			bScrollToSection = false;
	
		var obSectionDiv = document.getElementById('bx_entity_section_' + SECTION_ID);
		if (null != obSectionDiv)
		{
			var obParentSection = obSectionDiv.parentNode;
			if (null != obParentSection)
			{
				obParentSection = obParentSection.previousSibling;
				
				if (null != obParentSection && obParentSection.id && obParentSection.id.substr(0, 20) == 'bx_entity_section_')
				{
					jsEntSearch._openSection(parseInt(obParentSection.id.substr(20)));
				}
			}
			
			BXLoadEntity(SECTION_ID, true, bScrollToSection);
		}
	},
	
	__result_row_click: function()
	{	
		var obUserRow = document.getElementById('bx_entity_' + this.__bx_data.ID);
		if (null != obUserRow)
		{
		
			if (obUserRow.className != 'bx-entity-row bx-emp-selected')
			{
				obUserRow.onclick();
			}
		}
		else
		{
<?
if (!$bMultiple):
?>

			if (current_selected > 0)
			{
				document.getElementById('bx_entity_' + current_selected).className = 'bx-entity-row';
			}

<?
endif;
?>
			current_selected<?echo $bMultiple ? '[current_selected.length]' : ''?> = parseInt(this.__bx_data.ID);		
		}
	},
	
	__onclose: function()
	{
		if (null != this._div)
			this._div.parentNode.removeChild(this._div);
		
		if (null != this._timerId)
			clearTimeout(this._timerId);
			
		jsUtils.removeCustomEvent('onEntitySearchClose', this.__onclose);
	},
	
	__control_keypress: function(e)
	{
		if (null == e)
			e = window.event;
		
		// 40 - down, 38 - up, 13 - enter
		switch (e.keyCode)
		{
			case 13: //enter
				if (jsEntSearch._search_focus < 0)
					jsEntSearch.Run();
				else
				{
					jsEntSearch._control.onblur();
					jsEntSearch._control.blur();
					jsEntSearch._result[jsEntSearch._search_focus]._row.onclick();
				}
				
			break;
			
			case 40: //down
				if (jsEntSearch._result.length > 0 && jsEntSearch._search_focus < jsEntSearch._result.length-1)
				{
					if (jsEntSearch._search_focus >= 0)
						jsEntSearch._result[jsEntSearch._search_focus]._row.className = 'bx-emp-search-result-row';
					
					jsEntSearch._search_focus++;
					jsEntSearch._result[jsEntSearch._search_focus]._row.className = 'bx-emp-search-result-row bx-emp-search-result-row-selected';
				}
			break;
			
			case 38: //up
				if (jsEntSearch._result.length > 0 && jsEntSearch._search_focus > -1)
				{
					jsEntSearch._result[jsEntSearch._search_focus]._row.className = 'bx-emp-search-result-row';
					jsEntSearch._search_focus--;
					
					if (jsEntSearch._search_focus >= 0)
						jsEntSearch._result[jsEntSearch._search_focus]._row.className = 'bx-emp-search-result-row bx-emp-search-result-row-selected';
				}
			
			break;
			default:
				if (null != jsEntSearch._timerId)
					clearTimeout(jsEntSearch._timerId);
				
				jsEntSearch._timerId = setTimeout(jsEntSearch.Run, jsEntSearch._delay);
			break;
		}
	},
	
	__control_focus: function()
	{
		if (this.value == this.value_tmp) 
		{
			this.value = '';
			this.className = '';
		}

		if (null != jsEntSearch._div)
			jsEntSearch._div.style.display = 'block';
	},
	
	__control_blur: function()
	{
		if (this.value == '') 
		{
			this.value = this.value_tmp;
			this.className = 'bx-search-control-empty';
		}
		
		if (null != jsEntSearch._div)
		{
			setTimeout(function() {
				jsEntSearch._div.style.display = 'none';
			}, 300);
		}
	}
};
</script>
<div class="content" id="_f_popup_content" style="height: 400px; overflow-x: hidden; oveflow-y: auto; padding: 0px;"><input id="bx_emp_search_control" type="text" style="width: 99%" value="" autocomplete="off" />
<script>
jsEntSearch.InitControl('bx_emp_search_control');
</script>

<div class="bx-entity-section-list" id="bx_entity_search_layout">
	<div class="bx-entity-section-first" onclick="BXLoadEntity('last')" id="bx_entity_section_last"><div class="bx-entity-section-name bx-emp-opened"><?echo GetMessage('CRM_ES_LAST')?></div></div>
	<div style="display: none;" id="bx_children_last"><div class="bx-entity-list" id="bx_entitys_last" style="margin-left: 15px"><i><?echo GetMessage('CRM_ES_WAIT')?></i></div></div>
	<script>
	BXLoadEntity('last', true);
	</script>

	<div class="bx-entity-section-first" onclick="BXLoadEntity('all')" id="bx_entity_section_all"><div class="bx-entity-section-name bx-emp-closed"><?=GetMessage('CRM_ES_LIST')?></div></div>
	<div style="display: none" id="bx_children_all"><div class="bx-entity-list" id="bx_entitys_all" style="margin-left: 15px"><i><?=GetMessage('CRM_ES_WAIT')?></i></div></div>
	<script>
		BXLoadEntity('all', true);
	</script>
	</div>
</div>
<div class="buttons">
	<input type="button" id="submitbtn" value="<?echo GetMessage('CRM_ES_SUBMIT')?>" onclick="BXEntitySet();" title="<?echo GetMessage('CRM_ES_SUBMIT_TITLE')?>" />
	<input type="button" value="<?echo GetMessage('CRM_ES_CANCEL')?>" onclick="document.getElementById('<?echo $win_id?>').__object.CloseDialog();" title="<?echo GetMessage('CRM_ES_CANCEL_TITLE')?>" />
</div>
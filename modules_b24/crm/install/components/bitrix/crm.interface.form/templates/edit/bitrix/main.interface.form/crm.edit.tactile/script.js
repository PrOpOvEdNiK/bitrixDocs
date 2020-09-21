if(typeof(BX.CrmEditFormManager) === "undefined")
{
	BX.CrmEditFormManager = function()
	{
		this._id = "";
		this._settings = null;
		this._form = null;
		this._formId = "";
		this._tabId = "";
		this._settingsManager = null;
		this._userFieldManager = null;
	};
	BX.CrmEditFormManager.prototype =
	{
		initialize: function(id, settings)
		{
			this._id = BX.type.isNotEmptyString(id) ? id : BX.util.getRandomString(8);
			this._settings = settings ? settings : {};

			this._form = this.getSetting("form", null);
			this._formId = this.getSetting("formId", "");

			this._tabId = this.getSetting("tabId", "");
			if(!BX.type.isNotEmptyString(this._tabId))
			{
				this._tabId = "tab_1";
			}

			if(!BX.type.isNotEmptyString(this._formId))
			{
				throw "Error: The 'formId' parameter is not defined in settings or empty.";
			}
			this._settingsManager = BX.CrmFormSettingManager.create(
				this._id,
				{
					formId: this._formId,
					manager: this,
					form: this._form,
					sectionWrapperId: this.getSetting("sectionWrapperId", ""),
					undoContainerId: this.getSetting("undoContainerId", ""),
					tabId: this._tabId,
					metaData: this.getSetting("metaData", {}),
					hiddenMetaData: this.getSetting("hiddenMetaData", {}),
					isSettingsApplied: this.getSetting("isSettingsApplied", false),
					canCreateUserField: this.getSetting("canCreateUserField", false),
					canSaveSettingsForAll: this.getSetting("canSaveSettingsForAll", false)
				}
			);

			var userFieldEntityId = this.getSetting("userFieldEntityId", "");
			if(BX.type.isNotEmptyString(userFieldEntityId))
			{
				this._userFieldManager = BX.CrmFormUserFieldManager.create(
					this._id,
					{
						manager: this,
						serviceUrl: this.getSetting("userFieldServiceUrl"),
						serverTime: this.getSetting("serverTime"),
						//imagePath: this.getSetting("imagePath"),
						entityId: userFieldEntityId,
						canCreate: this.getSetting("canCreateUserField", false),
						addFieldButton: this._formId + "_add_field"
					}
				);
			}
		},
		getSetting: function (name, defaultval)
		{
			return this._settings.hasOwnProperty(name) ? this._settings[name] : defaultval;
		},
		getId: function()
		{
			return this._id;
		},
		getSettingsManager: function()
		{
			return this._settingsManager;
		},
		getUserFieldManager: function()
		{
			return this._userFieldManager;
		},
		enableFieldDragging: function(fieldId, enable)
		{
			this._settingsManager.enableFieldDragging(fieldId, enable);
		}
	};
	BX.CrmEditFormManager.items = {};
	BX.CrmEditFormManager.create = function(id, settings)
	{
		var self = new BX.CrmEditFormManager();
		self.initialize(id, settings);
		this.items[self.getId()] = self;
		return self;
	};
}
if(typeof(BX.CrmFormSettingManager) === "undefined")
{
	BX.CrmFormSettingManager = function()
	{
		this._id = "";
		this._settings = null;

		this._manager = null;
		this._form = null;
		this._formId = "";
		this._sectionWrapperId = "";
		this._undoContainerId = "";
		this._menuButton = null;
		this._menu = null;
		this._menuId = "";
		this._isMenuShown = false;

		this._tabId = "";
		this._metaData = null;
		this._hiddenMetaData = null;
		this._editData = null;
		this._isSettingsApplied = false;

		this._dragDropControllers = {};
		this._dragDropUndoData = null;
		this._sectionSettings = {};
		this._fieldSettings = {};
		this._temporaryFields = {};
		this._temporaryFieldCounter = 0;

		this._canCreateUserField = false;
		this._reload = false;
	};
	BX.CrmFormSettingManager.prototype =
	{
		initialize: function(id, settings)
		{
			this._id = BX.type.isNotEmptyString(id) ? id : BX.util.getRandomString(8);
			this._settings = settings ? settings : {};

			this._form = this.getSetting("form", null);
			this._formId = this.getSetting("formId", "");
			if(!BX.type.isNotEmptyString(this._formId))
			{
				throw "Error: The 'formId' parameter is not defined in settings or empty.";
			}

			this._menuButton = BX(this._formId + "_menu");
			if(this._menuButton)
			{
				BX.bind(this._menuButton, "click", BX.delegate(this._onMenuButtonClick, this));
			}

			this._menuId = this._id.toLowerCase() + "_main_menu";
			this._sectionWrapperId = this.getSetting("sectionWrapperId", "");
			this._undoContainerId = this.getSetting("undoContainerId", "");

			this._tabId = this.getSetting("tabId", "");
			if(!BX.type.isNotEmptyString(this._tabId))
			{
				this._tabId = "tab_1";
			}

			this._metaData = this.getSetting("metaData", null);
			if(!BX.type.isPlainObject(this._metaData))
			{
				throw "Error: The 'metaData' parameter is not defined in settings or empty.";
			}

			this._hiddenMetaData = this.getSetting("hiddenMetaData", null);
			if(BX.type.isArray(this._hiddenMetaData))
			{
				this._hiddenMetaData = {};
			}
			else if(!BX.type.isPlainObject(this._hiddenMetaData))
			{
				throw "Error: The 'hiddenMetaData' parameter is not defined in settings or empty.";
			}

			this._manager = this.getSetting("manager", null);

			this._canCreateUserField = this.getSetting("canCreateUserField", false);

			this._isSettingsApplied = this.getSetting("isSettingsApplied", false);
			this._initializeFromMetaData();
		},
		_initializeFromMetaData: function()
		{
			// Initialize edit data
			this._editData = [];
			for(var k in this._metaData)
			{
				if(!this._metaData.hasOwnProperty(k))
				{
					continue;
				}

				var tabInfo = BX.clone(this._metaData[k]);

				var fieldInfos = [];
				var fieldMetaData = BX.type.isPlainObject(this._metaData[k]["fields"]) ? this._metaData[k]["fields"] : {};
				for(var l in fieldMetaData)
				{
					if(fieldMetaData.hasOwnProperty(l))
					{
						fieldInfos.push(BX.clone(fieldMetaData[l]));
					}
				}

				tabInfo["fields"] = fieldInfos;
				this._editData.push(tabInfo);
			}

			// Initialize drag & drop for fields and sections
			var data = this._metaData.hasOwnProperty(this._tabId) ? this._metaData[this._tabId] : null;
			if(typeof(data) !== "object")
			{
				throw "Error: Could not find '" + this._tabId + "' in metaData.";
			}

			var fields = data["fields"];
			if(!BX.type.isPlainObject(fields))
			{
				return;
			}

			var fieldDragDropContainers = [];
			for(var fieldId in fields)
			{
				if(!fields.hasOwnProperty(fieldId))
				{
					continue;
				}

				var info = fields[fieldId];
				var type = BX.type.isNotEmptyString(info["type"]) ? info["type"] : "";
				if(type === "section")
				{
					//var sectionTable = BX(fieldId.toLowerCase() + "_contents");
					//var sectionNode  = sectionTable ? sectionTable.tBodies[0] : null;
					var sectionNode  = BX(fieldId.toLowerCase() + "_contents");
					if(!sectionNode)
					{
						continue;
					}

					this._sectionSettings[fieldId] = BX.CrmFormSectionSetting.create(
						fieldId,
						{ manager: this, data: info }
					);

					fieldDragDropContainers.push(
						{
							id: fieldId,
							node: sectionNode,
							enableDrag: true,
							enableDrop: true,
							allowedDragEffects: "move",
							dragEndCallback: BX.delegate(this._onFieldDragEnd, this)
						}
					);
				}
				else
				{
					var fieldNode = BX(fieldId.toLowerCase() + "_wrap");
					if(!fieldNode)
					{
						continue;
					}

					this._fieldSettings[fieldId] = BX.CrmFormFieldSetting.create(
						fieldId,
						{ manager: this, data: info }
					);
				}
			}

			this._dragDropControllers["field"] = BX.DragDropController.create(
				this._formId.toLowerCase() + "_field",
				{
					prefix: this._formId.toLowerCase(),
					enableAutoInitialization: true,
					enableMouseOverCursorFix: false,
					enableDragEffectFix: true,
					contextId: "field",
					containers: fieldDragDropContainers
				}
			);

			this._dragDropControllers["section"] = BX.DragDropController.create(
				this._formId.toLowerCase() + "_section",
				{
					prefix: this._formId.toLowerCase(),
					enableAutoInitialization: true,
					enableMouseOverCursorFix: true,
					enableDragEffectFix: true,
					contextId: "section",
					containers:
					[
						{
							id: this._formId,
							node: this._sectionWrapperId,
							enableDrag: true,
							enableDrop: true,
							allowedDragEffects: "move",
							dropCallback: BX.delegate(this._onSectionDrop, this),
							dragEndCallback: BX.delegate(this._onSectionDragEnd, this)
						}
					]
				}
			);
		},
		getSetting: function (name, defaultval)
		{
			return this._settings.hasOwnProperty(name) ? this._settings[name] : defaultval;
		},
		getId: function()
		{
			return this._id;
		},
		getFormId: function()
		{
			return this._formId;
		},
		getTabId: function()
		{
			return this._tabId;
		},
		getFormNodeId: function()
		{
			return "form_" + this._formId;
		},
		getHiddenFieldInfos: function()
		{
			var result = [];
			for(var k in this._hiddenMetaData)
			{
				if(!this._hiddenMetaData.hasOwnProperty(k))
				{
					continue;
				}

				var info = this._hiddenMetaData[k];
				var type = BX.type.isNotEmptyString(info["type"]) ? info["type"] : "";
				if(type === "section")
				{
					continue;
				}
				result.push(info);
			}
			return result;
		},
		canCreateUserField: function()
		{
			return this._canCreateUserField;
		},
		createTemporaryField: function(type, section)
		{
			this._temporaryFieldCounter++;
			var label = this.getMessage("newFieldName") + " " + this._temporaryFieldCounter.toString();
			var userField = this._manager.getUserFieldManager().createTemporaryField({ type: type, label: label });

			var table = section.getContentsNode();
			var index = table.rows.length - 1;
			var temporaryId = userField.getFieldName();

			var fieldType = "text";
			if(type === "boolean")
			{
				fieldType = "checkbox";
			}
			else if(type === "datetime")
			{
				fieldType = "date";
			}

			var field = BX.CrmFormFieldSetting.create(
				temporaryId,
				{
					data: { id: temporaryId, type: fieldType, userFieldType: type, name: label },
					isTemporary: true,
					editMode: true,
					manager: this,
					node: BX.CrmFormFieldRenderer.renderUserFieldRow(userField, table, index)
				}
			);
			this._temporaryFields[temporaryId] = { field: field, section: section };
		},
		createSection: function(precedingSection)
		{
			var loc = this.getSectionLocation(precedingSection.getId());
			var index = loc.index;
			if(index < 0)
			{
				return;
			}

			index += loc.length + 1;

			var sectionId = "section_" + BX.util.getRandomString(8).toLocaleLowerCase();
			var data = { type: "section", id: sectionId, name: this.getMessage("newSectionName") };

			var tabQty = this._editData.length;
			for(var i = 0; i < tabQty; i++)
			{

				var tabInfo = this._editData[i];
				if(tabInfo["id"] !== this._tabId)
				{
					continue;
				}

				var fields = tabInfo["fields"];
				if(!BX.type.isArray(fields))
				{
					return;
				}

				if(index >= fields.length)
				{
					fields.push(data);
				}
				else
				{
					fields.splice(index, 0, data);
				}
			}

			var table = BX.CrmFormFieldRenderer.renderSectionTable(data, precedingSection.getContentsNode());
			this._sectionSettings[sectionId] = BX.CrmFormSectionSetting.create(
				sectionId,
				{
					data: data,
					editMode: true,
					manager: this
				}
			);

			var headRow = table.rows[0];
			headRow.draggable = true;
			headRow.setAttribute("data-dragdrop-id", sectionId);
			headRow.setAttribute("data-dragdrop-context", "field");

			var dragDropController = this._dragDropControllers["section"];
			dragDropController.registerItem(
				dragDropController.createItem(sectionId, headRow),
				this._formId
			);

			dragDropController = this._dragDropControllers["field"];
			var container =  BX.DragDropContainer.create(
				sectionId,
				{
					node: table,
					enableDrag: true,
					enableDrop: true,
					allowedDragEffects: "move",
					dragEndCallback: BX.delegate(this._onFieldDragEnd, this)
				}
			);
			dragDropController.registerContainer(container);
			this.save(false);
		},
		getTabFields: function()
		{
			var tabQty = this._editData.length;
			for(var i = 0; i < tabQty; i++)
			{

				var tabInfo = this._editData[i];
				if(tabInfo["id"] !== this._tabId)
				{
					continue;
				}

				return tabInfo["fields"];
			}
			return null;
		},
		getFieldIndex: function(fieldId)
		{
			if(!BX.type.isNotEmptyString(fieldId))
			{
				return -1;
			}

			var tabQty = this._editData.length;
			for(var i = 0; i < tabQty; i++)
			{

				var tabInfo = this._editData[i];
				if(tabInfo["id"] !== this._tabId)
				{
					continue;
				}

				var fields = tabInfo["fields"];
				if(!BX.type.isArray(fields))
				{
					return -1;
				}

				var fieldQty = fields.length;
				for(var j = 0; j < fieldQty; j++)
				{
					var fieldInfo = fields[j];
					if(fieldInfo["id"] === fieldId)
					{
						return j;
					}
				}
			}
			return -1;
		},
		setFieldIndex: function(fieldId, newIndex, oldIndex)
		{
			if(!BX.type.isNotEmptyString(fieldId)
				|| !BX.type.isNumber(newIndex)
				|| newIndex < 0)
			{
				return false;
			}

			oldIndex = parseInt(oldIndex);
			if(isNaN(oldIndex) || oldIndex < 0)
			{
				oldIndex = this.getFieldIndex(fieldId);
			}

			if(oldIndex < 0)
			{
				return false;
			}

			if(newIndex === oldIndex)
			{
				return true;
			}

			var tabQty = this._editData.length;
			for(var i = 0; i < tabQty; i++)
			{

				var tabInfo = this._editData[i];
				if(tabInfo["id"] !== this._tabId)
				{
					continue;
				}

				var fields = tabInfo["fields"];
				if(!BX.type.isArray(fields))
				{
					return false;
				}

				var fieldInfo = fields[oldIndex];
				fields.splice(oldIndex, 1);
				if((newIndex - oldIndex) > 1)
				{
					newIndex--;
				}

				if(newIndex >= fields.length)
				{
					fields.push(fieldInfo);
				}
				else
				{
					fields.splice(newIndex, 0, fieldInfo);
				}
			}

			return this.save(false);
		},
		removeField: function(fieldId)
		{
			var result = this._removeField(fieldId) && this.save(false);
			if(result)
			{
				this._dragDropUndoData = null;
				BX.cleanNode(BX(this._undoContainerId), false);
			}
			return result;
		},
		restoreField: function(fieldId, sectionId)
		{
			if(!BX.type.isNotEmptyString(fieldId))
			{
				return false;
			}

			if(!BX.type.isNotEmptyString(sectionId))
			{
				return false;
			}

			if(!this._hiddenMetaData.hasOwnProperty(fieldId))
			{
				return false;
			}
			var fieldInfo = this._hiddenMetaData[fieldId];

			var loc = this.getSectionLocation(sectionId);
			var index = loc.index;
			if(index < 0)
			{
				return false;
			}

			index += loc.length + 1;
			var tabQty = this._editData.length;
			for(var i = 0; i < tabQty; i++)
			{

				var tabInfo = this._editData[i];
				if(tabInfo["id"] !== this._tabId)
				{
					continue;
				}

				var fields = tabInfo["fields"];
				if(!BX.type.isArray(fields))
				{
					return false;
				}

				if(index >= fields.length)
				{
					fields.push(fieldInfo);
				}
				else
				{
					fields.splice(index, 0, fieldInfo);
				}
			}

			this._reload = true;
			this.save(false);
			return true;
		},
		getSectionLocation: function(sectionId)
		{
			if(!BX.type.isNotEmptyString(sectionId))
			{
				return { index: -1, length: 0, fields: [] };
			}

			var tabQty = this._editData.length;
			for(var i = 0; i < tabQty; i++)
			{
				var tabInfo = this._editData[i];
				if(tabInfo["id"] !== this._tabId)
				{
					continue;
				}

				var fields = tabInfo["fields"];
				if(!BX.type.isArray(fields))
				{
					return { index: -1, length: 0, fields: [] };
				}

				var sectionFields = [];
				var sectionIndex = -1;
				var length = 0;
				var fieldQty = fields.length;
				for(var j = 0; j < fieldQty; j++)
				{
					var fieldInfo = fields[j];
					if(fieldInfo["type"] === "section")
					{
						if(sectionIndex >= 0)
						{
							break;
						}
						else if(fieldInfo["id"] === sectionId)
						{
							sectionIndex = j;
						}
					}
					else if(sectionIndex >= 0)
					{
						sectionFields.push(fieldInfo["id"]);
						length++;
					}
				}
				return { index: sectionIndex, length: length, fields: sectionFields };
			}
			return { index: -1, length: 0, fields: [] };
		},
		getSectionIndex: function(sectionId)
		{
			var loc = this.getSectionLocation(sectionId);
			return loc.index;
		},
		setSectionIndex: function(sectioId, newIndex, loc)
		{
			if(!BX.type.isNotEmptyString(sectioId))
			{
				return false;
			}

			if(!BX.type.isNumber(newIndex) || newIndex < 0)
			{
				return false;
			}

			if(!loc)
			{
				loc = this.getSectionLocation(sectioId);
			}

			var oldIndex = loc.index;
			if(oldIndex < 0)
			{
				return false;
			}

			if(newIndex === oldIndex)
			{
				return true;
			}

			var tabQty = this._editData.length;
			for(var i = 0; i < tabQty; i++)
			{

				var tabInfo = this._editData[i];
				if(tabInfo["id"] !== this._tabId)
				{
					continue;
				}

				var fields = tabInfo["fields"];
				if(!BX.type.isArray(fields))
				{
					return false;
				}

				var sectionInfo = fields[oldIndex];
				var sectionFieldInfos = [];
				var length  = loc.length;
				if(length > 0)
				{
					var lastFieldIndex = oldIndex + length;
					for(var j = (oldIndex + 1); j <= lastFieldIndex; j++)
					{
						sectionFieldInfos.push(fields[j]);
					}
					fields.splice(oldIndex + 1, length);
				}

				fields.splice(oldIndex, 1);
				if(newIndex >= oldIndex)
				{
					newIndex -= loc.length + 1;
				}

				if(newIndex >= fields.length)
				{
					fields.push(sectionInfo);
					for(var k = 0; k < sectionFieldInfos.length; k++)
					{
						fields.push(sectionFieldInfos[k]);
					}
				}
				else
				{
					fields.splice(newIndex, 0, sectionInfo);
					for(var l = 0; l < sectionFieldInfos.length; l++)
					{
						fields.splice(newIndex + l + 1, 0, sectionFieldInfos[l]);
					}
				}
			}

			return this.save(false);
		},
		getSectionFieldIds: function(sectionId)
		{
			var loc = this.getSectionLocation(sectionId);
			return loc.fields;
		},
		setupField: function(fieldId, fieldData)
		{
			var index = this.getFieldIndex(fieldId);
			if(index < 0)
			{
				return false;
			}

			var fields = this.getTabFields();
			if(!BX.type.isArray(fields))
			{
				return false;
			}

			fields[index] = fieldData;
			return this.save(false);
		},
		save: function(forAllUsers)
		{
			if(!this._form)
			{
				return false;
			}

			BX.showWait();
			this._form.aTabsEdit = BX.clone(this._editData);

			var options = { callback: BX.delegate(this._onSettingsSave, this) };
			if(!!forAllUsers && this.getSetting("canSaveSettingsForAll", false))
			{
				options["setDefaultSettings"] = true;
				options["deleteUserSettings"] = true;
			}

			this._form.SaveSettings(options);
			return true;
		},
		reset: function()
		{
			this._form.EnableSettings(false);
		},
		processFieldEditStart: function(field)
		{
			this._dragDropControllers["field"].enableItemDragging(field.getId(), false);
		},
		processFieldEditEnd: function(field)
		{
			var fieldId =  field.getId();
			if(!field.isTemporary())
			{
				this._dragDropControllers["field"].enableItemDragging(fieldId, true);
				this.setupField(fieldId, field.getData());
				return true;
			}

			this._manager.getUserFieldManager().createField(
				{ type: field.getUserFieldType(), name: field.getName() },
				fieldId,
				BX.delegate(this._onUserFieldCreate, this)
			);
			return false;
		},
		processFieldEditCancelation: function(field)
		{
			if(!field.isTemporary())
			{
				this._dragDropControllers["field"].enableItemDragging(field.getId(), true);
				return true;
			}

			// Forget it!
			var row = field.getNode();
			BX.findParent(row, { tagName: "TABLE" }).deleteRow(row.rowIndex);
			field.release(false);
			delete this._temporaryFields[field.getId()];
			return false;
		},
		processSectionEditStart: function(section)
		{
			this._dragDropControllers["section"].enableItemDragging(section.getId(), false);
		},
		processSectionEditEnd: function(section)
		{
			var sectionId =  section.getId();
			this._dragDropControllers["section"].enableItemDragging(sectionId, true);
			this.setupField(sectionId, section.getData());
			return true;
		},
		processSectionRemove: function(section)
		{
			var sectionId = section.getId();
			var loc = this.getSectionLocation(sectionId);
			if(loc.index < 0)
			{
				return false;
			}

			var fieldIds = loc.fields;
			for(var i = 0; i < fieldIds.length; i++)
			{
				var fieldId = fieldIds[i];
				if(typeof(this._fieldSettings[fieldId]) === "undefined")
				{
					continue;
				}

				var field = this._fieldSettings[fieldId];
				delete this._fieldSettings[fieldId];
				var fieldRow = field.getNode();
				BX.findParent(fieldRow, { tagName: "TABLE" }).deleteRow(fieldRow.rowIndex);
				field.release(false);

				this._removeField(fieldId);
			}

			delete this._sectionSettings[sectionId];
			var sectionTable = section.getContentsNode();
			BX.findParent(sectionTable, { tagName: "DIV", className: "crm-offer-main-wrap" }).removeChild(sectionTable);
			section.release(false);

			return (this._removeField(sectionId) && this.save(false));
		},
		processFieldRemove: function(field)
		{
			var fieldId = field.getId();
			delete this._fieldSettings[fieldId];

			var row = field.getNode();
			BX.findParent(row, { tagName: "TABLE" }).deleteRow(row.rowIndex);
			field.release(false);

			this.removeField(fieldId);
			return true;
		},
		getMessage: function(name)
		{
			var m = BX.CrmFormSettingManager.messages;
			return m.hasOwnProperty(name) ? m[name] : name;
		},
		enableFieldDragging: function(fieldId, enable)
		{
			var controller = this._dragDropControllers["field"];
			if(controller)
			{
				controller.enableItemDragging(fieldId, enable);
			}
		},
		_findNextDragDropFieldNode: function(node)
		{
			return BX.findNextSibling(node, { tagName: "TR", className: "crm-offer-row" });
		},
		_findNextDragDropSectionNode: function(node)
		{
			return BX.findNextSibling(node, { tagName: "TABLE", className: "crm-offer-info-table" });
		},
		_moveDragDropFieldNode: function(node, containerNode, insertBeforeNode)
		{
			if(!BX.type.isDomNode(insertBeforeNode))
			{
				insertBeforeNode = containerNode.rows[containerNode.rows.length - 1];
			}

			containerNode.tBodies[0].insertBefore(node, insertBeforeNode);
		},
		_moveDragDropSectionNode: function(node, insertBeforeNode)
		{
			var wrapper = BX(this._sectionWrapperId);

			if(BX.type.isDomNode(insertBeforeNode))
			{
				wrapper.insertBefore(node, insertBeforeNode);
			}
			else
			{
				wrapper.appendChild(node);
			}
		},
		_removeField: function(fieldId)
		{
			if(!BX.type.isNotEmptyString(fieldId))
			{
				return false;
			}

			var oldIndex = this.getFieldIndex(fieldId);
			if(oldIndex < 0)
			{
				return false;
			}

			var tabQty = this._editData.length;
			for(var i = 0; i < tabQty; i++)
			{

				var tabInfo = this._editData[i];
				if(tabInfo["id"] !== this._tabId)
				{
					continue;
				}

				var fields = tabInfo["fields"];
				if(!BX.type.isArray(fields))
				{
					return false;
				}

				this._hiddenMetaData[fieldId] = fields[oldIndex];
				fields.splice(oldIndex, 1);
			}

			return true;
		},
		_onUserFieldCreate: function(sender, temporaryId, userField)
		{
			if(!BX.type.isNotEmptyString(temporaryId))
			{
				return;
			}

			if(typeof(this._temporaryFields[temporaryId]) === "undefined")
			{
				return;
			}

			var temporaryField = this._temporaryFields[temporaryId]["field"];
			var section = this._temporaryFields[temporaryId]["section"];

			var data = temporaryField.getData();
			var sectionId = section.getId();
			var fieldId = data["id"] = userField.getFieldName();

			var loc = this.getSectionLocation(sectionId);
			if(loc.index < 0)
			{
				throw "Error: Could not find '" + sectionId + "' section location.";
			}
			var index = (loc.index + loc.length + 1);

			var table = section.getContentsNode();
			temporaryField.release(false);
			table.deleteRow(temporaryField.getNode().rowIndex);

			var tabQty = this._editData.length;
			for(var i = 0; i < tabQty; i++)
			{

				var tabInfo = this._editData[i];
				if(tabInfo["id"] !== this._tabId)
				{
					continue;
				}

				var fields = tabInfo["fields"];
				if(!BX.type.isArray(fields))
				{
					return;
				}

				if(index >= fields.length)
				{
					fields.push(data);
				}
				else
				{
					fields.splice(index, 0, data);
				}
				break;
			}

			var node = BX.CrmFormFieldRenderer.renderUserFieldRow(userField, table, (table.rows.length - 1));
			this._fieldSettings[fieldId] = BX.CrmFormFieldSetting.create(fieldId, { data: data, manager: this, node: node });

			node.draggable = true;
			node.setAttribute("data-dragdrop-id", fieldId);
			node.setAttribute("data-dragdrop-context", "field");

			var dragDropController = this._dragDropControllers["field"];
			dragDropController.registerItem(
				dragDropController.createItem(fieldId, node),
				sectionId
			);

			this.save(false);
		},
		_onFieldDragEnd: function(item, container, controller, event)
		{
			if (event.dataTransfer.dropEffect !== "move")
			{
				return;
			}

			var dropContainer = controller.getCurrentDropContainer();
			if(!dropContainer)
			{
				return;
			}

			var dropItem = controller.getCurrentDropItem();
			if(item === dropItem)
			{
				return;
			}

			var dragItemId = item.getId();
			//var dragContainerId = container.getId();
			var dropItemId = dropItem ? dropItem.getId() : "";
			var dropContainerId = dropContainer.getId();

			// Modification of DOM
			var itemNode = item.getNode();
			var anchorItemNode = this._findNextDragDropFieldNode(itemNode);
			container.removeItem(item);
			item.release(true);
			this._moveDragDropFieldNode(itemNode, dropContainer.getNode(), dropItem ? dropItem.getNode() : null);
			var newItem = dropContainer.createItem(item.getId(), itemNode);

			// Store settings
			var newIndex = -1;
			if(dropItemId !== "")
			{
				newIndex = this.getFieldIndex(dropItemId);
			}
			else
			{
				var loc = this.getSectionLocation(dropContainerId);
				if(loc.index < 0)
				{
					throw "Error: Could not get section layout info.";
				}
				newIndex = loc.index + loc.length + 1;
			}

			var oldIndex = this.getFieldIndex(dragItemId);
			if(oldIndex >= 0 && this.setFieldIndex(dragItemId, newIndex, oldIndex))
			{
				newIndex = this.getFieldIndex(dragItemId);
				if(newIndex <= oldIndex)
				{
					oldIndex++;
				}

				this._dragDropUndoData =
					{
						type: "field",
						item: newItem,
						container: container,
						anchorNode: anchorItemNode,
						oldIndex: oldIndex,
						newIndex: this.getFieldIndex(dragItemId)
					};

				var undoContainer = BX(this._undoContainerId);
				if(undoContainer)
				{
					BX.cleanNode(undoContainer, false);
					undoContainer.appendChild(
						BX.create("DIV",
							{
								props: { className: "crm-view-message" },
								children:
								[
									BX.create("SPAN", { text: this.getMessage("saved") + " " }),
									BX.create("A",
										{
											props: { href: "#" },
											events: { click: BX.delegate(this._onSettingsChangeUndo, this) },
											text: this.getMessage("undo")
										}
									)
								]
							}
						)
					);
				}
			}
		},
		_onSectionDrop: function(item, container, controller, event)
		{
			if(controller.getCurrentDropItem())
			{
				return;
			}

			if(container.getNode() !== BX(this._sectionWrapperId))
			{
				return;
			}

			var target = BX.getEventTarget(event);
			if(!target)
			{
				return;
			}

			var table = BX.findParent(target, { tagName: "TABLE", className: "crm-offer-info-table" });
			if(table && table.rows.length > 0)
			{
				var dropItem = controller.findItemByNode(table.rows[0]);
				if(dropItem)
				{
					controller.setCurrentDropItem(dropItem);
				}
			}
		},
		_onSectionDragEnd: function(item, container, controller, event)
		{
			if (event.dataTransfer.dropEffect !== "move")
			{
				return;
			}

			if(!controller.getCurrentDropContainer())
			{
				return;
			}

			var dropItem = controller.getCurrentDropItem();
			if(!dropItem || item === dropItem)
			{
				return;
			}

			var dragItemId = item.getId();
			var dropItemId = dropItem.getId();

			var itemWrapper = BX(dragItemId.toLowerCase() + "_contents");
			var anchorWrapper = this._findNextDragDropSectionNode(itemWrapper);
			// Modification of DOM
			this._moveDragDropSectionNode(itemWrapper, BX(dropItemId.toLowerCase() + "_contents"));

			var loc = this.getSectionLocation(dragItemId);
			var oldIndex = loc.index;
			var newIndex = this.getFieldIndex(dropItemId);

			// Store settings
			if(oldIndex >= 0 && this.setSectionIndex(dragItemId, newIndex, loc))
			{
				loc = this.getSectionLocation(dragItemId);
				newIndex = loc.index;
				if(newIndex <= oldIndex)
				{
					oldIndex += loc.length + 1;
				}

				this._dragDropUndoData =
					{
						type: "section",
						item: item,
						container: container,
						anchorNode: anchorWrapper,
						oldIndex: oldIndex,
						newIndex: newIndex
					};

				var undoContainer = BX(this._undoContainerId);
				if(undoContainer)
				{
					BX.cleanNode(undoContainer, false);
					undoContainer.appendChild(
						BX.create("DIV",
							{
								props: { className: "crm-view-message" },
								children:
								[
									BX.create("SPAN", { text: this.getMessage("saved") + " " }),
									BX.create("A",
										{
											props: { href: "#" },
											events: { click: BX.delegate(this._onSettingsChangeUndo, this) },
											text: this.getMessage("undo")
										}
									)
								]
							}
						)
					);
				}
			}
		},
		_onSettingsSave: function()
		{
			if(this._isSettingsApplied)
			{
				BX.closeWait();
				if(this._reload)
				{
					this._form.Reload();
				}
				return;
			}

			this._form.EnableSettings(true, BX.delegate(this._onSettingsApply, this));
		},
		_onSettingsApply: function()
		{
			BX.closeWait();
			this._isSettingsApplied = true;

			if(this._reload)
			{
				this._form.Reload();
			}
		},
		_onResetMenuItemClick: function()
		{
			this._closeMenu();
			this.reset();
		},
		_onSaveForAllMenuItemClick: function()
		{
			this._closeMenu();
			this.save(true);
		},
		_onMenuButtonClick: function(e)
		{
			if(!e)
			{
				e = window.event;
			}

			this._openMenu();
			return BX.PreventDefault(e);
		},
		_openMenu: function()
		{
			if(this._isMenuShown)
			{
				return;
			}

			var menuItems =
			[
				{
					id: "reset",
					text: this.getMessage("resetMenuItem"),
					onclick: BX.delegate(this._onResetMenuItemClick, this)
				}
			];

			if(this.getSetting("canSaveSettingsForAll", false))
			{
				menuItems.push(
					{
						id: "saveForAll",
						text: this.getMessage("saveForAllMenuItem"),
						onclick: BX.delegate(this._onSaveForAllMenuItemClick, this)
					}
				);
			}

			if(typeof(BX.PopupMenu.Data[this._menuId]) !== "undefined")
			{
				BX.PopupMenu.Data[this._menuId].popupWindow.destroy();
				delete BX.PopupMenu.Data[this._menuId];
			}

			this._menu = BX.PopupMenu.create(
				this._menuId,
				this._menuButton,
				menuItems,
				{
					autoHide: true,
					offsetTop: 0,
					offsetLeft: 0,
					angle:
					{
						position: "top",
						offset: 10
					},
					events:
					{
						onPopupClose : BX.delegate(this._onMenuClose, this)
					}
				}
			);

			this._menu.popupWindow.show();
			this._isMenuShown = true;
		},
		_closeMenu: function()
		{
			if(this._menu && this._menu.popupWindow)
			{
				this._menu.popupWindow.close();
			}
		},
		_onMenuClose: function()
		{
			this._menu = null;
			if(typeof(BX.PopupMenu.Data[this._menuId]) !== "undefined")
			{
				BX.PopupMenu.Data[this._menuId].popupWindow.destroy();
				delete BX.PopupMenu.Data[this._menuId];
			}
			this._isMenuShown = false;
		},
		_onSettingsChangeUndo: function(e)
		{
			if(this._dragDropUndoData !== null)
			{
				var item = this._dragDropUndoData["item"];
				if(this._dragDropUndoData["type"] === "field")
				{
					var container = this._dragDropUndoData["container"];
					var node = item.getNode();
					container.removeItem(item);
					item.release(true);

					this._moveDragDropFieldNode(node, container.getNode(), this._dragDropUndoData["anchorNode"]);
					container.createItem(item.getId(), node);

					this.setFieldIndex(
						item.getId(),
						this._dragDropUndoData["oldIndex"],
						this._dragDropUndoData["newIndex"]
					);
				}
				else if(this._dragDropUndoData["type"] === "section")
				{
					this._moveDragDropSectionNode(
						BX(item.getId().toLowerCase() + "_contents"),
						this._dragDropUndoData["anchorNode"]
					);

					this.setSectionIndex(
						item.getId(),
						this._dragDropUndoData["oldIndex"]
					);
				}

				this._dragDropUndoData = null;
			}

			BX.cleanNode(BX(this._undoContainerId), false);
			return BX.PreventDefault(e);
		}
	};
	if(typeof(BX.CrmFormSettingManager.messages) === "undefined")
	{
		BX.CrmFormSettingManager.messages = {};
	}
	BX.CrmFormSettingManager.items = {};
	BX.CrmFormSettingManager.create = function(id, settings)
	{
		var self = new BX.CrmFormSettingManager();
		self.initialize(id, settings);
		this.items[self.getId()] = self;
		return self;
	};
}
if(typeof(BX.CrmFormFieldSetting) === "undefined")
{
	BX.CrmFormFieldSetting = function()
	{
		this._id = "";
		this._settings = null;

		this._manager = null;
		this._data = null;

		this._type = "";
		this._userFieldType = "";
		this._node = null;
		this._editButton = null;
		this._delButton = null;
		this._labelWrapper = null;
		this._dataWrapper = null;
		this._nameInput = null;
		this._buttonWrapper = null;
		this._saveButton = null;
		this._cancelButton = null;
		this._cover = null;

		this._editMode = false;
		this._isTemporary = false;

		this._editButtonClickHandler = BX.delegate(this._onEditButtonClick, this);
		this._deleteButtonClickHandler = BX.delegate(this._onDeleteButtonClick, this);
		this._saveButtonClickHandler = BX.delegate(this._onSaveButtonClick, this);
		this._cancelButtonClickHandler = BX.delegate(this._onCancelButtonClick, this);
	};
	BX.CrmFormFieldSetting.prototype =
	{
		initialize: function(id, settings)
		{
			this._id = BX.type.isNotEmptyString(id) ? id : BX.util.getRandomString(8);
			this._settings = settings ? settings : {};

			this._manager = this.getSetting("manager");
			if(!(this._manager instanceof BX.CrmFormSettingManager))
			{
				throw "Error: The 'manager' argument must be CrmFormSettingManager instance.";
			}

			this._data = this.getSetting("data");
			if(!BX.type.isPlainObject(this._data))
			{
				throw "Error: The 'data' parameter is not found in settings.";
			}

			this._type = BX.type.isNotEmptyString(this._data["type"]) ? this._data["type"] : "text";
			this._userFieldType = BX.type.isNotEmptyString(this._data["userFieldType"]) ? this._data["userFieldType"] : "";

			var idPrefix = id.toLowerCase();
			this._node = BX(idPrefix + "_wrap");
			if(!BX.type.isElementNode(this._node))
			{
				throw "Error: Could not find field node.";
			}

			var result = cssQuery('span.crm-offer-item-edit', this._node);
			if(result.length > 0)
			{
				this._editButton = result[0];
			}

			result = cssQuery('span.crm-offer-item-del', this._node);
			if(result.length > 0)
			{
				this._delButton = result[0];
			}

			result = cssQuery('div.crm-offer-info-label-wrap', this._node);
			if(result.length > 0)
			{
				this._labelWrapper = result[0];
			}

			result = cssQuery('div.crm-offer-info-data-wrap', this._node);
			if(result.length === 0)
			{
				throw "Error: Could not find data wrapper.";
			}
			this._dataWrapper = result[0];

			this._bindEvents();

			this._isTemporary = this.getSetting("isTemporary", false);
			this._editMode = this.getSetting("editMode", false);
			if(this._editMode)
			{
				this.enableEditMode(true, true);
				this._manager.processFieldEditStart(this);
			}
		},
		getSetting: function (name, defaultval)
		{
			return this._settings.hasOwnProperty(name) ? this._settings[name] : defaultval;
		},
		getId: function()
		{
			return this._id;
		},
		getType: function()
		{
			return this._type;
		},
		getUserFieldType: function()
		{
			return this._userFieldType;
		},
		getName: function()
		{
			return BX.type.isNotEmptyString(this._data["name"]) ? this._data["name"] : this._id;
		},
		isInEditMode: function()
		{
			return this._editMode;
		},
		isTemporary: function()
		{
			return this._isTemporary;
		},
		getNode: function()
		{
			return this._node;
		},
		getData: function()
		{
			return this._data;
		},
		enableEditMode: function(enable, forced)
		{
			enable = !!enable;
			forced = !!forced;
			if(this._editMode === enable && !forced)
			{
				return;
			}

			this._editMode = enable;
			if(this._type === "vertical_checkbox" || this._type === "checkbox")
			{
				this._processBooleanFieldModeChange();
			}
			else if(this._type === "vertical_container")
			{
				this._processContainerFieldModeChange();
			}
			else
			{
				this._processTextFieldModeChange();
			}
		},
		release: function(removeNode)
		{
			this._unbindEvents();

			if(removeNode && this._node)
			{
				this._node = BX.remove(this._node);
			}
		},
		getMessage: function(name)
		{
			var m = BX.CrmFormFieldSetting.messages;
			return m.hasOwnProperty(name) ? m[name] : name;
		},
		_bindEvents: function()
		{
			if(this._editButton)
			{
				BX.bind(this._editButton, "click", this._editButtonClickHandler);
			}

			if(this._delButton)
			{
				BX.bind(this._delButton, "click", this._deleteButtonClickHandler);
			}
		},
		_unbindEvents: function()
		{
			if(this._editButton)
			{
				BX.unbind(this._editButton, "click", this._editButtonClickHandler);
			}

			if(this._delButton)
			{
				BX.unbind(this._delButton, "click", this._deleteButtonClickHandler);
			}

			if(this._saveButton)
			{
				BX.unbind(this._saveButton, "click", this._saveButtonClickHandler);
			}

			if(this._cancelButton)
			{
				BX.unbind(this._cancelButton, "click", this._cancelButtonClickHandler);
			}
		},
		_processBooleanFieldModeChange: function()
		{
			if(this._editMode)
			{
				BX.addClass(this._node, "crm-offer-new-item");
				this._dataWrapper.style.display = "none";

				if(this._nameInput)
				{
					this._nameInput.style.display = "";
				}
				else
				{
					this._nameInput = BX.create(
						"INPUT",
						{
							props: { type: "text", className: "crm-offer-item-inp crm-offer-label-inp", placeholder: this.getMessage("fieldNamePlaceHolder") }
						}
					);
					this._dataWrapper.parentNode.insertBefore(this._nameInput, this._dataWrapper);
				}
				this._nameInput.value = BX.type.isNotEmptyString(this._data["name"]) ? this._data["name"] : this._id;

				this._ensureEditButtonsCreated();
				if(this._buttonWrapper.style.display !== "")
				{
					this._buttonWrapper.style.display = "";
				}

				this._nameInput.focus();
				//this._nameInput.select();
				this._nameInput.setSelectionRange(0, this._nameInput.value.length);
			}
			else
			{
				BX.removeClass(this._node, "crm-offer-new-item");

				this._nameInput.style.display = "none";
				this._buttonWrapper.style.display = "none";
				this._dataWrapper.style.display = "";

				var result = cssQuery('label.crm-offer-label', this._dataWrapper);
				if(result.length > 0)
				{
					result[0].innerHTML = BX.util.htmlspecialchars(BX.type.isNotEmptyString(this._data["name"]) ? this._data["name"] : this._id);
				}
			}
		},
		_processContainerFieldModeChange: function()
		{
			var result = cssQuery('div.crm-offer-editor-title', this._node);
			if(result.length === 0)
			{
				throw "Error: Could not find title container.";
			}
			var titleContainer = result[0];

			result = cssQuery('div.crm-offer-editor-title-contents-wapper', titleContainer);
			if(result.length === 0)
			{
				throw "Error: Could not find title wrapper.";
			}
			var titleWrapper = result[0];

			if(this._editMode)
			{
				BX.addClass(this._node, "crm-offer-new-item");

				titleWrapper.style.display = "none";
				if(this._nameInput)
				{
					this._nameInput.style.display = "";
				}
				else
				{
					this._nameInput = BX.create(
						"INPUT",
						{
							props: { type: "text", className: "crm-offer-item-inp", placeholder: this.getMessage("fieldNamePlaceHolder") }
						}
					);
					titleContainer.appendChild(this._nameInput);
				}
				this._nameInput.value = BX.type.isNotEmptyString(this._data["name"]) ? this._data["name"] : this._id;

				this._ensureEditButtonsCreated();
				if(this._buttonWrapper.style.display !== "")
				{
					this._buttonWrapper.style.display = "";
				}

				this._nameInput.focus();
				//this._nameInput.select();
				this._nameInput.setSelectionRange(0, this._nameInput.value.length);

				if(this._cover)
				{
					this._cover.style.display = "";
				}
				else
				{
					this._cover = BX.create("DIV", { props: { className: "crm-offer-disable-cover" } });
					this._dataWrapper.appendChild(this._cover);
				}
			}
			else
			{
				this._cover.style.display = "none";

				BX.removeClass(this._node, "crm-offer-new-item");

				this._nameInput.style.display = "none";
				this._buttonWrapper.style.display = "none";
				titleWrapper.style.display = "";

				result = cssQuery('span.crm-offer-editor-title-contents', titleWrapper);
				if(result.length === 0)
				{
					throw "Error: Could not find title content.";
				}
				result[0].innerHTML = BX.util.htmlspecialchars(BX.type.isNotEmptyString(this._data["name"]) ? this._data["name"] : this._id);
			}
		},
		_processTextFieldModeChange: function()
		{
			if(this._editMode)
			{
				BX.addClass(this._node, "crm-offer-new-item");

				this._labelWrapper.style.display = "none";
				if(this._nameInput)
				{
					this._nameInput.style.display = "";
				}
				else
				{
					this._nameInput = BX.create(
						"INPUT",
						{
							props: { type: "text", className: "crm-offer-item-inp", placeholder: this.getMessage("fieldNamePlaceHolder") }
						}
					);
					this._labelWrapper.parentNode.insertBefore(this._nameInput, this._labelWrapper);
				}
				this._nameInput.value = BX.type.isNotEmptyString(this._data["name"]) ? this._data["name"] : this._id;

				this._ensureEditButtonsCreated();
				if(this._buttonWrapper.style.display !== "")
				{
					this._buttonWrapper.style.display = "";
				}

				this._nameInput.focus();
				//this._nameInput.select();
				this._nameInput.setSelectionRange(0, this._nameInput.value.length);

				if(this._cover)
				{
					this._cover.style.display = "";
				}
				else
				{
					this._cover = BX.create("DIV", { props: { className: "crm-offer-disable-cover" } });
					this._dataWrapper.appendChild(this._cover);
				}
			}
			else
			{
				this._cover.style.display = "none";

				BX.removeClass(this._node, "crm-offer-new-item");

				this._nameInput.style.display = "none";
				this._buttonWrapper.style.display = "none";
				this._labelWrapper.style.display = "";

				var result = cssQuery('span.crm-offer-info-label', this._labelWrapper);
				if(result.length > 0)
				{
					result[0].innerHTML = BX.util.htmlspecialchars(BX.type.isNotEmptyString(this._data["name"]) ? this._data["name"] : this._id);
				}
			}
		},
		_ensureEditButtonsCreated: function()
		{
			if(this._buttonWrapper)
			{
				return;
			}

			this._saveButton = BX.create(
				"SPAN",
				{
					props: { className: "webform-small-button" },
					children:
					[
						BX.create("SPAN", { props: { className: "webform-small-button-left" } }),
						BX.create(
							"SPAN",
							{
								props: { className: "webform-small-button-text" },
								text: this.getMessage("saveButton")
							}
						),
						BX.create("SPAN", { props: { className: "webform-small-button-right" } })
					]
				}
			);
			BX.bind(this._saveButton, "click", this._saveButtonClickHandler);

			this._cancelButton = BX.create(
				"SPAN",
				{
					props: { className: "crm-offer-cancel-link" },
					text:  this.getMessage("cancelButton")
				}
			);
			BX.bind(this._cancelButton, "click", this._cancelButtonClickHandler);

			this._buttonWrapper = BX.create(
				"DIV",
				{
					props: { className: "crm-offer-item-btn-wrap" },
					children: [ this._saveButton, this._cancelButton ]
				}
			);

			this._dataWrapper.parentNode.appendChild(this._buttonWrapper);
		},
		_onEditButtonClick: function(e)
		{
			this.enableEditMode(true);
			this._manager.processFieldEditStart(this);
		},
		_onDeleteButtonClick: function(e)
		{
			var dlg = new BX.CDialog(
				{
					title: this.getMessage("fieldDeleteDlgTitle"),
					head: '',
					content: this.getMessage("fieldDeleteDlgContent"),
					resizable: false,
					draggable: true,
					height: 70,
					width: 300
				}
			);

			dlg.ClearButtons();
			dlg.SetButtons(
				[
					{
						title: this.getMessage("deleteButton"),
						id: 'delete',
						action: BX.delegate(this._onDeleteConfirmationButtonClick, this)
					},
					BX.CDialog.btnCancel
				]
			);
			dlg.Show();
		},
		_onDeleteConfirmationButtonClick: function(e)
		{
			BX.WindowManager.Get().Close();
			this._manager.processFieldRemove(this);
		},
		_onSaveButtonClick: function(e)
		{
			if(!this._editMode)
			{
				return;
			}

			var name = BX.util.trim(this._nameInput.value);
			if(name !== "")
			{
				this._data["name"] = name;
			}

			if(this._manager.processFieldEditEnd(this))
			{
				this.enableEditMode(false);
			}
		},
		_onCancelButtonClick: function(e)
		{
			if(this._manager.processFieldEditCancelation(this))
			{
				this.enableEditMode(false);
			}
		}
	};
	if(typeof(BX.CrmFormFieldSetting.messages) === "undefined")
	{
		BX.CrmFormFieldSetting.messages = {};
	}
	BX.CrmFormFieldSetting.create = function(id, settings)
	{
		var self = new BX.CrmFormFieldSetting();
		self.initialize(id, settings);
		return self;
	};
}
if(typeof(BX.CrmFormSectionSetting) === "undefined")
{
	BX.CrmFormSectionSetting = function()
	{
		this._id = "";
		this._settings = null;

		this._manager = null;
		this._data = null;

		this._titleNode = null;
		this._contentsNode = null;
		this._buttonsNode = null;
		this._addFieldButton = null;
		this._restoreFieldButton = null;
		this._addFieldMenuId = "";
		this._restoreFieldMenuId = "";

		this._editButton = null;
		this._editMode = false;
		this._titleLabel = null;
		this._titleInput = null;

		this._nodeMouseOverHandler = BX.delegate(this._onNodeMouseOver, this);
		this._nodeMouseOutHandler = BX.delegate(this._onNodeMouseOut, this);
		this._addFieldButtonClickHandler = BX.delegate(this._onAddFieldButtonClick, this);
		this._restoreFieldButtonClickHandler = BX.delegate(this._onRestoreFieldButtonClick, this);
		this._editButtonClickHandler = BX.delegate(this._onEditButtonClick, this);
		this._deleteButtonClickHandler = BX.delegate(this._onDeleteButtonClick, this);
		this._documentClickHandler = BX.delegate(this._onDocumentClick, this);

		this._addFieldMenu = null;
		this._isAddFieldMenuShown = false;
		this._restoreFieldMenu = null;
		this._isRestoreFieldMenuShown = false;
		this._mouseTimeoutId = 0;
		this._isMouseOver = false;
	};
	BX.CrmFormSectionSetting.prototype =
	{
		initialize: function(id, settings)
		{
			if(!BX.type.isNotEmptyString(id))
			{
				throw "Error: The 'id' argument is not defined or empty.";
			}
			this._id = id;

			this._settings = settings ? settings : {};

			this._manager = this.getSetting("manager");
			if(!(this._manager instanceof BX.CrmFormSettingManager))
			{
				throw "Error: The 'manager' argument must be CrmFormSettingManager instance.";
			}

			this._data = this.getSetting("data");
			if(!BX.type.isPlainObject(this._data))
			{
				throw "Error: The 'data' parameter is not found in settings.";
			}

			var idPrefix = id.toLowerCase();

			this._contentsNode = BX(idPrefix + "_contents");
			if(!BX.type.isElementNode(this._contentsNode))
			{
				throw "Error: Could not find section contents node.";
			}

			var result = cssQuery('div.crm-offer-title', BX(idPrefix));
			if(result.length > 0)
			{
				this._titleNode = result[0];
			}
			else
			{
				throw "Error: Could not find section title node.";
			}

			this._buttonsNode = BX(idPrefix + "_buttons");
			if(!BX.type.isElementNode(this._buttonsNode))
			{
				throw "Error: Could not find section buttons node.";
			}

			this._addFieldButton = BX(idPrefix + "_add_field");
			if(!BX.type.isElementNode(this._addFieldButton))
			{
				throw "Error: Could not find section 'Add Field' button.";
			}

			this._restoreFieldButton = BX(idPrefix + "_restore_field");
			if(!BX.type.isElementNode(this._restoreFieldButton))
			{
				throw "Error: Could not find section 'Show Field' button.";
			}

			this._addFieldMenuId = idPrefix + "_add_field_menu";
			this._restoreFieldMenuId = idPrefix + "_restore_field_menu";

			this._editButton = BX(idPrefix + "_edit");
			if(!BX.type.isElementNode(this._editButton))
			{
				throw "Error: Could not find section 'Edit' button.";
			}

			this._deleteButton = BX(idPrefix + "_delete");
			if(!BX.type.isElementNode(this._deleteButton))
			{
				throw "Error: Could not find section 'Delete' button.";
			}

			result = cssQuery('span.crm-offer-title-text', this._titleNode);
			if(result.length === 0)
			{
				throw "Error: Could not find title label.";
			}
			this._titleLabel = result[0];

			this._bindEvents();

			this._editMode = this.getSetting("editMode", false);
			if(this._editMode)
			{
				this.enableEditMode(true, true);
				this._manager.processSectionEditStart(this);
			}
		},
		release: function(removeNode)
		{
			this._unbindEvents();

			if(removeNode && this._contentsNode)
			{
				this._contentsNode = BX.remove(this._contentsNode);
			}
		},
		getSetting: function (name, defaultval)
		{
			return this._settings.hasOwnProperty(name) ? this._settings[name] : defaultval;
		},
		getId: function()
		{
			return this._id;
		},
		getTitleNode: function()
		{
			return this._titleNode;
		},
		getContentsNode: function()
		{
			return this._contentsNode;
		},
		getData: function()
		{
			return this._data;
		},
		getMessage: function(name)
		{
			var m = BX.CrmFormSectionSetting.messages;
			return m.hasOwnProperty(name) ? m[name] : name;
		},
		enableEditMode: function(enable, forced)
		{
			enable = !!enable;
			forced = !!forced;
			if(this._editMode === enable && !forced)
			{
				return;
			}

			this._editMode = enable;
			if(this._editMode)
			{
				this._titleLabel.style.display = "none";
				if(this._titleInput)
				{
					this._titleInput.style.display = "";
				}
				else
				{
					this._titleInput = BX.create(
						"INPUT",
						{
							props: { type: "text", className: "crm-item-table-inp", placeholder: this.getMessage("sectionTitlePlaceHolder") }
						}
					);
					this._titleInput.value = BX.type.isNotEmptyString(this._data["name"]) ? this._data["name"] : this._id;
					this._titleNode.insertBefore(this._titleInput, this._titleLabel);
				}

				this._titleInput.focus();
				//this._titleInput.select();
				this._titleInput.setSelectionRange(0, this._titleInput.value.length);

				this._enableDocumentClick(true);
			}
			else
			{
				this._titleInput.style.display = "none";
				this._titleLabel.style.display = "";
				this._titleLabel.innerHTML = BX.util.htmlspecialchars(BX.type.isNotEmptyString(this._data["name"]) ? this._data["name"] : this._id);

				this._enableDocumentClick(false);
			}
		},
		_bindEvents: function()
		{
			BX.bind(this._titleNode, "mouseover", this._nodeMouseOverHandler);
			BX.bind(this._titleNode, "mouseout", this._nodeMouseOutHandler);

			BX.bind(this._contentsNode, "mouseover", this._nodeMouseOverHandler);
			BX.bind(this._contentsNode, "mouseout", this._nodeMouseOutHandler);

			BX.bind(this._addFieldButton, "click", this._addFieldButtonClickHandler);
			BX.bind(this._restoreFieldButton, "click", this._restoreFieldButtonClickHandler);

			BX.bind(this._editButton, "click", this._editButtonClickHandler);
			BX.bind(this._deleteButton, "click", this._deleteButtonClickHandler);
		},
		_unbindEvents: function()
		{
			BX.unbind(this._titleNode, "mouseover", this._nodeMouseOverHandler);
			BX.unbind(this._titleNode, "mouseout", this._nodeMouseOutHandler);

			BX.unbind(this._contentsNode, "mouseover", this._nodeMouseOverHandler);
			BX.unbind(this._contentsNode, "mouseout", this._nodeMouseOutHandler);

			BX.unbind(this._addFieldButton, "click", this._addFieldButtonClickHandler);
			BX.unbind(this._restoreFieldButton, "click", this._restoreFieldButtonClickHandler);

			BX.unbind(this._editButton, "click", this._editButtonClickHandler);
			BX.unbind(this._deleteButton, "click", this._deleteButtonClickHandler);
		},
		_enableDocumentClick: function(enable)
		{
			if(enable)
			{
				var self = this;
				window.setTimeout(function(){ BX.bind(document, "click", self._documentClickHandler); }, 0);
			}
			else
			{
				BX.unbind(document, "click", this._documentClickHandler);
			}
		},
		_onAddFieldMenuItemClick: function(event, item)
		{
			this._closeAddFieldMenu();

			var id = BX.type.isNotEmptyString(item["id"]) ? item["id"] : "";
			if(id === "addSection")
			{
				this._manager.createSection(this);
				return;
			}

			var type = "string";
			if(id === "addDoubleField")
			{
				type = "double";
			}
			else if(id === "addBooleanField")
			{
				type = "boolean";
			}
			else if(id === "addDatetimeField")
			{
				type = "datetime";
			}

			this._manager.createTemporaryField(type, this);
		},
		_openAddFieldMenu: function()
		{
			if(this._isAddFieldMenuShown)
			{
				return;
			}

			var callback = BX.delegate(this._onAddFieldMenuItemClick, this);
			var menuItems = [];
			if(this._manager.canCreateUserField())
			{
				menuItems.push(
					{
						id: "addStringField",
						className: "crm-offer-popup-item menu-popup-no-icon",
						text: this.getMessage("createTextFiledMenuItem"),
						onclick: callback
					}
				);

				menuItems.push(
					{
						id: "addDoubleField",
						className: "crm-offer-popup-item menu-popup-no-icon",
						text: this.getMessage("createDoubleFiledMenuItem"),
						onclick: callback
					}
				);

				menuItems.push(
					{
						id: "addBooleanField",
						className: "crm-offer-popup-item menu-popup-no-icon",
						text: this.getMessage("createBooleanFiledMenuItem"),
						onclick: callback
					}
				);

				menuItems.push(
					{
						id: "addDatetimeField",
						className: "crm-offer-popup-item menu-popup-no-icon",
						text: this.getMessage("createDatetimeFiledMenuItem"),
						onclick: callback
					}
				);

				menuItems.push(
					{
						id: "addDatetimeField",
						className: "crm-offer-popup-item menu-popup-no-icon",
						text: this.getMessage("createDatetimeFiledMenuItem"),
						onclick: callback
					}
				);

				menuItems.push({ delimiter: true });
			}

			menuItems.push(
				{
					id: "addSection",
					className: "crm-offer-popup-item menu-popup-no-icon",
					text: this.getMessage("createSectionMenuItem"),
					onclick: callback
				}
			);

			if(typeof(BX.PopupMenu.Data[this._addFieldMenuId]) !== "undefined")
			{
				BX.PopupMenu.Data[this._addFieldMenuId].popupWindow.destroy();
				delete BX.PopupMenu.Data[this._addFieldMenuId];
			}

			this._addFieldMenu = BX.PopupMenu.create(
				this._addFieldMenuId,
				this._addFieldButton,
				menuItems,
				{
					offsetTop: 0,
					offsetLeft: 0,
					angle:
					{
						position: "top",
						offset: 10
					},
					events:
					{
						onPopupClose : BX.delegate(this._onAddFieldMenuClose, this)
					}
				}
			);

			this._addFieldMenu.popupWindow.show();
			this._isAddFieldMenuShown = true;
		},
		_closeAddFieldMenu: function()
		{
			if(this._addFieldMenu && this._addFieldMenu.popupWindow)
			{
				this._addFieldMenu.popupWindow.close();
			}
		},
		_openRestoreFieldMenu: function()
		{
			if(this._isRestoreFieldMenuShown)
			{
				return;
			}

			var menuItems = [];
			var infos = this._manager.getHiddenFieldInfos();

			if(infos.length === 0)
			{
				return;
			}

			for(var i = 0; i < infos.length; i++)
			{
				var info = infos[i];
				menuItems.push(
					{
						id: info["id"],
						className: "crm-offer-popup-item menu-popup-no-icon",
						text: info["name"],
						onclick: BX.delegate(this._onRestoreFieldMenuItemClick, this)
					}
				);
			}

			if(typeof(BX.PopupMenu.Data[this._restoreFieldMenuId]) !== "undefined")
			{
				BX.PopupMenu.Data[this._restoreFieldMenuId].popupWindow.destroy();
				delete BX.PopupMenu.Data[this._restoreFieldMenuId];
			}

			this._restoreFieldMenu = BX.PopupMenu.create(
				this._restoreFieldMenuId,
				this._restoreFieldButton,
				menuItems,
				{
					offsetTop: 0,
					offsetLeft: 0,
					angle:
					{
						position: "top",
						offset: 10
					},
					events:
					{
						onPopupClose : BX.delegate(this._onRestoreFieldMenuClose, this)
					}
				}
			);

			this._restoreFieldMenu.popupWindow.show();
			this._isRestoreFieldMenuShown = true;
		},
		_onNodeMouseOver: function(e)
		{
			this._isMouseOver = true;

			if(this._mouseTimeoutId !== null)
			{
				window.clearInterval(this._mouseTimeoutId);
				this._mouseTimeoutId = null;
			}

			var self = this;

			this._mouseTimeoutId = window.setTimeout(
				function()
				{
					if(self._mouseTimeoutId != null)
					{
						self._mouseTimeoutId = null;

						var node = self._buttonsNode;
						if(node.style.visibility !== "visible")
						{
							node.style.visibility = "visible";
						}
					}
				},
				300
			);
		},
		_onNodeMouseOut: function(e)
		{
			this._isMouseOver = false;

			if(this._isAddFieldMenuShown || this._isRestoreFieldMenuShown)
			{
				return;
			}

			if(this._mouseTimeoutId !== null)
			{
				window.clearInterval(this._mouseTimeoutId);
				this._mouseTimeoutId = null;
			}

			var self = this;

			this._mouseTimeoutId = window.setTimeout(
				function()
				{
					if(self._mouseTimeoutId != null)
					{
						self._mouseTimeoutId = null;

						var node = self._buttonsNode;
						if(node.style.visibility !== "hidden")
						{
							node.style.visibility = "hidden";
						}
					}
				},
				300
			);
		},
		_onDocumentClick: function(e)
		{
			if(!e)
			{
				e = window.event;
			}

			var target = BX.getEventTarget(e);
			if(target && this._titleInput === target)
			{
				return;
			}

			if(!this._editMode)
			{
				BX.unbind(document, "click", this._documentClickHandler);
				return;
			}

			var name = BX.util.trim(this._titleInput.value);
			if(name !== "")
			{
				this._data["name"] = name;
			}

			if(this._manager.processSectionEditEnd(this))
			{
				this.enableEditMode(false);
			}
		},
		_onEditButtonClick: function(e)
		{
			if(!this._editMode)
			{
				this.enableEditMode(true);
				this._manager.processSectionEditStart(this);
			}
		},
		_onDeleteButtonClick: function(e)
		{
			var dlg = new BX.CDialog(
				{
					title: this.getMessage("sectionDeleteDlgTitle"),
					head: '',
					content: this.getMessage("sectionDeleteDlgContent"),
					resizable: false,
					draggable: true,
					height: 70,
					width: 300
				}
			);

			dlg.ClearButtons();
			dlg.SetButtons(
				[
					{
						title: this.getMessage("deleteButton"),
						id: 'delete',
						action: BX.delegate(this._onDeleteConfirmationButtonClick, this)
					},
					BX.CDialog.btnCancel
				]
			);
			dlg.Show();
		},
		_onDeleteConfirmationButtonClick: function(e)
		{
			BX.WindowManager.Get().Close();
			this._manager.processSectionRemove(this);
		},
		_onAddFieldButtonClick: function(e)
		{
			if(!e)
			{
				e = window.event;
			}

			this._openAddFieldMenu();
			return BX.PreventDefault(e);
		},
		_onRestoreFieldButtonClick: function(e)
		{
			if(!e)
			{
				e = window.event;
			}

			this._openRestoreFieldMenu();
			return BX.PreventDefault(e);
		},
		_onAddFieldMenuClose: function()
		{
			this._addFieldMenu = null;
			if(typeof(BX.PopupMenu.Data[this._addFieldMenuId]) !== "undefined")
			{
				BX.PopupMenu.Data[this._addFieldMenuId].popupWindow.destroy();
				delete BX.PopupMenu.Data[this._addFieldMenuId];
			}
			this._isAddFieldMenuShown = false;

			if(!this._isMouseOver && this._buttonsNode.style.visibility !== "hidden")
			{
				this._buttonsNode.style.visibility = "hidden";
			}
		},
		_onRestoreFieldMenuItemClick: function(event, item)
		{
			var fieldId = BX.type.isNotEmptyString(item["id"]) ? item["id"] : "";
			if(fieldId !== "")
			{
				this._manager.restoreField(fieldId, this._id);
			}
		},
		_onRestoreFieldMenuClose: function()
		{
			this._restoreFieldMenu = null;
			if(typeof(BX.PopupMenu.Data[this._restoreFieldMenuId]) !== "undefined")
			{
				BX.PopupMenu.Data[this._restoreFieldMenuId].popupWindow.destroy();
				delete BX.PopupMenu.Data[this._restoreFieldMenuId];
			}
			this._isRestoreFieldMenuShown = false;

			if(!this._isMouseOver && this._buttonsNode.style.visibility !== "hidden")
			{
				this._buttonsNode.style.visibility = "hidden";
			}
		}
	};
	if(typeof(BX.CrmFormSectionSetting.messages) === "undefined")
	{
		BX.CrmFormSectionSetting.messages = {};
	}
	BX.CrmFormSectionSetting.create = function(id, settings)
	{
		var self = new BX.CrmFormSectionSetting();
		self.initialize(id, settings);
		return self;
	};
}
if(typeof(BX.CrmFormUserFieldManager) === "undefined")
{
	BX.CrmFormUserFieldManager = function()
	{
		this._id = "";
		this._settings = null;

		this._canCreate = false;
		this._entityId = "";
		this._manager = null;

		this._pendingData = null;

		this._data = {};
		this._fields = {};
	};
	BX.CrmFormUserFieldManager.prototype =
	{
		initialize: function(id, settings)
		{
			this._id = BX.type.isNotEmptyString(id) ? id : BX.util.getRandomString(8);
			this._settings = settings ? settings : {};

			this._entityId = this.getSetting("entityId", "");
			if(!BX.type.isNotEmptyString(this._entityId))
			{
				throw "Error: The 'entityId' parameter is not defined in settings or empty.";
			}

			this._canCreate = this.getSetting("canCreate", false);
			this._manager = this.getSetting("manager", null);
		},
		getSetting: function (name, defaultval)
		{
			return this._settings.hasOwnProperty(name) ? this._settings[name] : defaultval;
		},
		getId: function()
		{
			return this._id;
		},
		canCreate: function()
		{
			return this._canCreate;
		},
		createField: function(params, temporaryId, callback)
		{
			if(!this._canCreate)
			{
				throw "Error: User is not authorized to create user fields.";
			}

			if(!BX.type.isPlainObject(params))
			{
				throw "Error: The 'params' argument must be a plain object.";
			}

			var name = BX.type.isNotEmptyString(params["name"]) ? params["name"] : "";
			if(name === "")
			{
				throw "Error: The 'name' parameter is not defined in params or empty.";
			}

			var type = BX.type.isNotEmptyString(params["type"]) ? params["type"] : "";
			if(type === "")
			{
				type = "string";
			}
			else if(type !=="string" && type !== "double" && type !== "boolean" && type !== "datetime")
			{
				throw "Error: Type '" + type + "' is not supported in current context.";
			}

			var fieldData =
			{
				"USER_TYPE_ID": type,
				"ENTITY_ID": this._entityId,
				"MULTIPLE": 'N',
				"MANDATORY": 'N',
				"SHOW_FILTER": 'Y',
				"EDIT_FORM_LABEL": name
			};

			this._pendingData =
				{
					fieldData: fieldData,
					temporaryId: BX.type.isNotEmptyString(temporaryId) ? temporaryId : "",
					callback: BX.type.isFunction(callback) ? callback : null
				};

			this._beginCreateField();
		},
		createTemporaryField: function(params)
		{
			if(!BX.type.isPlainObject(params))
			{
				throw "Error: The 'params' argument must be a plain object.";
			}

			var temporaryId = BX.util.getRandomString(8);
			params["name"] = temporaryId;
			var fieldData = this._prepareFieldData(params);

			return BX.CrmFormUserField.create(
				temporaryId,
				{
					manager: this,
					fieldData: fieldData
				}
			);
		},
		getImagePath: function()
		{
			return this.getSetting("imagePath", "/bitrix/js/main/core/images/");
		},
		getServerTime: function()
		{
			return this.getSetting("serverTime", "");
		},
		_prepareFieldData: function(params)
		{
			if(!BX.type.isPlainObject(params))
			{
				throw "Error: The 'params' argument must be a plain object.";
			}

			var type = BX.type.isNotEmptyString(params["type"]) ? params["type"] : "";
			if(type === "")
			{
				type = "string";
			}
			else if(type !== "string" && type !== "double" && type !== "boolean" && type !== "datetime")
			{
				throw "Error: Type '" + type + "' is not supported in current context.";
			}

			var name = BX.type.isNotEmptyString(params["name"]) ? params["name"] : "";
			if(name === "")
			{
				throw "Error: The 'name' parameter is not defined in params or empty.";
			}

			var label = BX.type.isNotEmptyString(params["label"]) ? params["label"] : "";
			if(label === "")
			{
				throw "Error: The 'label' parameter is not defined in params or empty.";
			}

			return(
				{
					"FIELD_NAME": name,
					"USER_TYPE_ID": type,
					"ENTITY_ID": this._entityId,
					"MULTIPLE": 'N',
					"MANDATORY": 'N',
					"SHOW_FILTER": 'Y',
					"EDIT_FORM_LABEL": label
				}
			);
		},
		_beginCreateField: function()
		{
			var serviceUrl = this.getSetting("serviceUrl", "");
			if(!BX.type.isNotEmptyString(serviceUrl))
			{
				throw "Error: Could not find 'serviceUrl' parameter in settings.";
			}

			BX.ajax(
			{
				url: serviceUrl,
				method: 'POST',
				dataType: 'json',
				data:
				{
					'ACTION' : 'ADD_FIELD',
					'DATA': this._pendingData["fieldData"]
				},
				onsuccess: BX.delegate(this._onCreateFieldRequestSuccess, this),
				onfailure: BX.delegate(this._onCreateFieldRequestFailure, this)
			});

		},
		_onCreateFieldRequestSuccess: function(data)
		{
			var error = BX.type.isNotEmptyString(data["ERROR"]) ? data["ERROR"] : "";
			if(error !== "")
			{
				alert(error);
				return;
			}

			var result = BX.type.isPlainObject(data['RESULT']) ? data['RESULT'] : {};
			var fieldData = this._pendingData["fieldData"];
			var fieldId = fieldData["ID"] = BX.type.isNotEmptyString(result["ID"]) ? result["ID"] : "";
			if(!BX.type.isNotEmptyString(fieldId))
			{
				throw "Error: Could not find 'ID' in action result.";
			}

			var fieldName = fieldData["FIELD_NAME"] = BX.type.isNotEmptyString(result["FIELD_NAME"]) ? result["FIELD_NAME"] : "";
			if(!BX.type.isNotEmptyString(fieldName))
			{
				throw "Error: Could not find 'FIELD_NAME' in action result.";
			}

			this._data[fieldName] = fieldData;

			var field = BX.CrmFormUserField.create(fieldName, { manager: this, fieldData: fieldData });
			this._fields[fieldName] = field;

			if(this._pendingData["callback"])
			{
				this._pendingData["callback"](this, this._pendingData["temporaryId"], field);
			}

			this._pendingData = null;
		},
		_onCreateFieldRequestFailure: function(data)
		{
			this._pendingData = null;
			alert("Could not create user field.");
		}
	};
	BX.CrmFormUserFieldManager.items = {};
	BX.CrmFormUserFieldManager.create = function(id, settings)
	{
		var self = new BX.CrmFormUserFieldManager();
		self.initialize(id, settings);
		this.items[self.getId()] = self;
		return self;
	};
}
if(typeof(BX.CrmFormUserField) === "undefined")
{
	BX.CrmFormUserField = function()
	{
		this._id = "";
		this._fieldData = null;
		this._settings = null;
		this._manager = this;
		this._userTypeId = "";
		this._fieldName = "";
		this._label = "";

		this._elements = {};
	};
	BX.CrmFormUserField.prototype =
	{
		initialize: function(id, settings)
		{
			this._id = BX.type.isNotEmptyString(id) ? id : BX.util.getRandomString(8);
			this._settings = settings ? settings : {};

			this._fieldData = this.getSetting("fieldData", null);
			if(!BX.type.isPlainObject(this._fieldData))
			{
				throw "Error: The 'fieldData' parameter is not found in settings.";
			}

			this._userTypeId = this.getParam("USER_TYPE_ID");
			if(!BX.type.isNotEmptyString(this._userTypeId))
			{
				throw "Error: The 'USER_TYPE_ID' parameter is not found in field data.";
			}

			this._fieldName = this.getParam("FIELD_NAME");
			if(!BX.type.isNotEmptyString(this._fieldName))
			{
				throw "Error: The 'FIELD_NAME' parameter is not found in field data.";
			}

			this._label = this.getParam("EDIT_FORM_LABEL");
			if(!BX.type.isNotEmptyString(this._label))
			{
				this._label = this._fieldName;
			}

			this._manager = this.getSetting("manager", null);
			if(!this._manager)
			{
				throw "Error: The 'manager' parameter is not found in settings.";
			}
		},
		getSetting: function (name, defaultval)
		{
			return this._settings.hasOwnProperty(name) ? this._settings[name] : defaultval;
		},
		getId: function()
		{
			return this._id;
		},
		getParam: function(name)
		{
			return BX.type.isNotEmptyString(this._fieldData[name]) ? this._fieldData[name] : "";
		},
		getUserTypeId: function()
		{
			return this._userTypeId;
		},
		getFieldName: function()
		{
			return this._fieldName;
		},
		getFieldLabel: function()
		{
			return this._label;
		},
		isNeedTitle: function()
		{
			return this._userTypeId !== "boolean";
		},
		prepareLayout: function()
		{
			if(this._userTypeId === "string")
			{
				return this._prepareStringFieldLayout();
			}
			else if(this._userTypeId === "double")
			{
				return this._prepareDoubleFieldLayout();
			}
			else if(this._userTypeId === "boolean")
			{
				return this._prepareBooleanFieldLayout();
			}
			else if(this._userTypeId === "datetime")
			{
				return this._prepareDatetimeFieldLayout();
			}
			return null;
		},
		_prepareStringFieldLayout: function()
		{
			this._elements["value"] = BX.create("INPUT",
				{
					props:
					{
						className: "crm-offer-item-inp",
						type: "text",
						name: this._fieldName,
						size: 30,
						value: ""
					}
				}
			);
			return [ this._elements["value"] ];
		},
		_prepareDoubleFieldLayout: function()
		{
			this._elements["value"] = BX.create("INPUT",
				{
					props:
					{
						className: "crm-offer-item-inp",
						type: "text",
						name: this._fieldName,
						size: 30,
						value: ""
					}
				}
			);
			return [ this._elements["value"] ];
		},
		_prepareBooleanFieldLayout: function()
		{
			this._elements['value'] = BX.create("INPUT",
				{
					props:
					{
						type: "hidden",
						name: this._fieldName,
						value: "N"
					}
				}
			);

			var chbxId = this._fieldName.toLowerCase() + "_chbx";
			this._elements['checkbox'] = BX.create("INPUT",
				{
					props:
					{
						id: chbxId,
						name: this._fieldName,
						type: "checkbox",
						className: "crm-offer-checkbox",
						value: "Y"
					}
				}
			);

			this._elements["label"] =
				BX.create(
					"LABEL",
					{
						props: { className: "crm-offer-label" },
						attrs: { "for": chbxId },
						text: this._label
					}
				);

			return [this._elements["value"], this._elements["checkbox"], this._elements["label"] ];
		},
		_prepareDatetimeFieldLayout: function()
		{
			this._elements["value"] = BX.create("INPUT",
				{
					props:
					{
						className: "crm-offer-item-inp crm-item-table-date",
						type: "text",
						id: this._fieldName,
						name: this._fieldName,
						value: ""
					}
				}
			);

			BX.bind(this._elements["value"], "click", BX.delegate(this._onDateTimeIconClick, this));

			return [ this._elements["value"] ];
		},
		_onDateTimeIconClick: function(e)
		{
			BX.calendar(
				{
					node:this._elements["value"],
					field: this._fieldName,
					bTime: true,
					serverTime: this._manager.getServerTime(),
					bHideTimebar: false
				}
			);
		}
	};
	BX.CrmFormUserField.create = function(id, settings)
	{
		var self = new BX.CrmFormUserField();
		self.initialize(id, settings);
		return self;
	}
}
if(typeof(BX.CrmFormFieldRenderer) === "undefined")
{
	BX.CrmFormFieldRenderer = function() {};
	BX.CrmFormFieldRenderer.renderUserFieldRow = function(field, table, index)
	{
		if(!BX.type.isElementNode(table))
		{
			throw "Error: The 'table' argument must be DOM element.";
		}

		index = parseInt(index);
		if(isNaN(index) || index < 0)
		{
			index = -1;
		}

		var id = field.getFieldName();
		var row = table.insertRow(index);
		row.id = id.toLowerCase() + "_wrap";
		row.className = "crm-offer-row";

		var cell = row.insertCell(-1);
		cell.className = "crm-offer-info-drg-btn";
		cell.appendChild(
			BX.create("SPAN", { props: { className: "crm-offer-drg-btn" } })
		);

		cell = row.insertCell(-1);
		cell.className = "crm-offer-info-left";
		cell.appendChild(
			BX.create("DIV",
				{
					props: { className: "crm-offer-info-label-wrap" },
					children:
					[
						BX.create("SPAN", { props: { className: "crm-offer-info-label-alignment" } }),
						BX.create("SPAN",
							{
								props: { className: "crm-offer-info-label" },
								text: field.isNeedTitle() ? (field.getFieldLabel() + ":") : ""
							}
						)
					]
				}
			)
		);

		cell = row.insertCell(-1);
		cell.className = "crm-offer-info-right";
		cell.appendChild(
			BX.create("DIV",
				{
					props: { className: "crm-offer-info-data-wrap" },
					children: field.prepareLayout()
				}
			)
		);

		cell = row.insertCell(-1);
		cell.className = "crm-offer-info-right-btn";
		cell.appendChild(BX.create("SPAN", { props: { className: "crm-offer-item-del" } }));
		cell.appendChild(BX.create("SPAN", { props: { className: "crm-offer-item-edit" } }));

		cell = row.insertCell(-1);
		cell.className = "crm-offer-last-td";

		return row;
	};
	BX.CrmFormFieldRenderer.renderSectionTable = function(data, anchorNode)
	{
		var id = data["id"];
		var prefix = id.toLowerCase();
		var name = data["name"];

		var table = BX.create(
			"TABLE",
			{ props: { id: prefix + "_contents", className: "crm-offer-info-table" } }
		);

		var row = table.insertRow(-1);
		row.id = id;

		var cell = row.insertCell(-1);
		cell.setAttribute("colspan", "5");
		cell.appendChild(
			BX.create(
				"DIV",
				{
					props: { className: "crm-offer-title" },
					children:
					[
						BX.create("SPAN", { props: { className: "crm-offer-drg-btn" } }),
						BX.create("SPAN", { props: { className: "crm-offer-title-text" }, text: name }),
						BX.create(
							"SPAN",
							{
								props: { className: "crm-offer-title-set-wrap" },
								text: name,
								children:
								[
									BX.create(
										"SPAN",
										{
											props:
											{
												id: prefix + "_edit",
												className: "crm-offer-title-edit"
											}
										}
									),
									BX.create(
										"SPAN",
										{
											props:
											{
												id: prefix + "_delete",
												className: "crm-offer-title-del"
											}
										}
									)
								]
							}
						)
					]
				}
			)
		);

		row = table.insertRow(-1);
		row.id = prefix + "_buttons";
		row.style.visibility = "hidden";

		cell = row.insertCell(-1);
		cell.className = "crm-offer-info-drg-btn";

		cell = row.insertCell(-1);
		cell.className = "crm-offer-info-left";

		cell = row.insertCell(-1);
		cell.className = "crm-offer-info-right";
		cell.appendChild(
			BX.create(
				"DIV",
				{
					props: { className: "crm-offer-item-link-wrap" },
					children:
					[
						BX.create(
							"SPAN",
							{
								props: { id: prefix + "_add_field", className: "crm-offer-info-link" },
								text: this.getMessage("addFieldButton")
							}
						),
						BX.create(
							"SPAN",
							{
								props: { id: prefix + "_restore_field", className: "crm-offer-info-link" },
								text: this.getMessage("restoreFieldButton")
							}
						)
					]
				}
			)
		);


		cell = row.insertCell(-1);
		cell.className = "crm-offer-info-right-btn";

		cell = row.insertCell(-1);
		cell.className = "crm-offer-last-td";

		var targetNode = BX.findNextSibling(anchorNode, { tagName: "TABLE", className: "crm-offer-info-table" });
		if(targetNode)
		{
			targetNode.parentNode.insertBefore(table, targetNode);
		}
		else
		{
			anchorNode.parentNode.appendChild(table);
		}

		return table;
	};
	BX.CrmFormFieldRenderer.getMessage = function(name)
	{
		var m = BX.CrmFormFieldRenderer.messages;
		return m.hasOwnProperty(name) ? m[name] : name;
	};
	if(typeof(BX.CrmFormFieldRenderer.messages) === "undefined")
	{
		BX.CrmFormFieldRenderer.messages = {};
	}
}
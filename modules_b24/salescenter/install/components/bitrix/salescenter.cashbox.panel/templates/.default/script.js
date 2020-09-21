;(function () {
	'use strict';

	BX.namespace('BX.SaleCenterCashbox');

	BX.SaleCenterCashbox = {
		init: function(config)
		{
			this.cashboxParams = config.cashboxParams;

			var cashbox = new BX.TileGrid.Grid(this.cashboxParams);
			cashbox.draw();
		},
	};

	/**
	 *
	 * @param options
	 * @extends {BX.TileGrid.Item}
	 * @constructor
	 */
	BX.SaleCenterCashbox.TileGrid = function(options)
	{
		BX.TileGrid.Item.apply(this, arguments);

		this.title = options.title;
		this.image = options.image;
		this.itemSelected = options.itemSelected;
		this.itemSelectedColor = options.itemSelectedColor;
		this.itemSelectedImage = options.itemSelectedImage;
		this.layout = {
			container: null,
			image: null,
			title: null,
			clipTitle: null,
			company: null,
			controls: null,
			buttonAction: null,
			price: null
		};
		this.data = options.data || {};
	};

	BX.SaleCenterCashbox.TileGrid.prototype =
	{
		__proto__: BX.TileGrid.Item.prototype,
		constructor: BX.TileGrid.Item,

		getContent: function()
		{
			if(!this.layout.wrapper)
			{
				this.layout.wrapper = BX.create('div', {
					props: {
						className: 'salescenter-cashbox-item'
					},
					children: [
						BX.create('div', {
							props: {
								className: 'salescenter-cashbox-item-content'
							},
							children: [
								this.getImage(),
								this.getTitle(),
								this.getStatus()
							],
						})
					],
					events: {
						click: function()
						{
							this.onClick();
						}.bind(this)
					}
				});
			}

			this.itemSelected ? this.setSelected() : null;

			return this.layout.wrapper;
		},

		getImage: function()
		{
			if(!this.layout.image)
			{
				this.layout.image = BX.create('div', {
					props: {
						className: 'salescenter-cashbox-item-image'
					},
					style: {
						backgroundImage: this.image ? 'url(' + this.image + ')' : null
					}
				});
			}

			return this.layout.image;
		},

		getStatus: function()
		{
			if(!this.itemSelected)
				return;

			this.layout.itemSelected = BX.create('div', {
				props: {
					className: 'salescenter-cashbox-item-status-selected'
				}
			});

			return this.layout.itemSelected;
		},

		setSelected: function()
		{
			if(!this.itemSelected)
				return;

			BX.addClass(this.layout.wrapper, 'salescenter-cashbox-item-selected');

			if(this.itemSelectedImage)
			{
				this.layout.image.style.backgroundImage = 'url(' + this.itemSelectedImage + ')';
			}

			if(this.itemSelectedColor)
			{
				this.layout.wrapper.style.backgroundColor = this.itemSelectedColor;
			}

			this.layout.itemSelected = BX.create('div', {
				props: {
					className: 'salescenter-cashbox-item-status-selected'
				}
			});

			this.layout.wrapper.appendChild(this.layout.itemSelected);
		},

		setUnselected: function()
		{
			if(this.itemSelected)
			{
				return;
			}

			BX.removeClass(this.layout.wrapper, 'salescenter-cashbox-item-selected');

			if(this.image)
			{
				this.layout.image.style.backgroundImage = 'url(' + this.image + ')';
			}

			this.layout.wrapper.style.backgroundColor = '';

			var itemSelected = this.layout.wrapper.querySelector('.salescenter-cashbox-item-status-selected');
			if(itemSelected)
			{
				itemSelected.parentNode.removeChild(itemSelected);
			}
		},

		getTitle: function()
		{
			if(!this.layout.title)
			{
				this.layout.title = BX.create('div', {
					props: {
						className: 'salescenter-cashbox-item-title'
					},
					text: this.title
				});
			}

			return this.layout.title;
		},

		onClick: function()
		{
			this.formData = '';
			var sliderOptions = {
				allowChangeHistory: false,
				width: 1000,
				events: {
					onLoad: function(e)
					{
						var slider = e.getSlider();
						this.formData = this.getAllFormData(slider);
					}.bind(this),
					onClose: function (e)
					{
						if(this.onCloseSlider(e))
						{
							this.reloadCashboxItem(this.data.handler);
						}
					}.bind(this),
				}
			};

			if(!this.itemSelected && !this.data.showMenu)
			{
				BX.SidePanel.Instance.open(this.data.connectPath, sliderOptions);
			}
			else
			{
				this.showItemMenu(this, {
					sliderOptions: sliderOptions
				});
			}
		},

		onCloseSlider: function(event)
		{
			var sliderDocument = this.getSliderDocument(event.slider);
			var savedInput = sliderDocument.getElementById('salescenter-form-is-saved');
			if(savedInput && savedInput.value === 'y')
			{
				return true;
			}
			var formData = this.getAllFormData(event.slider);
			if (this.formData === formData || this.isClose === true)
			{
				this.isClose = false;
				return false;
			}

			event.action = false;

			this.popup = new BX.PopupWindow(
				"salescenter_slider_close_confirmation",
				null,
				{
					autoHide: false,
					draggable: false,
					closeByEsc: false,
					offsetLeft: 0,
					offsetTop: 0,
					zIndex: event.slider.zIndex + 100,
					bindOptions: { forceBindPosition: true },
					titleBar: BX.message('SCP_POPUP_TITLE'),
					content: BX.message('SCP_POPUP_CONTENT'),
					buttons: [
						new BX.PopupWindowButton(
							{
								text : BX.message('SCP_POPUP_BUTTON_CLOSE'),
								className : "ui-btn ui-btn-success",
								events: { click: BX.delegate(this.onCloseConfirmButtonClick.bind(this, 'close')) }
							}
						),
						new BX.PopupWindowButtonLink(
							{
								text : BX.message('SCP_POPUP_BUTTON_CANCEL'),
								className : "ui-btn ui-btn-link",
								events: { click: BX.delegate(this.onCloseConfirmButtonClick.bind(this, 'cancel')) }
							}
						)
					],
					events: {
						onPopupClose: function()
						{
							this.destroy();
						}
					}
				}
			);
			this.popup.show();

			return false;
		},

		onCloseConfirmButtonClick: function(button)
		{
			this.popup.close();
			if (BX.SidePanel.Instance.getTopSlider())
			{
				BX.SidePanel.Instance.getTopSlider().focus();
			}

			if(button === "close")
			{
				this.isClose = true;
				BX.SidePanel.Instance.getTopSlider().close();
			}
		},

		showItemMenu: function (item, options)
		{
			var menu = [],
				menuItemIndex,
				itemNode = item.layout.container,
				menuitemId = 'salescenter-item-menu-' + BX.util.getRandomString(),
				filter;

			item.sliderOptions = {};
			if (options.sliderOptions)
			{
				item.sliderOptions = options.sliderOptions;
			}

			for (menuItemIndex in item.data.menuItems)
			{
				if (item.data.menuItems.hasOwnProperty(menuItemIndex))
				{
					if (item.data.menuItems[menuItemIndex].DELIMITER)
					{
						menu.push({
							delimiter: true
						});
					}
					else
					{
						menu.push({
							text: item.data.menuItems[menuItemIndex].NAME,
							link: item.data.menuItems[menuItemIndex].LINK,
							onclick: function(e, tile)
							{
								item.moreTabsMenu.close();
								BX.SidePanel.Instance.open(tile.options.link, item.sliderOptions);
							}
						});
					}

				}
			}

			item.moreTabsMenu = BX.PopupMenu.create(
				menuitemId,
				itemNode,
				menu,
				{
					autoHide: true,
					offsetLeft: 0,
					offsetTop: 0,
					closeByEsc: true,
					events: {
						onPopupClose : function()
						{
							item.moreTabsMenu.popupWindow.destroy();
							BX.PopupMenu.destroy(menuitemId);
						},
						onPopupDestroy: function ()
						{
							item.moreTabsMenu = null;
						}
					}
				}
			);
			item.moreTabsMenu.popupWindow.show();
		},

		reloadCashboxItem: function(handler)
		{
			var self = this;
			BX.ajax.runComponentAction(
				'bitrix:salescenter.cashbox.panel',
				'reloadCashboxItem',
				{
					mode: 'class',
					data: {
						handler: handler,
					}
				}
			).then(function(response)
			{
				self.itemSelected = response.data.itemSelected;
				if (self.itemSelected)
				{
					self.setSelected();
				}
				else
				{
					self.setUnselected();
				}

				self.data.menuItems = response.data.menuItems;
				self.data.showMenu = response.data.showMenu;
			});
		},

		getAllFormData: function(slider)
		{
			var innerDoc = this.getSliderDocument(slider);
			var formNode = innerDoc.getElementsByTagName('form');

			if (formNode && formNode.length > 0)
			{
				var prepared = BX.ajax.prepareForm(formNode[0]),
					i;

				for (i in prepared.data)
				{
					if (prepared.data.hasOwnProperty(i) && i === '')
					{
						delete prepared.data[i];
					}
				}

				return !!prepared && prepared.data ? JSON.stringify(prepared.data) : '';
			}

			return '';
		},

		getSliderDocument: function(slider)
		{
			var sliderIframe, innerDoc;
			sliderIframe = slider.iframe;
			innerDoc = sliderIframe.contentDocument || sliderIframe.contentWindow.document;

			return innerDoc;
		},
	};

})();
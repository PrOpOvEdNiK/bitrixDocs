;(function () {
	'use strict';

	BX.namespace('BX.SaleCenterPaySystem');

	BX.SaleCenterPaySystem = {
		paySystem: null,
		paySystemApp: null,
		mode: "main",

		init: function(config)
		{
			this.mode = config.mode;
			this.paySystemParams = config.paySystemParams;
			this.paySystemAppParams = config.paySystemAppParams;

			this.paySystem = new BX.TileGrid.Grid(this.paySystemParams);
			this.paySystem.draw();

			if (this.mode === "main")
			{
				this.paySystemApp = new BX.TileGrid.Grid(this.paySystemAppParams);
				this.paySystemApp.draw();
			}
		},

		reloadSlider: function(responseData)
		{
			if(responseData.paySystemPanelParams)
			{
				this.paySystem.redraw(responseData.paySystemPanelParams);
			}

			if(responseData.paySystemAppPanelParams && (this.mode === "main"))
			{
				this.paySystemApp.redraw(responseData.paySystemAppPanelParams);
			}
		}
	};

	/**
	 *
	 * @param options
	 * @extends {BX.TileGrid.Item}
	 * @constructor
	 */
	BX.SaleCenterPaySystem.TileGrid = function(options)
	{
		BX.TileGrid.Item.apply(this, arguments);

		this.title = options.title;
		this.image = options.image;
		this.itemSelected = options.itemSelected;
		this.itemSelectedColor = options.itemSelectedColor;
		this.itemSelectedImage = options.itemSelectedImage;
		this.outerImage = options.outerImage || false;
		this.layout = {
			container: null,
			image: null,
			title: null,
		};
		this.data = options.data || {};
	};

	BX.SaleCenterPaySystem.TileGrid.prototype =
	{
		__proto__: BX.TileGrid.Item.prototype,
		constructor: BX.TileGrid.Item,

		getContent: function()
		{
			if(this.data.type === "counter")
			{
				return this.getItemCounter();
			}

			if(this.data.type === "integration")
			{
				return this.getItemIntegration();
			}

			if(!this.layout.wrapper)
			{
				this.layout.wrapper = BX.create('div', {
					props: {
						className: 'salescenter-paysystem-item'
					},
					children: [
						BX.create('div', {
							props: {
								className: 'salescenter-paysystem-item-content'
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
						className: 'salescenter-paysystem-item-image'
					},
					style: {
						backgroundSize: this.outerImage ? '40px' : '',
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
					className: 'salescenter-paysystem-item-status-selected'
				}
			});

			return this.layout.itemSelected;
		},

		setSelected: function()
		{
			if(!this.itemSelected)
				return;

			BX.addClass(this.layout.wrapper, 'salescenter-paysystem-item-selected');

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
					className: 'salescenter-paysystem-item-status-selected'
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

			BX.removeClass(this.layout.wrapper, 'salescenter-paysystem-item-selected');

			if(this.image)
			{
				this.layout.image.style.backgroundImage = 'url(' + this.image + ')';
			}

			this.layout.wrapper.style.backgroundColor = '';

			var itemSelected = this.layout.wrapper.querySelector('.salescenter-paysystem-item-status-selected');
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
						className: 'salescenter-paysystem-item-title'
					},
					text: this.title
				});
			}

			return this.layout.title;
		},

		getItemCounter: function()
		{
			return BX.create("div", {
				props: {
					className: "salescenter-paysystem-item salescenter-paysystem-integration-marketplace-tile-item salescenter-paysystem-integration-marketplace-tile-counter"
				},
				children: [
					BX.create('div', {
						props: {
							className: "salescenter-paysystem-integration-marketplace-tile-counter-head"
						},
						children: [
							BX.create('div', {
								props: {
									className: "salescenter-paysystem-integration-marketplace-tile-counter-name"
								},
								text: this.title
							}),
							BX.create('div', {
								props: {
									className: "salescenter-paysystem-integration-marketplace-tile-counter-value"
								},
								text: this.data.count
							}),
						]
					}),
					BX.create('div', {
						props: {
							className: "salescenter-paysystem-integration-marketplace-tile-counter-link-box"
						},
						children: [
							BX.create('div', {
								props: {
									className: "salescenter-paysystem-integration-marketplace-tile-counter-link"
								},
								text: this.data.description
							})
						]
					})
				],
				events: {
					click: function()
					{
						this.onClick();
					}.bind(this)
				}
			})
		},

		getItemIntegration: function()
		{
			return BX.create("div", {
				props: {
					className: "salescenter-paysystem-item salescenter-paysystem-integration-marketplace-tile-item salescenter-paysystem-integration-marketplace-tile-integration"
				},
				children: [
					BX.create("div", {
						props: {
							className: "salescenter-paysystem-integration-marketplace-tile-integration-inner"
						},
						children: [
							BX.create("div", {
								props: {
									className: "salescenter-paysystem-integration-marketplace-tile-integration-logo"
								},
							}),
							BX.create("div", {
								props: {
									className: "salescenter-paysystem-integration-marketplace-tile-integration-text"
								},
								text: this.data.description
							})
						]
					})
				],
				events: {
					click: function()
					{
						this.onClick();
					}.bind(this)
				}
			})
		},

		openRestAppLayout: function(applicationId, appCode)
		{
			BX.ajax.runComponentAction("bitrix:salescenter.paysystem.panel", "getRestApp", {
				data: {
					code: appCode
				}
			}).then(function(response)
			{
				var app = response.data;
				if(app.TYPE === "A")
				{
					this.showRestApplication(appCode);
				}
				else
				{
					BX.rest.AppLayout.openApplication(applicationId);
				}
			}.bind(this)).catch(function(response)
			{
				this.restAppErrorPopup(" ", response.errors.pop().message);
			}.bind(this));
		},

		restAppErrorPopup: function(title, text)
		{
			var popup = new BX.PopupWindow('rest-app-error-alert', null, {
				closeIcon: true,
				closeByEsc: true,
				autoHide: false,
				titleBar: title,
				content: text,
				zIndex: 16000,
				overlay: {
					color: 'gray',
					opacity: 30
				},
				buttons: [
					new BX.PopupWindowButton({
						'id': 'close',
						'text': BX.message('SPP_SALESCENTER_JS_POPUP_CLOSE'),
						'events': {
							'click': function(){
								popup.close();
							}
						}
					})
				],
				events: {
					onPopupClose: function() {
						this.destroy();
					},
					onPopupDestroy: function() {
						popup = null;
					}
				}
			});
			popup.show();
		},

		onClick: function()
		{
			if(this.data.type === 'paysystem')
			{
				BX.Salescenter.Manager.addAnalyticAction({
					analyticsLabel: 'salescenterClickPaymentTile',
					isConnected: this.itemSelected ? 'y' : 'n',
					type: this.data.paySystemType,
				});
				var sliderOptions = {
					allowChangeHistory: false,
					width: 1000,
					events: {
						onClose: this.reload.bind(this, BX.SaleCenterPaySystem.mode)
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
			}
			else if(this.data.type === 'paysystem_extra')
			{
				var sliderOptions = {
					allowChangeHistory: false,
					events: {
						onClose: this.reload.bind(this, "main")
					}
				};
				BX.SidePanel.Instance.open(this.data.connectPath, sliderOptions);
			}
			else if(this.data.type === "counter")
			{
				BX.SidePanel.Instance.open(this.data.connectPath);
			}
			else if(this.data.type === "integration")
			{
				window.open(this.data.url);
			}
			else if(this.data.type === "marketplaceApp")
			{
				if (this.itemSelected)
				{
					this.openRestAppLayout(this.id, this.data.code);
				}
				else
				{
					this.showRestApplication(this.data.code);
				}
			}
			else if(this.data.type === 'actionbox')
			{
				if (this.data.handler === 'anchor')
				{
					window.open (this.data.move);
				}
				else if (this.data.handler === 'marketplace')
				{
					BX.rest.Marketplace.open({PLACEMENT: this.data.move});
				}
				else if (this.data.handler === 'landing')
				{
					var dataMove = this.data.move;
					BX.SidePanel.Instance.open('salecenter', {
						contentCallback: function () {
							return "<iframe src='" + dataMove + "'" +
								" style='width: 100%; height:" +
								" -webkit-calc(100vh - 20px); height:" +
								" calc(100vh - 20px);'></iframe>";
						}
					});
				}
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

		reloadPage: function()
		{
			var previousSlider = BX.SidePanel.Instance.getPreviousSlider(BX.SidePanel.Instance.getSliderByWindow(window));
			var parentWindow = (
				previousSlider
					? previousSlider.getWindow()
					: top
			);

			if (parentWindow)
			{
				parentWindow.window.location.reload();
			}
		},

		showRestApplication: function(appCode)
		{
			var applicationUrlTemplate = "/marketplace/detail/#app#/";
			var url = applicationUrlTemplate.replace("#app#", encodeURIComponent(appCode));
			BX.SidePanel.Instance.open(url, {
				allowChangeHistory: false,
				events: {
					onClose: this.reload.bind(this, "main")
				}
			});
		},

		reload: function(mode)
		{
			console.log(mode);
			BX.ajax.runComponentAction(
				"bitrix:salescenter.paysystem.panel",
				"getComponentResult",
				{
					mode: "ajax",
					data: {
						mode: mode
					}
				}
			).then(function(response)
			{
				BX.SaleCenterPaySystem.reloadSlider(response.data);
			});
		}
	};
})();
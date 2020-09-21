(function (exports,main_core,main_popup,salescenter_manager) {
	'use strict';

	function _templateObject5() {
	  var data = babelHelpers.taggedTemplateLiteral(["<div class=\"salescenter-item-title\">", "</div>"]);

	  _templateObject5 = function _templateObject5() {
	    return data;
	  };

	  return data;
	}

	function _templateObject4() {
	  var data = babelHelpers.taggedTemplateLiteral(["<div class=\"salescenter-item-label\"><span class=\"salescenter-item-label-text\">", "</span></div>"]);

	  _templateObject4 = function _templateObject4() {
	    return data;
	  };

	  return data;
	}

	function _templateObject3() {
	  var data = babelHelpers.taggedTemplateLiteral(["<div class=\"salescenter-item-status-selected\"></div>"]);

	  _templateObject3 = function _templateObject3() {
	    return data;
	  };

	  return data;
	}

	function _templateObject2() {
	  var data = babelHelpers.taggedTemplateLiteral(["<div class=\"salescenter-item-image\" style=\"background-image:url(", ")\"></div>"]);

	  _templateObject2 = function _templateObject2() {
	    return data;
	  };

	  return data;
	}

	function _templateObject() {
	  var data = babelHelpers.taggedTemplateLiteral(["<div class=\"salescenter-item ", "\" onclick=\"", "\" style=\"", "\">\n\t\t\t<div class=\"salescenter-item-content\">\n\t\t\t\t", "\n\t\t\t\t", "\n\t\t\t\t", "\n\t\t\t</div>\n\t\t</div>"]);

	  _templateObject = function _templateObject() {
	    return data;
	  };

	  return data;
	}
	var namespace = main_core.Reflection.namespace('BX.Salescenter');

	var ControlPanel =
	/*#__PURE__*/
	function () {
	  function ControlPanel() {
	    babelHelpers.classCallCheck(this, ControlPanel);
	  }

	  babelHelpers.createClass(ControlPanel, null, [{
	    key: "init",
	    value: function init(options) {
	      var _this = this;

	      if (main_core.Type.isPlainObject(options)) {
	        this.constructor.shopRoot = options.shopRoot;
	      }

	      main_core.Event.ready(function () {
	        if (BX.SidePanel.Instance) {
	          BX.SidePanel.Instance.bindAnchors({
	            rules: [{
	              condition: [_this.constructor.shopRoot + "sale_delivery_service_edit/", _this.constructor.shopRoot + "sale_pay_system_edit/"],
	              handler: _this.constructor.adjustSidePanelOpener
	            }, {
	              condition: ["/shop/orders/details/(\\d+)/", "/shop/orders/payment/details/(\\d+)/", "/shop/orders/shipment/details/(\\d+)/"]
	            }, {
	              condition: ["/crm/configs/sale/"]
	            }]
	          });
	        }

	        if (!top.window["adminSidePanel"] || !BX.is_subclass_of(top.window["adminSidePanel"], top.BX.adminSidePanel)) {
	          top.window["adminSidePanel"] = new top.BX.adminSidePanel({
	            publicMode: true
	          });
	        }
	      });
	    }
	  }, {
	    key: "addCommonConnectionDependentTile",
	    value: function addCommonConnectionDependentTile(tile) {
	      ControlPanel.commonConnectionDependentTiles.push(tile);
	    }
	  }, {
	    key: "addPageMenuTile",
	    value: function addPageMenuTile(tile) {
	      ControlPanel.pageMenuTiles.push(tile);
	    }
	  }, {
	    key: "adjustSidePanelOpener",
	    value: function adjustSidePanelOpener(event, link) {
	      if (BX.SidePanel.Instance) {
	        var isSidePanelParams = link.url.indexOf("IFRAME=Y&IFRAME_TYPE=SIDE_SLIDER") >= 0;

	        if (!isSidePanelParams || isSidePanelParams && !BX.SidePanel.Instance.getTopSlider()) {
	          event.preventDefault();
	          link.url = BX.util.add_url_param(link.url, {
	            "publicSidePanel": "Y"
	          });
	          BX.SidePanel.Instance.open(link.url, {
	            allowChangeHistory: false
	          });
	        }
	      }
	    }
	  }, {
	    key: "connectShop",
	    value: function connectShop(id) {
	      salescenter_manager.Manager.startConnection({
	        context: id
	      }).then(function () {
	        salescenter_manager.Manager.loadConfig().then(function (result) {
	          if (result.isSiteExists) {
	            salescenter_manager.Manager.showAfterConnectPopup();
	            ControlPanel.commonConnectionDependentTiles.forEach(function (item) {
	              item.data.active = true;
	              item.dropMenu();
	              item.rerender();
	            });
	          }
	        });
	      });
	    }
	  }, {
	    key: "paymentSystemsTileClick",
	    value: function paymentSystemsTileClick() {
	      if (ControlPanel.paymentSystemsTile) {
	        ControlPanel.paymentSystemsTile.onClick();
	      }
	    }
	  }, {
	    key: "closeMenu",
	    value: function closeMenu() {
	      var menu = main_popup.PopupMenu.getCurrentMenu();

	      if (menu) {
	        menu.destroy();
	      }
	    }
	  }, {
	    key: "dropPageMenus",
	    value: function dropPageMenus() {
	      ControlPanel.pageMenuTiles.forEach(function (item) {
	        item.dropMenu();
	      });
	    }
	  }, {
	    key: "reloadUserConsentTile",
	    value: function reloadUserConsentTile() {
	      if (ControlPanel.userConsentTile) {
	        ControlPanel.userConsentTile.reloadTile();
	      }
	    }
	  }]);
	  return ControlPanel;
	}();

	babelHelpers.defineProperty(ControlPanel, "shopRoot", '/shop/settings/');
	babelHelpers.defineProperty(ControlPanel, "commonConnectionDependentTiles", []);
	babelHelpers.defineProperty(ControlPanel, "pageMenuTiles", []);

	var BaseItem =
	/*#__PURE__*/
	function (_BX$TileGrid$Item) {
	  babelHelpers.inherits(BaseItem, _BX$TileGrid$Item);

	  function BaseItem(options) {
	    var _this2;

	    babelHelpers.classCallCheck(this, BaseItem);
	    _this2 = babelHelpers.possibleConstructorReturn(this, babelHelpers.getPrototypeOf(BaseItem).call(this, options));
	    _this2.title = options.title;
	    _this2.image = options.image;
	    _this2.data = options.data || {};

	    if (_this2.isDependsOnConnection()) {
	      ControlPanel.addCommonConnectionDependentTile(babelHelpers.assertThisInitialized(_this2));
	    }

	    if (_this2.hasPagesMenu()) {
	      ControlPanel.addPageMenuTile(babelHelpers.assertThisInitialized(_this2));
	    }

	    if (_this2.id === 'payment-systems') {
	      ControlPanel.paymentSystemsTile = babelHelpers.assertThisInitialized(_this2);
	    } else if (_this2.id === 'userconsent') {
	      ControlPanel.userConsentTile = babelHelpers.assertThisInitialized(_this2);
	    }

	    return _this2;
	  }

	  babelHelpers.createClass(BaseItem, [{
	    key: "isDependsOnConnection",
	    value: function isDependsOnConnection() {
	      return this.data.isDependsOnConnection === true;
	    }
	  }, {
	    key: "hasPagesMenu",
	    value: function hasPagesMenu() {
	      return this.data.hasPagesMenu === true;
	    }
	  }, {
	    key: "getContent",
	    value: function getContent() {
	      this.layout.innerContent = main_core.Tag.render(_templateObject(), this.getAdditionalContentClass(), this.onClick.bind(this), this.getContentStyles(), this.getImage(), this.getTitle(), this.isActive() ? this.getStatus() : '');
	      return this.layout.innerContent;
	    }
	  }, {
	    key: "rerender",
	    value: function rerender() {
	      if (!this.layout.innerContent) {
	        return;
	      }

	      var contentNode = this.layout.innerContent.parentNode;
	      contentNode.removeChild(this.layout.innerContent);
	      contentNode.appendChild(this.getContent());
	    }
	  }, {
	    key: "getAdditionalContentClass",
	    value: function getAdditionalContentClass() {
	      if (this.isActive()) {
	        return 'salescenter-item-selected';
	      }

	      return '';
	    }
	  }, {
	    key: "isActive",
	    value: function isActive() {
	      return this.data.active === true;
	    }
	  }, {
	    key: "getLoadMenuItemsAction",
	    value: function getLoadMenuItemsAction() {
	      return null;
	    }
	  }, {
	    key: "onClick",
	    value: function onClick() {
	      var _this3 = this;

	      if (!this.isActive()) {
	        ControlPanel.connectShop(this.id);
	      } else {
	        var menu = this.getMenuItems();

	        if (!menu) {
	          this.reloadTile(true).then(function (response) {
	            menu = _this3.getMenuItems();

	            if (_this3.isActive() && menu) {
	              _this3.showMenu();
	            } else {
	              _this3.onClick();
	            }
	          });
	        } else {
	          this.showMenu();
	        }
	      }
	    }
	  }, {
	    key: "getContentStyles",
	    value: function getContentStyles() {
	      var styles = '';

	      if (this.isActive() && this.data.activeColor) {
	        styles = 'background-color: ' + this.data.activeColor;
	      }

	      return styles;
	    }
	  }, {
	    key: "getImage",
	    value: function getImage() {
	      var path = '';

	      if (this.image) {
	        path = this.image;
	      }

	      if (this.isActive() && this.data.activeImage) {
	        path = this.data.activeImage;
	      }

	      return main_core.Tag.render(_templateObject2(), path);
	    }
	  }, {
	    key: "getStatus",
	    value: function getStatus() {
	      return main_core.Tag.render(_templateObject3());
	    }
	  }, {
	    key: "getLabel",
	    value: function getLabel() {
	      return main_core.Tag.render(_templateObject4(), main_core.Loc.getMessage('SALESCENTER_CONTROL_PANEL_ITEM_LABEL_COMMING_SOON'));
	    }
	  }, {
	    key: "getTitle",
	    value: function getTitle() {
	      return main_core.Tag.render(_templateObject5(), this.title);
	    }
	  }, {
	    key: "getMenuItems",
	    value: function getMenuItems() {
	      return this.data.menu;
	    }
	  }, {
	    key: "dropMenu",
	    value: function dropMenu() {
	      delete this.data.menu;
	      return this;
	    }
	  }, {
	    key: "showMenu",
	    value: function showMenu() {
	      main_popup.PopupMenu.show(this.id + '-menu', this.layout.container, this.getMenuItems(), {
	        offsetLeft: 0,
	        offsetTop: 0,
	        closeByEsc: true,
	        className: 'salescenter-panel-menu'
	      });
	    }
	  }, {
	    key: "getUrl",
	    value: function getUrl() {
	      if (main_core.Type.isString(this.data.url)) {
	        return this.data.url;
	      }

	      return null;
	    }
	  }, {
	    key: "reloadTile",
	    value: function reloadTile() {
	      var _this4 = this;

	      var isClick = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : false;
	      return new Promise(function (resolve) {
	        if (main_core.Type.isString(_this4.data.reloadAction)) {
	          main_core.ajax.runComponentAction('bitrix:salescenter.control_panel', _this4.data.reloadAction, {
	            analyticsLabel: isClick ? 'salescenterControlPanelReloadTile' : null,
	            getParameters: isClick ? {
	              tileId: _this4.id
	            } : null,
	            mode: 'class',
	            data: {
	              id: _this4.id
	            }
	          }).then(function (response) {
	            if (!main_core.Type.isNil(response.data.active)) {
	              _this4.data.active = response.data.active;
	            }

	            if (!main_core.Type.isNil(response.data.menu)) {
	              _this4.data.menu = response.data.menu;
	            }

	            _this4.rerender();

	            resolve();
	          });
	        } else {
	          resolve();
	        }
	      });
	    }
	  }]);
	  return BaseItem;
	}(BX.TileGrid.Item);

	var PaymentItem =
	/*#__PURE__*/
	function (_BaseItem) {
	  babelHelpers.inherits(PaymentItem, _BaseItem);

	  function PaymentItem() {
	    babelHelpers.classCallCheck(this, PaymentItem);
	    return babelHelpers.possibleConstructorReturn(this, babelHelpers.getPrototypeOf(PaymentItem).apply(this, arguments));
	  }

	  babelHelpers.createClass(PaymentItem, [{
	    key: "dropMenu",
	    value: function dropMenu() {
	      return this;
	    }
	  }]);
	  return PaymentItem;
	}(BaseItem);

	var ServiceItem =
	/*#__PURE__*/
	function (_BaseItem2) {
	  babelHelpers.inherits(ServiceItem, _BaseItem2);

	  function ServiceItem() {
	    babelHelpers.classCallCheck(this, ServiceItem);
	    return babelHelpers.possibleConstructorReturn(this, babelHelpers.getPrototypeOf(ServiceItem).apply(this, arguments));
	  }

	  return ServiceItem;
	}(BaseItem);

	var PaymentSystemItem =
	/*#__PURE__*/
	function (_BaseItem3) {
	  babelHelpers.inherits(PaymentSystemItem, _BaseItem3);

	  function PaymentSystemItem() {
	    babelHelpers.classCallCheck(this, PaymentSystemItem);
	    return babelHelpers.possibleConstructorReturn(this, babelHelpers.getPrototypeOf(PaymentSystemItem).apply(this, arguments));
	  }

	  babelHelpers.createClass(PaymentSystemItem, [{
	    key: "onClick",
	    value: function onClick() {
	      if (this.isDependsOnConnection()) {
	        babelHelpers.get(babelHelpers.getPrototypeOf(PaymentSystemItem.prototype), "onClick", this).call(this);
	      } else if (this.id === 'userconsent') {
	        if (!this.isActive()) {
	          var url = this.getUrl();

	          if (url) {
	            salescenter_manager.Manager.openSlider(url).then(this.reloadTile.bind(this));
	          }
	        } else {
	          this.showMenu();
	        }
	      } else {
	        var _url = this.getUrl();

	        if (_url) {
	          salescenter_manager.Manager.openSlider(_url).then(this.reloadTile.bind(this));
	        }
	      }
	    }
	  }]);
	  return PaymentSystemItem;
	}(BaseItem);

	namespace.ControlPanel = ControlPanel;
	namespace.PaymentItem = PaymentItem;
	namespace.ServiceItem = ServiceItem;
	namespace.PaymentSystemItem = PaymentSystemItem;

}((this.window = this.window || {}),BX,BX.Main,BX.Salescenter));
//# sourceMappingURL=script.js.map

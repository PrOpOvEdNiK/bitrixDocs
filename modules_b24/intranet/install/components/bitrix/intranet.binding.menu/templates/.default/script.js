;(function () {

	'use strict';

	BX.namespace('BX.Intranet.Binding.Menu');

	BX.Intranet.Binding.Menu = function(id, items, params)
	{
		params = params || {};
		this.id = id || 'intranet_binding_menu';
		this.idTop = this.id + '_top';
		this.items = items;
		this.menu = null;
		this.menuShowed = false;
		this.sections = params.sections || {};
	};

	BX.Intranet.Binding.Menu.prototype =
	{
		/**
		 * Bind on button click.
		 */
		binding: function()
		{
			if (BX(this.id))
			{
				BX.bind(BX(this.id), 'click', BX.delegate(this.clickMenuButton, this));
				if (BX(this.idTop) && BX(this.idTop).getAttribute('href') === '#')
				{
					BX.bind(BX(this.idTop), 'click', BX.delegate(this.clickMenuButton, this));
				}
			}
		},

		/**
		 * Groups menu items with section codes.
		 * @return {[]}
		 */
		buildMenu: function()
		{
			var itemsExist = false;
			var newItems = [];
			for (var key in this.sections)
			{
				if (this.sections[key])
				{
					newItems.push({
						text: '&mdash; ' + this.sections[key] + ' &mdash;',
						className: ''
					});
				}
				else if (itemsExist)
				{
					newItems.push({
						delimiter: true
					});
				}
				var pushed = false;
				for (var i = 0, c = this.items.length; i < c; i++)
				{
					if (
						typeof this.items[i]['sectionCode'] !== 'undefined' &&
						this.items[i]['sectionCode'] === key
					)
					{
						pushed = true;
						itemsExist = true;
						if (typeof this.items[i]['onclick'] === 'undefined')
						{
							this.items[i]['onclick'] = function(id)
							{
								console.log(id);
							}.bind(undefined, this.items[i]['id']);
						}
						newItems.push(this.items[i]);
					}
				}
				if (!pushed)
				{
					newItems.pop();
				}
			}
			return newItems;
		},

		/**
		 * Handler on menu click.
		 */
		clickMenuButton: function(e)
		{
			if (!this.menu)
			{
				this.menu = new BX.PopupMenuWindow(
					this.id,
					BX(this.id),
					this.buildMenu(this.items),
					{
						autoHide: true,
						angle: true,
						offsetLeft: 50,
						events: {
							onClose: function()
							{
								this.menuShowed = false;
							}.bind(this)
						}
					}
				);
			}

			if (this.menu)
			{
				if (this.menuShowed)
				{
					this.menu.close();
				}
				else
				{
					this.menuShowed = true;
					this.menu.show();
				}
			}

			BX.PreventDefault(e);
		}
	};


})();

import {TextField} from 'landing.ui.field.textfield';
import {Dom, Tag, Event} from 'main.core';
import {BaseButton} from 'landing.ui.button.basebutton';
import {Menu} from 'main.popup';

import './css/style.css';

const instances = Symbol('instances');

/**
 * @memberOf BX.Landing.UI.Field
 */
export class VariablesField extends TextField
{
	static [instances] = [];

	constructor(options)
	{
		super({...options, textOnly: true});
		this.setEventNamespace('BX.Landing.UI.Field.VariablesField');
		this.onButtonClick = this.onButtonClick.bind(this);
		this.onTopDocumentClick = this.onTopDocumentClick.bind(this);

		Event.bind(window.top.document, 'click', this.onTopDocumentClick);

		Dom.append(this.getLayout(), this.layout);

		VariablesField[instances].push(this);
	}

	onTopDocumentClick()
	{
		this.getMenu().close();
		super.onDocumentClick();
	}

	onInputClick(event)
	{
		event.preventDefault();

		this.lastRange = this.input.ownerDocument.createRange(
			this.input.innerText.length,
			this.input.innerText.length,
		);

		this.lastRange = this.input.ownerDocument.getSelection().getRangeAt(0);
	}

	getLayout(): HTMLDivElement
	{
		return this.cache.remember('layout', () => {
			return Tag.render`
				<div class="landing-ui-field landing-ui-field-variables">
					<div class="landing-ui-field-variables-left">${this.input}</div>
					<div class="landing-ui-field-variables-right">${this.getButton()}</div>
				</div>
			`;
		});
	}

	getButton(): BaseButton
	{
		return this.cache.remember('button', () => {
			return Tag.render`
				<div 
					class="landing-ui-field-variables-button" 
					onclick="${this.onButtonClick}"
				></div>
			`;
		});
	}

	getMenu(): Menu
	{
		return this.cache.remember('menu', () => {
			const menu = new Menu({
				bindElement: this.getButton(),
				autoHide: true,
				items: this.options.variables.map((variable) => {
					return {
						text: variable.name,
						onclick: () => {
							this.onVariableClick(variable);
							menu.close();
						},
					};
				}),
				events: {
					onPopupShow: () => {
						VariablesField[instances].forEach((item) => {
							item.getMenu().close();
						});

						setTimeout(() => {
							Dom.style(menu.getMenuContainer(), {
								left: 'auto',
								right: '0px',
								top: '30px',
							});
						});
					},
				},
			});

			Dom.append(menu.getMenuContainer(), this.getLayout());

			return menu;
		});
	}

	onInputInput()
	{
		const currentDocument = this.getLayout().ownerDocument;
		this.lastRange = currentDocument.getSelection().getRangeAt(0);
		super.onInputInput();
	}

	onVariableClick(variable)
	{
		this.enableEdit();
		this.input.focus();
		const currentDocument = this.getLayout().ownerDocument;

		if (this.lastRange)
		{
			currentDocument.getSelection().removeAllRanges();
			currentDocument.getSelection().addRange(this.lastRange);
		}

		currentDocument.execCommand('insertText', null, ` ${variable.value} `);
	}

	onButtonClick(event: MouseEvent)
	{
		event.preventDefault();
		event.stopPropagation();

		if (!this.lastRange && this.input.innerText.length)
		{
			const currentDocument = this.input.ownerDocument;
			currentDocument.getSelection().collapse(this.input.childNodes[0], this.input.innerText.length);
			this.lastRange = currentDocument.getSelection().getRangeAt(0);
		}

		const menu = this.getMenu();
		if (menu.getPopupWindow().isShown())
		{
			this.getMenu().close();
		}
		else
		{
			this.getMenu().show();
		}
	}
}
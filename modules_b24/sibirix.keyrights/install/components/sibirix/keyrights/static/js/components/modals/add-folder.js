const React      = require('react');
const classnames = require('classnames');
const extend     = require('extend');
const SelectTree = require('./select-tree');
const help = require('../../helpers/helpers');

const _colorsIdx = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
const ESC_CODE   = 27;

const AddFolder = React.createClass({
    getInitialState() {
        return {
            selectingPlace: false,
            selectedParent: false,
            name: '',
            note: '',
            loading: false,
            color: 1,
            foldersOpened: false
        }
    },

    resetInputPosition() {
        var len = this.name.value.length;
        this.name.setSelectionRange(len, len);
    },

    componentDidMount() {
        this.name.addEventListener('focus', (e) => this.resetInputPosition());
        window.addEventListener('keyup', (e) => this.onKeyUp(e));
        setTimeout(() => {this[this.props.modal.focusNote ? 'note' : 'name'].focus();}, 300);

        if (this.props.modal.ID) {
            this.setState({
                name: this.props.modal.NAME,
                selectedParent: parseInt(this.props.modal.SECTION),
                color: this.props.modal.ICON,
                note: this.props.modal.NOTE
            });
        } else {
            this.setState({
                selectedParent: this.props.modal.parentId ? parseInt(this.props.modal.parentId) : 0,
            });
        }
    },

    componentWillUnmount() {
        this.name.removeEventListener('focus', (e) => this.resetInputPosition());
        window.removeEventListener('keyup', (e) => this.onKeyUp(e));
    },

    onKeyUp(e) {
        if (e.keyCode === ESC_CODE) {
            this.props.closeModal();
            return;
        }
    },

    edit() {
        const {color, note} = this.state;
        const name = this.name.value;

        this.setState({loading: true});

        this.props.editFolder(extend({}, this.props.modal, {
            NAME: name,
            SECTION: this.state.selectedParent,
            IBLOCK_SECTION_ID: this.state.selectedParent,
            ICON: color,
            NOTE: note,
        }));
    },

    add() {
        const {color, note} = this.state;
        const name = this.name.value;

        const data = {
            ID: null,
            NAME: name,
            CAN_WRITE: true,
            ICON: color,
            NOTE: note,
            SECTION: this.state.selectedParent,
            IBLOCK_SECTION_ID: this.state.selectedParent
        };

        this.setState({loading: true});
        this.props.addFolder(data, this.props.currentUser);
    },

    inputKeyupHandler(e) {
        if (e.which == 13) {
            e.preventDefault();
            if (this.props.modal.ID) {
                this.edit();
            } else {
                this.add();
            }
        }
    },

    textareaKeyupHandler(e) {
        if (e.ctrlKey && e.which == 13) {
            e.preventDefault();
            if (this.props.modal.ID) {
                this.edit();
            } else {
                this.add();
            }
        }
    },

    render() {
        const {color, foldersOpened, loading, name, note} = this.state;
        const {closeModal} = this.props;

        const footerClasses   = classnames('modal-footer', {loading: loading});
        const submitClasses   = classnames("btn btn-default btn-primary", {disabled: !name.trim()});
        const dropdownClasses = classnames('dropdown', {vis: foldersOpened});

        const isEditing = this.props.modal.ID ? true : false;
        const submitAction = isEditing ? this.edit : this.add;

        const parentId = this.state.selectedParent || 0;
        const parent = this.props.tree.sections[this.props.tree.index[parentId]] || {};

        return (
            <div className={classnames("modal section-add", {['selecting-place']: this.state.selectingPlace})} id="sectionAdd">

                <div className="select-tree-wrap">
                    <SelectTree
                        close={() => this.setState({selectingPlace: false})}
                        child={this.props.modal}
                        selected={this.state.selectedParent}
                        onSelect={selectedParent => this.setState({selectingPlace: false, selectedParent})}/>
                </div>

                <div className="modal-dialog modal-sm">
                    <div className="inner-cover" onClick={() => this.setState({selectingPlace: false})}></div>
                    <div
                        onClick={() => this.setState({foldersOpened: false})}
                        className={foldersOpened ? "cover vis" : "cover"}>
                    </div>
                    <div className="modal-content">
                        <form action="javascript:void(0);">
                            <div className="modal-header">
                                <button onClick={closeModal} className="close" dangerouslySetInnerHTML={{__html: '&times;'}}></button>
                                <h4 className="modal-title">{isEditing ? help.t('SECTION_EDITING') : help.t('SECTION_ADDING')}</h4>
                            </div>

                            <div className="modal-body">
                                <label>
                                    <input
                                        onKeyUp={() => this.setState({name: this.name.value})}
                                        onKeyDown={e => {this.inputKeyupHandler(e)}}
                                        defaultValue={this.props.modal.NAME}
                                        ref={node => this.name = node}
                                        type="text"
                                        placeholder={help.t('NAME')}
                                        className="form-control"/>
                                </label>
                                <div className={dropdownClasses}>
                                    <div className="dropdown-toggle"
                                        onClick={() => this.setState({foldersOpened: !foldersOpened})}>
                                        <i className={`section-icon icon-folder-sprite folder-${color}`} dangerouslySetInnerHTML={{__html: '&nbsp;'}}></i>
                                        <div className="icon-arrow-down"></div>
                                    </div>
                                    <div className="dropdown-menu close-outside" id="icon-dropdown">
                                        <div className="icons-default">
                                            {_colorsIdx.map((i) =>
                                                <i
                                                    onClick={() => this.setState({color: i, foldersOpened: false})}
                                                    key={i}
                                                    className={`icon-folder-sprite folder-${i}`}></i>
                                            )}
                                        </div>
                                    </div>
                                </div>

                                <div className="note-input-wrapper">
                                    <textarea onChange={e => this.setState({note: e.target.value})}
                                              onKeyDown={e => {this.textareaKeyupHandler(e)}}
                                              className="form-control"
                                              placeholder={help.t('NOTE')}
                                              ref={node => this.note = node}
                                              value={note} />
                                </div>

                                <div className="place-wrap">
                                    <a onClick={() => this.setState({selectingPlace: true})} href="javascript:void(0);">
                                        <i className="glyphicon glyphicon-pencil"></i>
                                        <i className={`icon-folder-sprite folder-${parent.ICON}`}></i>
                                        <span title={parent.NAME}>{parent.NAME}<span className="name-label">{help.t('PARENT_SECTION')}</span></span>
                                    </a>
                                </div>
                            </div>

                            <div className={footerClasses}>
                                <a onClick={closeModal}
                                    href="javascript:void(0);"
                                    className="btn btn-default">{help.t('CANCEL2')}</a>
                                <button onClick={submitAction}
                                    className={submitClasses}>{isEditing ? help.t('EDIT') : help.t('ADD')}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        )
    }
});

module.exports = AddFolder;

const React       = require('react');
const classnames  = require('classnames');
const cryptHelper = require('../../helpers/crypt');
const help        = require('../../helpers/helpers');
const extend      = require('extend');
const SelectTree  = require('../modals/select-tree');
const FileSaver   = require('file-saver');
const Blob        = require('blob');
const colors      = require('../../constants/colors');

const maxFileSize = 25 * 1024;
const forbiddenExtensions = ['exe', 'bat'];

const _initialState = {
    popupIsVisible: false,
    passIsVisible: false,
    loading: false,
    name: '',
    login: '',
    password: '',
    parentSection: 0,
    passwordConfirm: '',
    url: '',
    note: '',
    files: [],
    color: '0',
};

const AddItem = React.createClass({
    getInitialState() {
        return _initialState;
    },

    componentDidMount() {
        this.props.setHeading(this.state.name);
        setTimeout(() => {this.name.focus();}, 300);
        const {item} = this.props;

        if (item.isEdit) {
            const data = cryptHelper.decrypt(item.element.CRYPTED);

            this.setState({
                id: item.element.ID,
                name: item.element.NAME,
                color: item.element.COLOR ? item.element.COLOR : '0',
                login: data.LOGIN,
                parentSection: item.element.SECTION,
                password: data.PASSWORD,
                passwordConfirm: data.PASSWORD,
                url: data.URL,
                note: data.NOTE,
                files: data.FILES ? data.FILES : [],
            });
        } else {
            this.setState({
                parentSection: this.props.activeFolder
            })
        }
    },

    componentWillReceiveProps(props) {
        if (this.props.item.isEdit && props.item.isNew) {
            this.setState(_initialState)
            setTimeout(() => {this.name.focus();}, 300);
        }
    },

    onFieldChange(field) {
        let state    = {};
        const value = this[field].value;
        state[field] = value;

        if (field === 'password' && this.state.passIsVisible) {
            this.passwordConfirm.value = value;
            state.passwordConfirm = value;
        }

        if (field === 'name') {
            this.props.setHeading(value);
        }

        this.setState(state);
    },

    _buildFormData() {
        const data = {
            NAME:        this.state.name,
            CRYPTED:     cryptHelper.encrypt({
                LOGIN:            this.state.login,
                PASSWORD:         this.state.password,
                PASSWORD_CONFIRM: this.state.passwordConfirm,
                URL:              this.state.url,
                NOTE:             this.state.note,
                FILES:            this.state.files,
            }),
            OLD_SECTION: this.props.item.element ? parseInt(this.props.item.element.SECTION) : null,
            IS_MOVED:    this.props.item.element && parseInt(this.props.item.element.SECTION) !== parseInt(this.state.parentSection),
            SECTION:     this.state.parentSection,
            COLOR:       this.state.color,
        };

        return data;
    },

    _preSubmit() {
        clearTimeout(this.passVisibilityTimeout);
        this.setState({loading: true});
    },

    edit() {
        this._preSubmit();
        this.props.edit(extend({}, this.props.item.element, this._buildFormData()));
    },

    add() {
        this._preSubmit();

        this.props.add(extend({}, this._buildFormData(), {
            CAN_OWN: true,
            CAN_READ: true,
            CAN_WRITE: true,
            CREATED_BY: this.props.currentUser.ID,
        }));
    },

    togglePassVisibility() {
        clearTimeout(this.passVisibilityTimeout);
        const newState = {passIsVisible: !this.state.passIsVisible};

        if (newState.passIsVisible && this.state.password.trim()) {
            const value = this.password.value;
            this.passwordConfirm.value = value;
            newState.passwordConfirm = value;
        }

        this.setState(newState);
        this.password.focus();
    },

    generatePass() {
        const pass = help.strRand(10);
        this.password.value = pass;
        this.passwordConfirm.value = pass;

        this.onFieldChange('password');
        this.onFieldChange('passwordConfirm');

        this.setState({passIsVisible: true});

        this.passVisibilityTimeout = setTimeout(() => {this.setState({passIsVisible: false})}, 3000);
    },

    keyupHandler(ctrlEnter = false) {
        return e => {
            if (e.which == 13 && (!ctrlEnter || e.ctrlKey || e.metaKey)) {
                this.submit();
            }
        }
    },

    submit() {
        const {name, password, passwordConfirm} = this.state;
        const {item} = this.props;

        const passesAreIdentical = password === passwordConfirm;
        let submitHandle = item && item.isEdit ? this.edit : this.add;

        if (!name.trim() || !passesAreIdentical) {
            submitHandle = () => false;
        }

        submitHandle();
    },

    handleFileChange(e) {
        this._buildFormData();
        const file = e.target.files[0];
        const maxSize = maxFileSize - this.state.files.reduce((sum, f) => sum+f.size, 0);

        for (let i = 0; i < forbiddenExtensions.length; i++) {
            if (file.name.match(new RegExp('\.' + forbiddenExtensions[i] + '$', 'i'))) {
                this.props.showAlert(help.t('FILE_UPLOAD_ERROR_EXT'));
                return;
            }
        }

        if (file.size > maxSize) {
            e.target.value = '';
            this.props.showAlert(help.t('FILE_UPLOAD_ERROR_SIZE'));
            return;
        }

        let reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => {
            this.appendFile(file, reader.result);
            e.target.value = '';
        };

        reader.onerror = e => {
            console.log('Error: ', e);
            this.props.showAlert(help.t('FILE_UPLOAD_ERROR_UNKNWN') + e);
        };
    },

    appendFile(file, content) {
        this.setState({
            files: this.state.files.concat([{
                id: (new Date()).valueOf(),
                name: file.name,
                size: file.size,
                type: file.type,
                content
            }])
        }, () => {
            this._buildFormData();
        })
    },

    fileDownload(id) {
        const file = this.state.files.filter(f => f.id === id)[0];
        if (file) {
            let content = file.content + '';
            content = content.substr(content.indexOf('base64,')+('base64,').length);

            let byteString = atob(content);

            let ab = new ArrayBuffer(byteString.length);
            let ia = new Uint8Array(ab);
            for (let i = 0; i < byteString.length; i++) {
                ia[i] = byteString.charCodeAt(i);
            }

            let blob = new Blob([ia], { type: file.type });

            FileSaver.saveAs(blob, file.name);
        }
    },

    fileDelete(id) {
        const file = this.state.files.filter(f => f.id === id)[0];
        if (file) {
            let files = [].concat(this.state.files);
            files.splice(files.indexOf(file), 1);
            this.setState({files});
        }
    },

    render() {
        const {name, login, password, passwordConfirm, url, note, loading, passIsVisible} = this.state;
        const {closeNewItem, item} = this.props;
        const passesAreIdentical = password === passwordConfirm;
        const submitClasses = classnames("btn btn-primary", {disabled: !name.trim() || !passesAreIdentical});
        const passwordConfirmClasses = classnames({['has-error']: !passesAreIdentical && document.activeElement.name != 'password'});
        const eyeClasses = classnames('icon-eye', {opened: passIsVisible});

        const passScore = help.checkPassStrength(password);

        const parent = this.props.tree.sections[this.props.tree.index[this.state.parentSection]] || {};

        return (
            <form action="javascript:void(0);" className={classnames('item-form', {loading, ['popup-vis']: this.state.popupIsVisible})}>

                <div onClick={() => this.setState({popupIsVisible: false})} className={classnames("popup-cover", {vis: this.state.popupIsVisible})}></div>

                <div className="select-tree-wrap">
                    <SelectTree
                        isElement={true}
                        close={() => this.setState({popupIsVisible: false})}
                        child={parent}
                        selected={this.state.parentSection}
                        onSelect={parentSection => this.setState({popupIsVisible: false, parentSection})}/>
                </div>

                <table className="table pass-info">
                    <tbody>
                    <tr>
                        <td>{help.t('NAME')}</td>
                        <td>
                            <input
                                defaultValue={name}
                                value={name}
                                onChange={() => this.onFieldChange('name')}
                                onKeyUp={this.keyupHandler()}
                                ref={node => this.name = node}
                                type="text"
                                maxLength="255"
                                className="form-control"/>
                        </td>
                    </tr>
                    <tr>
                        <td>{help.t('LOGIN')}</td>
                        <td>
                            <input
                                defaultValue={login}
                                value={login}
                                onChange={() => this.onFieldChange('login')}
                                onKeyUp={this.keyupHandler()}
                                ref={node => this.login = node}
                                type="text"
                                maxLength="255"
                                className="form-control"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {help.t('PASS')}
                            <i onClick={() => this.togglePassVisibility()} className={eyeClasses}></i>
                        </td>
                        <td>
                            <input
                                defaultValue={password}
                                value={password}
                                onChange={() => this.onFieldChange('password')}
                                onBlur={() => this.onFieldChange('password')}
                                onKeyUp={this.keyupHandler()}
                                ref={node => this.password = node}
                                type={passIsVisible ? "text" : "password"}
                                name="password"
                                maxLength="255"
                                className="form-control"/>
                        </td>
                    </tr>
                    <tr>
                        <td>{help.t('REPEAT')}</td>
                        <td className={passwordConfirmClasses}>
                            <input
                                disabled={passIsVisible ? 'disabled' : false}
                                defaultValue={passwordConfirm}
                                value={passwordConfirm}
                                onChange={() => this.onFieldChange('passwordConfirm')}
                                onKeyUp={this.keyupHandler()}
                                ref={node => this.passwordConfirm = node}
                                type={passIsVisible ? "text" : "password"}
                                maxLength="255"
                                className="form-control"/>
                        </td>
                    </tr>
                    <tr>
                        <td>{help.t('DIFFICULT')}</td>
                        <td>
                            <span className={`label ${passScore.class}`}>{passScore.title}</span>
                            <a onClick={this.generatePass} href="javascript:void(0);" className="pass-gen">
                                <i className="glyphicon glyphicon-repeat"></i>
                                {help.t('GENERATE_PASS')}
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>URL</td>
                        <td>
                            <input
                                defaultValue={url}
                                value={url}
                                onChange={() => this.onFieldChange('url')}
                                ref={node => this.url = node}
                                onKeyUp={this.keyupHandler()}
                                maxLength="255"
                                type="text"
                                className="form-control"/>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <div className="place-wrap">
                    <a onClick={() => !loading && this.setState({popupIsVisible: true})} href="javascript:void(0);">
                        <i className="glyphicon glyphicon-pencil"></i>
                        <i className={`icon-folder-sprite folder-${parent.ICON}`}></i>
                        <span title={parent.NAME}>{parent.NAME}<span className="name-label">{help.t('PARENT_SECTION')}</span></span>
                    </a>
                </div>

                <div className="note">
                    <div className="note-header">{help.t('NOTE')}:</div>
                    <textarea
                        defaultValue={note}
                        value={note}
                        onChange={() => this.onFieldChange('note')}
                        onKeyUp={this.keyupHandler(true)}
                        ref={node => this.note = node}
                        maxLength="500"
                        className="form-control"></textarea>
                </div>

                <div className="files note">
                    <div className="note-header">{help.t('FILES')}:</div>
                    {this.state.files.length ? this.state.files.map(f => <div className="file-wrapper" key={f.id}>
                        <a href="javascript:void(0)" onClick={e => this.fileDownload(f.id)} title={f.name}>{f.name}</a>
                        <i className="icon-remove" onClick={e => this.fileDelete(f.id)} title={help.t('DEL')}></i>
                    </div>) : null}
                    <div className="droparea">
                        <input type="file" onChange={this.handleFileChange} />
                    </div>
                </div>

                <div className="note">
                    <div className="note-header">{help.t('COLORS')}:</div>
                    <div className="colors">
                        {colors.map((color, ind) => <div className={classnames("color-block", {selected: String(ind) === this.state.color})} key={ind} onClick={e => this.setState({color: String(ind)})}>
                            <div className="tile" title={color.title} style={{backgroundColor: color.color}} />
                        </div>)}
                    </div>
                </div>


                <div className="note">
                    <input onClick={this.submit} type="submit" value={help.t('SAVE')} className={submitClasses}/>
                    <a onClick={closeNewItem} href="javascript:void(0);" className="btn btn-default">{help.t('CANCEL')}</a>
                </div>
            </form>
        )
    }
});

module.exports = AddItem;

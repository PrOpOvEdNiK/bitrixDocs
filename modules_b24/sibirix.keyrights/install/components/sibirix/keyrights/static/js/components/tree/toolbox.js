const React   = require('react');
const classes = require('classnames');
const help    = require('../../helpers/helpers');

const F_KEY = 70;

const Toolbox = React.createClass({
    getInitialState() {
        return {
            searchIsOpened: false,
            isSettingsOpened: false
        };
    },

    listenKeys(e) {
        if (e.ctrlKey && e.keyCode === F_KEY) {
            e.preventDefault();
            this.setState({searchIsOpened: true});

            return false;
        }
    },

    componentDidMount() {
        window.addEventListener('keydown', this.listenKeys);
    },

    componentWillUnmount() {
        window.removeEventListener('keydown', this.listenKeys);
    },

    componentWillReceiveProps(props) {
        if (!this.props.forceSearchClose && props.forceSearchClose) {
            this.setState({searchIsOpened: false});
        }
    },

    componentDidUpdate(prevProps, prevState) {
        if (!prevState.searchIsOpened && this.state.searchIsOpened) setTimeout(() => {this.searchInput.focus()}, 300);
    },

    openRoot() {
        this.setState({isSettingsOpened: false});
        this.props.openRoot();
    },

    onSearchChange() {
        clearTimeout(this.searchTimeout);
        this.searchTimeout = setTimeout(() => {
            const val = this.searchInput.value;
            if (val.trim().length > 1) {
                this.props.searchInput(val);
            } else {
                this.props.toggleSearch(false);
            }
        }, 500);
    },

    onInputKeyup(e) {
        if (e.which == 13) {
            const val = this.searchInput.value;
            if (val.trim().length > 1) {
                this.props.searchInput(val);
            } else {
                this.props.toggleSearch(false);
            }
        } else if (e.which == 27) {
            this.setState({searchIsOpened: false});
        }
    },

    render() {
        const {addFolderPopup, showImportPopup, canEditRoot, canEditFolder, newItem, currentUser, activeFolder, searchInput, exportData, showHistoryPopup, showViewUserPopup, showRemoveRightsPopup} = this.props;
        const {isSettingsOpened, searchIsOpened} = this.state;

        const settingClasses = classes(
            'tool',
            {
                setting: currentUser.admin || this.props.view,
                open: isSettingsOpened,
                ['no-tool']: !currentUser.admin && !this.props.view
            }
        );

        const addPassClasses = classes('tool', 'add-password', {disabled: parseInt(activeFolder) === 0 || !canEditFolder});
        const addPassAction  = parseInt(activeFolder) === 0 || !canEditFolder ? () => false : newItem;
        return (
            <div className="toolbox">
                <div onClick={() => canEditRoot ? addFolderPopup() : false}
                    className={classes("tool add-folder", {disabled: !canEditRoot})}></div>
                <div onClick={addPassAction} className={addPassClasses}></div>
                <div className={settingClasses}>
                    {currentUser.admin || this.props.view ?
                        <SettingsDropdown
                            showImportPopup={showImportPopup}
                            exportData={exportData}
                            openRoot={this.openRoot}
                            visible={isSettingsOpened}
                            toggleDropdown={() => this.setState({isSettingsOpened: !isSettingsOpened})}
                            showHistoryPopup={showHistoryPopup}
                            showViewUserPopup={showViewUserPopup}
                            view={this.props.view}
                            resetViewUser={this.props.resetViewUser}
                            currentUser={currentUser}
                            showRemoveRightsPopup={showRemoveRightsPopup}
                            /> :
                        null
                    }
                </div>
                <div onClick={() => this.setState({searchIsOpened: !searchIsOpened})}
                    className={classes("tool search", {active: searchIsOpened})}></div>
                <div className="clearfix"></div>
                <div className={classes("search-wrapper main-search", {visible: searchIsOpened})}>
                    <input onChange={this.onSearchChange}
                           onKeyUp={this.onInputKeyup}
                           onBlur={() => {this.setState({searchIsOpened: false})}}
                        ref={node => this.searchInput = node}
                        type="text"
                        className="form-control"/>
                    <i className="icon-search"></i>
                    <div className="clearfix"></div>
                </div>
            </div>
        )
    }
});

const SettingsDropdown = ({toggleDropdown, showImportPopup, visible, openRoot, exportData, showHistoryPopup, showViewUserPopup, view, resetViewUser, currentUser, showRemoveRightsPopup}) => (
    <div>
        {visible ? <div onClick={toggleDropdown} className="cover"></div> : null}

        <i onClick={toggleDropdown} className="dropdown-toggle"></i>

            <ul className="dropdown-menu">
                <li>
                    <a onClick={showImportPopup} href="javascript:void(0);">
                    <span>
                        <i className="icon icon-import"></i>
                        {help.t('IMPORT')}
                    </span>
                    </a>
                </li>
                <li>
                    <a onClick={exportData} href="javascript:void(0);">
                    <span>
                        <i className="icon icon-import"></i>
                        {help.t('EXPORT')}
                    </span>
                    </a>
                </li>
                <li>
                    <a onClick={showHistoryPopup} href="javascript:void(0);">
                    <span>
                        <i className="icon icon-import"></i>
                        {help.t('GET_HISTORY')}
                    </span>
                    </a>
                </li>
                { !view ?
                    <li>
                        <a onClick={openRoot} href="javascript:void(0);">{help.t('ROOT_RIGHTS_EDIT')}</a>
                    </li>
                    :
                    null
                }
                {CONST.backend === 'bitrix' ? <li>
                    <a onClick={showViewUserPopup} href="javascript:void(0);">
                    <span>
                        {help.t('VIEW_USER')}
                    </span>
                    </a>
                </li> : null}
                { view ?
                    <li>
                        <a onClick={resetViewUser} href="javascript:void(0);">
                            {help.t('UNVIEW_USER')}&nbsp;{'( ' + currentUser.NAME + ' ' + currentUser.LAST_NAME + ' )'}
                        </a>
                    </li>
                    :
                    null
                }
                <li>
                    <a onClick={showRemoveRightsPopup} href="javascript:void(0);">
                    <span>
                        {help.t('REMOVE_RIGHTS')}
                    </span>
                    </a>
                </li>
            </ul>
    </div>
)

module.exports = Toolbox;

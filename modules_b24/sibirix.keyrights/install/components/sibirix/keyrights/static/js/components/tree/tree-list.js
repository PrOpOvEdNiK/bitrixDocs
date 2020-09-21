const React = require('react');
const classes = require('classnames');
const ActionTypes = require('../../constants/action-types');
const help = require('../../helpers/helpers');

const TreeList = React.createClass({
    shouldComponentUpdate(nextProps) {
        if (nextProps.lastAction === ActionTypes.SEARCH_INPUT || nextProps.lastAction === ActionTypes.TOGGLE_SEARCH) {
            return false;
        }

        return true;
    },
    render() {
        return (
            <ul className={this.props.top ? "list tree" : "low list tree"}>
                {this.props.items.map((t, k) =>
                        <TreeElement
                            {...this.props}
                            item={t}
                            key={k}/>
                )}
            </ul>
        )
    }
});
const _truthyActions = [
    ActionTypes.OPEN_FOLDER,
    ActionTypes.MOVE_FOLDER,
    ActionTypes.ITEM_IS_ADDED,
    ActionTypes.FOLDER_IS_ADDED,
    ActionTypes.FOLDER_IS_EDITED,
    ActionTypes.FOLDER_IS_REMOVED,
    ActionTypes.CHANGE_FAVORITE_FOLDER,
    ActionTypes.CHANGE_FAVORITE_ITEM,
];

const TreeElement = React.createClass({
    getInitialState() {
        return {
            isDropHover: false,
            menuIsVisible: false,
            menuTop: 0,
            opened: false
        }
    },

    shouldComponentUpdate(nextProps, nextState) {
        if (this.state.menuIsVisible !== nextState.menuIsVisible) return true;
        if (this.state.isDropHover !== nextState.isDropHover) return true;
        if (this.state.menuTop !== nextState.menuTop) return true;
        if (this.state.opened !== nextState.opened) return true;

        const {lastAction, activeFolder, item} = nextProps;
        const lastActiveFolder = this.props.activeFolder;

        if (_truthyActions.indexOf(lastAction) === -1) return false;

        if (lastAction === ActionTypes.OPEN_FOLDER || lastAction === ActionTypes.ITEM_IS_ADDED) {
            if (parseInt(activeFolder) === parseInt(item.ID) || parseInt(lastActiveFolder) === parseInt(item.ID)) {
                return true;
            }

            if (item.ALL_KIDS.indexOf(parseInt(activeFolder)) !== -1 || item.ALL_KIDS.indexOf(parseInt(lastActiveFolder)) !== -1) return true;

            return false;
        }

        return true;
    },

    onToggleClick(e) {
        e.stopPropagation();

        this.setState({opened: !this.state.opened})
    },

    onDragStart(e) {
        if (parseInt(this.props.item.SECTION) !== 0) {
            this.props.toggleDragToRoot(true);
        }

        e.stopPropagation();
        e.dataTransfer.setData("itemId", this.props.item.ID);
        e.dataTransfer.setData("parentId", this.props.item.SECTION);
    },

    onDragOver(e) {
        e.stopPropagation();

        if (this.props.item.CAN_WRITE) {
            e.preventDefault();
            this.setState({isDropHover: true});
        }
    },

    onDragLeave(e) {
        e.preventDefault();
        e.stopPropagation();

        this.setState({isDropHover: false});
    },

    onDrop(e) {
        e.stopPropagation();
        this.props.toggleDragToRoot(false);

        if (e.dataTransfer.getData("itemId")) {
            const dragId = parseInt(e.dataTransfer.getData("itemId"));
            const dragParentId = parseInt(e.dataTransfer.getData("parentId"));
            const targetId = parseInt(this.props.item.ID);

            this.setState({isDropHover: false});

            if ((dragId === targetId) || (dragParentId && parseInt(dragParentId) === targetId)) return false;

            this.props.moveFolder(dragId, targetId);
        } else {
            const dragId = parseInt(e.dataTransfer.getData("entityId"));
            const dragParentId = parseInt(e.dataTransfer.getData("parentId"));
            const targetId = parseInt(this.props.item.ID);

            this.setState({isDropHover: false});

            if ((dragParentId && parseInt(dragParentId) === targetId)) return false;

            this.props.moveItem(dragId, targetId, dragParentId);
        }
    },

    componentDidMount() {
        this.item.addEventListener('dragstart', this.onDragStart);
        this.item.addEventListener('dragover', this.onDragOver);
        this.item.addEventListener('dragleave', this.onDragLeave);
        this.item.addEventListener('drop', this.onDrop);
    },

    componentWillMount() {
        const {item, activeFolder} = this.props;

        item.ALL_KIDS.indexOf(parseInt(activeFolder)) !== -1 && this.setState({opened: true});
    },

    componentWillUnmount() {
        this.item.removeEventListener('dragstart', this.onDragStart);
        this.item.removeEventListener('dragover', this.onDragOver);
        this.item.removeEventListener('dragleave', this.onDragLeave);
        this.item.removeEventListener('drop', this.onDrop);
    },

    open(e) {
        e.stopPropagation();
        this.props.openFolder(this.props.item.ID);
    },

    componentWillReceiveProps (nextProps) {
        let {activeFolder, item} = nextProps;

        let opened = this.state.opened;

        if (item.ALL_KIDS.indexOf(parseInt(activeFolder)) !== -1) opened = true;

        this.setState({opened})
    },

    toggleMenu(e, menuIsVisible) {
        e.preventDefault();
        e.stopPropagation();

        if (menuIsVisible) {
            const rect = e.target.getBoundingClientRect();
            var between = window.innerHeight - rect.top;

            if(between < 200) {
                this.setState({menuIsVisible, menuTop: rect.top-100});
            } else {
                this.setState({menuIsVisible, menuTop: rect.top});
            }

        } else {
            this.setState({menuIsVisible});
        }
    },

    handleMenuClick(e, action) {
        this.toggleMenu(e, false);
        action();
    },

    render() {
        const {changeFavorite, moveToTop, activeFolder, lastAction, toggleDragToRoot,addUsers, moveFolder, moveItem, showEditFolderPopup, showRemoveFolderConfirm, item, getKids, addFolderPopup, openFolder} = this.props;
        let {opened} = this.state;

        let classNames = "item-content drag-root tree-element";
        let elementHasKids = item.ALL_KIDS.length;

        if (elementHasKids) classNames += ' has-child';
        if (opened) classNames += ' opened';
        if (parseInt(activeFolder) === parseInt(item.ID)) classNames += ' active';
        return (
            <li ref={node => this.item = node}
                draggable={item.CAN_WRITE ? true : false}
                onContextMenu={(e) => this.toggleMenu(e, true)}
                onClick={this.open}>
                <div className={classes(classNames, {['drop-hover']: this.state.isDropHover})}>
                    <i className={classes(`icon icon-folder icon-folder-sprite folder-${item.ICON}`, {favorite: item.isFavorite } )}>
                        <span
                            onClick={this.onToggleClick}
                            className="toggle-button"
                            title={help.t('SHOW_HIDE')}></span>
                    </i>
                    <span className="one-line">{item.NAME}</span>
                    {item.CAN_WRITE ?
                        <div
                            className={classes("menu dropdown", {open: this.state.menuIsVisible})}>
                            {this.state.menuIsVisible ?
                                <div onContextMenu={(e) => this.toggleMenu(e, false)}
                                     onClick={(e) => this.toggleMenu(e, false)}
                                     className="cover"></div> : null}
                            <i onClick={(e) => this.toggleMenu(e, true)}
                               className="icon-menu dropdown-toggle" dangerouslySetInnerHTML={{__html: '&nbsp;'}}></i>
                            <ul style={{top: this.state.menuTop}} className="dropdown-menu tree">
                                <li>
                                    <a onClick={(e) => this.handleMenuClick(e, () => addFolderPopup(item.ID))}
                                       href="javascript:void(0);">
                                        <span>{help.t('SUBSECTION_ADD')}</span>
                                        <small>Ctrl+d</small>
                                    </a>
                                </li>
                                <li>
                                    <a onClick={(e) => this.handleMenuClick(e, () => showRemoveFolderConfirm(item.ID))}
                                       href="javascript:void(0);">
                                        <span>{help.t('DEL')}</span>
                                    </a>
                                </li>
                                <li>
                                    <a onClick={(e) => this.handleMenuClick(e, () => showEditFolderPopup(item))}
                                       href="javascript:void(0);">
                                        <span>{help.t('EDIT')}</span>
                                        <small>Ctrl+e</small>
                                    </a>
                                </li>
                                <li>
                                    <a onClick={(e) => this.handleMenuClick(e, () => addUsers({isSection: true, id: item.ID}))}
                                       href="javascript:void(0);">
                                        <span>{help.t('GRANT_ACCESS')}</span>
                                        <small>Ctrl+shift+a</small>
                                    </a>
                                </li>
                                <li>
                                    <a onClick={(e) => this.handleMenuClick(e, () => changeFavorite(item.ID, true))}
                                       href="javascript:void(0);">
                                        <span>{help.t(item.isFavorite ? 'REMOVE_FAVORITE' : 'ADD_FAVORITE')}</span>
                                    </a>
                                </li>
                                {item.SECTION !== 0 ? <li>
                                    <a onClick={(e) => this.handleMenuClick(e, () => moveToTop(item.ID))}
                                       href="javascript:void(0);">
                                        <span>{help.t('MOVE_TO_TOP')}</span>
                                    </a>
                                </li> : null}
                            </ul>
                        </div> :
                        null
                    }
                </div>

                {elementHasKids && opened ?
                    <TreeList
                        changeFavorite={changeFavorite}
                        moveToTop={moveToTop}
                        lastAction={lastAction}
                        moveItem={moveItem}
                        addUsers={addUsers}
                        toggleDragToRoot={toggleDragToRoot}
                        moveFolder={moveFolder}
                        showEditFolderPopup={showEditFolderPopup}
                        showRemoveFolderConfirm={showRemoveFolderConfirm}
                        addFolderPopup={addFolderPopup}
                        openFolder={openFolder}
                        activeFolder={activeFolder}
                        top={false}
                        getKids={getKids}
                        items={getKids(item).sort(help.sortByNameAsc)}/>
                    : null}
            </li>
        )
    }
});

module.exports = TreeList;

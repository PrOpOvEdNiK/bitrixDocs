const React   = require('react');
const classes = require('classnames');
const Actions = require('../actions/');
const {connect} = require('react-redux');
const help    = require('../helpers/helpers');
const extend      = require('extend');

const Toolbox    = require('./tree/toolbox');
const NoSections = require('./tree/no-sections.js');
const TreeList   = require('./tree/tree-list');

const Scrollbars  = require('react-gemini-scrollbar');
const ActionTypes = require('../constants/action-types');

const _truthyActions = [
    ActionTypes.END_FETCH_DATA,
    ActionTypes.OPEN_FOLDER,
    ActionTypes.MOVE_FOLDER,
    ActionTypes.ITEM_IS_ADDED,
    ActionTypes.FOLDER_IS_ADDED,
    ActionTypes.FOLDER_IS_EDITED,
    ActionTypes.REMOVE_ITEM,
    ActionTypes.SEARCH_INPUT,
    ActionTypes.TOGGLE_SEARCH,
    ActionTypes.FOLDER_IS_REMOVED,
    ActionTypes.CHANGE_FAVORITE_FOLDER,
    ActionTypes.CHANGE_FAVORITE_ITEM,
    ActionTypes.SHOW_FAVORITE
];

const A_KEY = 65;
const D_KEY = 68;
const E_KEY = 69;

const Tree = React.createClass({
    getInitialState() {
        return {
            forceSearchOpen: false,
            isItemDragged: false
        };
    },

    onDragOver(e) {
        e.preventDefault();
    },
    onDragLeave(e) {
        e.preventDefault();
        e.stopPropagation();
    },
    onDrop(e) {
        this.setState({isItemDragged: false});
        this.props.moveFolder(parseInt(e.dataTransfer.getData("itemId")), 0);
    },

    listenKeys(e) {
        if (e.ctrlKey) {
            if (e.keyCode === D_KEY) {
                e.preventDefault();
                this.props.showAddFolderPopup(this.props.activeFolder);

                return false;
            }

            if (e.keyCode === E_KEY) {
                e.preventDefault();

                this.props.showEditFolderPopup(this.props.sections[this.props.index[this.props.activeFolder]]);
                return false;
            }

            if (e.shiftKey && e.keyCode === A_KEY) {
                e.preventDefault();
                this.props.addUsers({isSection: true, id: this.props.activeFolder});

                return false;
            }
        }
    },

    componentDidMount() {
        window.document.title = "KeyRights";

        this.dragRoot.addEventListener('dragover', this.onDragOver);
        this.dragRoot.addEventListener('dragleave', this.onDragLeave);
        this.dragRoot.addEventListener('drop', this.onDrop);

        window.addEventListener('keydown', this.listenKeys);

        if (!this.props.activeFolder && this.props.activeFolder !== 0 && this.props.tree.length) {
            this.props.openFolder(this.props.tree[0].ID, this.props.currentUser);
        }
    },

    componentWillUnmount() {
        this.dragRoot.removeEventListener('dragover', this.onDragOver);
        this.dragRoot.removeEventListener('dragleave', this.onDragLeave);
        this.dragRoot.removeEventListener('drop', this.onDrop);

        window.removeEventListener('keyup', this.listenKeys);
    },

    componentWillUpdate(nextProps) {
        if (!nextProps.activeFolder && nextProps.activeFolder !== 0 && nextProps.tree.length) {
            this.props.openFolder(nextProps.tree[0].ID, nextProps.currentUser);
        }
    },

    getKids(item) {
        return item.ALL_KIDS
            .map(i => this.props.sections[this.props.index[i]] ? this.props.sections[this.props.index[i]] : false)
            .filter(k => k && parseInt(k.SECTION) === parseInt(item.ID));
    },

    shouldComponentUpdate(nextProps, nextState) {
        if (this.state.isItemDragged !== nextState.isItemDragged || this.state.forceSearchOpen !== nextState.forceSearchOpen) return true;
        if (_truthyActions.indexOf(nextProps.lastAction) === -1) return false;
        return true;
    },

    canEditRoot() {
        const root = this.props.sections[this.props.index[0]];
        return root && root.CAN_WRITE;
    },

    render() {
        const {showAddFolderPopup, currentUser, tree, activeFolder, openFolder, removeFolder, sections, index, items, showHistoryPopup} = this.props;

        const canEditRoot = this.canEditRoot();
        var section = sections[index[activeFolder]];

        return (
            <div className={classes("sidepanel navi", {dragging: this.state.isItemDragged && canEditRoot})}>
                <div ref={node => this.dragRoot = node} className="drag-to-root">{help.t('TO_ROOT_FOLDER')}</div>
                <Toolbox
                    forceSearchClose={this.props.forceSearchClose}
                    exportData={() => this.props.exportData()}
                    forceSearchOpen={this.state.forceSearchOpen}
                    searchInput={this.props.searchInput}
                    toggleSearch={this.props.toggleSearch}
                    canEditRoot={canEditRoot}
                    canEditFolder={section && section.CAN_WRITE}
                    activeFolder={this.props.activeFolder}
                    openRoot={() => this.props.openFolder(0, currentUser)}
                    currentUser={this.props.currentUser}
                    newItem={() => this.props.newItem(activeFolder)}
                    addFolderPopup={this.props.showAddFolderPopup}
                    showImportPopup={this.props.showImportPopup}
                    showHistoryPopup={showHistoryPopup}
                    showViewUserPopup={this.props.showViewUserPopup}
                    view={this.props.view}
                    resetViewUser={this.props.resetViewUser}
                    showRemoveRightsPopup={this.props.showRemoveRightsPopup}
                />

                {tree.length ?
                    <Scrollbars>
                        <div className="wrapper-left">
                            <TreeList
                                {...this.props}
                                toggleDragToRoot={(isItemDragged) => this.setState({isItemDragged})}
                                addFolderPopup={this.props.showAddFolderPopup}
                                openFolder={(id) => openFolder(id, currentUser)}
                                removeFolder={(id) => removeFolder(id)}
                                getKids={(item) => this.getKids(item)}
                                items={tree}
                                top={true}/>
                        </div>
                    </Scrollbars>
                    : <NoSections addFolderPopup={showAddFolderPopup} canEditRoot={canEditRoot} />}
            </div>
        )
    }
});

function getBaseTree(items) {
    return items.filter((t) => parseInt(t.SECTION) === 0);
}

function mapStateToProps(state) {
    var sections = state.tree.tree.sections.map(section => {
        return extend({isFavorite: state.favorite.folders.indexOf(parseInt(section.ID)) != -1}, section);
    });
    const {index} = state.tree.tree;
    return {
        items: state.items.items,
        lastAction: state.action,
        forceSearchClose: state.search.forceClose,
        tree: getBaseTree(sections),
        activeFolder: state.tree.activeFolder,
        currentUser: state.currentUser,
        sections: sections,
        index,
        view: state.view
    }
}

function mapDispatchToProps(dispatch) {
    return {
        openFolder: (id, user) => dispatch(Actions.openFolder(id, user)),
        exportData: (items, sections) => dispatch(Actions.exportData(items, sections)),
        showRemoveFolderConfirm: (id) => dispatch(Actions.showRemoveFolderConfirm(id)),
        showEditFolderPopup: (data) => dispatch(Actions.showEditFolderPopup(data)),
        showImportPopup: () => dispatch(Actions.showImportPopup()),
        newItem: () => dispatch(Actions.newItem()),
        addUsers: (data) => dispatch(Actions.addUsers(data)),
        moveFolder: (id, to) => dispatch(Actions.moveFolder(id, to)),
        moveItem: (id, to, oldTo) => dispatch(Actions.moveItem(id, to, oldTo)),
        searchInput: (q) => dispatch(Actions.searchInput(q)),
        toggleSearch: (state) => dispatch(Actions.toggleSearch(state)),
        showAddFolderPopup: (state) => dispatch(Actions.showAddFolderPopup(state)),
        changeFavorite: (id, isFolder) => dispatch(Actions.changeFavorite(id, isFolder)),
        moveToTop: (id) => dispatch(Actions.moveFolder(id, 0)),
        getHistory: () => dispatch(Actions.getHistory()),
        showHistoryPopup: () => dispatch(Actions.showHistoryPopup()),
        showViewUserPopup: () => dispatch(Actions.showViewUserPopup()),
        resetViewUser: () => dispatch(Actions.resetViewUser()),
        showRemoveRightsPopup: () => dispatch(Actions.showRemoveRightsPopup()),
    }
}

module.exports = connect(mapStateToProps, mapDispatchToProps)(Tree);

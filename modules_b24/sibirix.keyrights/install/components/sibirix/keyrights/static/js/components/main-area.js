const React       = require('react');
const Actions     = require('../actions/');
const help        = require('../helpers/helpers');
const ActionTypes = require('../constants/action-types');
const extend      = require('extend');
const {connect} = require('react-redux');

const NoItems = require('./main/no-items');
const Heading = require('./main/heading');
const List    = require('./main/list');

const _truthyActions = [
    ActionTypes.END_FETCH_DATA,
    ActionTypes.OPEN_FOLDER,
    ActionTypes.MOVE_FOLDER,
    ActionTypes.FOLDER_IS_ADDED,
    ActionTypes.FOLDER_IS_EDITED,
    ActionTypes.CHANGE_MAIN_SORT,
    ActionTypes.SEARCH_INPUT,
    ActionTypes.ITEM_IS_ADDED,
    ActionTypes.ITEM_EDIT_START,
    ActionTypes.OPEN_ITEM,
    ActionTypes.MOVE_ITEM,
    ActionTypes.REMOVE_ITEM,
    ActionTypes.TOGGLE_SEARCH,
    ActionTypes.FOLDER_IS_REMOVED,
    ActionTypes.CHANGE_FAVORITE_FOLDER,
    ActionTypes.CHANGE_FAVORITE_ITEM,
    ActionTypes.SHOW_FAVORITE,
    ActionTypes.HIDE_FAVORITE,
];


const MainArea = React.createClass({
    shouldComponentUpdate(nextProps) {
        const {lastAction} = nextProps;

        if (_truthyActions.indexOf(lastAction) === -1) return false;

        return true;
    },
    render() {
        const {folders, items, sort, toggleSort, showFavorite, hideFavorite, isFavoritesOpened, activeFolderItem, showRemoveFolderConfirm, showEditFolderPopup, addUsers, showAddFolderPopup} = this.props;
        const isEmpty = !folders.length && !items.length && (!activeFolderItem || activeFolderItem.SECTION <= 0);

        return (
            <div className="main">
                <Heading isFavoritesOpened={isFavoritesOpened} showFavorite={showFavorite} hideFavorite={hideFavorite} toggleSort={toggleSort} selectedUser={this.props.selectedUser} selectedGroup={this.props.selectedGroup} sort={sort}/>

                {isEmpty
                    ? <NoItems isSearching={this.props.isSearching} isFavoritesOpened={isFavoritesOpened} activeFolderItem={activeFolderItem} showEditFolderPopup={showEditFolderPopup} />
                    : <List {...this.props} />
                }
            </div>
        )
    }
});

function mapStateToProps(state) {
    const {activeFolder} = state.tree;
    const {activeItem} = state.items;
    const {sort} = state.main;

    const sortingFunction = sort === 'asc' ? help.sortByNameAsc : help.sortByNameDesc;

    let folders  = [];
    let elements = [];
    let selectedUser = false;
    let selectedGroup = false;
    let activeFolderItem = false;

    if(state.isFavoritesOpened) {

        const foldersIds = state.favorite.folders;
        const items = state.items.items.entities.filter(entities => {
            return state.favorite.items.indexOf(parseInt(entities.ID)) != -1;
        }).sort(sortingFunction);

        let itemsParentsIds = help.unique(items.filter(i => foldersIds.indexOf(parseInt(i.SECTION)) === -1).map(i => parseInt(i.SECTION)));

        folders = [...foldersIds, ...itemsParentsIds].map(f => {
            const folder    = state.tree.tree.sections[state.tree.tree.index[f]];
            folder.ENTITIES = items.filter(i => parseInt(i.SECTION) === f).map(entities => {
                return extend({isFavorite: state.favorite.items.indexOf(parseInt(entities.ID)) != -1}, entities);
            });

            return folder;
        }).sort(sortingFunction);


    } else if (state.search.isSearching && state.search.query) {
        const foldersFoundIds = [];

        state.tree.tree.sections.forEach(s => {
            if (s.NAME.toLowerCase().indexOf(state.search.query.toLowerCase()) !== -1) {
                foldersFoundIds.push(parseInt(s.ID));
            }
        });

        const items = state.items.items.entities.filter(i => {
            return foldersFoundIds.indexOf(parseInt(i.SECTION)) !== -1 || i.NAME.toLowerCase().indexOf(state.search.query.toLowerCase()) !== -1;
        }).sort(sortingFunction);

        let itemsParentsIds = help.unique(items.filter(i => foldersFoundIds.indexOf(parseInt(i.SECTION)) === -1).map(i => parseInt(i.SECTION)));

        folders = [...foldersFoundIds, ...itemsParentsIds].map(f => {
            const folder    = state.tree.tree.sections[state.tree.tree.index[f]];
            folder.ENTITIES = items.filter(i => parseInt(i.SECTION) === f).map(entities => {
                return extend({isFavorite: state.favorite.items.indexOf(parseInt(entities.ID)) != -1}, entities);
            });

            return folder;
        }).sort(sortingFunction);

    } else if (state.search.userId || state.search.groupId) {
        selectedUser = state.search.userId ? state.users.filter(u => parseInt(u.ID) === state.search.userId)[0] : false;
        selectedGroup = state.search.groupId ? state.groups.items[state.groups.index[state.search.groupId]] : false;

        const items = state.items.items.entities.filter(i => {

        });

    } else {
        const activeElement = state.tree.tree.sections[state.tree.tree.index[activeFolder]];
        activeFolderItem = activeElement;
        folders             = activeFolder && activeElement
            ? activeElement.ALL_KIDS
                .map(k => typeof state.tree.tree.index[k] !== 'undefined' ? state.tree.tree.sections[state.tree.tree.index[k]] : false)
                .filter(f => f && parseInt(f.SECTION) === parseInt(activeFolder)).sort(sortingFunction)
            : [];

        elements = activeFolder ? state.items.items.entities.filter((i) => i.SECTION == activeFolder).sort(sortingFunction) : [];
    }

    elements = elements.map(entities => {
        return extend({isFavorite: state.favorite.items.indexOf(parseInt(entities.ID)) != -1}, entities);
    });

    folders = folders.map(folder => {
        return extend({isFavorite: state.favorite.folders.indexOf(parseInt(folder.ID)) != -1}, folder);
    });

    return {
        selectedUser,
        selectedGroup,
        lastAction: state.action,
        isSearching: state.search.isSearching,
        items: elements,
        folders,
        currentUser: state.currentUser,
        activeFolder,
        activeFolderItem,
        activeItem,
        sort,
        isFavoritesOpened: state.isFavoritesOpened
    }
}

function mapDispatchToProps(dispatch) {
    return {
        moveFolder: (id, to) => dispatch(Actions.moveFolder(id, to)),
        moveItem: (id, to, oldTo) => dispatch(Actions.moveItem(id, to, oldTo)),
        openFolder: (id, user) => dispatch(Actions.openFolder(id, user)),
        changeFavorite: (id, isFolder) => dispatch(Actions.changeFavorite(id, isFolder)),
        showFavorite: () => dispatch(Actions.showFavorite()),
        hideFavorite: () => dispatch(Actions.hideFavorite()),
        openItem: id => dispatch(Actions.openItem(id)),
        showRemoveItemConfirm: item => dispatch(Actions.showRemoveItemConfirm(item)),
        toggleSort: () => dispatch(Actions.toggleSort()),
        showRemoveFolderConfirm: (id) => dispatch(Actions.showRemoveFolderConfirm(id)),
        showEditFolderPopup: (data) => dispatch(Actions.showEditFolderPopup(data)),
        showAddFolderPopup: (state) => dispatch(Actions.showAddFolderPopup(state)),
        addUsers: (data) => dispatch(Actions.addUsers(data))
    }
}

module.exports = connect(mapStateToProps, mapDispatchToProps)(MainArea);

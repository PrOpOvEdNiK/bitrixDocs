const extend      = require('extend');
const ActionTypes = require('../constants/action-types');
const help        = require('../helpers/helpers');
const {combineReducers} = require('redux');

const _buildIndex = (sections) => {
    let ids = {};

    sections.forEach((t, i) => {
        ids[t.ID] = i;
    });

    return ids;
};

const activeFolder = (state = false, action = {type: ''}) => {
    switch (action.type) {
        case ActionTypes.OPEN_FOLDER:
            return parseInt(action.id) === 0 ? state : action.id;

        case ActionTypes.ITEM_IS_ADDED:
            return parseInt(action.data.SECTION);

        case ActionTypes.FOLDER_IS_REMOVED:
            return parseInt(action.item.ID) === parseInt(state) || action.item.ALL_KIDS.indexOf(parseInt(state)) !== -1 ? false : state;

        case ActionTypes.VIEW_USER:
            return false;

        case ActionTypes.RESET_VIEW_USER:
            return false;

        default:
            return state;
    }
};

const tree = (state = {sections: [], index: {}}, action = {type: ''}) => {
    let sections, treeIndex;
    switch (action.type) {
        case ActionTypes.END_FETCH_DATA:
            sections = action.sections.length ? action.sections : [];

            const allowed = help.getAllowedFolders(action.currentUser, sections, _buildIndex(sections), action.items).sort(help.sortByNameAsc);

            return {
                sections: allowed,
                index: _buildIndex(allowed),
            };

        case ActionTypes.CHANGE_OWNER_START:
            if (!action.sectionId) return state;

            const changedFolder = state.sections[state.index[action.sectionId]];
            changedFolder.OWNER = action.owner;

            sections = [
                ...state.sections.slice(0, state.index[action.sectionId]),
                extend({}, changedFolder, help.getFolderAccessObj(changedFolder, action.user, state.sections, state.index)),
                ...state.sections.slice(state.index[action.sectionId] + 1)];

            return {
                sections,
                index: _buildIndex(sections),
            };

        case ActionTypes.FOLDER_IS_ADDED:
            const newFolder = extend({}, action.data.section, {
                ALL_PARENTS: help.getItemParents(action.data.section, state.sections, state.index).map(p => parseInt(p.ID)),
                ALL_KIDS: []
            });

            sections = [...state.sections, newFolder].sort(help.sortByNameAsc);
            treeIndex = _buildIndex(sections);

            if (newFolder.SECTION) {
                let parentId = parseInt(newFolder.SECTION);

                while (parentId === 0 || parentId) {
                    const parentIndex = treeIndex[parentId];
                    const parent      = sections[parentIndex];

                    parent.ALL_KIDS   = [...parent.ALL_KIDS, parseInt(newFolder.ID)];

                    sections = [
                        ...sections.slice(0, parentIndex),
                        parent,
                        ...sections.slice(parentIndex + 1)];

                    parentId = parseInt(parent.SECTION);
                }
            }

            return {
                sections,
                index: treeIndex
            };

        case ActionTypes.MOVE_FOLDER:
            const moveItem = state.sections[state.index[action.id]];
            const moveFrom = state.sections[state.index[moveItem.SECTION]];
            const moveTo   = state.sections[state.index[action.to]];

            sections = state.sections.map(s => {
                if (parseInt(s.ID) === parseInt(moveItem.ID)) {
                    let parents = [].concat(moveTo.ALL_PARENTS);

                    parents.push(parseInt(moveTo.ID));

                    s = extend({}, s, {ALL_PARENTS: parents, SECTION: moveTo.ID, IBLOCK_SECTION_ID: moveTo.ID});

                } else if (parseInt(s.ID) === parseInt(moveFrom.ID)) {
                    const index = s.ALL_KIDS.indexOf(parseInt(moveItem.ID));
                    s.ALL_KIDS  = [...s.ALL_KIDS.slice(0, index), ...s.ALL_KIDS.slice(index + 1)];

                } else if (parseInt(s.ID) === parseInt(moveTo.ID)) {
                    s.ALL_KIDS = [...s.ALL_KIDS, parseInt(moveItem.ID)];
                } else if (moveItem.ALL_PARENTS.indexOf(parseInt(s.ID)) && parseInt(s.ID) != parseInt(moveFrom.ID)) {
                    s.ALL_KIDS.splice(s.ALL_KIDS.indexOf(parseInt(moveItem.ID)), 1);
                }

                return s;
            });

            return {
                sections,
                index: state.index
            };

        case ActionTypes.FOLDER_IS_REMOVED:
            const index = state.index[action.item.ID];
            const f     = state.sections[index];

            sections = [
                ...state.sections.slice(0, index),
                ...state.sections.slice(index + 1),
            ].sort(help.sortByNameAsc);

            if (f.ALL_KIDS.length) {
                sections = sections.filter(s => f.ALL_KIDS.indexOf(parseInt(s.ID)) === -1);
            }

            sections = sections.map(s => {
                if (s.ALL_KIDS.indexOf(parseInt(f.ID)) !== -1) {
                    const idx = s.ALL_KIDS.indexOf(f.ID);

                    s.ALL_KIDS = [
                        ...s.ALL_KIDS.slice(0, idx),
                        ...s.ALL_KIDS.slice(0, idx + 1),
                    ];
                }

                return s;
            });

            return {
                sections,
                index: _buildIndex(sections),
            };

        case ActionTypes.FOLDER_IS_EDITED:
            const itemIndex = state.index[action.data.ID];
            const changedSection = extend({}, state.sections[itemIndex], action.data);
            const oldSection = state.sections[itemIndex].SECTION;

            sections = [
                ...state.sections.slice(0, itemIndex),
                changedSection,
                ...state.sections.slice(itemIndex + 1)
            ];
            treeIndex = _buildIndex(sections);

            if (parseInt(action.data.SECTION) !== parseInt(oldSection)) {
                //remove from kids arr
                sections = sections.map(s => {
                    if (s.ALL_KIDS.indexOf(parseInt(action.data.ID)) !== -1) {
                        const idx = s.ALL_KIDS.indexOf(action.data.ID);

                        s.ALL_KIDS = [
                            ...s.ALL_KIDS.slice(0, idx),
                            ...s.ALL_KIDS.slice(0, idx + 1),
                        ];
                    }

                    return s;
                });

                //add to kids arr
                let parentId = parseInt(action.data.SECTION);

                while (parentId === 0 || parentId) {
                    const parentIndex = treeIndex[parentId];
                    const parent      = sections[parentIndex];

                    parent.ALL_KIDS   = [...parent.ALL_KIDS, parseInt(action.data.ID)];

                    sections = [
                        ...sections.slice(0, parentIndex),
                        parent,
                        ...sections.slice(parentIndex + 1)];

                    parentId = parseInt(parent.SECTION);
                }
            }

            return {
                sections,
                index: treeIndex,
            }

        case ActionTypes.SAVE_RIGHTS_START:
            if (action.data.entityId) return state;

            sections = state.sections.map((s) => {
                if (parseInt(s.ID) !== parseInt(action.data.sectionId)) return s;
                const ex = extend({}, s, {RIGHTS: action.data.rights ? action.data.rights : []});
                return extend({}, ex, help.getFolderAccessObj(ex, action.user, state.sections, state.index));
            });

            return {
                sections,
                index: _buildIndex(sections),
            }

        case ActionTypes.FOLDER_IS_OPENED:
            sections = state.sections.map((s) => {
                if (parseInt(s.ID) !== parseInt(action.data.section_id)) return s;
                const data = {
                    OWNER: action.data.owner,
                    RIGHTS: action.data.rights
                }

                const ex = extend({}, s, data);
                return extend({}, ex, help.getFolderAccessObj(ex, action.user, state.sections, state.index));
            });

            return {
                sections,
                index: _buildIndex(sections),
            }
        default:
            return state;
    }
}

module.exports = combineReducers({tree, activeFolder});

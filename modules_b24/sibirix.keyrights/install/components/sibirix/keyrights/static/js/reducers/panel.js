const extend      = require('extend');
const ActionTypes = require('../constants/action-types');
const {combineReducers} = require('redux');

const panelElement = (state = false, action = {type: ''}) => {
    let smartLoad;
    switch (action.type) {
        case ActionTypes.OPEN_FOLDER:
            return {
                isFolder: true,
                smartLoad: true,
                id: action.id,
                isLoading: false
            };

        case ActionTypes.REMOVE_ITEM:
            return {
                isFolder: true,
                smartLoad: false,
                id: action.item.SECTION,
                isLoading: false
            };

        case ActionTypes.FOLDER_IS_OPENED:
            return extend({}, state, {isLoading: false, smartLoad: false});

        case ActionTypes.SAVE_RIGHTS_START:
            smartLoad = true;

            if (state.isFolder) {
                if (parseInt(state.id) !== parseInt(action.data.sectionId)) smartLoad = false;
            } else {
                if (parseInt(state.id) !== parseInt(action.data.entityId)) smartLoad = false;
            }

            return extend({}, state, {smartLoad});

        case ActionTypes.CHANGE_OWNER_START:
            smartLoad = true;

            if (state.isFolder) {
                if (parseInt(state.id) !== parseInt(action.sectionId)) smartLoad = false;
            } else {
                if (parseInt(state.id) !== parseInt(action.entityId)) smartLoad = false;
            }

            return extend({}, state, {smartLoad});

        case ActionTypes.CHANGE_OWNER_END:
            return extend({}, state, {smartLoad: false});

        case ActionTypes.SAVE_ITEM_RIGHTS_END:
            return extend({}, state, {smartLoad: false});

        case ActionTypes.SAVE_FOLDER_RIGHTS_END:
            return extend({}, state, {smartLoad: false});

        case ActionTypes.ITEM_IS_OPENED:
            return extend({}, state, {isLoading: false, smartLoad: false});

        case ActionTypes.NEW_ITEM_FORM:
            return extend({}, state, {isNew: true, isEdit: false});

        case ActionTypes.EDIT_ITEM_FORM:
            return extend({}, state, {isEdit: true});

        case ActionTypes.CLOSE_NEW_ITEM:
            return {
                isFolder: state.isFolder,
                id: state.id
            };

        case ActionTypes.ITEM_IS_ADDED:
            return {
                isFolder: false,
                id: action.data.ID
            };

        case ActionTypes.ITEM_EDIT_START:
            if (action.data.IS_MOVED) {
                return {
                    isFolder: true,
                    smartLoad: true,
                    id: parseInt(action.data.OLD_SECTION),
                    isLoading: false
                };
            }

            return extend({}, state, {isEdit: false, smartLoad: true});

        case ActionTypes.ITEM_IS_EDITED:
            return extend({}, state, {isEdit: false, smartLoad: false});

        case ActionTypes.OPEN_ITEM:
            return {
                isLoading: false,
                smartLoad: true,
                isFolder: false,
                id: action.id
            };
        default:
            return state;
    }
};

module.exports = combineReducers({panelElement});
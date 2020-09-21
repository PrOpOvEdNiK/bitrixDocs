const extend      = require('extend');
const ActionTypes = require('../constants/action-types');
const {combineReducers} = require('redux');

const _initial = false;

const alert = (state = '', action = {type: ''}) => {
    switch (action.type) {
        case ActionTypes.ALERT:
            return action.text;
        case ActionTypes.CLOSE_ALERT:
            return '';
    }

    return state;
};

const openedModal = (state = _initial, action = {type: '', data: null}) => {
    switch (action.type) {
        case ActionTypes.CLOSE_MODAL:
            return false;

        case ActionTypes.ADD_USERS:
            return {
                type: ActionTypes.ADD_USERS,
                isSection: action.isSection,
                id: parseInt(action.id)
            };

        case ActionTypes.CHANGE_OWNER:
            return {
                type: ActionTypes.CHANGE_OWNER,
                isSection: action.isSection,
                id: parseInt(action.id)
            };

        case ActionTypes.OPEN_ITEM:
            return false;

        case ActionTypes.REMOVE_ITEM:
            return false;

        case ActionTypes.SAVE_RIGHTS_START:
            return false;

        case ActionTypes.CHANGE_OWNER_START:
            return false;

        case ActionTypes.IMPORT_IS_DONE:
            return false;

        case ActionTypes.FOLDER_IS_ADDED:
            return false;

        case ActionTypes.FOLDER_IS_EDITED:
            return false;

        case ActionTypes.FOLDER_IS_REMOVED:
            return false;

        case ActionTypes.SHOW_ADD_FOLDER_POPUP:
            return {
                type: 'ADD_FOLDER',
                parentId: action.data
            }

        case ActionTypes.SHOW_IMPORT_POPUP:
            return {
                type: 'IMPORT'
            }

        case ActionTypes.SHOW_REMOVE_FOLDER_CONFIRM:
            return {
                type: 'REMOVE_FOLDER_CONFIRM',
                id: parseInt(action.id)
            }

        case ActionTypes.REMOVE_ITEM_CONFIRM:
            return {
                type: 'REMOVE_ITEM_CONFIRM',
                item: action.item
            }

        case ActionTypes.SHOW_EDIT_FOLDER_POPUP:
            return extend({}, {type: 'EDIT_FOLDER'}, action.data);

        case ActionTypes.SHOW_HISTORY_POPUP:
            return {
                type: 'HISTORY'
            }

        case ActionTypes.SHOW_VIEW_USER_POPUP:
            return {
                type: 'VIEW_USER'
            }

        case ActionTypes.SHOW_REMOVE_RIGTHS_POPUP:
            return {
                type: 'REMOVE_RIGHTS'
            }

        default:
            return state;
    }
};

module.exports = combineReducers({openedModal, alert});
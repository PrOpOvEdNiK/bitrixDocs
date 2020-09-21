const extend      = require('extend');
const ActionTypes = require('../constants/action-types');

const _initial = userData;
userData = {};

const currentUser = (state = _initial, action = {type: ''}) => {
    switch (action.type) {
        case ActionTypes.NOT_PERMISSION:
            return 'not_permission';
        case ActionTypes.VIEW_USER:
            if (action.item.isGroup) {
                action.item.ID = -1;
                action.item.admin = false;
                action.item.NAME = action.item.isGroup;
                action.item.LAST_NAME = '';
            }
            return action.item;
        case ActionTypes.RESET_VIEW_USER:
            return _initial;
        default:
            return state;
    }
};

module.exports = currentUser;

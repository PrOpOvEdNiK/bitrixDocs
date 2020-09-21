const extend      = require('extend');
const ActionTypes = require('../constants/action-types');

const loaded = (state = false, action = {type: ''}) => {
    switch (action.type) {
        case ActionTypes.NOT_PERMISSION:
            return true;
        case ActionTypes.END_FETCH_DATA:
            return true;
        case ActionTypes.VIEW_USER:
            return false;
        case ActionTypes.RESET_VIEW_USER:
            return false;
        default:
            return state;
    }
};

module.exports = loaded;

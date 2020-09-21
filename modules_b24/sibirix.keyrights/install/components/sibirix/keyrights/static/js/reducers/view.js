const extend      = require('extend');
const ActionTypes = require('../constants/action-types');
const help        = require('../helpers/helpers');


const view = (state = false, action = {type: ''}) => {
    switch (action.type) {
        case ActionTypes.VIEW_USER:
            return true;
        case ActionTypes.RESET_VIEW_USER:
            return false;
        default:
            return state;
    }
};

module.exports = view;

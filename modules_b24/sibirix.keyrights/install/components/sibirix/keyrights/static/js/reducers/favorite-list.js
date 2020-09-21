const extend      = require('extend');
const ActionTypes = require('../constants/action-types');
const help        = require('../helpers/helpers');

const isFavoritesOpened = (state = false, action = {type: ''}) => {
    switch (action.type) {
        case ActionTypes.OPEN_FOLDER:
            return false;
        case ActionTypes.SEARCH_INPUT:
            return false;
        case ActionTypes.TOGGLE_SEARCH:
            return false;
        case ActionTypes.HIDE_FAVORITE:
            return false;
        case ActionTypes.SHOW_FAVORITE:
            return true;
        default:
            return state;
    }
};

module.exports = isFavoritesOpened;
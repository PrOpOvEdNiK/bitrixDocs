const extend      = require('extend');
const ActionTypes = require('../constants/action-types');
const {combineReducers} = require('redux');

const query = (state = '', action = {type: ''}) => {
    switch (action.type) {
        case ActionTypes.SEARCH_INPUT:
            return action.q.trim();
        case ActionTypes.SHOW_FAVORITE:
            return '';
        default:
            return state;
    }
};

const userId = (state = false, action = {type: ''}) => {
    switch (action.type) {
        default:
            return state;
    }
}

const groupId = (state = false, action = {type: ''}) => {
    switch (action.type) {
        default:
            return state;
    }
}

const isSearching = (state = false, action = {type: ''}) => {
    switch (action.type) {
        case ActionTypes.SEARCH_INPUT:
            return action.q.trim() ? true : false;

        case ActionTypes.TOGGLE_SEARCH:
            return action.state;

        case ActionTypes.OPEN_FOLDER:
            return false;

        case ActionTypes.SHOW_FAVORITE:
            return false;
        default:
            return state;
    }
};

const forceClose = (state = false, action = {type: ''}) => {
    switch (action.type) {
        case ActionTypes.SEARCH_INPUT:
            return false;

        case ActionTypes.OPEN_FOLDER:
            return true;

        case ActionTypes.SHOW_FAVORITE:
            return true;
        default:
            return state;
    }
};

module.exports = combineReducers({query, isSearching, forceClose, userId, groupId});

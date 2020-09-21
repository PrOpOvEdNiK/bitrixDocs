const extend      = require('extend');
const ActionTypes = require('../constants/action-types');
const {combineReducers} = require('redux');

const sort = (state = 'asc', action = {type: ''}) => {
    switch (action.type) {
        case ActionTypes.CHANGE_MAIN_SORT:
            return state === 'asc' ? 'desc' : 'asc';
        default:
            return state;
    }
};

module.exports = combineReducers({sort});
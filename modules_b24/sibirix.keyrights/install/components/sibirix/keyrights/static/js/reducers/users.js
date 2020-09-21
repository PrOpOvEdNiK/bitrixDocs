const extend      = require('extend');
const ActionTypes = require('../constants/action-types');

const users = (state = [], action = {type: ''}) => {
    switch (action.type) {
        case ActionTypes.END_FETCH_DATA:
            return action.users;
        default:
            return state;
    }
};
module.exports = users;

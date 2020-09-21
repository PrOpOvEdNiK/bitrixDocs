const extend      = require('extend');
const ActionTypes = require('../constants/action-types');
const help        = require('../helpers/helpers');

var storageFavorite = localStorage.db ? JSON.parse(localStorage.db) : {folders: [], items: []};
const favorite = (state = storageFavorite, action = {type: ''}) => {
    switch (action.type) {
        case ActionTypes.CHANGE_FAVORITE_FOLDER:
            return action.arrayFavorite;
        case ActionTypes.CHANGE_FAVORITE_ITEM:
            return action.arrayFavorite;
        default:
            return state;
    }
};

module.exports = favorite;

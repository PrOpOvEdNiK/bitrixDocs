const {combineReducers} = require('redux');
const extend = require('extend');

// reducers
const tree        = require('./tree');
const action      = require('./action');
const items       = require('./items');
const panel       = require('./panel');
const main        = require('./main');
const users       = require('./users');
const search      = require('./search');
const currentUser = require('./current-user');
const groups      = require('./groups');
const loaded      = require('./load');
const modal       = require('./modals');
const favorite    = require('./favorite');
const isFavoritesOpened = require('./favorite-list');
const view = require('./view');

module.exports = combineReducers({
    tree,
    action,
    main,
    search,
    items,
    panel,
    modal,
    users,
    currentUser,
    loaded,
    groups,
    favorite,
    isFavoritesOpened,
    view
});
const {compose, createStore, applyMiddleware } = require('redux');
const reduxThunk = require('redux-thunk');

const rootReducer = require('../reducers');

const store = compose(
    applyMiddleware(reduxThunk)
)(createStore);

module.exports = store(rootReducer);

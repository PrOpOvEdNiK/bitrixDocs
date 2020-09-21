const extend      = require('extend');
const ActionTypes = require('../constants/action-types');

const _buildKidsIndex = (gs) => {
    let ids = {};

    gs.forEach((t) => {
        if (t.PARENT) {
            ids[t.PARENT] = true;
        }
    });

    return ids;
}

const _buildIndex = (gs) => {
    let ids = {};

    gs.forEach((t, i) => {
        ids[t.ID] = i;
    });

    return ids;
}

const groups = (state = {items: [], index: {}}, action = {type: ''}) => {
    switch (action.type) {
        case ActionTypes.END_FETCH_DATA:
            const items = action.groups.length ? action.groups : [];

            return {
                items,
                index: _buildIndex(items),
                kidsIndex: _buildKidsIndex(items)
            }
        default:
            return state;
    }
};

module.exports = groups;

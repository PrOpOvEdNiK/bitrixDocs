const extend      = require('extend');
const ActionTypes = require('../constants/action-types');
const help        = require('../helpers/helpers');
const {combineReducers} = require('redux');

const _buildIndex = (entities) => {
    let ids = {};

    entities.forEach((t, i) => {
        ids[t.ID] = i;
    });

    return ids;
};

const items = (state = {entities: [], index: {}}, action = {type: ''}) => {
    let entities;
    switch (action.type) {
        case ActionTypes.ITEM_IS_ADDED:
            entities = [...state.entities, action.data];
            return {
                entities: entities,
                index: _buildIndex(entities)
            };

        case ActionTypes.ITEM_IS_EDITED:
            return {
                entities: state.entities.map(t => {
                    if (parseInt(t.ID) !== parseInt(action.data.ID)) return t;
                    action.data.IS_MOVED = false;
                    return extend({}, t, action.data);
                }),
                index: state.index
            };

        case ActionTypes.ITEM_EDIT_START:
            const item = state.entities[state.index[action.data.ID]];
            return {
                entities: [
                    ...state.entities.slice(0, state.index[action.data.ID]),
                    extend({}, item, action.data),
                    ...state.entities.slice(state.index[action.data.ID] + 1),
                ],
                index: state.index
            };

        case ActionTypes.MOVE_ITEM:
            return {
                entities: state.entities.map(i => {
                    if (parseInt(i.ID) !== parseInt(action.entityId)) return i;
                    i.SECTION = action.idNewFolder

                    return i;
                }),
                index: state.index
            };

        case ActionTypes.REMOVE_ITEM:
            entities = [
                ...state.entities.slice(0, state.index[action.item.ID]),
                ...state.entities.slice(state.index[action.item.ID] + 1),
            ];

            return {
                entities,
                index: _buildIndex(entities)
            };

        case ActionTypes.ITEM_IS_OPENED:
            return {
                entities: state.entities.map(t => {
                    if (parseInt(t.ID) !== parseInt(action.data.ID)) return t;
                    return extend({}, t, {RIGHTS: action.data.rights, OWNER: parseInt(action.data.owner)});
                }),
                index: state.index
            };

        case ActionTypes.CHANGE_OWNER_START:
            if (!action.entityId) return state;

            const changedItem = state.entities[state.index[action.entityId]];
            changedItem.OWNER = action.owner;

            entities = [
                ...state.entities.slice(0, state.index[action.entityId]),
                extend({}, changedItem),
                ...state.entities.slice(state.index[action.entityId] + 1)
            ];

            return {
                entities,
                index: _buildIndex(entities)
            };

        case ActionTypes.SAVE_RIGHTS_START:
            if (!action.data.entityId) return state;

            return {
                entities: [
                    ...state.entities.slice(0, state.index[action.data.entityId]),
                    extend({}, state.entities[state.index[action.data.entityId]], {RIGHTS: action.data.rights}),
                    ...state.entities.slice(state.index[action.data.entityId] + 1)
                ],
                index: state.index
            };

        case ActionTypes.END_FETCH_DATA:
            return {
                entities: action.items,
                index: _buildIndex(action.items)
            };

        default:
            return state;
    }
};

const activeItem = (state = false, action = {type: ''}) => {
    switch (action.type) {
        case ActionTypes.ITEM_IS_ADDED:
            return action.data.ID;
        case ActionTypes.OPEN_ITEM:
            return action.id;
        case ActionTypes.OPEN_FOLDER:
            return false;
        default:
            return state;
    }
};

module.exports = combineReducers({items, activeItem});

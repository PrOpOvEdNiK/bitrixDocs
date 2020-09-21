const ActionTypes = require('../constants/action-types');
const request = require('superagent');
const extend = require('extend');
const json2csv = require('json2csv');
const help = require('../helpers/helpers');
const crypt = require('../helpers/crypt');

require('es6-promise').polyfill();

const LIST_SECTIONS_URL = 'crypt/section/list/';
const IMPORT_URL = 'exchange/import/';
const LIST_ITEMS_URL = 'crypt/password/list/';
const LIST_RIGHTS_URL = 'crypt/rights/list/';
const CALL_METHOD_URL = 'api/call-method';
const SAVE_FOLDER_URL = 'crypt/section/save/';
const MOVE_FOLDER_URL = 'crypt/section/move/';
const MOVE_ITEM_URL = 'crypt/password/move/';
const REMOVE_ITEM_URL = 'crypt/password/remove/';
const REMOVE_FOLDER_URL = 'crypt/section/remove/';
const SAVE_RIGHTS_URL = 'crypt/rights/save/';
const SAVE_ITEM_URL = 'crypt/password/save/';
const CHANGE_OWNER_URL = 'crypt/set-owner/';
const HISTORY_URL = 'exchange/history/';
const COPY_LOGGER = 'exchange/copy';
const LIST_ITEMS_URL_FOR_ID = 'crypt/password/list-for-id/';
const REMOVE_RIGHTS_URL = 'crypt/rights/remove';

const fetchData = (currentUser, forId = false) => {
    return dispatch => {
        let pKey;
        if (CONST.backend == 'bitrix24')  {
            BX24.init();
            pKey = new Promise(
                resolve => {
                    BX24.callMethod(
                        'entity.item.get',
                        {
                            ENTITY: 'keyrights.user',
                            'NAME': 'passPhrase'
                        },
                        function(result) {
                            if (result && result.answer && result.answer.result && result.answer.result[0]) {
                                CONST.key = result.answer.result[0].PREVIEW_TEXT;
                                resolve(result.answer.result[0].PREVIEW_TEXT);
                            }
                        }
                    );
                }
            );
        } else {
            pKey = new Promise(resolve => {
                resolve();
            })
        }

        const pTree = new Promise(
                resolve => {
                request.get(LIST_SECTIONS_URL)
                    .set('Accept', 'application/json')
                    .query({
                        csrf_token: csrfToken,
                    })
                    .end(function (err, resp) {
                        let ans = JSON.parse(resp.text);

                        if (ans.result === 'ok') {

                            resolve(ans.data.map(function (el) {
                                if (el.SECTION === '') {
                                    el.SECTION = false;
                                }

                                return el;
                            }));
                        }
                    });

            }
        );

        let params = {
            csrf_token: csrfToken,
        };

        if (forId) {
            params.isGroup = currentUser.isGroup;
            if (params.isGroup) {
                params.forId = currentUser.UF_DEPARTMENT[0];
            } else {
                params.forId = currentUser.ID;
            }
        }

        const pItems = new Promise(
                resolve => {
                    var url;
                    url = forId ? LIST_ITEMS_URL_FOR_ID : LIST_ITEMS_URL;
                request.get(url)
                    .set('Accept', 'application/json')
                    .query(params)
                    .end(function (err, resp) {
                        let ans = JSON.parse(resp.text);
                        if (ans.result === 'ok') {
                            resolve(ans.data);
                        }
                    });
            }
        );

        const pUsers = new Promise(
                resolve => {
                request.post(CALL_METHOD_URL)
                    .set('Accept', 'application/json')
                    .query({
                        csrf_token: csrfToken,
                    })
                    .send({
                        method: "user.get",
                        params: {SORT: "ID", ORDER: "ASC"}
                    })
                    .end(function (err, resp) {
                        let ans = JSON.parse(resp.text);
                        if (ans.result === 'ok') {
                            resolve(ans.data);
                        }
                    });
            }
        );

        const pGroups = new Promise(
                resolve => {
                request.post(CALL_METHOD_URL)
                    .set('Accept', 'application/json')
                    .query({
                        csrf_token: csrfToken,
                    })
                    .send({
                        method: "department.get",
                        params: {SORT: "ID", ORDER: "DESC"}
                    })
                    .end(function (err, resp) {
                        let ans = JSON.parse(resp.text);
                        resolve(ans.data);
                    });
            }
        );

        Promise.all([pTree, pItems, pUsers, pGroups, pKey]).then(
                values => {
                dispatch(setData(currentUser, values));
            }
        );
    };
};

function openFolder(id, user) {
    window.location.hash = '#/'+id;
    return dispatch => {
        dispatch({type: ActionTypes.OPEN_FOLDER, id});
        request.post(LIST_RIGHTS_URL)
            .set('Accept', 'application/json')
            .send({section: id})
            .query({
                csrf_token: csrfToken,
            })
            .end(function (err, resp) {
                let ans = JSON.parse(resp.text);
                if (ans.result === 'ok') {
                    dispatch(folderIsOpened(ans.data, user));
                } else if (ans.error) {
                    dispatch(showAlert(ans.error));
                }
            });
    }
}

function openItem(id) {

    let path = window.location.hash.substr(2).split('/');
    path[1] = id;
    path = path.join('/');
    window.location.hash = '#/'+path;


    return dispatch => {
        dispatch({type: ActionTypes.OPEN_ITEM, id});

        request.post(LIST_RIGHTS_URL)
            .set('Accept', 'application/json')
            .send({item: id})
            .query({
                csrf_token: csrfToken
            })
            .end(function (err, resp) {
                let ans = JSON.parse(resp.text);

                if (ans.result === 'ok') {
                    ans.data.ID = id;
                    dispatch(itemIsOpened(ans.data));
                } else if (ans.error) {
                    dispatch(showAlert(ans.error));
                }
            });
    }
}

const removeFolder = (item) => {
    return dispatch => {
        request.post(REMOVE_FOLDER_URL)
            .set('Accept', 'application/json')
            .query({
                csrf_token: csrfToken,
            })
            .send({sectionId: item.ID})
            .end(function (err, resp) {
                let ans = JSON.parse(resp.text);

                if (ans.result === 'ok') {
                    dispatch(_folderRemoved(item));
                } else if (ans.error) {
                    dispatch(showAlert(ans.error));
                }
            });
    };
};

const addFolder = (data, user) => {
    return dispatch => {
        request.post(SAVE_FOLDER_URL)
            .set('Accept', 'application/json')
            .query({
                csrf_token: csrfToken,
            })
            .send(data)
            .end(function (err, resp) {
                let ans = JSON.parse(resp.text);

                if (ans.result === 'ok') {
                    ans.data.section.CAN_WRITE = true;
                    dispatch(_folderAdded(ans.data));
                    dispatch(openFolder(ans.data.section.ID, user));
                } else if (ans.error) {
                    dispatch(showAlert(ans.error));
                }
            });
    }
};

const moveFolder = (id, to) => {
    return dispatch => {
        dispatch({type: ActionTypes.MOVE_FOLDER, id, to});
        request.post(MOVE_FOLDER_URL)
            .set('Accept', 'application/json')
            .query({
                csrf_token: csrfToken,
            })
            .send({id, idNewParentFolder: to})
            .end(function (err, resp) {
                let ans = JSON.parse(resp.text);

                if (ans.error) {
                    dispatch(showAlert(ans.error));
                }
            });
    };
};

const moveItem = (entityId, idNewFolder, idOldFolder) => {
    return dispatch => {
        dispatch({type: ActionTypes.MOVE_ITEM, entityId, idNewFolder, idOldFolder});
        request.post(MOVE_ITEM_URL)
            .set('Accept', 'application/json')
            .query({
                csrf_token: csrfToken,
            })
            .send({entityId, idNewFolder, idOldFolder})
            .end(function (err, resp) {
                let ans = JSON.parse(resp.text);
                if (ans.error) {
                    dispatch(showAlert(ans.error));
                }
            });
    };
};

const _importRec = (dispatch) => {
    request.post(IMPORT_URL)
        .set('Accept', 'application/json')
        .query({
            csrf_token: csrfToken,
        })
        .send({step: 'next'})
        .end((err, resp) => {
            let ans = JSON.parse(resp.text);

            if (ans.result === 'ok') {
                if (ans.data == 'progress') {
                    _importRec(dispatch);
                } else {
                    dispatch(showAlert(help.t('IMPORT_FINISHED')));
                    dispatch({type: ActionTypes.IMPORT_IS_DONE});
                }
            }
        })
};

const importData = (data) => {
    return dispatch => {
        request.post(IMPORT_URL)
            .set('Accept', 'application/json')
            .query({
                csrf_token: csrfToken,
            })
            .send({data})
            .end((err, resp) => {
                let ans = JSON.parse(resp.text);

                if (ans.result === 'ok') {
                    if (ans.data == 'progress') {
                        _importRec(dispatch);
                    } else {
                        dispatch(showAlert(help.t('IMPORT_FINISHED')));
                        dispatch({type: ActionTypes.IMPORT_IS_DONE});
                        window.location.reload();
                    }
                }
            })
    };
};

const changeOwner = ({entityId, owner, sectionId}, user) => {
    return dispatch => {
        dispatch({
            type: ActionTypes.CHANGE_OWNER_START,
            sectionId,
            entityId,
            owner,
            user
        });

        request.post(CHANGE_OWNER_URL)
            .set('Accept', 'application/json')
            .query({
                csrf_token: csrfToken,
            })
            .send({entityId, owner, sectionId})
            .end(function (err, resp) {
                let ans = JSON.parse(resp.text);

                if (ans.result === 'ok') {
                    dispatch({
                        type: ActionTypes.CHANGE_OWNER_END
                    });
                } else if (ans.error) {
                    dispatch(showAlert(ans.error));
                }
            });
    };
};

const editFolder = (data) => {
    return dispatch => {
        dispatch(_folderChanged(data));
        request.post(SAVE_FOLDER_URL)
            .set('Accept', 'application/json')
            .query({
                csrf_token: csrfToken,
            })
            .send(data)
            .end(function (err, resp) {
                let ans = JSON.parse(resp.text);

                if (ans.result === 'ok') {
                    dispatch(_folderChanged(ans.data.section));
                } else if (ans.error) {
                    dispatch(showAlert(ans.error));
                }
            });
    }
};

const saveRights = (data, user) => {
    return dispatch => {
        dispatch({type: ActionTypes.SAVE_RIGHTS_START, data, user});

        request.post(SAVE_RIGHTS_URL)
            .set('Accept', 'application/json')
            .query({
                csrf_token: csrfToken,
            })
            .send(data)
            .end(function (err, resp) {
                let ans = JSON.parse(resp.text);

                if (ans.result === 'ok') {
                    if (data.entityId) {
                        dispatch({type: ActionTypes.SAVE_ITEM_RIGHTS_END, data, user});
                    } else {
                        dispatch({type: ActionTypes.SAVE_FOLDER_RIGHTS_END, data});
                    }
                } else if (ans.error) {
                    dispatch(showAlert(ans.error));
                }
            });
    }
};

const removeItem = item => {
    return dispatch => {
        dispatch({type: ActionTypes.REMOVE_ITEM, item});

        request.post(REMOVE_ITEM_URL)
            .set('Accept', 'application/json')
            .query({
                csrf_token: csrfToken,
            })
            .send({
                entityId: parseInt(item.ID),
                sectionId: parseInt(item.SECTION)
            })
            .end(function (err, resp) {
                let ans = JSON.parse(resp.text);

                if (ans.result === 'ok') {

                } else if (ans.error) {
                    dispatch(showAlert(ans.error));
                }
            });
    };
};

const addItem = (data) => {
    return dispatch => {
        request.post(SAVE_ITEM_URL)
            .set('Accept', 'application/json')
            .query({
                csrf_token: csrfToken,
            })
            .send(data)
            .end(function (err, resp) {
                let ans = JSON.parse(resp.text);

                if (ans.result === 'ok') {
                    data.ID = ans.data.result;
                    dispatch(_itemAdded(extend({}, data, ans.data)));
                } else if (ans.error) {
                    dispatch(showAlert(ans.error));
                }
            });
    }
};

const saveEditedItem = (data) => {
    return dispatch => {
        dispatch({type: ActionTypes.ITEM_EDIT_START, data});
        request.post(SAVE_ITEM_URL)
            .set('Accept', 'application/json')
            .query({
                csrf_token: csrfToken,
            })
            .send(data)
            .end(function (err, resp) {
                let ans = JSON.parse(resp.text);

                if (ans.result === 'ok') {
                    dispatch(_itemChanged(extend({}, data, ans.data)));
                } else if (ans.error) {
                    dispatch(showAlert(ans.error));
                }
            });
    }
};

const copyLogger = (item_id) => {
    return dispatch => {
        request.post(COPY_LOGGER)
            .set('Accept', 'application/json')
            .query({
                csrf_token: csrfToken,
            })
            .send({item_id: item_id})
            .end(function (err, resp) {
                let ans = JSON.parse(resp.text);
                if (ans.error) {
                    dispatch(showAlert(ans.error));
                }
            });
    }
};

const getHistory = (data) => {
    return  dispatch => {
        request.post(HISTORY_URL)
            .set('Accept', 'application/json')
            .query({
                csrf_token: csrfToken,
            })
            .send(data)
            .end(function (err, resp) {
                let ans = JSON.parse(resp.text);
                if (ans.result === 'ok') {
                    data = ans.data;

                    var fields = [help.t('REPORT_WHEN'), help.t('REPORT_WHO'), help.t('REPORT_WHAT'), help.t('REPORT_DO')];
                    json2csv({data, fieldNames: fields}, (err, csv) => {
                        if (err) {
                            console.log(err);
                            return;
                        }

                        const encodedUri = encodeURI(csv);
                        const link = document.createElement("a");

                        link.setAttribute("href", 'data:text/csv;charset=utf-8,' + encodedUri);
                        link.setAttribute("download", "history.csv");

                        link.click();
                        dispatch(showAlert(help.t('SUCCES_HISTORY_EXPORT')));
                    });
                } else if (ans.error) {
                    dispatch(showAlert(ans.error));
                }
            });
    }
};

const removeRights = (data) => {
    return dispatch => {
        request.post(REMOVE_RIGHTS_URL)
            .set('Accept', 'application/json')
            .query({
                csrf_token: csrfToken,
            })
            .send({
                data:data
            })
            .end(function (err, resp) {
                let ans = JSON.parse(resp.text);

                if (ans.result === 'ok') {
                    dispatch({type: ActionTypes.REMOVE_RIGHTS_IS_DONE});
                } else if (ans.error) {
                    dispatch(showAlert(ans.error));
                }
            });
    }
};



const setData = (user, data) => {
    return {
        type: ActionTypes.END_FETCH_DATA,
        sections: data[0],
        items: data[1],
        users: data[2],
        groups: data[3],
        currentUser: user
    };
};

const folderIsOpened = (data, user) => {
    return {
        type: ActionTypes.FOLDER_IS_OPENED,
        data,
        user
    }
};

const itemIsOpened = (data) => {
    return {
        type: ActionTypes.ITEM_IS_OPENED,
        data
    }
};

function newItem() {
    return {
        type: ActionTypes.NEW_ITEM_FORM,
    }
}

function editItem(data) {
    return {
        type: ActionTypes.EDIT_ITEM_FORM,
        data
    }
}

function toggleSort(state) {
    return {
        type: ActionTypes.CHANGE_MAIN_SORT,
        state
    }
}


const changeFavorite = (id, isFolder) => {
    var arrayFavorite = localStorage.db ? JSON.parse(localStorage.db) : {folders: [], items: []};
    if (isFolder) {
        if (arrayFavorite.folders.indexOf(parseInt(id)) >= 0) {
            arrayFavorite.folders = arrayFavorite.folders.filter(function (val) {
                return (val != id)
            });
        } else {
            arrayFavorite.folders.push(parseInt(id));
        }
        localStorage.db = JSON.stringify(arrayFavorite);
        return {
            type: ActionTypes.CHANGE_FAVORITE_FOLDER,
            arrayFavorite
        }

    }
    if (arrayFavorite.items.indexOf(parseInt(id)) >= 0) {
        arrayFavorite.items = arrayFavorite.items.filter(function (val) {
            return (val != id)
        });
    } else {
        arrayFavorite.items.push(parseInt(id));
    }
    localStorage.db = JSON.stringify(arrayFavorite);
    return {
        type: ActionTypes.CHANGE_FAVORITE_ITEM,
        arrayFavorite
    }

};
const showFavorite = () => {
    return {
        type: ActionTypes.SHOW_FAVORITE,
    }
};

const hideFavorite = () => {
    return {
        type: ActionTypes.HIDE_FAVORITE,
    }
};

const showAddFolderPopup = (data = null) => {
    return {
        type: ActionTypes.SHOW_ADD_FOLDER_POPUP,
        data
    }
};

const showImportPopup = () => {
    return {
        type: ActionTypes.SHOW_IMPORT_POPUP
    }
};

const showRemoveFolderConfirm = (id = null) => {
    return {
        type: ActionTypes.SHOW_REMOVE_FOLDER_CONFIRM,
        id
    }
};

const showEditFolderPopup = (data) => {
    return {
        type: ActionTypes.SHOW_EDIT_FOLDER_POPUP,
        data
    }
};

const closeModal = () => {
    return {
        type: ActionTypes.CLOSE_MODAL
    }
};

const searchInput = (q) => {
    return {
        type: ActionTypes.SEARCH_INPUT,
        q
    };
};

const toggleSearch = (state) => {
    return {
        type: ActionTypes.TOGGLE_SEARCH,
        state
    };
};

const addUsers = (data) => {
    return {
        type: ActionTypes.ADD_USERS,
        isSection: data.isSection,
        id: data.id
    };
};

const showChangeOwnerPopup = (data) => {
    return {
        type: ActionTypes.CHANGE_OWNER,
        isSection: data.isSection,
        id: data.id
    };
};

const showAlert = (text) => {
    return {
        type: ActionTypes.ALERT,
        text
    };
};

const closeAlert = () => {
    return {type: ActionTypes.CLOSE_ALERT};
};


const showRemoveItemConfirm = item => ({type: ActionTypes.REMOVE_ITEM_CONFIRM, item});

const closeNewItem = () => {
    return {
        type: ActionTypes.CLOSE_NEW_ITEM
    }
};

const _folderAdded = (data) => {
    return {
        type: ActionTypes.FOLDER_IS_ADDED,
        data
    }
};

const _folderRemoved = (item) => {
    return {
        type: ActionTypes.FOLDER_IS_REMOVED,
        item
    }
};

const _folderChanged = (data) => {
    return {
        type: ActionTypes.FOLDER_IS_EDITED,
        data
    }
};

const _itemChanged = (data) => {
    return {
        type: ActionTypes.ITEM_IS_EDITED,
        data
    }
};

const _itemAdded = (data) => {
    return {
        type: ActionTypes.ITEM_IS_ADDED,
        data
    }
};

const showHistoryPopup = () => {
    return {
        type: ActionTypes.SHOW_HISTORY_POPUP
    }
};

const exportData = () => {
    return (dispatch, getState) => {
        const state = getState();
        const sections = state.tree.tree.sections;
        const index = state.tree.tree.index;
        const items = state.items.items;

        const data = items.entities.map(item => {
            const dad = sections[index[item.SECTION]];
            const decrypt = crypt.decrypt(item.CRYPTED);

            let row = {
                ['Password Groups']: dad.NAME,
                ['Group Tree']: dad.SECTION == 0 ? '' : sections[index[dad.SECTION]].NAME,
                ['Account']: item.NAME,
                ['Login Name']: decrypt.LOGIN,
                ['Password']: decrypt.PASSWORD,
                ['Web Site']: decrypt.URL,
                ['Comments']: decrypt.NOTE
            };

            return row;
        });

        if (!data.length) return;

        const fields = Object.keys(data[0]);
        json2csv({data, fields}, (err, csv) => {
            if (err) {
                console.log(err);
                return;
            }

            const encodedUri = encodeURI(csv);
            const link = document.createElement("a");

            link.setAttribute("href", 'data:text/csv;charset=utf-8,' + encodedUri);
            link.setAttribute("download", "backup.csv");

            link.click();
        });
    };
};

const showViewUserPopup = () => {
    return {
        type: ActionTypes.SHOW_VIEW_USER_POPUP,
    }
};

const viewUser = (item) => {
    return {
        type: ActionTypes.VIEW_USER,
        item
    }
};

const resetViewUser = () => {
  return {
      type: ActionTypes.RESET_VIEW_USER
  }
};

const showRemoveRightsPopup = () => {
    return {
        type: ActionTypes.SHOW_REMOVE_RIGTHS_POPUP
    }
};

module.exports = {
    fetchData,
    openFolder,
    openItem,
    toggleSort,
    showAddFolderPopup,
    showRemoveFolderConfirm,
    showEditFolderPopup,
    showImportPopup,
    closeModal,
    addFolder,
    editFolder,
    searchInput,
    newItem,
    editItem,
    closeNewItem,
    addItem,
    addUsers,
    moveFolder,
    moveItem,
    saveEditedItem,
    saveRights,
    removeFolder,
    toggleSearch,
    changeOwner,
    showChangeOwnerPopup,
    showAlert,
    closeAlert,
    removeItem,
    showRemoveItemConfirm,
    importData,
    exportData,
    changeFavorite,
    showFavorite,
    hideFavorite,
    getHistory,
    showHistoryPopup,
    copyLogger,
    showViewUserPopup,
    viewUser,
    resetViewUser,
    showRemoveRightsPopup,
    removeRights
};

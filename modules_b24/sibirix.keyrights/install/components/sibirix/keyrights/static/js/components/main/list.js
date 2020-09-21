const React      = require('react');
const Item       = require('./item');
const Folder     = require('./folder');
const FolderNote = require('./folder-note');
const Scrollbars = require('react-gemini-scrollbar');
const help = require('../../helpers/helpers');

module.exports = ({isFavoritesOpened, changeFavorite, folders, lastAction, moveFolder, moveItem, showRemoveItemConfirm, isSearching, currentUser, items, openFolder, openItem,
    activeItem, showRemoveFolderConfirm, showEditFolderPopup, addUsers, showAddFolderPopup, activeFolderItem}) => {
    let res = [];

    folders.map((f, k) => {
            res.push(<Folder
                moveFolder={moveFolder}
                moveItem={moveItem}
                openFolder={(id) => openFolder(id, currentUser)}
                folder={f}
                key={k}
                changeFavorite={changeFavorite}
                showRemoveFolderConfirm={showRemoveFolderConfirm}
                showEditFolderPopup={showEditFolderPopup}
                showAddFolderPopup={showAddFolderPopup}
                addUsers={addUsers}
            />);


            if (isFavoritesOpened || isSearching && f.ENTITIES && f.ENTITIES.length) {
                f.ENTITIES.map((e, key) => res.push(<Item
                    lastAction={lastAction}
                    activeItem={activeItem}
                    openItem={openItem}
                    showRemoveItemConfirm={showRemoveItemConfirm}
                    item={e}
                    key={`${k}_${key}_${f.ID}_${e.ID}`}
                    changeFavorite={changeFavorite}/>))
            }
        }
    );
    return (
        <div className="wrapper wrapper-main">
            <Scrollbars>
                <div className="table-wrapper">
                    <table className="table table-hover">
                        <tbody>
                        {activeFolderItem && activeFolderItem.SECTION > 0 ? <tr onClick={() => openFolder(activeFolderItem.SECTION, currentUser)}>
                            <td colSpan="3" style={{fontSize: '11px', color: '#999'}}><span className="glyphicon-folder-open glyphicon" style={{marginRight: 10}}></span>{help.t('GO_UP')}</td>
                        </tr> : null}
                        {res.map(f => f)}

                        {items.map((f, k) =>
                            <Item changeFavorite={changeFavorite} showRemoveItemConfirm={showRemoveItemConfirm}
                                  lastAction={lastAction} activeItem={activeItem} openItem={openItem} item={f}
                                  key={f.ID}/>
                        )}
                        </tbody>
                    </table>
                </div>
            </Scrollbars>
            {activeFolderItem && activeFolderItem.ID > 0 ? <FolderNote folder={activeFolderItem} showEditFolderPopup={showEditFolderPopup} /> : null}
        </div>
    )
};

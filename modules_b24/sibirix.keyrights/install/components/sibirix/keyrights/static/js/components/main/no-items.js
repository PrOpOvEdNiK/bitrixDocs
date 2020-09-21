const React = require('react');
const help = require('../../helpers/helpers');
const FolderNote = require('./folder-note');

module.exports = ({isSearching, isFavoritesOpened, activeFolderItem, showEditFolderPopup}) => {
    const text = isSearching ? help.t('SEARCH_FOUND_NOTHING') : isFavoritesOpened ? help.t('EMPTY_FAVORITE_LIST') : help.t('EMPTY_MESSAGE_TIP');
    return (
        <div className="wrapper wrapper-main">
            <div className="empty-password">{text}</div>
            {activeFolderItem && activeFolderItem.ID > 0 ? <FolderNote folder={activeFolderItem} showEditFolderPopup={showEditFolderPopup} /> : null}
        </div>
    );
};

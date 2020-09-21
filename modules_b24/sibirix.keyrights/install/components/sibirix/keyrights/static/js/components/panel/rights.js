const React   = require('react');
const Item    = require('./item');
const Folder  = require('./folder');
const classes = require('classnames');

module.exports = ({item, isLoading, showChangeOwnerPopup, smartLoad, addUsers, saveRights, copyLogger}) => {
    return (
        <div className={classes('detail-wrap', {loading: isLoading})}>
            {item.isFolder ?
                <Folder
                    saveRights={saveRights}
                    showChangeOwnerPopup={showChangeOwnerPopup}
                    addUsers={addUsers}
                    isLoading={isLoading}
                    owner={item.owner}
                    folder={item.element}/> :

                <Item
                    saveRights={saveRights}
                    showChangeOwnerPopup={showChangeOwnerPopup}
                    addUsers={addUsers}
                    smartLoad={smartLoad}
                    owner={item.owner}
                    item={item.element}
                    copyLogger={copyLogger}/>}
        </div>
    )
}
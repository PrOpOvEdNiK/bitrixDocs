const React   = require('react');
const help    = require('../../helpers/helpers');
const classes = require('classnames');


module.exports = (props) => (
    <div className="table-wrapper">
        <table className="table table-hover">
            <thead>
                {props.selectedUser || props.selectedGroup ? <UserHead {...props} /> : <MainHead {...props} />}
            </thead>
        </table>
    </div>
);

const MainHead = ({sort, toggleSort, showFavorite, hideFavorite, isFavoritesOpened}) => {
    return (
        <tr>
            <th onClick={toggleSort} className={sort === 'asc' ? "column-name" : "column-name sorted-desc"}>
                {help.t('NAME')} <i className="glyphicon glyphicon-sort"></i>
            </th>
            <th className="column-url">
                URL
            </th>
            <th className="column-expired">
                <a className={classes(`favorite-toogle`, {open: isFavoritesOpened })}
                   onClick={isFavoritesOpened ? hideFavorite : showFavorite}
                   href="javascript:void(0);">
                </a>
            </th>
        </tr>
    );
}

const UserHead = ({selectedUser, selectedGroup}) => {
    const name = selectedUser === false ? selectedGroup.NAME : `${selectedUser.NAME} ${selectedUser.LAST_NAME}`;
    const item = selectedUser ? selectedUser : selectedGroup;
    return (
        <tr>
            <th colSpan="3" className="column-name">
                {false && item.PERSONAL_PHOTO ?
                    <img className="head-img" width="26" height="26" src={item.PERSONAL_PHOTO} alt={name}/> :
                    <img className="head-img" width="26"
                        height="26"
                        src={CONST.staticPath + "images/group-avatar.png"}
                        alt={name}/>
                }
                <span>{name}</span>
            </th>
        </tr>
    );
}

const React = require('react');
const help = require('../../helpers/helpers');

const _getUserPic = (u) => {
    const base = CONST.staticPath + 'images/group-avatar.png';

    return u && u.PERSONAL_PHOTO ? u.PERSONAL_PHOTO : base;
};

const _getUserName = (u) => {
    return u.NAME ? `${u.NAME} ${u.LAST_NAME}` : u.LOGIN ? u.LOGIN : u.EMAIL;
};

module.exports = ({owner, change, noName, canEdit}) => {
    if (!owner || noName === true) return <tr></tr>;

    return (
        <tr>
            <td className="avatar">
                <i className="icon-crown" dangerouslySetInnerHTML={{__html: '&nbsp;'}}></i>
                <img src={_getUserPic(owner)}
                    alt=""/>
            </td>
            <td clasSpan={canEdit ? 1 : 4} className="name">
                <div className="title">{_getUserName(owner)}</div>
            </td>
            {canEdit ?
                <td colSpan="3" className="owner-change">
                    <a onClick={change} href="javascript:void(0);" className="change-owner">{help.t('OWNER_CHANGE_ACTION')}</a>
                </td> :
                null
            }
        </tr>
    );
};

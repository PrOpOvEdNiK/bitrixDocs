const React = require('react');
const cryptHelper = require('../../helpers/crypt');

const Item = ({item, heading, edit, isLoading}) => {
    let favUrl = CONST.staticPath + 'images/no-icon.ico';
    let hasIcon = false;
    if (item && item.element) {
        const linkObj = cryptHelper.getLink(item.element.CRYPTED);
        if (linkObj.isLink) {
            hasIcon = true;
            favUrl = window.location.pathname + 'api/favicon/?url=' + encodeURI(linkObj.text) + '&csrf_token=' + window.csrfToken;
        }
    }

    return (
        <tr>
            <th>
            <span className="favicon">
                <img src={favUrl} alt="" className={hasIcon ? '' : 'no-icon'}/>
            </span>
                <span className="one-line">{heading}</span>
            </th>
            {item.isNew || item.isEdit || isLoading || item.element.CAN_WRITE !== true ? null : <Edit clickHandler={() => edit(item.element)} />}
        </tr>
    );
};

const Edit = ({clickHandler}) => (
    <th className="edit-link">
        <a className="glyphicon glyphicon-pencil" onClick={clickHandler} href="javascript:void(0);"></a>
    </th>
);

const Folder = ({item, heading, edit, isLoading}) => (
    <tr>
        <th>
            <i className={`icon-folder icon-folder-sprite folder-${item.element.ICON}`}></i>
            <span className="one-line">{heading}</span>
        </th>
        {isLoading || item.element.CAN_WRITE !== true || parseInt(item.element.ID) === 0 ? null : <Edit clickHandler={() => edit(item.element)} />}
    </tr>
);

module.exports = (props) => (
    <table className="table sidepanel-header">
        <thead>
        {!props.item.isFolder
            ? <Item {...props} />
            : <Folder {...props} />
        }
        </thead>
    </table>
);

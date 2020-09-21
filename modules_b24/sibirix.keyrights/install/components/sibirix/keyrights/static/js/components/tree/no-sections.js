const React = require('react');
const help = require('../../helpers/helpers');

module.exports = ({onAdd, addFolderPopup, canEditRoot}) => (
    <div className="wrapper wrapper-left">
        <div className="empty-folder">
            <div className="text-wrap">{help.t('SECTION_ADD_TIP')}</div>
            {canEditRoot ? <button onClick={addFolderPopup} className="btn btn-primary center-block">{help.t('SECTION_ADD')}</button> : null}
        </div>
    </div>
);

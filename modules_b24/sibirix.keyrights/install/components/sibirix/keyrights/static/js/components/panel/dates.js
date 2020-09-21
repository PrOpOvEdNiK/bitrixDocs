const React  = require('react');
const moment = require('moment');
const help = require('../../helpers/helpers');

require('moment/locale/ru');
moment.locale('ru');

module.exports = ({dateCreated, dateChanged}) => (
    <div className="sidepanel-body">
        <div className="folder-info">
            <div>
                <span className="left">{help.t('CREATED')}: </span>
                <span className="left">{moment(dateCreated).format('DD.MM.YYYY HH:mm')}</span>
            </div>
            <div>
                <span className="left">{help.t('LAST_CHANGE')}: </span>
                <span className="left">{moment(dateChanged).format('DD.MM.YYYY HH:mm')}</span>
            </div>
        </div>
    </div>
);

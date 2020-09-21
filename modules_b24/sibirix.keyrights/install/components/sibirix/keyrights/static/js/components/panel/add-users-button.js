const React = require('react');
const help = require('../../helpers/helpers');

module.exports = ({action}) => (
    <button onClick={action} className="btn btn-primary center-block">{help.t('USERS_ADD')}</button>
);

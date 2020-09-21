const React      = require('react');
const extend     = require('extend');
const help = require('../../../helpers/helpers');

const SelectedItem = ({name, remove, done}) => (
    <a onClick={ !done ? remove : null } href="javascript:void(0);">
        { !done ? <span className="delete" dangerouslySetInnerHTML={{__html: '&times;'}}></span> : null }
        <span>{name}</span>
    </a>
);

module.exports = SelectedItem;
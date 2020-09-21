const React      = require('react');
const helper = require('../../helpers/helpers');
const anchorme = require('anchorme').default;

module.exports = React.createClass({
    getInitialState() {
        return {};
    },

    showEdit(e) {
        e.stopPropagation();
        e.preventDefault();
        this.props.showEditFolderPopup(Object.assign({}, this.props.folder, {focusNote: true}));
        return false;
    },

    render() {

        return <div className="folder-note-wrapper">{this.props.folder.NOTE
            ? <div onDoubleClick={this.showEdit}
                   title={helper.t('DBLCLICK_TO_EDIT')}
                   dangerouslySetInnerHTML={{__html: anchorme(this.props.folder.NOTE.trim().replace(/\n/g, '<br>'), {
                       attributes: [{
                           name: 'target',
                           value: '_blank',
                       }]
                   })}} />
            : (this.props.folder.CAN_WRITE ? <a href="javascript:void(0)"
                                                onClick={this.showEdit}>{helper.t('ADD_NOTE')}</a> : null)}</div>;
    }
});

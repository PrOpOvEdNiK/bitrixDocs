const React = require('react');
const help = require('../../helpers/helpers');

module.exports = ({closeModal, text}) => (
    <div className="modal confirm-dialog alert">
        <div className="modal-dialog">
            <div className="modal-content">
                <form action="javascript:void(0);">
                    <div className="modal-header">
                        <h4 className="modal-title">{text}</h4>
                    </div>
                    <div className="modal-footer">
                        <a onClick={closeModal} href="javascript:void(0);" className="btn btn-primary">{help.t('CLOSE')}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
);

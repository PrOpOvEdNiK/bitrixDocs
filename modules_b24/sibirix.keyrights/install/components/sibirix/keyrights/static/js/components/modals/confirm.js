const React = require('react');
const classes = require('classnames');
const help = require('../../helpers/helpers');

const Confirm = React.createClass({
    getInitialState() {
        return {loading: false}
    },

    handleOk() {
        this.setState({loading: true});
        this.props.onOk();
    },

    render() {
        const {text, onCancel} = this.props;

        return (
            <div className={classes("modal confirm-dialog", {loading: this.state.loading})}>
                <div className="modal-dialog">
                    <div className="modal-content">
                        <form action="javascript:void(0);">
                            <div className="modal-header">
                                <button onClick={onCancel} className="close" dangerouslySetInnerHTML={{__html: '&times;'}}></button>
                                <h4 className="modal-title">{text}</h4>
                            </div>
                            <div className="modal-body"></div>
                            <div className="modal-footer">
                                <a onClick={onCancel} href="javascript:void(0);" className="btn btn-default">{help.t('CANCEL')}</a>
                                <a onClick={this.handleOk} href="javascript:void(0);" className="btn btn-default">OK</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        )
    }
});

module.exports = Confirm;

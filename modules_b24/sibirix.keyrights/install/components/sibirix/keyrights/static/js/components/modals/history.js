require('moment/locale/ru');
const React       = require('react');
const crypt       = require('../../helpers/crypt');
const help        = require('../../helpers/helpers');
const moment      = require('moment');
const DatePicker  = require('react-day-picker');
const DateUtils   = require("react-day-picker").DateUtils;
const LocaleUtils = require('../../helpers/daypicker-locale-utils');

const History = React.createClass({

    getInitialState() {
        return {
            from: moment().startOf('day').subtract(1, 'month').toDate(),
            to: moment().startOf('day').toDate(),
        };
    },

    handleDayClick(e, day, modifiers) {
        if (modifiers.indexOf("disabled") > -1) return false;
        const range = DateUtils.addDayToRange(day, this.state);
        this.setState(range);
    },

    handleResetClick(e) {
        e.preventDefault();
        this.setState({
            from: null,
            to: null
        });
    },

    start() {
        var data = {
            dateFrom: moment(this.state.from).format('DD.MM.YYYY'),
            dateUntil: moment(this.state.to).format('DD.MM.YYYY'),
        };

        this.sendToServer(data);
    },

    sendToServer(data) {
        this.props.history(data);
    },

    isFutureDay(d) {
        var today = new Date();
        d.setHours(0, 0, 0, 0);
        today.setHours(0, 0, 0, 0);
        return d > today;
    },

    render() {
        const { from, to } = this.state;

        const modifiers = {
            selected: day => DateUtils.isDayInRange(day, this.state),
            disabled: this.isFutureDay,
        };

        return (
            <div className="modal history">
                <div className="modal-dialog">
                    <div className="modal-content">
                        <div className="modal-header">
                            <button onClick={this.props.closeModal} className="close"
                                    dangerouslySetInnerHTML={{__html: '&times;'}}></button>
                            <h4 className="modal-title">{help.t('HISTORY')}</h4>
                        </div>
                        <div className="modal-body">

                            { !from && !to && <p>{help.t('REPORT_CHOOSE')} <strong>{help.t('REPORT_FIRST_DAY')}</strong>.</p> }
                            { from && !to && <p>{help.t('REPORT_CHOOSE')} <strong>{help.t('REPORT_LAST_DAY')}</strong>.
                                <a href="#" onClick={ this.handleResetClick } style={{float: "right"}}>{help.t('REPORT_RESET')}</a>
                            </p> }
                            { from && to &&
                            <p>{help.t('REPORT_CHOOSE_FROM')} <strong>{
                                moment(from).format("L") }</strong> {help.t('REPORT_CHOOSE_TO')} <strong>{
                                moment(to).format("L") }</strong>. <a
                                href="#" onClick={ this.handleResetClick } style={{float: "right"}}>{help.t('REPORT_RESET')}</a>
                            </p>
                            }

                            <DatePicker
                                numberOfMonths={ 2 }
                                initialMonth={ moment().startOf('day').subtract(1, 'month').toDate() }
                                modifiers={ modifiers }
                                onDayClick={ this.handleDayClick }
                                localeUtils={LocaleUtils}
                                locale="ru"
                                />
                        </div>
                        <div className="modal-footer">
                            <button onClick={this.props.closeModal} style={{float:'left'}}
                                    className="btn btn-default">{help.t('CANCEL2')}</button>
                            { from && to && <button onClick={this.start}
                                                    className="btn btn-primary">{help.t('HISTORY_START')}</button> }
                        </div>
                    </div>
                </div>
            </div>
        )
    }
});

module.exports = History;

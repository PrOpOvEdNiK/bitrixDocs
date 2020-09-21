require('moment/locale/ru');
const React       = require('react');
const moment      = require('moment');
const classes     = require('classnames');
const DatePicker  = require('react-day-picker');
const LocaleUtils = require('react-day-picker/moment');
const help = require('../../helpers/helpers');

const Right = React.createClass({
    getInitialState() {
        return {
            isDatePickerVisible: false
        }
    },
    changeTimed(d) {
        if (moment(d).date() <= moment().date()) return false;

        this.setState({isDatePickerVisible: false});
        this.props.saveRights(this.props.right, {timed: d ? moment(d).format() : null});
    },
    toggleDatepicker(e, isDatePickerVisible) {
        e.preventDefault();
        e.stopPropagation();

        this.setState({isDatePickerVisible});
    },
    render() {
        const {item, right, saveRights, isInherited, blocked} = this.props;
        const person = right.user ? item.allowedUsers[right.user] : item.allowedGroups[right.group];

        let name = '';
        if (right.user) {
            if (person.NAME || person.LAST_NAME) {
                name = `${person.NAME} ${person.LAST_NAME}`;
            } else {
                name = person.EMAIL;
            }
        } else {
            name = person.NAME;
        }

        return (
            <tr className={classes({inherited: isInherited === true, hide: right.user && this.props.owner == right.user, datepicker: this.state.isDatePickerVisible})}>
                <td className="avatar">
                    {person.PERSONAL_PHOTO ?
                        <img width="26" height="26" src={person.PERSONAL_PHOTO} alt={person.NAME}/> :
                        <img width="26"
                            height="26"
                            src={CONST.staticPath + "images/group-avatar.png"}
                            alt={person.NAME}/>
                    }
                </td>
                <td className="name">
                    <div title={name}>{name}</div>
                </td>
                {item.CAN_WRITE ?
                    <td className="date-to">
                        {this.state.isDatePickerVisible ?
                            <div>
                                <div onClick={e => this.toggleDatepicker(e, false)}
                                    className="cover" />
                                <div className="datepicker-wrap">
                                    <div className="datepicker">
                                        <DatePicker
                                            fromMonth={new Date()}
                                            onDayClick={(e, d) => this.changeTimed(d)}
                                            localeUtils={LocaleUtils}
                                            locale="ru"
                                        />
                                    </div>
                                </div>
                            </div>
                            :
                            null
                        }
                        {right.timed ?
                            <div>
                                <a onClick={e => this.toggleDatepicker(e, true)}
                                    href="javascript:void(0);">{moment(right.timed).format('DD.MM.YYYY')}
                                </a>
                                <span className="date-remove"
                                    onClick={() => this.changeTimed(null)} dangerouslySetInnerHTML={{__html: '&nbsp;&times;'}} />
                            </div> :
                            <a onClick={e => this.toggleDatepicker(e, true)} href="javascript:void(0);">
                                <span />
                                <i className="icon-cal" dangerouslySetInnerHTML={{__html: '&nbsp;'}} />
                            </a>
                        }
                    </td> :
                    <td className="date-to">
                        {right.timed ?
                            <a href="javascript:void(0);">{moment(right.timed).format('DD.MM.YYYY')}</a> : null
                        }
                    </td>
                }
                <td colSpan={item.CAN_WRITE ? 1 : 2}>
                    <label>
                        {item.CAN_WRITE ?
                            <select onChange={() => saveRights(right, {edit: this.select.value === 'write'})}
                                ref={node => this.select = node}
                                value={right.edit ? 'write' : 'read'}>
                                <option value="write">{help.t('EDITING')}</option>
                                <option value="read">{help.t('READING')}</option>
                            </select> :
                            <span className="right-type">{help.t(right.edit ? 'EDITING' : 'READING')}</span>
                        }
                    </label>
                </td>
                {item.CAN_WRITE ?
                    <td className="delete">
                        <a onClick={() => saveRights(right, {blocked: true})}
                            href="javascript:void(0);"
                            title={help.t('FORBID_ACCESS')}
                            className="close" dangerouslySetInnerHTML={{__html: '&times;'}} />
                    </td> :
                    null
                }
            </tr>
        )
    }
});

module.exports = Right;

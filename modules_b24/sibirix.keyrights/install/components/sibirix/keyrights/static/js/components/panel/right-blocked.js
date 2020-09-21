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
        const {item, right, saveRights, blocked} = this.props;
        const person = right.user ? item.allowedUsers[right.user] : item.allowedGroups[right.group];
        const name   = right.user ? `${person.NAME} ${person.LAST_NAME}` : person.NAME;

        return (
            <tr className={classes({blocked})}>
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
                <td className="link-wrap" colSpan='3'>
                    {item.CAN_WRITE ? <a onClick={() => saveRights(this.props.right, {blocked: false})} href="javascript:void(0);">{help.t('UNLOCK')}</a> : null}
                </td>
            </tr>
        )
    }
});

module.exports = Right;

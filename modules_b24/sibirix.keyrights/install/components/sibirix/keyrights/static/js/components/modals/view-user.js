const React      = require('react');
const classes    = require('classnames');
const Scrollbars = require('react-gemini-scrollbar');
const extend     = require('extend');
const help = require('../../helpers/helpers');
const TabGroups = require('./user-pick-elements/tab-groups.js');
const TabUsers = require('./user-pick-elements/tab-users.js');

const ViewUser = React.createClass({
    getInitialState() {
        return {
            tab: 'groups',
            isLoading: false,
            selectedGroups: [],
            selectedUsers: []
        }
    },

    select(item, isGroup = false) {
        this.props.closeModal();
        let newItem = extend({}, item);
        if (isGroup) {
            newItem = extend({}, this.props.currentUser);
            newItem.UF_DEPARTMENT = [parseInt(item.ID)];
            newItem.isGroup = item.NAME;
        }
        this.props.view(newItem);
    },

    _buildRights(currentRights, groups, users) {
        let rights = [];

        groups.forEach((group) => {
            const right = {
                blocked: false,
                edit: true,
                group: parseInt(group.ID),
                timed: null
            };

            const inCurrent = currentRights.filter(r => r.group === right.group);
            if (inCurrent.length) {
                const index          = currentRights.indexOf(inCurrent[0]);
                currentRights[index] = extend({}, inCurrent[0], right);

                return;
            }

            rights.push(right);
        });
        users.forEach((user) => {
            const right = {
                edit: true,
                blocked: false,
                timed: null,
                user: parseInt(user.ID)
            };

            const inCurrent = currentRights.filter(r => r.user === right.user);
            if (inCurrent.length) {
                const index          = currentRights.indexOf(inCurrent[0]);
                currentRights[index] = extend({}, inCurrent[0], right);

                return;
            }

            rights.push(right);
        });
        currentRights.forEach((right) => {
            rights.push(right);
        });

        return rights;
    },

    render() {
        const {closeModal, modal, groups, users} = this.props;
        const {tab, selectedGroups, selectedUsers, isLoading} = this.state;

        return (
            <div className={classes("modal view-user", {loading: isLoading})}>
                <div className="modal-dialog">
                    <div className="modal-content add-user" style={{width: '500px'}}>
                        <div className="modal-header">
                            <button onClick={closeModal} className="close" dangerouslySetInnerHTML={{__html: '&times;'}}></button>
                            <h4 className="modal-title">
                                {help.t('VIEW_USER')}
                            </h4>
                        </div>
                        <div className="modal-body">
                            <div className="row">
                                    <ul className="nav nav-tabs">
                                        <li onClick={() => this.setState({tab: 'groups'})}
                                            className={classes({active: tab === 'groups'})}>
                                            <a href="javascript:void(0);">{help.t('GROUPS')}</a>
                                        </li>
                                        <li onClick={() => this.setState({tab: 'users'})}
                                            className={classes({active: tab === 'users'})}>
                                            <a href="javascript:void(0);">{help.t('USERS')}</a>
                                        </li>
                                    </ul>
                                    <div className="tab-content">
                                        {tab === 'groups' ?
                                            <TabGroups
                                                remove={(index) => this.removeSelection(index)}
                                                selectedUsers={selectedUsers}
                                                selectedGroups={selectedGroups}
                                                select={(item) => this.select(item, true)}
                                                groups={groups}/> :
                                            <TabUsers
                                                remove={(index) => this.removeSelection(index, false)}
                                                selectedUsers={selectedUsers}
                                                users={users}
                                                select={(item) => this.select(item, false)}
                                            />
                                        }
                                    </div>
                            </div>
                        </div>
                        <div className="modal-footer">
                            <button onClick={() => this.props.closeModal()} className="btn btn-default">{help.t('CANCEL2')}</button>
                        </div>
                    </div>
                </div>
            </div>
        )
    }
});

module.exports = ViewUser;

const React      = require('react');
const classes    = require('classnames');
const Scrollbars = require('react-gemini-scrollbar');
const extend     = require('extend');
const help = require('../../helpers/helpers');
const TabGroups = require('./user-pick-elements/tab-groups.js');
const TabUsers = require('./user-pick-elements/tab-users.js');
const SelectedItem = require('./user-pick-elements/selected-item.js');

const DirectoryName = ({name, color}) => {
    return (
        <span className="directory">
            <span className={`icon-folder icon-folder-sprite folder-${color}`}></span>
            <span>{name}</span>
        </span>
    )
};

const EntityName = ({name}) => {
    return (
        <span className="directory">
            <span>{name}</span>
        </span>
    )
};

const Footer = ({onCancel, onSubmit}) => (
    <div className="modal-footer">
        <button onClick={() => onCancel()} className="btn btn-default">{help.t('CANCEL2')}</button>
        <button onClick={() => onSubmit()} className="btn btn-primary">{help.t('SAVE')}</button>
    </div>
);

const AddUsers = React.createClass({
    getInitialState() {
        return {
            tab: 'groups',
            isLoading: false,
            selectedGroups: [],
            selectedUsers: []
        }
    },

    removeSelection(index, isGroup = true) {
        let state = {};
        if (isGroup) {
            state.selectedGroups = [...this.state.selectedGroups.slice(0, index), ...this.state.selectedGroups.slice(index + 1)];
        } else {
            state.selectedUsers = [...this.state.selectedUsers.slice(0, index), ...this.state.selectedUsers.slice(index + 1)];
        }

        this.setState(state);
    },

    select(item, isGroup) {
        let state = {};
        if (isGroup) {
            state.selectedGroups = [...this.state.selectedGroups, item];
        } else {
            state.selectedUsers = [...this.state.selectedUsers, item];
        }
        this.setState(state);
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

    onSubmit() {
        const {selectedGroups, selectedUsers} = this.state;
        const {modal} = this.props;

        const data = {
            entityId: modal.isSection ? false : modal.id,
            sectionId: modal.isSection ? modal.id : parseInt(modal.item.SECTION),
            rights: this._buildRights(modal.item.RIGHTS, selectedGroups, selectedUsers)
        };

        this.setState({isLoading: true});
        this.props.submit(data);
    },

    render() {
        const {closeModal, modal, groups, users} = this.props;
        const {tab, selectedGroups, selectedUsers, isLoading} = this.state;

        return (
            <div className={classes("modal add-user", {loading: isLoading})} id="add-user">
                <div className="modal-dialog">
                    <div className="modal-content add-user">
                        <div className="modal-header">
                            <button onClick={closeModal} className="close" dangerouslySetInnerHTML={{__html: '&times;'}}></button>
                            <h4 className="modal-title">
                                <span>{!modal.isSection ? help.t('ACCESS_GRANTING_ITEM') : help.t('ACCESS_GRANTING_SECTION')}: </span>
                                {modal.isSection
                                    ? <DirectoryName color={modal.item.ICON} name={modal.item.NAME}/>
                                    : <EntityName name={modal.item.NAME}/>
                                }
                            </h4>
                        </div>
                        <div className="modal-body" style={{paddingLeft: 0}}>
                            <div className="row">
                                <div className="col-sm-7 left-col">
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
                                <div className="right-col col-sm-5">
                                    <div className="added-list">
                                        <div className="added-items">
                                            <Scrollbars>
                                                { selectedGroups.length ?
                                                    <div className="block-wrap">
                                                        <div><h5>{help.t('GROUPS')}</h5>
                                                            <hr/>
                                                        </div>
                                                        {selectedGroups.map((g, k) => (
                                                            <SelectedItem remove={() => this.removeSelection(k)}
                                                                key={k}
                                                                name={g.NAME}/>
                                                        ))}
                                                    </div> :
                                                    null
                                                }
                                                { selectedUsers.length ?
                                                    <div className="block-wrap">
                                                        <div><h5>{help.t('USERS')}</h5>
                                                            <hr/>
                                                        </div>
                                                        {selectedUsers.map((g, k) => (
                                                            <SelectedItem
                                                                remove={() => this.removeSelection(k, false)}
                                                                key={k}
                                                                name={`[${g.ID}] ${g.NAME} ${g.LAST_NAME} (${g.EMAIL})`}/>
                                                        ))}
                                                    </div> :
                                                    null
                                                }
                                            </Scrollbars>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <Footer onSubmit={this.onSubmit} onCancel={this.props.closeModal}/>
                    </div>
                </div>
            </div>
        )
    }
});

module.exports = AddUsers;

const React      = require('react');
const classes    = require('classnames');
const Scrollbars = require('react-gemini-scrollbar');
const extend     = require('extend');
const help = require('../../helpers/helpers');
const {connect} = require('react-redux');
const TabGroups = require('./user-pick-elements/tab-groups.js');
const TabUsers = require('./user-pick-elements/tab-users.js');
const SelectedItem = require('./user-pick-elements/selected-item.js');

const Footer = ({onCancel, onSubmit, done}) => (
    <div className="modal-footer">
        { done ?
            <button onClick={() => onCancel()}
                    className="btn btn-primary">{help.t('REMOVE_RIGHTS_SUCCESS_BUTTON')}</button>
            : null }
        { !done ?
            <button onClick={() => onCancel()} className="btn btn-default">{help.t('CANCEL2')}</button>
            : null }
        { !done ?
            <button onClick={() => onSubmit()} className="btn btn-primary">{help.t('REMOVE_RIGHTS')}</button>
            : null }
    </div>
);



const RemoveRights = React.createClass({
    getInitialState() {
        return {
            tab: 'groups',
            isLoading: false,
            selectedGroups: [],
            selectedUsers: [],
            done: false
        }
    },

    shouldComponentUpdate(nextProps, nextState) {
        if (nextProps.done) {
            nextState.isLoading = false;
        }
        return true;
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

    _buildRights(groups, users) {
        let data = [];

        groups.forEach((group) => {
            const right = {
                id: parseInt(group.ID),
                isGroup: true
            };
            data.push(right);
        });

        users.forEach((user) => {
            const right = {
                id: parseInt(user.ID),
                isGroup: false
            };
            data.push(right);
        });

        return data;
    },

    onSubmit() {
        const {selectedGroups, selectedUsers} = this.state;

        const data = this._buildRights(selectedGroups, selectedUsers);

        this.setState({isLoading: true});
        let result = this.props.removeRights(data);
    },

    render() {
        const {closeModal, modal, groups, users, done} = this.props;
        const {tab, selectedGroups, selectedUsers, isLoading} = this.state;

        return (
            <div className={classes("modal add-user", {loading: isLoading})} id="add-user">
                <div className="modal-dialog">
                    <div className="modal-content add-user">
                        <div className="modal-header">
                            <button onClick={closeModal} className="close" dangerouslySetInnerHTML={{__html: '&times;'}}></button>
                            <h4 className="modal-title">
                                { done ? help.t('REMOVE_RIGHTS_SUCCESS') : help.t('REMOVE_RIGHTS') }
                            </h4>
                        </div>
                        <div className="modal-body" style={{paddingLeft: 0}}>
                            {done ?

                                <div className="left-col col-md-12" style={{float: 'none'}}>
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
                                                                          name={g.NAME}
                                                                          done={done}/>
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
                                                                name={`[${g.ID}] ${g.NAME} ${g.LAST_NAME} (${g.EMAIL})`}
                                                                done={done}/>
                                                        ))}
                                                    </div> :
                                                    null
                                                }
                                            </Scrollbars>
                                        </div>
                                    </div>
                                </div>


                                :
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
                            }
                        </div>
                        <Footer onSubmit={this.onSubmit} onCancel={this.props.closeModal} done={done}/>
                    </div>
                </div>
            </div>
        )
    }
});

function mapStateToProps(state) {

    let done = false;

    if (state.action == 'REMOVE_RIGHTS_IS_DONE') {
        done = true;
    }

    return {
        done: done
    }
}
module.exports = connect(mapStateToProps)(RemoveRights);

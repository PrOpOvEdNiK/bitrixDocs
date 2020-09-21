const React      = require('react');
const classes    = require('classnames');
const extend     = require('extend');
const help = require('../../../helpers/helpers');

const UserElement = ({user, remove, isSelected, select, index}) => (
    <li title={`[${user.ID}] ${user.NAME} ${user.LAST_NAME} (${user.EMAIL})`}
        className={classes({selected: isSelected})}>
        <a onClick={() => select(user)} href="javascript:void(0);">
            <span>{`[${user.ID}] ${user.NAME} ${user.LAST_NAME} (${user.EMAIL})`}</span>
            {//isSelected
                //   ? <span className="minus glyphicon-minus glyphicon" title={help.t('DEL')}></span>
                //    : <span className="plus glyphicon-plus glyphicon" title={help.t('ADD')}></span>
            }
        </a>
    </li>
);

const TabUsers = React.createClass({
    getInitialState() {
        return {
            q: ''
        };
    },
    render() {
        const {selectedUsers, select, users, remove} = this.props;
        const {q} = this.state;

        return (
            <div className="tab-pane active" id="users">
                <form action="javascript:void(0);" className="form-horizontal">
                    <div className="search-wrapper">
                        <input
                            value={q}
                            ref={node => this.search = node}
                            onChange={() => this.setState({q: this.search.value})}
                            type="text"
                            className="form-control"
                            id="filter-groups"/>
                        <i className="icon-search"></i>
                    </div>
                </form>
                <div className="user-add-collapsible-list">
                    <ul>
                        {users.filter(u => u.ACTIVE === 'Y' || u.ACTIVE === true).map((u, k) => {
                            if (q.trim()) {
                                if (!u.NAME || u.NAME.toLowerCase().indexOf(q.toLowerCase()) === -1) {
                                    if (!u.LAST_NAME || u.LAST_NAME.toLowerCase().indexOf(q.toLowerCase()) === -1) {
                                        if (!u.EMAIL || u.EMAIL.toLowerCase().indexOf(q.toLowerCase()) === -1) {
                                            return null;
                                        }
                                    }
                                }
                            }

                            let selected = selectedUsers.filter(user => user.ID === u.ID).length;


                            return (
                                <UserElement
                                    index={selectedUsers.indexOf(u)}
                                    select={!selected ? select : null}
                                    remove={selected ? remove : null}
                                    isSelected={selected}
                                    key={k}
                                    user={u}/>
                            )
                        })}
                    </ul>
                </div>
            </div>
        )
    }
});

module.exports = TabUsers;

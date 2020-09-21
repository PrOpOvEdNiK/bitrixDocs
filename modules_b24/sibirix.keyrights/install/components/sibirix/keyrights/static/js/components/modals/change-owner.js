const React   = require('react');
const classes = require('classnames');
const help = require('../../helpers/helpers');

const Footer = ({onCancel, onSubmit, selected}) => (
    <div className="modal-footer">
        <button onClick={() => onCancel()} className="btn btn-default">{help.t('CANCEL2')}</button>
        <button onClick={() => onSubmit()}
                className="btn btn-primary"
                disabled={!selected}>{help.t('SAVE')}</button>
    </div>
);

const UserElement = ({user, isSelected, select}) => (
    <li title={`[${user.ID}] ${user.NAME} ${user.LAST_NAME} (${user.EMAIL})`}
        className={classes({selected: isSelected})}>
        <a onClick={() => select(user)} href="javascript:void(0);">
            <span>{`[${user.ID}] ${user.NAME} ${user.LAST_NAME} (${user.EMAIL})`}</span>
            {isSelected
                ? <span className="minus glyphicon-minus glyphicon" title={help.t('DEL')}></span>
                : <span className="plus glyphicon-plus glyphicon" title={help.t('ADD')}></span>
            }
        </a>
    </li>
);

const DirectoryName = ({name, color}) => {
    return (
        <span className="directory">
            <span className={`icon-folder icon-folder-sprite folder-${color}`}></span>
            <span>{name}</span>
        </span>
    )
}

const EntityName = ({name}) => {
    return (
        <span className="directory">
            <span>{name}</span>
        </span>
    )
}

const ChangeOwner = React.createClass({
    getInitialState() {
        return {
            q: '',
            selected: false
        };
    },
    onSubmit() {
        if (!this.state.selected) {
            return;
        }

        const data = {
            owner: this.state.selected
        };

        if (this.props.modal.isSection) {
            data.entityId  = null;
            data.sectionId = parseInt(this.props.modal.item.ID);
        } else {
            data.sectionId = parseInt(this.props.modal.item.SECTION);
            data.entityId  = parseInt(this.props.modal.item.ID);
        }

        this.props.submit(data);
    },
    render() {
        const {closeModal, modal, users} = this.props;
        const {q} = this.state;

        return (
            <div className="modal add-user" id="add-user">
                <div className="modal-dialog">
                    <div className="modal-content add-user">
                        <div className="modal-header">
                            <button onClick={closeModal} className="close" dangerouslySetInnerHTML={{__html: '&times;'}}></button>
                            <h4 className="modal-title">
                                <span>{help.t('OWNER_CHANGING_' + (!modal.isSection ? 'PASS' : 'SECTION'))}: </span>
                                {modal.isSection
                                    ? <DirectoryName color={modal.item.ICON} name={modal.item.NAME}/>
                                    : <EntityName name={modal.item.NAME}/>
                                }
                            </h4>
                        </div>
                        <div className="modal-body" style={{paddingLeft: 0}}>
                            <div className="row">
                                <div className="col-md-12 left-col">
                                    <div className="tab-content">
                                        <div className="tab-pane active" id="users">
                                            <form action="javascript:void(0);" className="form-horizontal">
                                                <div className="search-wrapper">
                                                    <input
                                                        value={q}
                                                        ref={node => this.search = node}
                                                        onChange={() => this.setState({q: this.search.value, selected: false})}
                                                        type="text"
                                                        className="form-control"
                                                        id="filter-groups"/>
                                                    <i className="icon-search"></i>
                                                </div>
                                            </form>
                                            <div className="user-add-collapsible-list">
                                                <ul>
                                                    {users.map((u, k) => {
                                                        if (q.trim()) {
                                                            if (!u.NAME || u.NAME.toLowerCase().indexOf(q.toLowerCase()) === -1) {
                                                                if (!u.LAST_NAME || u.LAST_NAME.toLowerCase().indexOf(q.toLowerCase()) === -1) {
                                                                    if (!u.EMAIL || u.EMAIL.toLowerCase().indexOf(q.toLowerCase()) === -1) {
                                                                        return null;
                                                                    }
                                                                }
                                                            }
                                                        }

                                                        return (
                                                            <UserElement
                                                                select={() => this.setState({selected: u.ID})}
                                                                isSelected={parseInt(this.state.selected) == parseInt(u.ID)}
                                                                key={k}
                                                                user={u}/>
                                                        )
                                                    })}
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <Footer onSubmit={this.onSubmit}
                                onCancel={this.props.closeModal}
                                selected={!!this.state.selected}
                        />
                    </div>
                </div>
            </div>
        )
    }
});

module.exports = ChangeOwner;

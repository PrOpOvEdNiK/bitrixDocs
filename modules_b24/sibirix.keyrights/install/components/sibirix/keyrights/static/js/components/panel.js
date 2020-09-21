const React      = require('react');
const classnames = require('classnames');
const {connect} = require('react-redux');

const help         = require('../helpers/helpers');
const Actions      = require('../actions/');
const PanelContent = require('./panel/content');

const Panel = React.createClass({
    getInitialState() {
        return {
            heading: ''
        }
    },

    componentWillReceiveProps(props) {
        if (props.item.isNew) {
            this.setState({heading: ''});
        }
    },

    getInheritedRights(item) {
        return help.getInherited(item, this.props.tree);
    },

    render() {
        const {item} = this.props;

        const panelClassnames = classnames(
            'sidepanel',
            'detail',
            {['detail-password']: item && (!item.isFolder || item.isNew || item.isEdit)},
            {view: item && !item.isNew && !item.isEdit},
            {edit: item && (item.isNew || item.isEdit)}
        );

        return (
            <div className="sidepanel-wrapper">
                <div className={panelClassnames}>
                    <div className="wrapper wrapper-right">
                        {!item ?
                            null :
                            <PanelContent
                                {...this.props}
                                setHeading={(heading) => this.setState({heading})}
                                heading={this.state.heading}/>}
                    </div>
                </div>
            </div>
        )
    }
});

function mapStateToProps(state) {
    let item = false;
    const {panelElement} = state.panel;
    const {activeFolder} = state.tree;
    const {isLoading, smartLoad} = panelElement;

    if (panelElement !== false) {
        const {isFolder, id, isNew, isEdit} = panelElement;

        if (isNew) {
            item = {isNew};
        } else {
            const element = isFolder
                ? state.tree.tree.sections[state.tree.tree.index[id]]
                : state.items.items.entities[state.items.items.index[id]];

            if (element) {
                const ownerId = parseInt(element.OWNER) || parseInt(element.CREATED_BY);
                item          = {isFolder, element, isEdit};
                item.owner    = state.users.filter((u) => parseInt(u.ID) === ownerId)[0];

                if (item.element.RIGHTS === undefined) item.element.RIGHTS = [];
            } else {
                item = false;
            }

            if (item && !isLoading) {
                let itemRights  = item.element.RIGHTS;
                const inherited = help.getInherited(item, state.tree.tree);
                itemRights      = [...itemRights, ...inherited];

                const rightsUsers  = itemRights.filter(r => r.user).map(r => parseInt(r.user));
                const rightsGroups = itemRights.filter(r => r.group).map(r => parseInt(r.group));

                const allowedGroups = state.groups.items.filter(g => rightsGroups.indexOf(parseInt(g.ID)) !== -1);
                const allowedUsers  = state.users.filter(g => rightsUsers.indexOf(parseInt(g.ID)) !== -1);

                item.element.allowedGroups = help.fieldToKey(allowedGroups, 'ID');
                item.element.allowedUsers  = help.fieldToKey(allowedUsers, 'ID');
                item.element.inherited     = inherited;
            }
        }
    }

    return {
        item,
        tree: state.tree.tree,
        items: state.items.items.entities,
        activeFolder,
        smartLoad,
        isLoading,
        currentUser: state.currentUser
    };
}

function mapDispatchToProps(dispatch) {
    return {
        showEditPasswordForm: (data) => dispatch(Actions.editItem(data)),
        showEditFolderPopup: (data) => dispatch(Actions.showEditFolderPopup(data)),
        closeNewItem: () => dispatch(Actions.closeNewItem()),
        addItem: (data) => dispatch(Actions.addItem(data)),
        saveEditedItem: (data) => dispatch(Actions.saveEditedItem(data)),
        addUsers: (data) => dispatch(Actions.addUsers(data)),
        showChangeOwnerPopup: (data) => dispatch(Actions.showChangeOwnerPopup(data)),
        saveRights: (data, user) => dispatch(Actions.saveRights(data, user)),
        copyLogger: (item_id) => dispatch(Actions.copyLogger(item_id)),
        showAlert: (text) => dispatch(Actions.showAlert(text)),
    }
}

module.exports = connect(mapStateToProps, mapDispatchToProps)(Panel);

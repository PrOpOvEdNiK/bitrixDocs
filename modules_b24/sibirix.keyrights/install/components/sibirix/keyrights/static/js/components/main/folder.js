const React = require('react');
const classes = require('classnames');
const help = require('../../helpers/helpers');

const Folder = React.createClass({
    getInitialState() {
        return {
            isDropHover: false
        };
    },

    onDragStart(e) {
        e.stopPropagation();
        e.dataTransfer.setData("itemId", this.props.folder.ID);
        e.dataTransfer.setData("parentId", this.props.folder.SECTION);
    },

    onDragOver(e) {
        e.stopPropagation();

        if (this.props.folder.CAN_WRITE) {
            e.preventDefault();
            this.setState({isDropHover: true});
        }
    },

    onDragLeave(e) {
        e.preventDefault();
        e.stopPropagation();

        this.setState({isDropHover: false});
    },

    toggleMenu(e, menuIsVisible) {
        e.preventDefault();
        e.stopPropagation();
        this.setState({menuIsVisible});
    },

    handleMenuClick(e, action) {
        this.toggleMenu(e, false);
        action();
    },

    handleAction(e, action) {
        this.toggleMenu(e, false);
        action();
    },

    onDrop(e) {
        e.stopPropagation();

        if (e.dataTransfer.getData("itemId")) {
            const dragId = parseInt(e.dataTransfer.getData("itemId"));
            const dragParentId = parseInt(e.dataTransfer.getData("parentId"));
            const targetId = parseInt(this.props.folder.ID);

            this.setState({isDropHover: false});

            if ((dragId === targetId) || (dragParentId && parseInt(dragParentId) === targetId) || this.props.folder.ALL_PARENTS.indexOf(parseInt(e.dataTransfer.getData("itemId"))) !== -1) return false;

            this.props.moveFolder(dragId, targetId);
        } else {
            const dragId = parseInt(e.dataTransfer.getData("entityId"));
            const dragParentId = parseInt(e.dataTransfer.getData("parentId"));
            const targetId = parseInt(this.props.folder.ID);

            this.setState({isDropHover: false});

            if ((dragParentId && parseInt(dragParentId) === targetId)) return false;

            this.props.moveItem(dragId, targetId, dragParentId);
        }
    },

    componentDidMount() {
        this.item.addEventListener('dragstart', this.onDragStart);
        this.item.addEventListener('dragover', this.onDragOver);
        this.item.addEventListener('dragleave', this.onDragLeave);
        this.item.addEventListener('drop', this.onDrop);
    },

    componentWillUnmount() {
        this.item.removeEventListener('dragstart', this.onDragStart);
        this.item.removeEventListener('dragover', this.onDragOver);
        this.item.removeEventListener('dragleave', this.onDragLeave);
        this.item.removeEventListener('drop', this.onDrop);
    },

    render() {
        const {folder, changeFavorite, showEditFolderPopup, showRemoveFolderConfirm, showAddFolderPopup, addUsers, moveFolder} = this.props;
        return (
            <tr className={classes({['drop-hover']: this.state.isDropHover})} ref={node => this.item = node}
                draggable={folder.CAN_WRITE}
                onClick={() => this.props.openFolder(folder.ID)}
                onContextMenu={(e) => this.toggleMenu(e, true)}
            >
                <td>
                    <div className="drag-root">
                        <i className={classes(`icon icon-folder icon-folder-sprite folder-${folder.ICON}`, {favorite: folder.isFavorite } )} dangerouslySetInnerHTML={{__html: '&nbsp;'}}></i>
                        <span>{folder.NAME}</span>
                        <div className={classes("menu dropdown", {open: this.state.menuIsVisible})}>
                            {folder.CAN_WRITE ?
                             <div
                                 className={classes("menu dropdown", {open: this.state.menuIsVisible})}>
                                 <i onClick={(e) => this.toggleMenu(e, true)} className="icon-menu dropdown-toggle folder"></i>
                                 {this.state.menuIsVisible ?
                                  <div onContextMenu={(e) => this.toggleMenu(e, false)}
                                       onClick={(e) => this.toggleMenu(e, false)}
                                       className="cover"></div> : null}

                                 <ul style={{top: this.state.menuTop}} className="dropdown-menu tree">
                                     <li>
                                         <a onClick={(e) => this.handleMenuClick(e, () => showAddFolderPopup(folder.ID))}
                                            href="javascript:void(0);">
                                             <span>{help.t('SUBSECTION_ADD')}</span>
                                             <small>Ctrl+d</small>
                                         </a>
                                     </li>
                                     <li>
                                         <a onClick={(e) => this.handleMenuClick(e, () => showRemoveFolderConfirm(folder.ID))}
                                            href="javascript:void(0);">
                                             <span>{help.t('DEL')}</span>
                                         </a>
                                     </li>
                                     <li>
                                         <a onClick={(e) => this.handleMenuClick(e, () => showEditFolderPopup(folder))}
                                            href="javascript:void(0);">
                                             <span>{help.t('EDIT')}</span>
                                             <small>Ctrl+e</small>
                                         </a>
                                     </li>
                                     <li>
                                         <a onClick={(e) => this.handleMenuClick(e, () => addUsers({isSection: true, id: folder.ID}))}
                                            href="javascript:void(0);">
                                             <span>{help.t('GRANT_ACCESS')}</span>
                                             <small>Ctrl+shift+a</small>
                                         </a>
                                     </li>
                                     <li>
                                         <a onClick={(e) => this.handleMenuClick(e, () => changeFavorite(folder.ID, true))}
                                            href="javascript:void(0);">
                                             <span>{help.t(folder.isFavorite ? 'REMOVE_FAVORITE' : 'ADD_FAVORITE')}</span>
                                         </a>
                                     </li>
                                     {folder.SECTION !== 0 ? <li>
                                         <a onClick={(e) => this.handleMenuClick(e, () => moveFolder(folder.ID, 0))}
                                            href="javascript:void(0);">
                                             <span>{help.t('MOVE_TO_TOP')}</span>
                                         </a>
                                     </li> : null}
                                 </ul>
                             </div> :
                             null
                            }
                        </div>
                    </div>
                </td>
                <td>
                </td>
                <td>
                    <a className={classes(`favorite-toogle small`, {open: !folder.isFavorite })}
                       onClick={(e) => this.handleAction(e, () => changeFavorite(folder.ID, true))}
                       href="javascript:void(0);">
                    </a>
                </td>
            </tr>
        )
    }
});

module.exports = Folder;

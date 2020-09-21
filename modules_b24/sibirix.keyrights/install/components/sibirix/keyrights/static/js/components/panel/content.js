const React   = require('react');
const classes = require('classnames');

const Heading = require('./heading');
const Rights  = require('./rights');
const AddItem = require('./add-item');
const help    = require('../../helpers/helpers');

const Scrollbars = require('react-gemini-scrollbar');

module.exports = (props) => {
    const {item, heading} = props;

    const edit      = item.isFolder ? props.showEditFolderPopup : props.showEditPasswordForm;
    let headingText = item.isNew ? heading ? heading : help.t('PASS_NEW') : item.element.NAME;

    if (item.isEdit) {
        headingText = heading || item.element.NAME;
    }

    return (
        <div className={classes("rel", {loading: props.smartLoad})}>
            <Heading isLoading={props.isLoading} edit={edit} heading={headingText} item={item}/>
            <div className="panel-scroll-wrapper" style={{height: 'calc(100% - 52px)'}}>
                <Scrollbars>
                    {item.isNew || item.isEdit ?
                     <AddItem
                         setHeading={(heading) => props.setHeading(heading)}
                         add={props.addItem}
                         edit={props.saveEditedItem}
                         item={item}
                         tree={props.tree}
                         currentUser={props.currentUser}
                         activeFolder={props.activeFolder}
                         showAlert={props.showAlert}
                         closeNewItem={props.closeNewItem}/> :

                     <Rights
                         saveRights={id => props.saveRights(id, props.currentUser)}
                         addUsers={props.addUsers}
                         showChangeOwnerPopup={props.showChangeOwnerPopup}
                         isLoading={props.isLoading}
                         smartLoad={props.smartLoad}
                         item={item}
                         copyLogger={props.copyLogger}/>}
                </Scrollbars>
            </div>
        </div>
    );
};

const React          = require('react');
const Scrollbars     = require('react-gemini-scrollbar');
const extend         = require('extend');
const AddUsersButton = require('./add-users-button');
const Creator        = require('./creator');
const Right          = require('./right');
const RightBlocked   = require('./right-blocked');
const Dates          = require('./dates');
const help           = require('../../helpers/helpers');

module.exports = React.createClass({
    saveRights(right, patch) {
        const {folder} = this.props;
        const rights = folder.RIGHTS;

        const index = rights.indexOf(right);

        if (index !== -1) {
            rights[index] = extend({}, rights[index], patch);
        } else {
            rights.push(extend({}, right, patch));
        }

        const data = {
            sectionId: folder.ID,
            entityId: false,
            rights
        };

        this.props.saveRights(data);
    },

    render() {
        const {owner, folder, addUsers, isLoading} = this.props;

        if (isLoading) {
            return (
                <div className="detail-content">
                    {parseInt(folder.ID) === 0 ? null :
                        <Dates dateCreated={folder.DATE_CREATE} dateChanged={folder.TIMESTAMP_X}/>}
                </div>
            );
        }

        return (
            <div className="detail-content">
                <Scrollbars>
                    <div className="panel-body">
                        <div className="list-allowed">
                            <div className="panel-heading">{help.t('HAVE_RIGHTS')}</div>
                            <div className="panel-body">
                                <table className="table rights">
                                    <colgroup>
                                        <col style={{width: 29}} />
                                        <col style={{width: 41}} />
                                        <col style={{width: 48}} />
                                        <col style={{width: 71}} />
                                        <col style={{width: 10}} />
                                    </colgroup>
                                    <tbody>
                                    <Creator change={() => this.props.showChangeOwnerPopup({isSection: true, id: folder.ID})}
                                        canEdit={folder.CAN_OWN}
                                        noName={parseInt(folder.ID) === 0}
                                        owner={owner}/>

                                    {folder.RIGHTS.filter(r => !r.blocked).sort((a, b) => a.user ? -1 : 1).map((r, k) =>
                                        <Right saveRights={(right, patch) => this.saveRights(right, patch)}
                                            key={k}
                                            item={folder}
                                            right={r}
                                            owner={owner.ID}/>
                                    )}

                                    {folder.inherited.filter(r => !r.blocked).sort((a, b) => a.user ? -1 : 1).map((r, k) =>
                                        <Right isInherited={true}
                                            saveRights={(right, patch) => this.saveRights(right, patch)}
                                            key={k}
                                            item={folder}
                                            right={r}
                                            owner={owner.ID}/>
                                    )}

                                    </tbody>
                                </table>

                                {folder.RIGHTS.filter(r => r.blocked).length ?
                                    <table className="table rights">
                                        <tbody>

                                        <tr>
                                            <td className="blocked-td" colSpan="5">{help.t('BLOCKED')}</td>
                                        </tr>

                                        {folder.RIGHTS.filter(r => r.blocked).sort((a, b) => a.user ? -1 : 1).map((r, k) =>
                                            <RightBlocked
                                                blocked={true}
                                                saveRights={(right, patch) => this.saveRights(right, patch)}
                                                key={k}
                                                item={folder}
                                                right={r}/>
                                        )}

                                        </tbody>
                                    </table> :
                                    null
                                }

                                {folder.CAN_WRITE ?
                                    <div className="no-rights-btn-wrap">
                                        <AddUsersButton action={() => addUsers({isSection: true, id: folder.ID})}/>
                                    </div> :
                                    null
                                }
                            </div>
                        </div>

                        {parseInt(folder.ID) === 0 ? null :
                            <Dates dateCreated={folder.DATE_CREATE} dateChanged={folder.TIMESTAMP_X}/>}
                    </div>
                </Scrollbars>
            </div>
        );
    }
});

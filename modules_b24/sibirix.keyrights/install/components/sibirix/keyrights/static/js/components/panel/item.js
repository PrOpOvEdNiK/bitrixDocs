const React          = require('react');
const extend         = require('extend');
const clipboard      = require('clipboard-js');
const cryptHelper    = require('../../helpers/crypt');
const Creator        = require('./creator');
const Right          = require('./right');
const RightBlocked   = require('./right-blocked');
const AddUsersButton = require('./add-users-button');
const Dates          = require('./dates');
const Scrollbars     = require('react-gemini-scrollbar');
const help           = require('../../helpers/helpers');
const FileSaver      = require('file-saver');
const Blob           = require('blob');

const Note = ({note}) => (
    <div className="note">
        <div className="note-header">{help.t('NOTE')}:</div>
        <span className="note-output">{note}</span>
    </div>
);

const Login = ({login, copyLogger}) => (
    <tr>
        <td>{help.t('LOGIN')}</td>
        <td>{login} <i onClick={() => clipboard.copy(login) } className="icon-file"></i></td>
    </tr>
);

const Password = ({password, isVisible, toggle, copyLogger, item_id}) => (
    <tr>
        <td>{help.t('PASS')}</td>
        <td>
            <i onClick={() => toggle(!isVisible)}
                className={isVisible ? "icon-eye opened" : "icon-eye"}></i>
            <span className={isVisible ? "password text" : "password"}>{isVisible ? password : '********'}
                <i onClick={() => { clipboard.copy(password); copyLogger(item_id);} } className="icon-file"></i>
            </span>
        </td>
    </tr>
);

const URL = ({url}) => (
    <tr>
        <td>URL</td>
        <td>{url}<i onClick={() => clipboard.copy(url)} className="icon-file"></i>
        </td>
    </tr>
);

module.exports = React.createClass({
    getInitialState() {
        return {
            passIsVisible: false,
            copyLogin: false,
            copyPassword: false,
            copyUrl: false
        }
    },

    componentWillReceiveProps(np) {
        this.setState({
            passIsVisible: false,
            copyLogin: false,
            copyPassword: false,
            copyUrl: false
        });
    },

    saveRights(right, patch) {
        const {item} = this.props;
        const rights = item.RIGHTS;

        const index = rights.indexOf(right);

        let data;
        if (index !== -1) {
            rights[index] = extend({}, rights[index], patch);
        } else {
            rights.push(extend({}, right, patch));
        }

        data = {
            sectionId: item.SECTION,
            entityId: item.ID,
            rights
        };

        this.props.saveRights(data);
    },

    copySuccess (string) {
        this.setState({[string]: true});
        setTimeout((function() {
            this.setState({[string]: false});
        }).bind(this), 1500);
    },

    fileDownload(id) {
        const data = cryptHelper.decrypt(this.props.item.CRYPTED);
        const file = data.FILES.filter(f => f.id === id)[0];
        if (file) {
            let content = file.content + '';
            content = content.substr(content.indexOf('base64,')+('base64,').length);

            let byteString = atob(content);

            let ab = new ArrayBuffer(byteString.length);
            let ia = new Uint8Array(ab);
            for (let i = 0; i < byteString.length; i++) {
                ia[i] = byteString.charCodeAt(i);
            }

            let blob = new Blob([ia], { type: file.type });

            FileSaver.saveAs(blob, file.name);
        }
    },

    render() {
        const data = cryptHelper.decrypt(this.props.item.CRYPTED);
        const {passIsVisible} = this.state;
        const {owner, item, addUsers, copyLogger} = this.props;

        return (
            <div className="detail-content">
                <Scrollbars>
                    {data.LOGIN || data.PASSWORD || data.URL || (data.FILES && data.FILES.length)
                        ? <table className="table pass-info">
                        <tbody>
                        {data.LOGIN ?

                            <tr>
                                <td>{help.t('LOGIN')}</td>
                                <td>{data.LOGIN} <i onClick={() => {clipboard.copy(data.LOGIN); this.copySuccess('copyLogin')  }}
                                    className={this.state.copyLogin ? "copy-success icon-file" : "icon-file"}>{this.state.copyLogin ? help.t('REMOVE_RIGHTS_SUCCESS_BUTTON') : null}</i></td>
                            </tr>

                            : null
                        }
                        {data.PASSWORD
                            ?

                            <tr>
                                <td>{help.t('PASS')}</td>
                                <td>
                                    <i onClick={() => this.setState({passIsVisible: !passIsVisible})}
                                       className={this.state.passIsVisible ? "icon-eye opened" : "icon-eye"}></i>
                                    <span className={this.state.passIsVisible ? "password text" : "password"}>{this.state.passIsVisible ? data.PASSWORD : '********'}
                                        <i onClick={() => {clipboard.copy(data.PASSWORD); this.copySuccess('copyPassword'); copyLogger(item.ID);  }}
                                            className={this.state.copyPassword ? "copy-success icon-file" : "icon-file"}>
                                            {this.state.copyPassword ? help.t('REMOVE_RIGHTS_SUCCESS_BUTTON') : null}</i>
                                    </span>
                                </td>
                            </tr>

                            : null}
                        {data.URL ?

                            <tr>
                                <td>URL</td>
                                <td>{data.URL}<i onClick={() => {clipboard.copy(data.URL); this.copySuccess('copyUrl')  }}
                                                 className={this.state.copyUrl ? "copy-success icon-file" : "icon-file"}>
                                                 {this.state.copyUrl ? help.t('REMOVE_RIGHTS_SUCCESS_BUTTON') : null}</i>
                                </td>
                            </tr>

                            : null}
                        {data.FILES && data.FILES.length ? <tr>
                            <td>{help.t('FILES')}</td>
                            <td>{data.FILES.map(f => <div className="file-wrapper" key={f.id}>
                                <a href="javascript:void(0)" onClick={e => this.fileDownload(f.id)} title={f.name}>{f.name}</a>
                            </div>)}</td>
                        </tr> : null}
                        <tr>
                            <td colSpan="2"></td>
                        </tr>
                        </tbody>
                    </table>
                        : null
                    }

                    {data.NOTE ? <Note note={data.NOTE}/> : null}

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
                                <Creator change={() => this.props.showChangeOwnerPopup({isSection: false, id: item.ID})}
                                    canEdit={item.CAN_OWN}
                                    owner={owner}/>

                                {item.RIGHTS.filter(r => !r.blocked).sort((a, b) => a.user ? -1 : 1).map((r, k) =>
                                    <Right saveRights={(right, patch) => this.saveRights(right, patch)}
                                        key={k}
                                        item={item}
                                        right={r}/>
                                )}

                                {item.inherited.filter(r => !r.blocked).sort((a, b) => a.user ? -1 : 1).map((r, k) =>
                                    <Right isInherited={true}
                                        saveRights={(right, patch) => this.saveRights(right, patch)}
                                        key={k}
                                        item={item}
                                        right={r}
                                        owner={owner.ID}/>
                                )}

                                </tbody>
                            </table>

                            {item.RIGHTS.filter(r => r.blocked).length ?
                                <table className="table rights">
                                    <tbody>
                                    <tr>
                                        <td className="blocked-td" colSpan="5">{help.t('BLOCKED')}</td>
                                    </tr>
                                    {item.RIGHTS.filter(r => r.blocked).sort((a, b) => a.user ? -1 : 1).map((r, k) =>
                                        <RightBlocked
                                            blocked={true}
                                            saveRights={(right, patch) => this.saveRights(right, patch)}
                                            key={k}
                                            item={item}
                                            right={r}/>
                                    )}

                                    </tbody>
                                </table> :
                                null
                            }

                            {item.CAN_WRITE ?
                                <div className="no-rights-btn-wrap">
                                    <AddUsersButton action={() => addUsers({isSection: false, id: item.ID})}/>
                                </div> :
                                null
                            }
                        </div>
                    </div>

                    <Dates dateCreated={item.DATE_CREATE} dateChanged={item.TIMESTAMP_X}/>
                </Scrollbars>
            </div>
        )
    }
});

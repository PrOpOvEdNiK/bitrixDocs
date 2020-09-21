const React = require('react');
const crypt = require('../../helpers/crypt');
const help = require('../../helpers/helpers');

const Import = React.createClass({
    getInitialState() {
        return {
            filename: '',
            progress: 0
        };
    },

    onFileChange() {
        const filename = this.file.files[0].name;

        if (filename.indexOf('.csv') === -1) {
            this.file.value = '';
            this.props.showAlert(help.t('IMPORT_NEED_CSV'));
            return;
        }

        this.setState({filename});
    },

    startImport() {
        Papa.parse(this.file.files[0], {
            header: true,
            complete: (res) => {
                if (!res.data || !res.data.length) {
                    return;
                }

                this.sendToServer(res.data.filter(item => item['Account']).map(item => crypt.process(item)));
            },
            error: (err) => {
                this.props.showAlert(help.t('IMPORT_NEED_CSV'));
                this.file.value = '';
            }
        });
    },

    sendToServer(data) {
        this.setState({progress: 100});
        this.props.import(data);
    },

    render() {
        return (
            <div className="modal import" id="import-passwords">
                <div className="modal-dialog">
                    <div className="modal-content add-user">
                        <div className="modal-header">
                            <button onClick={this.props.closeModal} className="close" dangerouslySetInnerHTML={{__html: '&times;'}}></button>
                            <h4 className="modal-title">{help.t('IMPORT')}</h4>
                        </div>
                        <input onChange={this.onFileChange}
                            ref={node => this.file = node}
                            type="file"
                            style={{display: 'none'}}/>
                        {this.state.filename && !this.state.progress ?
                            <span className="filename">{this.state.filename}</span> :
                            null
                        }
                        {this.state.progress ?
                            <div className="progress progress-striped active">
                                <div className="progress-bar" style={{width: this.state.progress + '%'}}></div>
                            </div> :
                            null
                        }
                        <div className="modal-footer">
                            <button onClick={this.props.closeModal} className="btn btn-default">{help.t('CANCEL2')}</button>
                            {!this.state.filename ?
                                <button onClick={() => this.file.click()}
                                    className="btn btn-primary">{help.t('FILE_CHOOSE')}</button> :
                                <button style={{display: this.state.progress ? 'none' : 'inline-block'}}
                                    onClick={this.startImport}
                                    className="btn btn-primary">{!this.state.progress ? help.t('IMPORT_START') : help.t('IMPORTING')}</button>
                            }
                        </div>
                    </div>
                </div>
            </div>
        )
    }
});

module.exports = Import;

const React      = require('react');
const Tree       = require('./tree');
const MainArea   = require('./main-area');
const Panel      = require('./panel');
const Modals     = require('./modals');
const Footer     = require('./footer');
const LoadScreen = require('./load-screen');
const Actions    = require('../actions/');
const NotAccess  = require('./not-access');

const {connect} = require('react-redux');


const Root = React.createClass({

    shouldComponentUpdate(nextProps, nextState) {
        if(nextProps.currentUser != this.props.currentUser && nextProps.currentUser != 'not_permission') {
            this.props.fetchData(nextProps.currentUser, true);
        }
        return true;
    },
    componentDidMount() {
        this.props.fetchData(this.props.currentUser);
        let path = window.location.hash.substr(2).split('/');
        if (path[0]) {
            this.props.openFolder(parseInt(path[0]), this.props.currentUser);
            if (path[1]) {
                this.props.openItem(parseInt(path[1]));
            }
        }
    },
    render() {
        if (!this.props.loaded) {
            return <LoadScreen />
        }
        if(this.props.currentUser == 'not_permission') {
            return (
                <div className="content">
                    <NotAccess
                        view = { this.props.view }
                        resetView = { this.props.resetViewUser }
                    />
                    <Footer />
                </div>
            )
        }
        return (
            <div className="content">
                <Tree />
                <MainArea />
                <Panel />
                <Modals />
                <Footer />
            </div>
        )
    }
});

function mapStateToProps(state) {
    return {
        currentUser: state.currentUser,
        loaded: state.loaded,
        view: state.view
    }
}

function mapDispatchToProps(dispatch) {
    return {
        fetchData: (currentUser, userId) => dispatch(Actions.fetchData(currentUser, userId)),
        openFolder: (id, user) => dispatch(Actions.openFolder(id, user)),
        openItem: (id) => dispatch(Actions.openItem(id)),
        resetViewUser: () => dispatch(Actions.resetViewUser()),
    }
}

module.exports = connect(mapStateToProps, mapDispatchToProps)(Root);

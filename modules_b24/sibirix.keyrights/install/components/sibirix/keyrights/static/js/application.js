function start() {
    const React                = require('react');
    const {render}             = require('react-dom');
    const Router               = require('react-router').Router
    const Route                = require('react-router').Route
    const createBrowserHistory = require('history/lib/createBrowserHistory');
    const {Provider}           = require('react-redux');

    const app   = document.getElementById('keyrights');
    const store = require('./store/configure-store');

    const Root = require('./components/root.js');

    // if (window.navigator.userAgent.indexOf('Firefox') !== -1) {
    //     app.style.height = document.body.scrollHeight - 150 + 'px';
    // }

    render(
        <Provider store={store}>
            <Router history={createBrowserHistory()}>
                <Route path="/" component={Root}>
                    <Route path="/keyrights/" component={Root}/>
                </Route>
            </Router>
        </Provider>,
        app
    );
}

window.addEventListener('load', start);

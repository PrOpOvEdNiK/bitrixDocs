const React = require('react');
const slon = require('../slon');
const help = require('../helpers/helpers');

const Footer = React.createClass({
    componentDidMount() {
        slon();
    },
    render() {
        return (
            <footer>
                <img width="102" height="22" src={CONST.staticPath + "images/logo.png"}/>
                <span className="sep" dangerouslySetInnerHTML={{__html: '&nbsp;'}}></span>
                <span>{help.t('DEVELOPER_STUDIO')}</span>
                <a style={{marginLeft: '6px'}} href="http://www.sibirix.ru" target="_blank">
                    <canvas id="slonCanvas" width="90" height="16"></canvas>
                </a>
            </footer>
        )
    }
});

module.exports = Footer;

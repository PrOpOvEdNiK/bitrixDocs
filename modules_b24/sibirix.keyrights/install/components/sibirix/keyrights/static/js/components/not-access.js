const React = require('react');
const help  = require('../helpers/helpers');



module.exports = ({view, resetView}) => (
    <div className="not-access">
        <div>{help.t('NOT_ACCESS')}</div>
        { view ?
                <a onClick={resetView} href="javascript:void(0);">{help.t('RETURN')}</a>
                :
                null
                }
    </div>
);

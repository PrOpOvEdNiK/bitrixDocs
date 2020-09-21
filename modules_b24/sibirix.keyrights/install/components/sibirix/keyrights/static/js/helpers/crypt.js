const _key = CONST.key;
delete CONST.key;

const help = require('./helpers');

const cryptHelper = {
    encrypt(obj) {
        return Aes.Ctr.encrypt(JSON.stringify(obj), _key, 256);
    },
    decrypt(str) {
        var cryptedObj = {};

        if (typeof str === 'undefined' || 0 === str.length) {
            return cryptedObj;
        }

        try {
            cryptedObj = JSON.parse(Aes.Ctr.decrypt(str, _key, 256));
            if (typeof cryptedObj !== 'object' || cryptedObj == null) {
                cryptedObj = {};
            }
        } catch(err) {
            if (!(err instanceof SyntaxError)) {
                throw(err);
            }
        }

        return cryptedObj;
    },

    process(item) {
        return {
            NAME: item['Account'],
            SECTION: item['Password Groups'],
            PARENT_SECTION: item['Group Tree'],
            CRYPTED: this.encrypt({
                LOGIN: item['Login Name'],
                PASSWORD: item['Password'],
                URL: item['Web Site'],
                NOTE: item['Comments']
            })
        };
    },

    getLink(str) {
        const obj   = this.decrypt(str);
        let rawLink = obj.URL;

        if (!rawLink) return '';
        if (!rawLink.trim()) return rawLink;

        var url    = rawLink;
        var parts  = help.parseUrl(rawLink);
        var isLink = false;
        if ((parts.scheme == 'http') || (parts.scheme == 'https')) {
            isLink = true;
            url    = parts.scheme + '://' + parts.host;
        } else if (rawLink.indexOf('www.') === 0) {
            isLink  = true;
            url     = rawLink;
            rawLink = 'http://' + rawLink;
        }

        return {isLink, text: rawLink};
    }
};

module.exports = cryptHelper;

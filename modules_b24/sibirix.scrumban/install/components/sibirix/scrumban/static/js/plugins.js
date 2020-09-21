(function($) {
    $.extend({
        isAppleDevice: function() {
            var isIpad = navigator.userAgent.match(/iPad/i) != null;
            var isIphone = navigator.platform.indexOf("iPhone") != -1;
            var isIpod = navigator.platform.indexOf("iPod") != -1;

            return isIpad || isIphone || isIpod;
        },

        isCanvasSupported: function() {
            var elem = document.createElement('canvas');
            return !!(elem.getContext && elem.getContext('2d'));
        },

        /**
         * Узнать версию Flash-плеера
         */
        flashVersion: function() {
            var d, n = navigator, m, f = 'Shockwave Flash';
            if((m = n.mimeTypes) && (m = m["application/x-shockwave-flash"]) && m.enabledPlugin && (n = n.plugins) && n[f]) {d = n[f].description}
            else if (window.ActiveXObject) { try { d = (new ActiveXObject((f+'.'+f).replace(/ /g,''))).GetVariable('$version');} catch (e) {}}
            var res = d ? d.replace(/\D+/,'').split(/\D+/) : [0,0];
            res = $.map(res, function(item) { return parseInt(item, 10);} );
            return res;
        },

        initSortFunction: function(a, b) {
            if(parseInt(a, 10) < parseInt(b, 10)) return -1;
            if(parseInt(a, 10) > parseInt(b, 10)) return 1;
            return 0;
        },

        /**
         * CSS для поворота элемента
         * @param degrees
         * @param additional
         * @returns {*}
         */
        getRotateCss: function(degrees, additional) {
            var rotation = {
                "transform": "rotate(" + degrees + "deg)",
                "-o-transform": "rotate(" + degrees + "deg)",
                "-moz-transform": "rotate(" + degrees + "deg)",
                "-webkit-transform": "rotate(" + degrees + "deg)"
            };
            return $.extend(rotation, additional, {});
        },

        /**
         * Реализация PHP функции htmlspecialchars
         */
        htmlspecialchars: function(unsafe) {
            if (!unsafe || !unsafe.length) return '';
            return unsafe
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#039;");
        },

        htmlspecialchars_decode: function(safe) {
            if (!safe || !safe.length) return '';
            return safe
                .replace(/&amp;/g, "&")
                .replace(/&lt;/g, "<")
                .replace(/&gt;/g, ">")
                .replace(/&quot;/g, "\"")
                .replace(/&#039;/g, "'");
        },

        /**
         * Показ сообщений об ошибках
         */
        topMessage: function(message, options) {
            var defaults = {
                cssClass:  '',
                autoClose: false
            };
            options = $.extend(defaults, options);

            var $body = $('body');
            var width = $body.outerWidth();

            var css = {
                position:     'fixed',
                top:          '0px',
                left:         parseInt((width - 600) / 2, 10) + 'px',
                width:        '600px',
                textAlign:    'center',
                paddingRight: '20px'
            };

            var cssClose = {
                position:   'absolute',
                marginLeft: '600px'
            };

            var $closeLink = $('<a></a>').css(cssClose).addClass('top-floating-message-close');
            var $container = $('<div></div>').addClass('top-floating-message').css(css);
            $container.html(message);
            $container.prepend($closeLink);
            $body.append($container);


            $closeLink.one("click", function() {
                $container.fadeOut('slow', function () {
                    $container.remove();
                });
                return false;
            });

            if (options.autoClose) {
                var duration = parseInt(options.autoClose, 10);
                if (!isNaN(duration) && (duration > 0)) {
                    setTimeout(function() {
                        $closeLink.click();
                    }, duration);
                }
            }

            if (options.cssClass.length) {
                $container.addClass(options.cssClass);
            }
        },

        /**
         * Вырезание тегов из текста
         */
        stripTags: function(input, allowed) {
            if ((!input) || (input == "")) return "";

            allowed = (((allowed || "") + "").toLowerCase().match(/<[a-z][a-z0-9]*>/g) || []).join('');
            var tags = /<\/?([a-z][a-z0-9]*)\b[^>]*>/gi,
                commentsAndPhpTags = /<!--[\s\S]*?-->|<\?(?:php)?[\s\S]*?\?>/gi;
            return input.replace(commentsAndPhpTags, '').replace(tags, function ($0, $1) {
                return allowed.indexOf('<' + $1.toLowerCase() + '>') > -1 ? $0 : '';
            });
        }
    });

    /**
     * Сделать блок прилипающим при прокрутке
     */
    $.fn.autoFixPosition = function(options) {

        var defaults = {
            reversed: false,
            topPadding: 0
        };
        var o = $.extend(defaults, options, {});

        $(this).each(function() {
            var $this = $(this);

            var myTop = $this.offset().top - $this.topMargin();
            var baseHeight = $("body").height();
            var myHeight = $this.outerHeight();

            var fixedCss = {position: "fixed", top: o.topPadding, width: $this.outerWidth(), left: $this.offset().left};
            if (o.reversed) {
                fixedCss.top = undefined;
                fixedCss.bottom = 0;
            }
            var normalCss = {position: $this.css("position") || "inherit", top: "", width: "", left: ""};

            $(window).on("scroll", function() {
                var visibleTop    = window.cache.dScrollTop;
                var visibleHeight = window.cache.wHeight;
                var totalHeight   = $("body").height();

                if (o.reversed) {
                    if ((visibleTop + visibleHeight - myHeight) < (myTop - baseHeight + totalHeight)) {
                        $this.addClass("fixed").css(fixedCss);
                        if (o.onFix) { o.onFix(); }
                    } else {
                        $this.removeClass("fixed").css(normalCss);
                        if (o.onRelease) { o.onRelease(); }
                    }
                } else {
                    if (visibleTop + o.topPadding > myTop) {
                        $this.addClass("fixed").css(fixedCss);
                        if (o.onFix) { o.onFix(); }
                    } else {
                        $this.removeClass("fixed").css(normalCss);
                        if (o.onRelease) { o.onRelease(); }
                    }
                }
            }).trigger("scroll");
        });

        return $(this);
    };

    $.fn.styleSwitch = function(options) {
        var defaults = {
            callback: false
        };
        var o = $.extend(defaults, options, {});
        $(this).each(function(){

            var $switch = $(this);

            var nameInput = $switch.find('input').first().attr('name');

            var $valuesSpan = $switch.find('span');
            $valuesSpan.each(function(){
                $(this).data('value', $(this).find('input').attr('value'));
            });

            $switch.find('input').remove();

            var $input = $('<input type="hidden"/>').attr('name', nameInput).val('');
            $switch.append($input);

            $switch.on('click', 'span:not(.checked)', function(){
                $valuesSpan.removeClass('checked');
                $input.val($(this).data('value'));
                $(this).addClass('checked');

                if (o.callback) o.callback.apply($input);
            });

            $switch.on('reset.switch', function(){
                $valuesSpan.removeClass('checked');
                $input.val('');
                if (o.callback) o.callback.apply($input);
            });
        });
    };

    $.fn.dateTimePicker = function(options) {
        var defaults = {
            defaultValueDate: String._('TIMEPICKER_SET_DATE'),
            preventComma: false,
            disabled: false
        };
        function dateTimePicker(element, options) {
            this.options = $.extend({}, defaults, options);

            this.$this = $(element);
            this.$element = false;

            this.$timePicker = false;
            this.$textContainer = false;

            this.value = this.parseValue(this.$this.val());

            this.focused = false;
            this.timer = false;

            this.buildHtml();
            this.bindListeners();

            this.setTextValue();
        }

        //noinspection JSPotentiallyInvalidConstructorUsage
        dateTimePicker.prototype.parseValue = function(value){
            if (value === 'false' || value === false || value == '') {
                return {
                    date: false,
                    time: false
                }
            }

            var splitVal = value.split(' ');

            return {
                date: ((splitVal[0].indexOf(".00.") != -1) ? false : splitVal[0]),
                time: ((splitVal[1] == '00:00:00')         ? false : splitVal[1])
            }
        };

        //noinspection JSPotentiallyInvalidConstructorUsage
        dateTimePicker.prototype.isEmptyTime = function(time){
            return (time == '00:00' || time == '00:00:00' || !time || time == '');
        };

        //noinspection JSPotentiallyInvalidConstructorUsage
        dateTimePicker.prototype.buildHtml = function(){
            var $inputProto = $('<input/>');
            if (this.options.disabled) {
                $inputProto.attr('disabled', 'disabled');
            }

            this.$this.hide();

            this.$element = $inputProto.clone().css({width: 1, border: 0, background: 'transparent', color: 'transparent', outline: 'none'});
            this.$element.insertAfter(this.$this);

            this.$element.val(this.value.date);

            this.$textContainer = $('<span></span>');
            this.$textContainer.insertAfter(this.$element);

            this.$timePicker = $inputProto.clone().css({width: 1, border: 0, background: 'transparent', color: 'transparent', outline: 'none'});
            this.$timePicker.insertAfter(this.$textContainer);

            this.$timePicker.val(this.value.time);

            this.$inpList = $();
            this.$inpList.push( this.$timePicker.get(0) );
            this.$inpList.push( this.$element.get(0) );

            var self = this;
            if (!this.options.disabled) {
                this.$element.datepicker({
                    shortYearCutoff: '+30',
                    minDate: '-10y',
                    maxDate: '+10y',
                    dateFormat: "dd.mm.yy",
                    onSelect: function(date){
                        self.value.date = date;
                        self.setTextValue();
                    },
                    beforeShow: function($el, o) {
                        o.dpDiv.css('marginTop', 10);
                        if (options.css) {
                            setTimeout(function(){
                                o.dpDiv.css(options.css);
                            }, 0);
                        }
                    }
                });

                var defaultSettings = {
                    step: 30,
                    timeFormat: 'H:i'
                };
                var settings = $.extend({}, defaultSettings);
                if (this.options.timepicker) {
                    settings = $.extend(settings, this.options.timepicker);
                }
                this.$timePicker.timepicker(settings);
            }
        };

        //noinspection JSPotentiallyInvalidConstructorUsage
        dateTimePicker.prototype.bindListeners = function(){
            var self = this;
            this.$element.on('keyup', function(e){
                if ($.inArray(e.which, [37, 38, 39, 40]) > -1) {
                    self.$element.datepicker('show');
                }
            });

            this.$timePicker.on('change', function(){
                self.value.time = $(this).val();
                self.setTextValue();
            });

            this.$textContainer.on('click', '.ui-datetimepicker-date', function(){
                self.$element.focus();
            }).on('click', '.ui-datetimepicker-time', function(){
                Sibirix.Popup.hideAll();
                self.$timePicker.focus();
                return false;
            });

            this.$inpList.on('blur', function(){
                self.timer = setTimeout(function(){
                    self.unsetFocus();
                    self.setTextValue();
                    self.store();
                    self.timer = false;
                }, 300);

            }).on('focus', function(){
                self.setFocus();
                self.setTextValue();
                clearTimeout(self.timer);
                self.timer = false;

            }).on('keyup', function(e){
                if (e.which == 27) {
                    this.blur();
                    return false;
                }
                if (e.which == 46 || e.which == 8) {
                    self.value = {
                        date: false,
                        time: false
                    };
                    self.setTextValue();
                }
                return true;
            });
        };

        //noinspection JSPotentiallyInvalidConstructorUsage
        dateTimePicker.prototype.setFocus = function(){
            this.focused = true;
            this.$textContainer.toggleClass('focused', this.focused)
        };

        //noinspection JSPotentiallyInvalidConstructorUsage
        dateTimePicker.prototype.unsetFocus = function(){
            this.focused = false;
            this.$textContainer.toggleClass('focused', this.focused)
        };

        //noinspection JSPotentiallyInvalidConstructorUsage
        dateTimePicker.prototype.store = function() {
            var saveValue = false;
            if (!this.value.date) {
                saveValue = false;
            } else {
                if (this.value.time) {
                    if (this.value.time.length == 5) {
                        saveValue = this.value.date + ' ' + this.value.time + ':00';
                    } else {
                        saveValue = this.value.date + ' ' + this.value.time;
                    }
                } else {
                    saveValue = this.value.date + ' 00:00:00';
                }
            }

            if (this.$this.val() !== saveValue) {
                if (this.options.onStore) this.options.onStore(saveValue);
                this.$this.val(saveValue);
            }
        };

        //noinspection JSPotentiallyInvalidConstructorUsage
        dateTimePicker.prototype.setTextValue = function(){
            var v;
            var valueDate = this.value.date || '';
            var valueTime = this.value.time || '';

            if (!valueDate.length) {
                valueDate = this.options.defaultValueDate;
            }

            if (!valueTime.length) {
                if (!this.value.date) {
                    valueTime = String._('TIME').toLowerCase();
                } else {
                    if (this.focused) {
                        valueTime = '00:00';
                    } else {
                        valueTime = '';
                    }
                }
            } else {
                if (this.value.date) {
                    if (!this.focused && this.isEmptyTime(valueTime)) {
                        valueTime = '';
                    }
                } else {
                    if (!this.focused) {
                        valueTime = '';
                    }
                }
            }

            if ((valueTime !== '') && (!this.options.preventComma)) {
                valueDate += ',&nbsp;';
            }

            if (valueTime.length == 8 && valueTime.substr(5,1) == ':') {
                valueTime = valueTime.substr(0, 5);
            }

            v = '<span class="ui-datetimepicker-date">' + valueDate + '</span>';
            if (valueTime !== ''){
                v += '<span class="ui-datetimepicker-time">' + valueTime + '</span>';
            }
            this.$textContainer.html(v);
        };

        //noinspection JSPotentiallyInvalidConstructorUsage
        dateTimePicker.prototype.setValue = function(value) {
            this.value = this.parseValue(value);
            this.setTextValue();
            this.$element.datepicker('setDate', this.value.date);
        };

        return $(this).each(function(){
            var datePicker = $(this).data('dateTimePicker');
            if (!datePicker) {
                //noinspection JSPotentiallyInvalidConstructorUsage
                $(this).data('dateTimePicker', new dateTimePicker(this, options));
            }
        });
    };

    /**
     * Повернуть объект через CSS на определенный градус
     */
    $.fn.rotate = function(degrees) {
        $(this).css($.getRotateCss(degrees));
        return $(this);
    };

    /**
     * Мигание элемента
     */
    $.fn.blink = function(options) {
        var defaults = {
            from: 1,
            to:   0.5,
            time: 300,
            count: 3
        };
        var o = $.extend(defaults, options, {});
        var $this = $(this);

        $this.stop(true);
        for (var i = 0; i < o.count; i++) {
            $this.fadeTo(o.time, o.to).fadeTo(o.time, o.from);
        }

        return $(this);
    };

})(jQuery);

/**
 * Кэширование размеров окна и скроллов
 */
$(function() {
    var $win = $(window);
    var $doc = $(document);

    window.cache = {
        wWidth: $win.width(),
        wHeight: $win.height(),
        dScrollTop: $doc.scrollTop(),
        dScrollLeft: $doc.scrollLeft()
    };

    $win.on('resize', function() {
        window.cache.wWidth  = $win.width();
        window.cache.wHeight = $win.height();
    });
    $win.on('scroll', function() {
        window.cache.dScrollTop  = $doc.scrollTop();
        window.cache.dScrollLeft = $doc.scrollLeft();
    });
});

Date.fromPhp = function(phpDateString) {
    if ((phpDateString == "0000-00-00 00:00:00") || (phpDateString == "00.00.0000 00:00:00")) {
        return false;
    }

    var regexpList = [
        {
            regexp: /(\d{2,2})\.(\d{2,2})\.(\d{4,4}) (\d{2,2}):(\d{2,2}):(\d{2,2})/,
            year: 3, month: 2, day: 1, hour: 4, minut: 5, second: 6
        },
        {
            regexp: /(\d{4,4})-(\d{2,2})-(\d{2,2}) (\d{2,2}):(\d{2,2}):(\d{2,2})/,
            year: 1, month: 2, day: 3, hour: 4, minut: 5, second: 6
        },
        {
            regexp: /(\d{4,4})-(\d{2,2})-(\d{2,2})/,
            year: 1, month: 2, day: 3, hour: 0, minut: 0, second: 0
        },
        {
            regexp: /(\d{2,2}):(\d{2,2}):(\d{2,2})/,
            year: 0, month: 0, day: 0, hour: 1, minut: 2, second: 3
        }
    ];

    for (var indRegexp = 0; regexpList.length > indRegexp; indRegexp++) {
        var phpDateSplit, item = regexpList[indRegexp];
        if (phpDateSplit = item.regexp.exec(phpDateString)) {
            phpDateSplit[0] = "0";
            return new Date(
                phpDateSplit[item.year],
                phpDateSplit[item.month] - 1,
                phpDateSplit[item.day],
                phpDateSplit[item.hour],
                phpDateSplit[item.minut],
                phpDateSplit[item.second]);
        }
    }

    return false;
};

Date.prototype.toPhp = function() {
    var str = this.getFullYear() + '-' + ('0' + (this.getMonth() + 1)).slice(-2) + '-' + ('0' + this.getDate()).slice(-2);
    str += ' ' + ('0' + this.getHours()).slice(-2) + ':' + ('0' + this.getMinutes()).slice(-2) + ':' + ('0' + this.getSeconds()).slice(-2);
    return str;
};

Date.prototype.toDatepicker = function() {
    var str =  [('0' + this.getDate()).slice(-2), ('0' + (this.getMonth() + 1)).slice(-2), this.getFullYear()].join('.');
    str += ' ' + [('0' + this.getHours()).slice(-2), ('0' + this.getMinutes()).slice(-2), ('0' + this.getSeconds()).slice(-2)].join(':');
    return str;
};

/**
 * Из формата дейтпикера (dd.mm.yyyy HH:MM:SS) в формат php (yyyy-mm-dd HH:MM:SS)
 * @param dateString
 * @return {*}
 */
Date.fromDatepicker = function(dateString) {
    var parts = dateString.split(" ");

    if (parts.length && (parts.length > 1)) {
        if (parts[0] == 'false') return false;
        parts[0] = parts[0].split(".");
        parts[1] = parts[1].split(":");

        var date = new Date(
            (parts[0][2].length < 4) ? (((parts[0][2] < 30)? '20' : '19') + parts[0][2]) : parts[0][2],
            parts[0][1] - 1,
            parts[0][0],
            parts[1][0],
            parts[1][1],
            parts[1][2]
        );
        return (date != "Invalid Date") ? date : false;

    } else {
        return dateString;
    }
};

Date.toPlanFormat = function (totalMinutes, noDays) {
    totalMinutes = parseInt(totalMinutes, 10);
    if ((totalMinutes == 0) || (isNaN(totalMinutes))) return 0;

    var dwd = 8;
    if (window.project && window.project.durationWorkingDay) {
        dwd = window.project.durationWorkingDay;
    }
    if (window.jsonBoard && window.jsonBoard.durationWorkingDay) {
        dwd = window.jsonBoard.durationWorkingDay;
    }

    var minutes = totalMinutes % 60;
    var hours = Math.floor(totalMinutes / 60);
    var days = 0;

    if (!noDays) {
        days = Math.floor(hours / dwd);
        hours = hours % dwd;

        if (days > 10) {
            minutes = 0;
        }

        if (days > 40) {
            hours = 0;
        }
    }


    var parts = [];
    if (days != 0) parts.push(days + "d");
    if (hours != 0) parts.push(hours + "h");
    if (minutes != 0) parts.push(minutes + "m");

    return parts.join(" ");
};

Date.checkPlanFormat = function(estimate, optimizeFormat, strength){
    var key;
    var dwd = 8;
    if (window.project && window.project.durationWorkingDay) {
        dwd = window.project.durationWorkingDay;
    }
    if (window.jsonBoard && window.jsonBoard.durationWorkingDay) {
        dwd = window.jsonBoard.durationWorkingDay;
    }

    if (typeof optimizeFormat === 'undefined') {
        optimizeFormat = false;
    }

    strength = !!strength;

    var parts = {};
    var replaces = {'': 'm'};
    replaces[String._('DATE_REPLACE_M1')] = 'm';
    replaces[String._('DATE_REPLACE_M2')] = 'm';
    replaces[String._('DATE_REPLACE_M3')] = 'm';
    replaces[String._('DATE_REPLACE_H1')] = 'h';
    replaces[String._('DATE_REPLACE_H2')] = 'h';
    replaces[String._('DATE_REPLACE_H3')] = 'h';
    replaces[String._('DATE_REPLACE_D1')] = 'd';
    replaces[String._('DATE_REPLACE_D2')] = 'd';
    replaces[String._('DATE_REPLACE_D3')] = 'd';

    var allowed = {
        "d": true,
        "h": true,
        "m": true
    };
    var durations = {
        m: 1,
        h: 60,
        d: 60 * parseInt(dwd, 10)
    };

    var raw = estimate.toLowerCase().split(" ");

    var data, regExp = /(\d+)(.*)/i;
    for (var i = 0; i<raw.length; i++) {
        data = raw[i].match(regExp);
        if (!data || data.length < 2) {
            if (strength) return false;
            continue;
        }
        if (replaces[data[2]]) data[2] = replaces[data[2]];
        if (allowed[data[2]]) {
            parts[data[2]] = data[1].substr(0, 4);
        } else if (strength) {
            return false;
        }
    }

    var totalTime = [];
    for (key in allowed) {
        if (!allowed.hasOwnProperty(key)) continue;
        if (parts[key]) {
            totalTime.push(parts[key] + key);
        }
    }
    totalTime = totalTime.join(" ");

    if (optimizeFormat) {
        var minutes = 0;
        for (key in allowed) {
            if (!allowed.hasOwnProperty(key)) continue;
            if (parts[key]) {
                minutes += parts[key] * durations[key];
            }
        }
        return Date.toPlanFormat(minutes);
    }

    return totalTime;
};

Date.fromPlanFormat = function(estimate, durationDay) {
    if (!estimate || estimate == null || (typeof estimate === 'undefined') || estimate == 'null') return 0;
    durationDay = durationDay ? durationDay : 8;
    var parts = {};

    var replaces = {'': 'm'};
    replaces[String._('DATE_REPLACE_M1')] = 'm';
    replaces[String._('DATE_REPLACE_M2')] = 'm';
    replaces[String._('DATE_REPLACE_M3')] = 'm';
    replaces[String._('DATE_REPLACE_H1')] = 'h';
    replaces[String._('DATE_REPLACE_H2')] = 'h';
    replaces[String._('DATE_REPLACE_H3')] = 'h';
    replaces[String._('DATE_REPLACE_D1')] = 'd';
    replaces[String._('DATE_REPLACE_D2')] = 'd';
    replaces[String._('DATE_REPLACE_D3')] = 'd';

    var allowed = {
        "d": true,
        "h": true,
        "m": true
    };
    var durationOfMinutes = {
        "d": durationDay * 60,
        "h": 60,
        "m": 1
    };

    var raw = estimate.toLowerCase().split(" ");

    var data, regExp = /(\d{1,3})(.*)/i;
    for (var i = 0; i<raw.length; i++) {
        data = raw[i].match(regExp);
        if (!data) continue;
        if (!data || data.length < 2) continue;
        if (replaces[data[2]]) data[2] = replaces[data[2]];
        if (allowed[data[2]]) {
            parts[data[2]] = data[1];
        }
    }

    var totalTime = 0;
    for (var key in allowed) {
        if (!allowed.hasOwnProperty(key)) continue;
        if (parts[key]) {
            totalTime += durationOfMinutes[key] * parts[key];
        }
    }

    return totalTime;
};

Date.toSelectorFormat = function(dateTimeString) {
    var parts = dateTimeString.split(" ");
    return "<span>" + parts.join("</span><span>") + "</span>";
};

/**
 * returns timestamp as string in format hh:mm:ss
 * @param ts
 */
Date.timerFormat = function(ts) {
    var hours = Math.floor(ts / 3600),
        minutes = Math.floor((ts /60)) % 60,
        seconds = ts % 60;

    return (hours < 10 ? '0'+hours : hours)
        + ':' + (minutes < 10 ? '0'+minutes : minutes)
        + ':' + (seconds < 10 ? '0'+seconds : seconds);
};

/**
 * склонение окончаний
 */
String.ruHelper = {
    declension: function (num, e) {
        var result, count;
        count = num % 100;
        if (count >= 5 && count <= 20) {
            result = e['2'];
        } else {
            count = count % 10;
            if (count == 1) {
                result = e['0'];
            } else if (count >= 2 && count <= 4) {
                result = e['1'];
            } else {
                result = e['2'];
            }
        }
        return result;
    }
};

String._ = function(messageId){
    if (window.SCRUMBAN && window.SCRUMBAN.translator && window.SCRUMBAN.translator[messageId]) {
        return window.SCRUMBAN.translator[messageId];
    }
    return messageId;
};

String.translator = function(messageId, replace) {
    if (!window.SCRUMBAN || !window.SCRUMBAN.translator || !window.SCRUMBAN.translator[messageId]) {
        return messageId;
    }
    var mess = window.SCRUMBAN.translator[messageId];

    if (typeof replace !== 'undefined') {
        for (var i in replace) {
            if (!replace.hasOwnProperty(i)) continue;
            mess = mess.replace(i, replace[i]);
        }
    }

    return mess;
};

String.prototype.nl2br = function() {
    var t = $('<div></div>').html(this.toString());
    var nl2brText = t.html().replace(/\n/g, '<br />');

    delete t;
    return nl2brText;
};

String.prototype.br2nl = function() {
    var t, nl2brText;
    try {
        t = $('<div></div>').html(this.toString());
        nl2brText = t.html().replace(/<br\s*>/g, '\n');
        delete t;
    } catch (e) {
        nl2brText = this.replace(/<br[^>]*>/g, '\n');
    }

    return nl2brText;
};

String.prototype.convertBbToHtml = function() {
    var sContent = $.htmlspecialchars(this.toString());

    // Table
    sContent = sContent.replace(/[\r\n\s\t]?\[table\][\r\n\s\t]*?\[tr\]/ig, '[TABLE][TR]');
    sContent = sContent.replace(/\[tr\][\r\n\s\t]*?\[td\]/ig, '[TR][TD]');
    sContent = sContent.replace(/\[tr\][\r\n\s\t]*?\[th\]/ig, '[TR][TH]');
    sContent = sContent.replace(/\[\/td\][\r\n\s\t]*?\[td\]/ig, '[/TD][TD]');
    sContent = sContent.replace(/\[\/tr\][\r\n\s\t]*?\[tr\]/ig, '[/TR][TR]');
    sContent = sContent.replace(/\[\/td\][\r\n\s\t]*?\[\/tr\]/ig, '[/TD][/TR]');
    sContent = sContent.replace(/\[\/th\][\r\n\s\t]*?\[\/tr\]/ig, '[/TH][/TR]');
    sContent = sContent.replace(/\[\/tr\][\r\n\s\t]*?\[\/table\][\r\n\s\t]?/ig, '[/TR][/TABLE]');

    // List
    sContent = sContent.replace(/[\r\n\s\t]*?\[\/list\]/ig, '[/LIST]');
    sContent = sContent.replace(/[\r\n\s\t]*?\[\*\]?/ig, '[*]');

    var
        arSimpleTags = [
            'b','u', 'i', ['s', 'del'], // B, U, I, S
            'table', 'tr', 'td', 'th'//, // Table
        ],
        bbTag, tag, i, l = arSimpleTags.length, re;

    for (i = 0; i < l; i++)
    {
        if (typeof arSimpleTags[i] == 'object')
        {
            bbTag = arSimpleTags[i][0];
            tag = arSimpleTags[i][1];
        }
        else
        {
            bbTag = tag = arSimpleTags[i];
        }

        sContent = sContent.replace(new RegExp('\\[(\\/?)' + bbTag + '\\]', 'ig'), "<$1" + tag + ">");
    }

    // Link
    sContent = sContent.replace(/\[url\]((?:\s|\S)*?)\[\/url\]/ig, "<a href=\"$1\">$1</a>");
    sContent = sContent.replace(/\[url=([^\]]+)]([^\]]+)\[\/url]/ig, "<a href=\"$1\">$2</a>");

    // Img
    var _this = this;
    sContent = sContent.replace(/\[img(?:\s*?width=(\d+)\s*?height=(\d+))?\]((?:\s|\S)*?)\[\/img\]/ig,
        function(str, w, h, src)
        {
            var strSize = "";
            w = parseInt(w);
            h = parseInt(h);

            if (w && h && _this.bBBParseImageSize)
                strSize = ' width="' + w + '" height="' + h + '"';

            return '<img  src="' + src + '"' + strSize + '/>';
        }
    );

    // Font color
    i = 0;
    while (sContent.toLowerCase().indexOf('[color=') != -1 && sContent.toLowerCase().indexOf('[/color]') != -1 && i++ < 20)
        sContent = sContent.replace(/\[color=((?:\s|\S)*?)\]((?:\s|\S)*?)\[\/color\]/ig, "<font color=\"$1\">$2</font>");

    // List
    i = 0;
    while (sContent.toLowerCase().indexOf('[list=') != -1 && sContent.toLowerCase().indexOf('[/list]') != -1 && i++ < 20)
        sContent = sContent.replace(/\[list=1\]((?:\s|\S)*?)\[\/list\]/ig, "<ol>$1</ol>");

    i = 0;
    while (sContent.toLowerCase().indexOf('[list') != -1 && sContent.toLowerCase().indexOf('[/list]') != -1 && i++ < 20)
        sContent = sContent.replace(/\[list\]((?:\s|\S)*?)\[\/list\]/ig, "<ul>$1</ul>");

    sContent = sContent.replace(/\[\*\]/ig, "<li>");

    // Font
    i = 0;
    while (sContent.toLowerCase().indexOf('[font=') != -1 && sContent.toLowerCase().indexOf('[/font]') != -1 && i++ < 20)
        sContent = sContent.replace(/\[font=((?:\s|\S)*?)\]((?:\s|\S)*?)\[\/font\]/ig, "<font face=\"$1\">$2</font>");

    // Font size
    i = 0;
    while (sContent.toLowerCase().indexOf('[size=') != -1 && sContent.toLowerCase().indexOf('[/size]') != -1 && i++ < 20)
        sContent = sContent.replace(/\[size=((?:\s|\S)*?)\]((?:\s|\S)*?)\[\/size\]/ig, "<font size=\"$1\">$2</font>");

    // Replace \n => <br/>
    sContent = sContent.replace(/\n/ig, "<br />");

    return sContent;
};

String.prototype.convertHtmlToBb = function() {

    var s = this.toString();

    function rep(re, str) {
        s = s.replace(re, str);
    }

    rep(/\n/mig, "");
    // example: <strong> to [b]
    rep(/<a.*?href=\"(.*?)\".*?>(.*?)<\/a>/mig,"[url=$1]$2[/url]");
    rep(/<font.*?color=\"(.*?)\".*?class=\"codeStyle\".*?>(.*?)<\/font>/mig,"[code][color=$1]$2[/color][/code]");
    rep(/<font.*?color=\"(.*?)\".*?class=\"quoteStyle\".*?>(.*?)<\/font>/mig,"[quote][color=$1]$2[/color][/quote]");
    rep(/<font.*?class=\"codeStyle\".*?color=\"(.*?)\".*?>(.*?)<\/font>/mig,"[code][color=$1]$2[/color][/code]");
    rep(/<font.*?class=\"quoteStyle\".*?color=\"(.*?)\".*?>(.*?)<\/font>/mig,"[quote][color=$1]$2[/color][/quote]");
    rep(/<span style=\"color: ?(.*?);\">(.*?)<\/span>/mig,"[color=$1]$2[/color]");
    rep(/<font.*?color=\"(.*?)\".*?>(.*?)<\/font>/mig,"[color=$1]$2[/color]");
    rep(/<span style=\"font-size:(.*?);\">(.*?)<\/span>/mig,"[size=$1]$2[/size]");
    rep(/<font>(.*?)<\/font>/mig,"$1");
    rep(/<img.*?src=\"(.*?)\".*?\/>/mig,"[img]$1[/img]");
    rep(/<img.*?src=(.*?).*?\/>/mig,"[img]$1[/img]");
    rep(/<span class=\"codeStyle\">(.*?)<\/span>/mig,"[code]$1[/code]");
    rep(/<span class=\"quoteStyle\">(.*?)<\/span>/mig,"[quote]$1[/quote]");
    rep(/<strong class=\"codeStyle\">(.*?)<\/strong>/mig,"[code][b]$1[/b][/code]");
    rep(/<strong class=\"quoteStyle\">(.*?)<\/strong>/mig,"[quote][b]$1[/b][/quote]");
    rep(/<em class=\"codeStyle\">(.*?)<\/em>/mig,"[code][i]$1[/i][/code]");
    rep(/<em class=\"quoteStyle\">(.*?)<\/em>/mig,"[quote][i]$1[/i][/quote]");
    rep(/<u class=\"codeStyle\">(.*?)<\/u>/mig,"[code][u]$1[/u][/code]");
    rep(/<u class=\"quoteStyle\">(.*?)<\/u>/mig,"[quote][u]$1[/u][/quote]");
    rep(/<\/(strong|b)>/mig,"[/b]");
    rep(/<(strong|b)>/mig,"[b]");
    rep(/<\/(em|i)>/mig,"[/i]");
    rep(/<(em|i)>/mig,"[i]");
    rep(/<\/(del|s)>/mig,"[/S]");
    rep(/<(del|s)>/mig,"[S]");
    rep(/<\/u>/mig,"[/u]");
    rep(/<span style=\"text-decoration: ?underline;\">(.*?)<\/span>/mig,"[u]$1[/u]");
    rep(/<u>/mig,"[u]");
    rep(/<blockquote[^>]*>/mig,"[quote]");
    rep(/<\/blockquote>/mig,"[/quote]");
    rep(/<br \/>/mig,"\n");
    rep(/<br\/>/mig,"\n");
    rep(/<br>/mig,"\n");
    rep(/<p>/mig,"");
    rep(/<\/p>/mig,"\n");

    rep(/&nbsp;|\u00a0/mig," ");
    rep(/&quot;/mig,"\"");
    rep(/&lt;/mig,"<");
    rep(/&gt;/mig,">");
    rep(/&amp;/mig,"&");

    rep(/<span(.*?)>(.*?)<\/span>/mig,"$2");
    rep(/<span(.*?)>/mig,"");
    rep(/<\/span(.*?)>/mig,"");

    rep(/<ul>/mig, "[LIST]");
    rep(/<\/ul>/mig, "[/LIST]");
    rep(/<ol>/mig, "[LIST=1]");
    rep(/<\/ol>/mig, "[/LIST]");
    rep(/<li>([\s\S]*?)<\/li>/mig, "[*]$1");

    rep(/<table([^>]*)>/mig, "[TABLE]");
    rep(/<\/table>/mig, "[/TABLE]");
    rep(/<tbody[^>]*>/mig, "");
    rep(/<\/tbody>/mig, "");
    rep(/<tr([^>]*)>/mig, "[TR]");
    rep(/<\/tr>/mig, "[/TR]");
    rep(/<td([^>]*)>/mig, "[TD]");
    rep(/<\/td>/mig, "[/TD]");

    return s;
};

String.random = function(length, chars) {
    var mask = '';
    if (chars.indexOf('a') > -1) mask += 'abcdefghijklmnopqrstuvwxyz';
    if (chars.indexOf('A') > -1) mask += 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    if (chars.indexOf('#') > -1) mask += '0123456789';
    if (chars.indexOf('!') > -1) mask += '~`!@#$%^&*()_+-={}[]:";\'<>?,./|\\';
    var result = '';
    for (var i = length; i > 0; --i) result += mask[Math.round(Math.random() * (mask.length - 1))];
    return result;
};

Array.prototype.clean = function(deleteValue) {
    for (var i = 0; i < this.length; i++) {
        if (this[i] == deleteValue) {
            this.splice(i, 1);
            i--;
        }
    }
    return this;
};

Array.prototype.unique = function() {
    if (!this.length) return [];

    var arr = this.sort();
    var ret = [arr[0]];

    for (var i = 1; i < arr.length; i++) { // start loop at 1 as element 0 can never be a duplicate
        if (arr[i-1] !== arr[i]) {
            ret.push(arr[i]);
        }
    }
    return ret;
};

/**
 * Покачивание блока при его DnD
 */
(function($) {
    $.fn.dragRotate = function(event) {
        var $this = $(this);

        var direction = parseInt($this.attr("data-direction"), 10);
        var prevX     = parseInt($this.attr("data-prev-x"), 10);

        if (typeof $this.attr("data-prev-x") === 'undefined') {
            $this.attr("data-prev-x", event.clientX);
            $this.attr("data-direction", 0);
            return $this;
        }

        if (prevX > event.clientX + 3) {
            direction = direction > -5 ? direction-1 : -5;
            $this.attr("data-prev-x", event.clientX);
        } else if (prevX < event.clientX - 3) {
            direction = direction < 5  ? direction+1 :  5;
            $this.attr("data-prev-x", event.clientX);
        }

        var myDirection = direction;
        myDirection = myDirection <=  5 ? myDirection :  5;
        myDirection = myDirection >= -5 ? myDirection : -5;

        $this.attr("data-direction", direction).rotate(myDirection);

        return $this;
    };

    /**
     * Выставить курсор на определенную позицию внутри текстарии/инпута
     */
    $.fn.setCursorPosition = function(pos) {
        if ($(this).get(0).setSelectionRange) {
            $(this).get(0).setSelectionRange(pos, pos);
        } else if ($(this).get(0).createTextRange) {
            var range = $(this).get(0).createTextRange();
            range.collapse(true);
            range.moveEnd('character', pos);
            range.moveStart('character', pos);
            range.select();
        }
    };

    /**
     * Получить позичию курсора внутри текстарии/инпута
     */
    $.fn.getCaret = function() {
        var $t = $(this);
        if (!($t.is("textarea, input"))) return false;
        var t = $t.get(0);

        if (t.selectionStart) {
            return t.selectionStart;
        } else if (document.selection) {
            t.focus();

            var r = document.selection.createRange();
            if (r == null) {
                return 0;
            }

            var re = t.createTextRange(),
                rc = re.duplicate();
            re.moveToBookmark(r.getBookmark());
            rc.setEndPoint('EndToStart', re);

            return rc.text.length;
        }

        return 0;
    };

    if ($.browser.msie) {
        $.fn.select = function() { return this; };
    }

    Array.prototype.indexOf = function(item) {
        return $.inArray(item, this);
    }
})(jQuery);

/**
 * Хелпер для EJS для выбора нужного значения в выпадающих списках
 */
(function($) {
    $.EJS.Helpers.prototype.selectDefaultResponsible = function (value, el) {
        return function (el) {
            if (parseInt(value, 10) > 0) {
                $(el).val(1);
            } else {
                $(el).val(value);
            }
            $(el).trigger("liszt:updated");
        }
    };
    $.EJS.Helpers.prototype.chosenSelect = function (value, el) {
        return function (el) {
            $(el).val(value);
            $(el).trigger("liszt:updated");
        }
    };
})(jQuery);

/**
 * Проверка на валидность email
 */
(function($) {
    $.validateEmail = function (email) {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    };
})(jQuery);

/**
 * throw on setTimeout / setInterval
 */
(function(window){
    var _setTimeout = window.setTimeout,
        _setInterval = window.setInterval;
    window.setTimeout = function(callback, timeout){
        var _ex;
        try {
            throw new Error('setTimeout');
        } catch (e) {
            _ex = e;
        }

        return _setTimeout(function(){
            try {
                if (typeof callback == 'string') {
                    _setTimeout(callback, 0);
                } else {
                    callback.apply(window, arguments);
                }
            } catch (ex) {
                window.onerror(null, null, null, ex, _ex);
            }
        }, timeout);
    };

    window.setInterval = function(callback, timeout){
        var _ex;
        try {
            throw new Error('setInterval');
        } catch (e) {
            _ex = e;
        }

        return _setInterval(function(){
            try {
                if (typeof callback == 'string') {
                    _setInterval(callback, 0);
                } else {
                    callback.apply(window, arguments);
                }
            } catch (ex) {
                window.onerror(null, null, null, ex, _ex);
            }
        }, timeout);
    };
})(window);

/**
 * Автоизменение ширины поля для ввода текста
 */
(function ($) {
    $.fn.autoGrowInput = function (o) {

        o = $.extend({
            maxWidth: 1000,
            minWidth: 0,
            comfortZone: 70,
            changeOnInit: false,
            callback: false
        }, o);

        this.filter('input:text').each(function () {

            var minWidth = o.minWidth || $(this).width(),
                val = '',
                input = $(this),
                testSubject = $('<tester/>').css({
                    position: 'absolute',
                    top: -9999,
                    left: -9999,
                    width: 'auto',
                    fontSize: input.css('fontSize'),
                    fontFamily: input.css('fontFamily'),
                    fontWeight: input.css('fontWeight'),
                    letterSpacing: input.css('letterSpacing'),
                    whiteSpace: 'nowrap'
                }),

                check = function () {
                    if (val === (val = input.val())) {
                        return;
                    }

                    // Enter new content into testSubject
                    var escaped = val.replace(/&/g, '&amp;').replace(/\s/g, ' ').replace(/</g, '&lt;').replace(/>/g, '&gt;');
                    testSubject.html(escaped);

                    // Calculate new width + whether to change
                    var testerWidth = testSubject.width(),
                        newWidth = (testerWidth + o.comfortZone) >= minWidth ? testerWidth + o.comfortZone : minWidth,
                        currentWidth = input.width(),
                        isValidWidthChange = (newWidth < currentWidth && newWidth >= minWidth)
                                          || (newWidth > minWidth     && newWidth < o.maxWidth);

                    // Animate width
                    if (isValidWidthChange) {
                        input.width(newWidth);
                        if (o.callback) o.callback(newWidth);
                    } else if (newWidth >= o.maxWidth) {
                        input.width(o.maxWidth);
                        if (o.callback) o.callback(o.maxWidth);
                    } else if (newWidth <= minWidth) {
                        input.width(minWidth);
                        if (o.callback) o.callback(minWidth);
                    }

                };

            testSubject.insertAfter(input);

            $(this).bind('keyup keydown blur update', check);

            if (o.changeOnInit) {
                check();
            }
        });

        return this;
    };
})(jQuery);


/************************
 jquery-timepicker
 http://jonthornton.github.com/jquery-timepicker/

 requires jQuery 1.6+
 ************************/


!(function ($) {
    var _baseDate = new Date();
    _baseDate.setHours(0);
    _baseDate.setMinutes(0);
    _baseDate.setSeconds(0);
    var _ONE_DAY = 86400;
    var _defaults = {
        className: null,
        minTime: null,
        maxTime: null,
        durationTime: null,
        step: 30,
        showDuration: false,
        timeFormat: 'g:ia',
        scrollDefaultNow: false,
        scrollDefaultTime: false,
        selectOnBlur: false,
        preventAutoChangeTime: false
    };
    var _lang = {
        decimal: '.',
        mins: 'mins',
        hr: 'hr',
        hrs: 'hrs'
    };
    var globalInit = false;

    var methods =
    {
        init: function (options) {
            return this.each(function () {
                var self = $(this);

                // convert dropdowns to text input
                if (self[0].tagName == 'SELECT') {
                    var input = $('<input />');
                    var attrs = { 'type': 'text', 'value': self.val() };
                    var raw_attrs = self[0].attributes;

                    for (var i = 0; i < raw_attrs.length; i++) {
                        attrs[raw_attrs[i].nodeName] = raw_attrs[i].nodeValue;
                    }

                    input.attr(attrs);
                    self.replaceWith(input);
                    self = input;
                }

                var settings = $.extend({}, _defaults);

                if (options) {
                    settings = $.extend(settings, options);
                }

                if (settings.minTime) {
                    settings.minTime = _time2int(settings.minTime);
                }

                if (settings.maxTime) {
                    settings.maxTime = _time2int(settings.maxTime);
                }

                if (settings.durationTime) {
                    settings.durationTime = _time2int(settings.durationTime);
                }

                if (settings.lang) {
                    _lang = $.extend(_lang, settings.lang);
                }

                self.data('timepicker-settings', settings);
                self.attr('autocomplete', 'off');
                self.click(methods.show).focus(methods.show).blur(_formatValue).keydown(_keyhandler);
                self.addClass('ui-timepicker-input');

                if (self.val()) {
                    var prettyTime = _int2time(_time2int(self.val()), settings.timeFormat);
                    self.val(prettyTime);
                }

                if (!globalInit) {
                    // close the dropdown when container loses focus
                    $('body').on('click', function (e) {
                        if ($(e.target).closest('.ui-timepicker-input').length == 0 && $(e.target).closest('.ui-timepicker-list').length == 0) {
                            methods.hide();
                        }
                    });
                    globalInit = true;
                }
            });
        },

        show: function (/* e */) {
            var self = $(this);
            var list = self.data('timepicker-list');

            // check if list needs to be rendered
            if (!list || list.length == 0) {
                _render(self);
                list = self.data('timepicker-list');
            }

            var settings = self.data('timepicker-settings');
            var selected = list.find('.ui-timepicker-selected');

            // check if a flag was set to close this picker
            if (self.hasClass('ui-timepicker-hideme')) {
                self.removeClass('ui-timepicker-hideme');
                list.hide();
                return;
            }

            if (list.is(':visible')) {
                return;
            }

            // make sure other pickers are hidden
            methods.hide();

            /*var topMargin = settings.topMargin || parseInt(self.css('marginTop').slice(0, -2), 10);
            if (!topMargin) topMargin = 0; // correct for IE returning "auto"*/

            var offsetParent = self.offsetParent();
            var marginLeft = settings.marginLeft || (self.offset().left - offsetParent.offset().left - offsetParent.leftPadding());
            var marginTop;

            if (settings.marginTop === undefined) {
                if ((self.offset().top + self.outerHeight(true) + list.outerHeight()) > $(window).height() + $(window).scrollTop()) {
                    marginTop = -list.outerHeight();
                } else {
                    marginTop = self.outerHeight();
                }
            } else {
                marginTop = settings.marginTop;
            }

            list.css({
                'margin-left': marginLeft,
                'margin-top':  marginTop
            });

            list.show();

            if (!selected.length) {
                if (self.val()) {
                    selected = _findRow(self, list, _time2int(self.val()));
                } else if (settings.minTime === null && settings.scrollDefaultNow) {
                    selected = _findRow(self, list, _time2int(new Date()));
                } else if (settings.scrollDefaultTime !== false) {
                    selected = _findRow(self, list, _time2int(settings.scrollDefaultTime));
                }
            }

            if (selected && selected.length) {
                var topOffset = list.scrollTop() + selected.position().top - selected.outerHeight();
                list.scrollTop(topOffset);
            } else {
                var top = (9 * 60 / parseInt(settings.step)) * 23;
                list.scrollTop(top);
            }

            self.trigger('showTimepicker');
        },

        hide: function (/* e */) {
            $('.ui-timepicker-list:visible').each(function () {
                var list = $(this);
                var self = list.data('timepicker-input');
                var settings = self.data('timepicker-settings');
                if (settings.selectOnBlur) {
                    _selectValue(self);
                }

                list.hide();
                self.trigger('hideTimepicker');
            });
        },

        option: function (key, value) {
            var self = $(this);
            var settings = self.data('timepicker-settings');
            var list = self.data('timepicker-list');

            if (typeof key == 'object') {
                settings = $.extend(settings, key);

            } else if (typeof key == 'string' && typeof value != 'undefined') {
                settings[key] = value;

            } else if (typeof key == 'string') {
                return settings[key];
            }

            if (settings.minTime) {
                settings.minTime = _time2int(settings.minTime);
            }

            if (settings.maxTime) {
                settings.maxTime = _time2int(settings.maxTime);
            }

            if (settings.durationTime) {
                settings.durationTime = _time2int(settings.durationTime);
            }

            self.data('timepicker-settings', settings);

            if (list) {
                list.remove();
                self.data('timepicker-list', false);
            }

            return true;
        },

        getSecondsFromMidnight: function () {
            return _time2int($(this).val());
        },

        getTime: function () {
            return new Date(_baseDate.valueOf() + (_time2int($(this).val()) * 1000));
        },

        setTime: function (value) {
            var self = $(this);
            var prettyTime = _int2time(_time2int(value), self.data('timepicker-settings').timeFormat);
            self.val(prettyTime);
        }

    };

    // private methods

    function _render(self) {
        var settings = self.data('timepicker-settings');
        var list = self.data('timepicker-list');

        if (list && list.length) {
            list.remove();
            self.data('timepicker-list', false);
        }

        list = $('<ul></ul>');
        list.attr('tabindex', -1);
        list.addClass('ui-timepicker-list');
        if (settings.className) {
            list.addClass(settings.className);
        }

        list.css({'display': 'none', 'position': 'absolute' });

        if (settings.minTime !== null && settings.showDuration) {
            list.addClass('ui-timepicker-with-duration');
        }

        var durStart = (settings.durationTime !== null) ? settings.durationTime : settings.minTime;
        var start = (settings.minTime !== null) ? settings.minTime : 0;
        var end = (settings.maxTime !== null) ? settings.maxTime : (start + _ONE_DAY - 1);

        if (end <= start) {
            // make sure the end time is greater than start time, otherwise there will be no list to show
            end += _ONE_DAY;
        }

        for (var i = start; i <= end; i += settings.step * 60) {
            var timeInt = i % _ONE_DAY;
            var row = $('<li></li>');
            row.data('time', timeInt);
            row.text(_int2time(timeInt, settings.timeFormat));

            if (settings.minTime !== null && settings.showDuration) {
                var duration = $('<span></span>');
                duration.addClass('ui-timepicker-duration');
                duration.text(' (' + _int2duration(i - durStart) + ')');
                row.append(duration)
            }

            list.append(row);
        }

        list.data('timepicker-input', self);
        self.data('timepicker-list', list);

        self.parent().prepend(list);

        if (!settings.preventAutoChangeTime) {
            _setSelected(self, list);
        }

        list.on('click', 'li', function (/* e */) {
            self.addClass('ui-timepicker-hideme');
            self[0].focus();

            // make sure only the clicked row is selected
            list.find('li').removeClass('ui-timepicker-selected');
            $(this).addClass('ui-timepicker-selected');

            _selectValue(self);
            list.hide();
        });

        list.on('mousewheel.timepicker', function(event) {
            event.stopPropagation();
            return true;
        });
    }

    function _findRow(self, list, value) {
        if (!value && value !== 0) {
            return false;
        }

        var settings = self.data('timepicker-settings');
        var out = false;

        // loop through the menu items
        list.find('li').each(function (i, obj) {
            var jObj = $(obj);

            // check if the value is less than half a step from each row
            if (Math.abs(jObj.data('time') - value) <= settings.step * 30) {
                out = jObj;
                return false;
            }
            return true;
        });

        return out;
    }

    function _setSelected(self, list) {
        var timeValue = _time2int(self.val());

        var selected = _findRow(self, list, timeValue);
        if (selected) selected.addClass('ui-timepicker-selected');
    }

    function _formatValue() {
        if (this.value == '') {
            return;
        }

        var self = $(this);
        var prettyTime = _int2time(_time2int(this.value), self.data('timepicker-settings').timeFormat);
        self.val(prettyTime);
    }

    function _keyhandler(e) {
        var self = $(this);
        var list = self.data('timepicker-list');
        var settings = self.data('timepicker-settings');
        var selected;

        if (!list || !list.is(':visible')) {
            if (e.keyCode == 40) {
                self.focus();
            } else {
                return true;
            }
        }

        switch (e.keyCode) {

            case 13: // return
                if (settings.preventAutoChangeTime) {
                    methods.hide.apply(this);
                    e.preventDefault();
                    return false;
                }
                _selectValue(self);
                methods.hide.apply(this);
                e.preventDefault();
                return false;
                break;

            case 38: // up
                selected = list.find('.ui-timepicker-selected');

                if (!selected.length) {
                    list.children().each(function (i, obj) {
                        if ($(obj).position().top > 0) {
                            selected = $(obj);
                            return false;
                        }
                        return true;
                    });
                    selected.addClass('ui-timepicker-selected');

                } else if (!selected.is(':first-child')) {
                    selected.removeClass('ui-timepicker-selected');
                    selected.prev().addClass('ui-timepicker-selected');

                    if (selected.prev().position().top < selected.outerHeight()) {
                        list.scrollTop(list.scrollTop() - selected.outerHeight());
                    }
                }

                break;

            case 40: // down
                selected = list.find('.ui-timepicker-selected');

                if (selected.length == 0) {
                    list.children().each(function (i, obj) {
                        if ($(obj).position().top > 0) {
                            selected = $(obj);
                            return false;
                        }
                        return true;
                    });

                    selected.addClass('ui-timepicker-selected');
                } else if (!selected.is(':last-child')) {
                    selected.removeClass('ui-timepicker-selected');
                    selected.next().addClass('ui-timepicker-selected');

                    if (selected.next().position().top + 2 * selected.outerHeight() > list.outerHeight()) {
                        list.scrollTop(list.scrollTop() + selected.outerHeight());
                    }
                }

                break;

            case 27: // escape
                list.find('li').removeClass('ui-timepicker-selected');
                list.hide();
                break;

            case 9: //tab
                methods.hide();
                break;

            case 16:
            case 17:
            case 18:
            case 19:
            case 20:
            case 33:
            case 34:
            case 35:
            case 36:
            case 37:
            case 39:
            case 45:
                return true;

            default:
                list.find('li').removeClass('ui-timepicker-selected');
                return true;
        }

        return true;
    }

    function _selectValue(self) {
        var settings = self.data('timepicker-settings');
        var list = self.data('timepicker-list');
        var timeValue = null;

        var cursor = list.find('.ui-timepicker-selected');

        if (cursor.length) {
            // selected value found
            timeValue = cursor.data('time');
        } else if (self.val()) {
            // no selected value; fall back on input value
            timeValue = _time2int(self.val());
            _setSelected(self, list);
        }


        if (timeValue !== null) {
            var timeString = _int2time(timeValue, settings.timeFormat);
            self.attr('value', timeString);
        }

        self.trigger('change').trigger('changeTime');
    }

    function _int2duration(seconds) {
        var minutes = Math.round(seconds / 60);
        var duration;

        if (minutes < 60) {
            duration = [minutes, _lang.mins];
        } else if (minutes == 60) {
            duration = ['1', _lang.hr];
        } else {
            var hours = (minutes / 60).toFixed(1);
            if (_lang.decimal != '.') hours = hours.replace('.', _lang.decimal);
            duration = [hours, _lang.hrs];
        }

        return duration.join(' ');
    }

    function _int2time(seconds, format) {
        var hour, time = new Date(_baseDate.valueOf() + (seconds * 1000));
        var output = '';

        for (var i = 0; i < format.length; i++) {

            var code = format.charAt(i);
            switch (code) {

                case 'a':
                    output += (time.getHours() > 11) ? 'pm' : 'am';
                    break;

                case 'A':
                    output += (time.getHours() > 11) ? 'PM' : 'AM';
                    break;

                case 'g':
                    hour = time.getHours() % 12;
                    output += (hour == 0) ? '12' : hour;
                    break;

                case 'G':
                    output += time.getHours();
                    break;

                case 'h':
                    hour = time.getHours() % 12;

                    if (hour != 0 && hour < 10) {
                        hour = '0' + hour;
                    }

                    output += (hour == 0) ? '12' : hour;
                    break;

                case 'H':
                    hour = time.getHours();
                    output += (hour > 9) ? hour : '0' + hour;
                    break;

                case 'i':
                    var minutes = time.getMinutes();
                    output += (minutes > 9) ? minutes : '0' + minutes;
                    break;

                case 's':
                    var sec = time.getSeconds();
                    output += (sec > 9) ? sec : '0' + sec;
                    break;

                default:
                    output += code;
            }
        }

        return output;
    }

    function _time2int(timeString) {
        if (timeString == '') return null;
        if (timeString + 0 == timeString) return timeString;

        if (typeof(timeString) == 'object') {
            timeString = timeString.getHours() + ':' + timeString.getMinutes();
        }

        var time = timeString.toLowerCase().match(/(\d+)(?::(\d\d))?\s*([pa]?)/);

        if (!time) {
            return null;
        }

        var hours, hour = parseInt(time[1], 10);

        if (time[3]) {
            if (hour == 12) {
                hours = (time[3] == 'p') ? 12 : 0;
            } else {
                hours = (hour + (time[3] == 'p' ? 12 : 0));
            }

        } else {
            hours = hour;
        }

        var minutes = (parseInt(time[2], 10) || 0);
        return hours * 3600 + minutes * 60;
    }

    // Plugin entry
    $.fn.timepicker = function (method) {
        if (methods[method]) {
            return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
        }
        else if (typeof method === "object" || !method) {
            return methods.init.apply(this, arguments);
        }
        else {
            $.error("Method " + method + " does not exist on jQuery.timepicker");
            return false;
        }
    };
})(jQuery);
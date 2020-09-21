"use strict";

const help = require('./helpers');

var WEEKDAYS_LONG = [help.t('DP_SUNDAY'), help.t('DP_MONDAY'), help.t('DP_TUESDAY'), help.t('DP_WEDNESDAY'), help.t('DP_THURSDAY'), help.t('DP_FRIDAY'), help.t('DP_SATURDAY')];

var WEEKDAYS_SHORT = [help.t('DP_SUN'), help.t('DP_MON'), help.t('DP_TUE'), help.t('DP_WED'), help.t('DP_THU'), help.t('DP_FRI'), help.t('DP_SAT')];

var MONTHS = [help.t('DP_JAN'), help.t('DP_FEB'), help.t('DP_MAR'), help.t('DP_APR'), help.t('DP_MAY'), help.t('DP_JUN'),
              help.t('DP_JUL'), help.t('DP_AUG'), help.t('DP_SEP'), help.t('DP_OCT'), help.t('DP_NOV'), help.t('DP_DEC')];

exports["default"] = {

    formatMonthTitle: function formatMonthTitle(d) {
        return MONTHS[d.getMonth()] + " " + d.getFullYear();
    },

    formatWeekdayShort: function formatWeekdayShort(i) {
        return WEEKDAYS_SHORT[i];
    },

    formatWeekdayLong: function formatWeekdayLong(i) {
        return WEEKDAYS_LONG[i];
    },

    getFirstDayOfWeek: function getFirstDayOfWeek() {
        return 1;
    },

    getMonths: function getMonths() {
        return MONTHS;
    }

};
module.exports = exports["default"];

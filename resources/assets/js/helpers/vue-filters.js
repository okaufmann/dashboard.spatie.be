import Vue from 'vue';
import { formatNumber, gridFromTo, modifyClass, relativeDate, relativeDateMinutes } from './helpers';

Vue.filter('relative-date', relativeDate);

Vue.filter('relative-date-minutes', relativeDateMinutes);

Vue.filter('format-number', formatNumber);

Vue.filter('grid-from-to', gridFromTo);

Vue.filter('modify-class', modifyClass);

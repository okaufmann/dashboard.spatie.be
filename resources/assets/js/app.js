import './helpers/vue-filters';
import CurrentTime from './components/current-time';
import Echo from 'laravel-echo';
import GithubFile from './components/github-file';
import GoogleCalendar from './components/google-calendar';
import InternetConnection from './components/internet-connection';
import LastFm from './components/last-fm';
import moment from 'moment';
import PackagistStatistics from './components/packagist-statistics';
import RainForecast from './components/rain-forecast';
import RlsNotifier from './components/rls-notifier';
import UptimeRobot from './components/uptime-robot';
import Qwertee from './components/qwertee';
import Vue from 'vue';

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: dashboard.pusherKey,
    cluster: dashboard.pusherCluster,
    encrypted: dashboard.pusherEncrypted
});

moment.locale('en', {
    calendar: {
        lastDay: '[Yesterday]',
        sameDay: '[Today]',
        nextDay: '[Tomorrow]',
        lastWeek: '[last] dddd',
        nextWeek: 'dddd',
        sameElse: 'L',
    },
});

new Vue({

    el: 'body',

    components: {
        CurrentTime,
        GithubFile,
        GoogleCalendar,
        InternetConnection,
        LastFm,
        PackagistStatistics,
        RainForecast,
        RlsNotifier,
        UptimeRobot,
        Qwertee
    },

});



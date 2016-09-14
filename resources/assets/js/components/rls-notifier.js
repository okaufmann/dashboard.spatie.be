import Echo from '../mixins/echo';
import Grid from './grid';
import SaveState from '../mixins/save-state';

export default {

    template: `
        <grid :position="grid" modifiers="padded overflow">
            <section class="rls-notifier-statistics">
                <h1>Package Downloads</h1>
                <ul>
                    <li class="rls-notifier">
                        <span class="rls-notifier__period">Today</span>
                        <span class="rls-notifier__count">{{ newToday | format-number }}</span>
                    </li>
                    <li class="rls-notifier">
                        <h2 class="rls-notifier__period">AVG per Day</h2>
                        <span class="rls-notifier__count">{{ perDayAvg | format-number }}</span>
                    </li>
                    <li class="rls-notifier">
                        <h2 class="rls-notifier__period">Releases</h2>
                        <span class="rls-notifier__count">{{ releases | format-number }}</span>
                    </li>
                    <li class="rls-notifier -total">
                        <h2 class="rls-notifier__period">Links</h2>
                        <span class="rls-notifier__count">{{ links | format-number }}</span>
                    </li>
                </ul>
            </section>
        </grid>
    `,

    components: {
        Grid,
    },

    mixins: [Echo, SaveState],

    props: ['grid'],

    data() {
        return {
            newToday: 0,
            links: 0,
            releases: 0,
            perDayAvg: 0,
        };
    },

    methods: {
        getEventHandlers() {
            return {
                'RlsNotifier.StatisticsFetched': response => {
                    let statistics = response.statistics;
                    console.log(statistics);
                    this.newToday = statistics.new_today;
                    this.releases = statistics.total_releases;
                    this.links = statistics.total_links;
                    this.perDayAvg = statistics.avg_per_day;
                },
            };
        },

        getSavedStateId() {
            return 'rls-notifier';
        },
    },
};
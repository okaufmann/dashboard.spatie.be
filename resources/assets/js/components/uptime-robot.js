import Grid from './grid';
import moment from 'moment';
import _ from 'lodash';
import Echo from '../mixins/echo';
import SaveState from '../mixins/save-state';
import Doughnut from './doughnut';

export default {

    template: `
        <grid :position="grid" modifiers="overflow padded blue">
                <section class="uptime-robot">
                    <h1 class="title">Uptime Monitor</h1>

                    <div class="uptime-robot__content">
                        <p>Total: {{allTimeUptimeRatio}}%</p>
                        <div class="doughnut">
                            <doughnut
                                :labels="doughnutLabels"
                                :values="doughnutData" ></doughnut>
                            <div class="donut-inner"><h5>{{monitorsUp}}-{{monitorsDown}}</h5></div>
                        </div>
                        <ul class="uptime-robot__downMonitors">
                            <li v-for="monitor in monitorsDownData"  class="uptime-robot__downMonitor">
                                <h2 class="uptime-robot__downMonitor__title">{{ monitor.name }}</h2>
                                <div class="uptime-robot__downMonitor__since">{{ monitor.downSince | relative-date-minutes }} - {{monitor.allTimeUpTimeRatio}}%</div>
                            </li>
                        </ul>
                    </div>
                </section>
             </grid>
    `,

    components: {
        Grid, Doughnut
    },

    mixins: [Echo, SaveState],

    props: {
        dateformat: {
            type: String,
            default: 'DD-MM-YYYY',
        },
        timeformat: {
            type: String,
            default: 'HH:mm:ss',
        },
        grid: {
            type: String,
        },
    },

    computed: {
        doughnutLabels() {
            return ["Up", "Down"];
        },

        doughnutData() {
            return [this.monitorsUp, this.monitorsDown];
        },
    },

    data() {
        return {
            allTimeUptimeRatio: 0,
            monitorsUp: 0,
            monitorsDown: 0,
            monitorsDownData: [],
        };
    },

    created() {
    },

    methods: {
        getEventHandlers() {
            return {
                'UptimeRobot.MonitorsFetched': response => {
                    this.allTimeUptimeRatio = _.round(response.allTimeUptimeRatio, 3);
                    this.monitorsUp = response.monitorsUp;
                    this.monitorsDown = response.monitorsDown;
                    this.monitorsDownData = response.monitorsDownData;
                },
            };
        },

        getSavedStateId() {
            return 'uptime-robot';
        },
    },
};




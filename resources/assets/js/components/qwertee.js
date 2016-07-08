import Grid from './grid';
import _ from 'lodash';
import Pusher from '../mixins/pusher';
import SaveState from '../mixins/save-state';

export default {

    template: `
        <grid :position="grid" modifiers="overflow padded blue">
                <section class="uptime-robot">
                    <h1>Qwertee</h1>
                    <img :src="detailUrl" class="img-fullheight">
                    <img :src="mensUrl" class="img-fullheight">
                </section>
             </grid>
    `,

    components: {
        Grid
    },

    mixins: [Pusher, SaveState],

    props: {
        grid: {
            type: String,
        },
    },

    data() {
        return {
            detailUrl:null,
            mensUrl:null
        };
    },

    created() {
    },

    methods: {
        getEventHandlers() {
            return {
                'App\\Components\\Qwertee\\Events\\ShirtsFetched': response => {
                    this.detailUrl = response.detailUrl;
                    this.mensUrl = response.mensUrl;
                },
            };
        },

        getSavedStateId() {
            return 'qwertee';
        },
    },
};




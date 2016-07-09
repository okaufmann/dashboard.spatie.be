import Grid from './grid';
import _ from 'lodash';
import $ from 'jquery';
import Pusher from '../mixins/pusher';
import SaveState from '../mixins/save-state';
import * as slick from 'slick-carousel';

export default {

    template: `
        <grid :position="grid" modifiers="overflow padded blue">
                <section class="uptime-robot">
                    <h1 class="title">Qwertee</h1>
                    <div id="img-slider">
                        <div v-for="teeUrl in teesUrls"><img :src="teeUrl" class="img-fullheight"></div>
                    </div>
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
            teesUrls: null
        };
    },

    created() {
        var self = this;
        $(document).ready(function () {
            self.initializeSlick();
        });
    },

    methods: {
        getEventHandlers() {
            return {
                'App\\Components\\Qwertee\\Events\\ShirtsFetched': response => {
                    this.teesUrls = null;
                    this.$set('teesUrls', response.tees);
                    this.initializeSlick(true);
                },
            };
        },

        initializeSlick(reinit = false){
            if(reinit){
                $('#img-slider').slick('unslick');
            }

            $('#img-slider').slick({
                dots: false,
                infinite: true,
                autoplay: true,
                autoplaySpeed: 5000,
                arrows: false,
                mobileFirst: true
            });
        },

        getSavedStateId() {
            return 'qwertee';
        },
    },
};




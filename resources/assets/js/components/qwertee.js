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
            console.log('dom ready detected by qwertee. initialize slick now...');
            self.initializeSlick();
        });
    },

    methods: {
        getEventHandlers() {
            return {
                'App\\Components\\Qwertee\\Events\\ShirtsFetched': response => {
                    console.log('got new images: ', response);
                    this.destroySlick();
                    this.teesUrls = response.tees;

                    let self = this;
                    setTimeout(function(){
                        self.initializeSlick();
                    }, 1000);
                },
            };
        },

        destroySlick(){
            console.log('destroy slick');
            $('#img-slider').slick('unslick');
        },
        initializeSlick(){
            console.log('initialize slick');

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




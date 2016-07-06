import Chart from 'chart.js';
import '../helpers/global-chart-options';

export default {
    template: `
    <canvas class="doughnut"></canvas>

`,

    props: {
        labels: {},
        values: {},
        lineColor: {
            type: String,
        },
        backgroundColor: {
            type: String,
        },
    },

    watch: {
        values : function (value) {
            console.log("Changed to ", value);
            this.drawChart();
        }
    },

    methods: {
        drawChart(){
            let data = {
                labels: this.labels,

                datasets: [
                    {
                        data: this.values,
                        backgroundColor: [
                            "green",
                            "red"
                        ],

                    },
                ],
            };

            let options = {
                responsive: true,
                maintainAspectRatio: false,
                cutoutPercentage: 70
            };

            new Chart(
                this.$el.getContext('2d'), {
                    type: 'doughnut',
                    data,
                    options,
                }
            );
        }
    },

    ready() {
        this.drawChart();
    },
};
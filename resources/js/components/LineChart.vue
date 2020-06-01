<script>
import { Line } from "vue-chartjs";
import moment from "moment";

export default {
    extends: Line,
    name: "LineChart",
    props: ["data"],
    mounted() {
        // reformat in the way the lib wants
        let chartData = {
            labels: [],
            datasets: [
                {
                    label: "1Count",
                    backgroundColor: "#f87979",
                    data: [70, 100, 400, 180, 100, 300, 500]
                },
                {
                    label: "2Count",
                    backgroundColor: "#f83979",
                    data: [10, 30, 700, 180, 100, 300, 500]
                },
                {
                    label: "3Count",
                    backgroundColor: "#f39719",
                    data: [70, 100, 40, 180, 100, 300, 200]
                }
            ]
        };

        for (let i = 0; i < this.data.length; i++) {
            chartData.labels.push(moment(String(this.data[i].date)).format("LL"));
            //chartData.datasets[0].data.push(this.data[i].count);
        }

        this.renderChart(chartData, {
            responsive: true,
            maintainAspectRatio: false
        });
    }
};
</script>

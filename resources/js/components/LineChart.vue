<script>
import { Line } from "vue-chartjs";
import moment from "moment";

export default {
    extends: Line,
    name: "LineChart",
    props: ["data"],
    mounted() {
        // reformat in the way the lib wants
        let backgroundColor = [
            "#0074D9",
            "#FF4136",
            "#2ECC40",
            "#FF851B",
            "#7FDBFF",
            "#B10DC9",
            "#FFDC00",
            "#001f3f",
            "#39CCCC",
            "#01FF70",
            "#85144b",
            "#F012BE",
            "#3D9970",
            "#111111",
            "#AAAAAA"
        ];
        let chartData = {
            labels: [],
            datasets: []
        };

        for (let i = 0; i < this.data.length; i++) {
            chartData.labels.push(moment(String(this.data[i].date)).format("LL"));
            chartData.datasets.push({
                label: this.data[i].name,
                backgroundColor: backgroundColor[i],
                data: this.data[i].count
            });
        }

        this.renderChart(chartData, {
            responsive: true,
            maintainAspectRatio: false
        });
    }
};
</script>

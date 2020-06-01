<script>
import { Line } from "vue-chartjs";

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
                    label: "Load Count",
                    backgroundColor: "#f87979",
                    data: []
                }
            ]
        };

        for (let i = 0; i < this.data.length; i++) {
            chartData.labels.push(new Date(this.data[i].date).toDateString());
            chartData.datasets[0].data.push(this.data[i].count);
        }

        this.renderChart(chartData, {
            responsive: true,
            maintainAspectRatio: false
        });
    }
};
</script>

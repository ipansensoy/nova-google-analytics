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
            labels: ["One", "TWO", "THREE"],
            datasets: [
                {
                    label: "Data One",
                    backgroundColor: "#f87979",
                    data: [1, 2]
                },
                {
                    label: "Data two",
                    backgroundColor: "#f87979",
                    data: [3, 4]
                },
                {
                    label: "Data three",
                    backgroundColor: "#f87979",
                    data: [5, 6]
                }
            ]
        };

        // for (let i = 0; i < this.data.length; i++) {
        //     chartData.labels.push(moment(String(this.data[i].date)).format("LL"));
        //     chartData.datasets[0].data.push(this.data[i].count);
        // }

        this.renderChart(chartData, {
            responsive: true,
            maintainAspectRatio: false
        });
    }
};
</script>

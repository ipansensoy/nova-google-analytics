<template>
    <card class="px-4 py-4 media-type-chart-panel">
        <apexchart v-if="loaded" height="350" type="bar" :options="chartOptions" :series="chartSeries"></apexchart>
    </card>
</template>

<script>
export default {
    name: "App",
    props: ["card"],
    data() {
        return {
            loaded: false,
            chartOptions: null,
            chartSeries: null
        };
    },
    async created() {
        let resp = await fetch("/nova-vendor/nova-google-analytics/media-type-loaded");
        let data = await resp.json();
        this.chartOptions = {
            chart: {
                type: "bar",
                height: 350,
                stacked: true,
                toolbar: {
                    show: true
                }
            },
            title: {
                text: "Media type loaded on site this month"
            },

            plotOptions: {
                bar: {
                    horizontal: false
                }
            },
            xaxis: {
                categories: []
            },
            legend: {
                position: "right",
                offsetY: 40
            },
            fill: {
                opacity: 1
            }
        };
        this.chartSeries = [
            {
                name: "banner",
                data: []
            },
            {
                name: "video",
                data: []
            }
        ];
        this.loaded = true;
    }
};
</script>

<style scoped>
.media-type-chart-panel {
    height: 400px;
}
</style>

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
        for (let i = 0; i < data.length; i++) {
            this.chartOptions.labels.push(data[i].hostname);
            this.chartSeries[0].data.push(parseInt(data[i].banner_count));
            this.chartSeries[1].data.push(parseInt(data[i].video_count));
        }
        this.loaded = true;
    }
};
</script>

<style scoped>
.media-type-chart-panel {
    height: 400px;
}
</style>

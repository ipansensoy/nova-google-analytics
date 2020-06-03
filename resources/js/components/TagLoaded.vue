<template>
    <card class="px-4 py-4 pie-char-panel">
        <h2>Tag load count this week</h2>
        <br />
        <apexchart v-if="loaded" width="500" type="bar" :options="chartOptions" :series="chartSeries"></apexchart>
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
        let resp = await fetch("/nova-vendor/nova-google-analytics/tag-loaded");
        let data = await resp.json();

        let results = {};
        for (var i = 0; i < data.length; i++) {
            result[data[i].hostname] = parseInt(data[i].count);
        }
        this.chartOptions = {
            plotOptions: {
                bar: {
                    horizontal: true
                }
            },
            dataLabels: {
                enabled: false
            },
            xaxis: {
                categories: []
            },
            labels: []
        };
        this.catSeries = [];
        for (let result in results) {
            this.chartOptions.labels.push(result);
            this.chartOptions.xaxis.categories.push(results[0]);
            this.chartSeries.push(results[result]);
        }
        this.loaded = true;
    }
};
</script>

<style scoped>
.pie-char-panel {
    height: 350px;
}
</style>

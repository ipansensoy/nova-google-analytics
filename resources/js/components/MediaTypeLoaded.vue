<template>
    <card class="px-4 py-4 bar-char-panel">
        <apexchart v-if="loaded" height="350" type="line" :options="chartOptions" :series="chartSeries"></apexchart>
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
        let resp = await fetch("/nova-vendor/nova-google-analytics/mediatype-loaded");
        let data = await resp.json();
        // let results = {};
        // for (var i = 0; i < data.length; i++) {
        //     results[data[i].hostname] = parseInt(data[i].count);
        // }
        this.chartOptions = {
            chart: {
                height: 450,
                type: "line"
            },
            stroke: {
                width: [0, 4]
            },
            title: {
                text: "Tag and Experience Load this month"
            },
            dataLabels: {
                enabled: true,
                enabledOnSeries: [1]
            },
            xaxis: {
                type: "hostname"
            },
            yaxis: [
                {
                    title: {
                        text: "Tag Load Count"
                    }
                },
                {
                    opposite: true,
                    title: {
                        text: "Experience Load Count"
                    }
                }
            ],
            labels: []
        };
        this.chartSeries = [
            {
                name: "Tag Load Count",
                type: "column",
                data: []
            },
            {
                name: "Experience Load Count",
                type: "line",
                data: []
            }
        ];
        for (let i = 0; i < data.length; i++) {
            this.chartOptions.labels.push(data[i].hostname);
            this.chartSeries[0].data.push(parseInt(data[i].tcount));
            this.chartSeries[1].data.push(parseInt(data[i].ecount));
        }
        this.loaded = true;
    }
};
</script>

<style scoped>
.bar-char-panel {
    height: 400px;
}
</style>

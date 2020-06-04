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
        let resp = await fetch("/nova-vendor/nova-google-analytics/prebid-request");
        let data = await resp.json();
        this.chartOptions = {
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: "55%",
                    endingShape: "rounded"
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ["transparent"]
            },
            xaxis: {
                categories: []
            },
            yaxis: {},
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val;
                    }
                }
            }
        };
        this.chartSeries = [
            {
                name: "rubicon",
                data: []
            },
            {
                name: "appnnexus",
                data: []
            },
            {
                name: "pubmatic",
                data: []
            }
        ];
        for (let i = 0; i < data.length; i++) {
            this.chartOptions.xaxis.categories.push(data[i].hostname);
            switch (data[i].label) {
                case "pubmatic":
                    this.chartSeries[2].data.push(parseInt(data[i].total));
                    break;
                case "appnnexus":
                    this.chartSeries[1].data.push(parseInt(data[i].total));
                    break;
                case "rubicon":
                    this.chartSeries[0].data.push(parseInt(data[i].total));
                    break;
            }
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

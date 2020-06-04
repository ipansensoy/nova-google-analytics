<template>
    <card class="px-4 py-4 media-type-chart-panel">
        <apexchart v-if="loaded" height="350" type="bar" :options="chartOptions" :series="chartSeries"></apexchart>
    </card>
</template>

<script>
import { chain, groupBy, map, value } from "lodash";

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
            title: {
                text: "Bidder request count this week"
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
        const resolveGroupings = chain(data)
            .groupBy("hostname")
            .map((value, key) => ({ hostname: key, data: value }))
            .value();
        const results = [];
        const restructured = groupedByHostname => {
            let builder = {};
            builder.hostname = groupedByHostname.hostname;
            groupedByHostname.data.forEach(data => {
                builder[data.label] = data["total"];
            });
            return builder;
        };

        resolveGroupings.forEach(groupedByHostname => {
            results.push(restructured(groupedByHostname));
        });
        for (let i = 0; i < results.length; i++) {
            this.chartOptions.xaxis.categories.push(results[i].hostname);
            this.chartSeries[1].data.push(parseInt(results[i].appnexus));
            this.chartSeries[0].data.push(parseInt(results[i].rubicon));
            this.chartSeries[2].data.push(parseInt(results[i].pubmatic));
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

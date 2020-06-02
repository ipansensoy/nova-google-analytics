<template>
    <card class="px-4 py-4 pie-char-panel">
        <h2>Views by Category</h2>
        <apexchart v-if="loaded" width="400" type="pie" :options="catOptions" :series="catSeries"></apexchart>
    </card>
</template>

<script>
export default {
    name: "App",
    props: ["card"],
    data() {
        return {
            loaded: false,
            catOptions: null,
            catSeries: null,
            visitorOptions: null,
            visitorSeries: null
        };
    },
    async created() {
        let resp = await fetch("/nova-vendor/nova-google-analytics/tag-loaded");
        let data = await resp.json();
        let countByHost = data.map(item => {
            let obj = {};
            obj[item.hostname] = parseInt(item.count);
            return obj;
        });
        console.log(countByHost);
        this.catOptions = {
            labels: []
        };

        this.catSeries = [];

        for (let i = 0; i < countByHost.length; i++) {
            console.log(countByHost[i]);
            this.catOptions.labels.push(countByHost[i]["hostname"]);
            this.catSeries.push(countByHost[i]["count"]);
        }
        this.loaded = true;
    }
};
</script>

<style scoped>
.pie-char-panel {
    height: 400px;
}
</style>

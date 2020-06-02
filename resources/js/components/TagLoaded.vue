<template>
    <card class="px-4 py-4 pie-char-panel">
        <h2>Tag load count this week</h2>
        <br />
        <apexchart v-if="loaded" width="500" type="pie" :options="catOptions" :series="catSeries"></apexchart>
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

        let result = {};
        for (var i = 0; i < data.length; i++) {
            result[data[i].hostname] = parseInt(data[i].count);
        }
        this.catOptions = {
            labels: []
        };

        this.catSeries = [];
        for (let cat in result) {
            console.log(cat);
            this.catOptions.labels.push(cat);
            this.catSeries.push(result[cat]);
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

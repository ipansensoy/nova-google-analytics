<template>
    <card class="px-4 py-4 pie-char-panel">
        <h3 class="mr-3 text-base text-80 font-bold">Tag Load Count</h3>
        <PieChart v-if="loaded" :data="loadCount" :styles="styles" />
    </card>
</template>

<script>
import PieChart from "./PieChart";
export default {
    name: "App",
    props: ["card"],
    components: {
        PieChart
    },
    data() {
        return {
            loaded: false,
            loadCount: null,
            styles: {
                width: "450px",
                height: "400px",
                position: "relative"
            }
        };
    },
    async created() {
        let resp = await fetch("/nova-vendor/nova-google-analytics/tag-loaded");
        let data = await resp.json();
        this.loadCount = data;
        this.loaded = true;
    }
};
</script>

<style scoped>
.pie-char-panel {
    height: 400px;
}
</style>

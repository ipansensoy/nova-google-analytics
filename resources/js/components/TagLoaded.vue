<template>
    <card class="px-4 py-4">
        <PieChart v-if="loaded" :data="loadCount" :styles="styles" />
        <div class="mb-4">
            <h3 class="mr-3 text-base text-80 font-bold">Tag Load Count</h3>
        </div>
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
.most-visited-pages-list {
    height: 4.6rem;
}
</style>

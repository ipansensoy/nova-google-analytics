<template>
    <div class="small">
        <line-chart :chart-data="datacollection"></line-chart>
    </div>
</template>

<script>
import LineChart from "./Chart.vue";

export default {
    props: ["card"],
    components: {
        LineChart
    },
    data: function() {
        return {
            pages: [],
            datacollection: null
        };
    },

    mounted() {
        Nova.request()
            .get("/nova-vendor/nova-google-analytics/tag-loaded")
            .then(response => {
                this.pages = response.data;
                this.datacollection = response.data;
            });
    }
};
</script>

<style scoped>
.most-visited-pages-list {
    height: 4.6rem;
}
.small {
    max-width: 600px;
    margin: 150px auto;
}
</style>

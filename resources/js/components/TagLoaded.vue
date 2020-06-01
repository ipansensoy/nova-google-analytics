<template>
    <card class="px-4 py-4">
        <div class="mb-4">
            <h3 class="mr-3 text-base text-80 font-bold">Tag Load Count</h3>
        </div>
        <div v-if="!pages" class="flex items-center">
            <p class="text-80 font-bold">No Data</p>
        </div>
        <div>
            <line-chart v-if="loaded" :chartdata="pages" :options="options" />
        </div>
        <ul v-else class="most-visited-pages-list mb-4 mt-2 overflow-y-scroll">
            <li v-for="page in pages">
                <a :href="`https://${page.hostname}${page.path}`" target="_blank">{{ page.name }}</a
                >: {{ page.count }}
            </li>
        </ul>
    </card>
</template>

<script>
import LineChart from "./Chart.vue";
export default {
    props: ["card"],
    components: { LineChart },
    data: function() {
        return {
            pages: [],
            loaded: false
        };
    },

    mounted() {
        this.loaded = false;
        Nova.request()
            .get("/nova-vendor/nova-google-analytics/tag-loaded")
            .then(response => {
                this.pages = response.data;
                this.loaded = true;
            });
    }
};
</script>

<style scoped>
.most-visited-pages-list {
    height: 4.6rem;
}
</style>

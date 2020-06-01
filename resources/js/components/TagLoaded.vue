<template>
    <card class="px-4 py-4">
        <div class="mb-4">
            <h3 class="mr-3 text-base text-80 font-bold">Tag Load Count</h3>
        </div>
        <div v-if="!pages" class="flex items-center">
            <p class="text-80 font-bold">No Data</p>
        </div>
        <div class="small">
            <line-chart :chart-data="datacollection"></line-chart>
            <button @click="fillData()">Randomize</button>
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
            });
        this.fillData();
    },
    methods: {
        fillData() {
            this.datacollection = {
                labels: [this.getRandomInt(), this.getRandomInt()],
                datasets: [
                    {
                        label: "Data One",
                        backgroundColor: "#f87979",
                        data: [this.getRandomInt(), this.getRandomInt()]
                    },
                    {
                        label: "Data One",
                        backgroundColor: "#f87979",
                        data: [this.getRandomInt(), this.getRandomInt()]
                    }
                ]
            };
        },
        getRandomInt() {
            return Math.floor(Math.random() * (50 - 5 + 1)) + 5;
        }
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

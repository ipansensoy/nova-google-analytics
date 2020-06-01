<template>
    <card class="px-4 py-4">
        <div class="mb-4">
            <h3 class="mr-3 text-base text-80 font-bold">Tag Load Count</h3>
        </div>
        <div v-if="!pages" class="flex items-center">
            <p class="text-80 font-bold">No Data</p>
        </div>
        <ul v-else class="most-visited-pages-list mb-4 mt-2 overflow-y-scroll">
            <li v-for="page in pages">
                <a :href="`https://${page.hostname}`" target="_blank">{{ page.hostname }}</a
                >: {{ page.count }}
            </li>
        </ul>
    </card>
</template>

<script>
export default {
    props: ["card"],

    data: function() {
        return {
            pages: []
        };
    },

    mounted() {
        Nova.request()
            .get("/nova-vendor/nova-google-analytics/tag-loaded")
            .then(response => {
                this.pages = response.data;
            });
    }
};
</script>

<style scoped>
.most-visited-pages-list {
    height: 4.6rem;
}
</style>

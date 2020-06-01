<script>
import { Line } from "vue-chartjs";
export default {
    extends: Line,
    props: ["chartdata", "options"],
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
                this.renderChart(this.pages, this.options);
            });
    }
};
</script>

<style scoped>
.most-visited-pages-list {
    height: 4.6rem;
}
</style>

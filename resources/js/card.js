import VueApexCharts from "vue-apexcharts";
Nova.booting((Vue, router) => {
    Vue.use(VueApexCharts);
    Vue.component("apexchart", VueApexCharts);
    Vue.component("most-visited-pages", require("./components/MostVisitedPages"));
    Vue.component("referrer-list", require("./components/ReferrerList"));
    Vue.component("tag-loaded", require("./components/TagLoaded"));
});

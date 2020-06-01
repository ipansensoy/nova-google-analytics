Nova.booting((Vue, router) => {
    Vue.component("most-visited-pages", require("./components/MostVisitedPages"));
    Vue.component("referrer-list", require("./components/ReferrerList"));
    Vue.component("tag-loaded", require("./components/TagLoaded"));
});

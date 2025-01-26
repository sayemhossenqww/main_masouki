try {
    window.LazyLoad = require("vanilla-lazyload");
    window.topbar = require("topbar");
} catch (e) {}
topbar.config({
    barThickness: 6,
    barColors: {
        0: "rgba(255, 0, 0)",
        ".25": "rgba(255, 0, 0)",
        ".50": "rgba(255, 0, 0)",
        ".75": "rgba(255, 0, 0)",
        "1.0": "rgba(255, 0, 0)",
    },
});
topbar.show();
document.addEventListener("DOMContentLoaded", function () {
    topbar.hide();

    var lazyLoadInstance = new LazyLoad({
        elements_selector: ".lazy",
    });
    var searchForm = document.querySelector(".search-form");
    if (searchForm) {
        searchForm.addEventListener("submit", function (event) {
            topbar.show();
        });
    }

    var linksList = [].slice.call(document.querySelectorAll(".bruvs-link"));
    linksList.map(function (link) {
        link.addEventListener("click", function (event) {
            topbar.show();
        });
    });
});

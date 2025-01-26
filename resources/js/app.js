require("./bootstrap");
import { createApp } from "vue";
import * as Sentry from "@sentry/vue";
import { BrowserTracing } from "@sentry/tracing";

import AdminLoginComponent from "./components/Admin/Auth/AdminLoginComponenet.vue";
import UpdatePasswordComponent from "./components/Admin/UpdatePasswordComponent.vue";
import CategoryComponent from "./components/Admin/CategoryComponent.vue";
import PaymentMethodComponent from "./components/Admin/PaymentMethodComponent.vue";
import ItemComponent from "./components/Admin/ItemComponent.vue";
import AreaComponent from "./components/Admin/AreaComponent.vue";
import CouponComponent from "./components/Admin/CouponComponent.vue";
import StoreStatusComponent from "./components/Admin/StoreStatusComponent.vue";
import NotificationComponent from "./components/Admin/NotificationComponent.vue";
import SettingsComponent from "./components/Admin/SettingsComponent.vue";
import BannerComponent from "./components/Admin/BannerComponent.vue";
import ComposeMessageComponent from "./components/Admin/ComposeMessageComponent.vue";
import HomeComponent from "./components/HomeComponent.vue";
import HomeComponentV2 from "./components/HomeComponentV2.vue";
import CartButtonComponent from "./components/CartButtonComponent.vue";
import CartBottomButtonComponent from "./components/CartBottomButtonComponent.vue";
import CartComponent from "./components/CartComponent.vue";
import BackToTopComponent from "./components/Shared/BackToTopComponent.vue";
import ContactFormComponent from "./components/ContactFormComponent.vue";
import SubmitOrderComponent from "./components/SubmitOrderComponent.vue";
import ItemCartComponent from "./components/ItemCartComponent.vue";
import PrimeVue from 'primevue/config';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Dropdown from 'primevue/dropdown';
import Toaster from "@meforma/vue-toaster";
import store from "./store/store";
import CKEditor from "@ckeditor/ckeditor5-vue";
import IconComponent from "./components/Shared/IconComponent.vue";
import MtIconComponent from "./components/Shared/MtIconComponent.vue";
import DiscountBadgeComponent from "./components/Shared/DiscountBadgeComponent.vue";
import PropertyBadgeComponent from "./components/Shared/PropertyBadgeComponent.vue";
import ServiceComponent from "./components/Admin/ServiceComponent.vue";




const app = createApp({
    components: {
        AdminLoginComponent,
        UpdatePasswordComponent,
        CategoryComponent,
        ItemComponent,
        StoreStatusComponent,
        PaymentMethodComponent,
        CouponComponent,
        NotificationComponent,
        AreaComponent,
        SettingsComponent,
        ComposeMessageComponent,
        BannerComponent,
        HomeComponent,
        HomeComponentV2,
        CartComponent,
        CartButtonComponent,
        ContactFormComponent,
        SubmitOrderComponent,
        ItemCartComponent,
        CartBottomButtonComponent,

        BackToTopComponent,
        IconComponent,
        MtIconComponent,
        PropertyBadgeComponent,
        DiscountBadgeComponent,
        ServiceComponent,

    },
});


// Sentry.init({
//     app,
//     dsn: "https://2ad4876c3a9547718cb231d23a45f839@o512093.ingest.sentry.io/6396071",
//     integrations: [
//       new BrowserTracing({
//         tracingOrigins: ["127.0.0.1:8000", "the-bruvs.com", /^\//],
//       }),
//     ],
//     // Set tracesSampleRate to 1.0 to capture 100%
//     // of transactions for performance monitoring.
//     // We recommend adjusting this value in production
//     tracesSampleRate: 1.0,
//   });
app.use(store);
app.use(CKEditor);
app.use(PrimeVue);
app.use(Toaster, {
    // One of the options
    position: "bottom",
    duration: 2000,
});
app.component('DataTable', DataTable);
app.component('Column', Column);
app.component('Dropdown', Dropdown);
app.component('Icon', IconComponent);
app.component('MtIcon', MtIconComponent);
app.component('DiscountBadge', DiscountBadgeComponent);
app.mount("#app");

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
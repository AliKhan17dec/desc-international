import "./bootstrap";

import { createApp, nextTick } from "vue";
import App from "./App.vue";
import router from "./router";

// Optional libraries you already use
import "flowbite";
import "datatables.net";
import "datatables.net-dt/css/dataTables.dataTables.css";
import $ from "jquery";

// Alpine (kept because it's in your dependencies)
import Alpine from "alpinejs";
import { collapse } from "@alpinejs/collapse";

window.Alpine = Alpine;
Alpine.plugin(collapse);
Alpine.start();

// ---- Vue mount ----
const app = createApp(App);
app.use(router);
app.mount("#app");

// ---- DataTables init (works for Vue pages too) ----
function initDataTables() {
    $("[id^='cryptoTable']").each(function () {
        if (!$.fn.dataTable.isDataTable(this)) {
            $(this).DataTable({
                paging: false,
                searching: false,
                info: false,
                ordering: true,
                columnDefs: [{ orderable: false, targets: [4] }],
            });
        }
    });

    $("[id^='cryptoDiscoverTable']").each(function () {
        if (!$.fn.dataTable.isDataTable(this)) {
            $(this).DataTable({
                paging: false,
                searching: false,
                info: false,
                ordering: true,
                columnDefs: [{ orderable: false, targets: [3] }],
            });
        }
    });
}

// Run after every route change (because Vue renders after navigation)
// router.afterEach(async () => {
//     await nextTick();
//     initDataTables();
// });

// Run once on first load
// document.addEventListener("DOMContentLoaded", async () => {
//     await nextTick();
//     initDataTables();
// });

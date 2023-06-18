import { createApp, ref } from "vue";
import App from "./App.vue";
import { createRouter, createWebHashHistory } from "vue-router";

import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap/dist/js/bootstrap.bundle.min.js";
import AdminMainVue from "./components/AdminMain.vue";
import HomePageVue from "./components/HomePage.vue";
import TransactionsPageVue from "./components/TransactionsPage.vue";
import ItemPageVue from "./components/ItemPage.vue";
import WarehousesPageVue from "./components/WarehousesPage.vue";

export const ctx = ref({
  apiKey: localStorage.getItem("apiKey") as string | null,
  tenant: null as any | null,
});

const app = createApp(App);

const router = createRouter({
  // 4. Provide the history implementation to use. We are using the hash history for simplicity here.
  history: createWebHashHistory(),
  routes: [
    { path: "/", component: HomePageVue },
    { path: "/admin", component: AdminMainVue },
    { path: "/transactions", component: TransactionsPageVue },
    { path: "/items", component: ItemPageVue },
    { path: "/warehouses", component: WarehousesPageVue },
  ], // short for `routes: routes`
});

app.use(router);

app.mount("#app");

import { createApp, markRaw } from "vue";
import router from "./router";
import { createPinia } from "pinia";
import "./style.css";
import App from "./App.vue";
import ajaxClient from './assets/js/axios-client'
// import overly from "./components/lib/overly.vue";
// import alertDanger from "./components/lib/alert-danger.vue";
const pinia = createPinia();
pinia.use(({ store }) => {
    store.router = markRaw(router)
    store.ajaxClient = markRaw(ajaxClient)
    })
const app = createApp(App);
app.use(pinia).use(router)
// .use(overly).use(alertDanger)

// app.config.globalProperties.$ajaxClient = ajaxClient
// app.provide('$ajaxClient', ajaxClient)
app.mount("#app");

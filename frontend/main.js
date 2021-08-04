import { createApp } from "vue";
import App from "@/App.vue";
import router from "@/router";
import store from "@/store";
import "@/assets/tailwind.css";
import mitt from "mitt";
import "@/assets/styles/main.css";

const eventBus = mitt();
const app = createApp(App);

app.config.globalProperties.eventBus = eventBus;

app.use(store).use(router).mount("#app");

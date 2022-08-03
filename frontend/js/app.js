import './bootstrap';
import { createApp } from "vue";
import App from "@/views/App.vue";
import router from "@/router/index.js";
import store from "@/store/index.js";
import "@/assets/tailwind.css";
import "@/assets/styles/main.css";

const app = createApp(App);
app.use(store).use(router).mount("#app");
import "./bootstrap";
import { createApp } from "vue";
import { createI18n } from "vue-i18n";
import App from "@/components/App.vue";
import router from "@/router/index.js";
import "@/assets/tailwind.css";
import messages from "@intlify/unplugin-vue-i18n/messages";

const i18n = createI18n({
  legacy: false,
  globalInjection: true,
  locale: "en",
  fallbackLocale: "en",
  availableLocales: ["en", "pl"],
  messages: messages,
});

const app = createApp(App);
app.use(router).use(i18n).mount("#app");

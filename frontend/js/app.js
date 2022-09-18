import "./bootstrap";
import "@/assets/tailwind.css";
import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/inertia-vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import InertiaLink from "@/js/Shared/InertiaLink.js";
import { InertiaProgress } from "@inertiajs/progress";
import { createI18n } from "vue-i18n";
import App from "@/js/Shared/Layout/App.vue";
import messages from "@intlify/unplugin-vue-i18n/messages";
import { ZiggyVue } from "ziggy-vue";
import Toast from "vue-toastification";
import {
  plugin as formkitPlugin,
  defaultConfig as formkitDefaultConfig,
} from "@formkit/vue";
import formkitConfig from "../formkit.config";

const i18n = createI18n({
  legacy: false,
  globalInjection: true,
  locale: "pl",
  fallbackLocale: "pl",
  availableLocales: ["en", "pl"],
  messages: messages,
});

createInertiaApp({
  resolve: (name) => {
    const page = resolvePageComponent(
      `./Pages/${name}.vue`,
      import.meta.glob("./Pages/**/*.vue")
    );

    page.then((module) => {
      module.default.layout = module.default.layout || App;
    });

    return page;
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .component("InertiaLink", InertiaLink)
      .use(plugin)
      .use(i18n)
      .use(ZiggyVue)
      .use(Toast, {
        position: "bottom-right",
        maxToast: 5,
        timeout: 3000,
        pauseOnFocusLoss: false,
      })
      .use(formkitPlugin, formkitDefaultConfig(formkitConfig))
      .mount(el);
  },
});

InertiaProgress.init({
  delay: 0,
  color: "white",
});

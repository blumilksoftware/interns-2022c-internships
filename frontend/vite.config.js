import { defineConfig, loadEnv } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";
import VueI18nPlugin from "@intlify/unplugin-vue-i18n/vite";
import path from "path";

export default ({ mode }) => {
  process.env = { ...process.env, ...loadEnv(mode, process.cwd()) };
  return defineConfig({
    build: {
      outDir: process.env.VITE_PUBLIC_DIRECTORY_PATH + "/build/",
    },
    server: {
      host: process.env.VITE_HOST,
      port: process.env.VITE_PORT,
      hmr: {
        host: process.env.VITE_HMR_HOST,
      },
      watch: {
        usePolling: process.env.VITE_USE_POLLING,
      },
    },
    resolve: {
      alias: {
        "@": "",
        ziggy: path.resolve(
          "../backend/vendor/tightenco/ziggy/dist/index.m.js"
        ),
        "ziggy-vue": path.resolve(
          "../backend/vendor/tightenco/ziggy/dist/vue.m.js"
        ),
      },
    },
    plugins: [
      laravel({
        input: ["./js/app.js"],
        refresh: ["./views/**/*", "./js/**/*", "./assets/**/*"],
        publicDirectory: process.env.VITE_PUBLIC_DIRECTORY_PATH,
      }),
      vue({
        template: {
          transformAssetUrls: {
            base: null,
            includeAbsolute: false,
          },
        },
      }),
      VueI18nPlugin({
        include: "./assets/lang/**",
      }),
    ],
  });
};

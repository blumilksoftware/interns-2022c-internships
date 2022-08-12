import { defineConfig, loadEnv } from 'vite'
import laravel from 'laravel-vite-plugin'
import vue from '@vitejs/plugin-vue'

export default ({ mode }) => {
    process.env = { ...process.env, ...loadEnv(mode, process.cwd() + "/..") }
    return defineConfig({
        envDir: "../",
        build: {
            outDir: '../public/build/'
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
                '@': '',
            },
        },
        plugins: [
            laravel({
                input: [
                    './js/app.js',
                ],
                refresh: [
                    './views/**'
                ],
                publicDirectory: '../public',
            }),
            vue({
                template: {
                    transformAssetUrls: {
                        base: null,
                        includeAbsolute: false,
                    },
                },
            }),
        ],
    })
}

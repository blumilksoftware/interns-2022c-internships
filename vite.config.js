import { defineConfig, loadEnv } from 'vite'
import laravel from 'laravel-vite-plugin'
import vue from '@vitejs/plugin-vue'

export default ({ mode }) => {
    process.env = { ...process.env, ...loadEnv(mode, process.cwd()) }
    return defineConfig({
        server: {
            host: process.env.VITE_HOST,
            port: process.env.VITE_PORT,
            hmr: {
                host: 'localhost',
            },
        },
        resolve: {
            alias: {
                '@': '/frontend',
            },
        },
        plugins: [
            laravel({
                input: [
                    'frontend/js/app.js',
                ],
                refresh: [
                    'frontend/views/*',
                    'frontend/components/*',
                ],
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

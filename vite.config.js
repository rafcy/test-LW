import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import { createSvgIconsPlugin } from 'vite-plugin-svg-icons';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/ts/app.ts'],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        createSvgIconsPlugin({
            /**
             * custom dom id
             * @default: __svg__icons__dom__
             */
            customDomId: '__svg__icons__dom__',

            // Specify the icon folder to be cached
            iconDirs: [path.resolve(process.cwd(), './resources/assets/icons')],

            // Specify symbolId format
            symbolId: 'icon-[dir]-[name]',
        }),
    ],
    resolve: {
        alias: {
            '@': path.resolve(__dirname, './resources/ts')
        },
    },
});


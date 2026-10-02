import { resolve } from 'node:path';

import { defineConfig } from 'vite';

const root = resolve(import.meta.dirname, 'src/web/assets/cp');

export default defineConfig({
    root,
    input: resolve(root, 'src/redactor-tweaks.css'),
    build: {
        outDir: resolve(root, 'dist'),
        emptyOutDir: true,
        assetsDir: '',
        cssMinify: 'esbuild',
        cssTarget: ['chrome61', 'safari10'],
        rolldownOptions: {
            output: {
                assetFileNames: '[name][extname]',
            },
        },
    },
});

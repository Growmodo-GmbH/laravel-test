import { defineConfig, loadEnv, Plugin } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import path from 'path';
import eslint from 'vite-plugin-eslint';
import StylelintPlugin from 'vite-plugin-stylelint';
import legacy from '@vitejs/plugin-legacy';
import { viteStaticCopy } from 'vite-plugin-static-copy';
import { createHtmlPlugin } from 'vite-plugin-html';
import manifestSRI from 'vite-plugin-manifest-sri';
import { viteCommonjs } from '@originjs/vite-plugin-commonjs';
import { esbuildCommonjs } from '@originjs/vite-plugin-commonjs';
import { ViteMinifyPlugin } from 'vite-plugin-minify';
import { dependencies } from './package.json';
import basicSsl from '@vitejs/plugin-basic-ssl';

const routes = () =>
  import('resources/js/router/routes.js');

const fs = require('node:fs');

function renderChunks(deps: Record<string, string>) {
  let chunks = {};
  Object.keys(deps).forEach((key) => {
    if (['vue', 'vue-router', 'vue-loader'].includes(key)) return;
    chunks[key] = [key];
  });
  return chunks;
}

export default ({ mode }) => {
  process.env = { ...process.env, ...loadEnv(mode, process.cwd()) };
  
  return defineConfig({
    optimizeDeps: {
      force: true,
      esbuildOptions: {
        plugins: [esbuildCommonjs()],
      },
    },
    build: {
      ssr: false,
      minify: 'esnext',
      reportCompressedSize: true,
      chunkSizeWarningLimit: 1600,
      manifest: true,
      sourcemap: process.env.VITE_APP_ENV == 'local' ? true : false,
      rollupOptions: {
        output: {
          manualChunks(id, { getModuleInfo }) {
            const match = /.*\.strings\.(\w+)\.js/.exec(id);
            if (match) {
              const language = match[1]; // e.g. "en"
              const dependentEntryPoints = [];

              // we use a Set here so we handle each module at most once. This
              // prevents infinite loops in case of circular dependencies
              const idsToHandle = new Set(getModuleInfo(id).dynamicImporters);

              for (const moduleId of idsToHandle) {
                const { isEntry, dynamicImporters, importers } =
                  getModuleInfo(moduleId);
                if (isEntry || dynamicImporters.length > 0)
                  dependentEntryPoints.push(moduleId);

                // The Set iterator is intelligent enough to iterate over elements that
                // are added during iteration
                for (const importerId of importers) idsToHandle.add(importerId);
              }

              // If there is a unique entry, we put it into a chunk based on the entry name
              if (dependentEntryPoints.length === 1) {
                return `${
                  dependentEntryPoints[0].split('/').slice(-1)[0].split('.')[0]
                }.strings.${language}`;
              }
              // For multiple entries, we put it into a "shared" chunk
              if (dependentEntryPoints.length > 1) {
                return `shared.strings.${language}`;
              }
            }
          },
          globals: {
            vue: 'Vue',
          },
        },
        external: ['Vue'],
      },
      modulePreload: {
        polyfill: true,
      },
      commonjsOptions: {
        include: [/node_modules/],
      },
    },
    plugins: [
      laravel({
        input: ['resources/css/app.css', 'resources/js/app.js'],
        refresh: true,
        // valetTls: process.env.VITE_SERVER_HOST,
      }),
      vue({
        template: {
          transformAssetUrls: {
            base: null,
            includeAbsolute: false,
          },
        },
      }),
      StylelintPlugin({
        fix: true,
        quite: false,
        lintOnStart: false,
      }),
      eslint({
        cache: true,
        fix: true,
        lintOnStart: false,
        emitWarning: true,
        emitError: true,
        failOnWarning: false,
        failOnError: true,
      }),
      viteStaticCopy({
        targets: [
          {
            src: 'resources/img/favicon/favicon.ico',
            dest: '../',
          }
        ],
      }),
      legacy({
        targets: ['defaults', 'not IE 11'],
        polyfills: true,
      }),
      manifestSRI(),
      createHtmlPlugin({
        minify: true,
        entry: 'resources/js/app.js',
      }),
      ViteMinifyPlugin({
        minifyCSS: true,
        removeComments: true,
      }),
      viteCommonjs(),
    ],
    sourcemap: true,
    server: {
      host: '0.0.0.0',
      hmr: {
          host: 'localhost'
      },
    },
    resolve: {
      alias: {
        '~': path.resolve(__dirname, 'node_modules'),
        '@': path.resolve(__dirname, 'resources/js'),
        '@css': path.resolve(__dirname, 'resources/css'),
        '@img': path.resolve(__dirname, 'resources/img'),
        '@views': path.resolve(__dirname, 'resources/js/views'),
        '@pages': path.resolve(__dirname, 'resources/js/views/pages'),
        '@store': path.resolve(__dirname, 'resources/js/store'),
        '@services': path.resolve(__dirname, 'resources/js/services'),
        '@router': path.resolve(__dirname, 'resources/js/router'),
        '@components': path.resolve(__dirname, 'resources/js/components'),
      },
    },
  });
};

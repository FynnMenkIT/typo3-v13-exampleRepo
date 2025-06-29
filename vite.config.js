import {defineConfig} from 'vite';
import { dirname, resolve } from 'node:path';
import { fileURLToPath } from 'node:url';
import autoprefixer from "autoprefixer";
import { ViteImageOptimizer } from 'vite-plugin-image-optimizer';
import autoOrigin from 'vite-plugin-auto-origin';

// TYPO3 root path (relative to this config file)
const VITE_TYPO3_ROOT = "./";

// Vite input files (relative to TYPO3 root path)
const VITE_ENTRYPOINTS = [
  "assets/app.js",
  "assets/Scss/rte.scss",
];

// Output path for generated assets
const VITE_OUTPUT_PATH = "packages/site-distribution/Resources/Public/Vite";

const ddevHostnames = process.env.DDEV_HOSTNAME?.split(',') || [];
const ddevCorsOrigins = new RegExp(
  `^https?:\\/\\/(${ddevHostnames.map(host => host.replace(/\./g, '\\.')).join('|')})(?::\\d+)?$`
);

const currentDir = dirname(fileURLToPath(import.meta.url));
const rootPath = resolve(currentDir, VITE_TYPO3_ROOT);
export default defineConfig(({command, mode}) => {
  return {
    mode: `${mode}`,
    server: {
      cors: { origin: ddevCorsOrigins },
      allowedHosts: ddevHostnames,
    },
    base: '',
    build: {
      minify: mode !== 'development',
      manifest: true,
      assetsInlineLimit: 100, // Do not inline SVG files, so it can be used by the SvgIconProvider
      rollupOptions: {
        input: VITE_ENTRYPOINTS.map(entry => resolve(rootPath, entry)),
        output: {
          manualChunks: (path) => path.split('/').reverse()[path.split('/').reverse().indexOf('node_modules') - 1]
        }
      },
      outDir: resolve(rootPath, VITE_OUTPUT_PATH),
    },
    publicDir: false,
    plugins: [
      ViteImageOptimizer(),
      autoOrigin(),
    ],
    css: {
      devSourcemap: true,
      postcss: {
        plugins: [
          autoprefixer({})
        ],
      },
      preprocessorOptions: {
        scss: {
          additionalData: `$mode: ${mode};`,
          api: 'modern-compiler',
        },
      },
    },
  }
});

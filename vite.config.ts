import Vue from '@vitejs/plugin-vue'
import Laravel from 'laravel-vite-plugin'
import VueI18n from 'laravel-vue-i18n/vite'
import AutoImport from 'unplugin-auto-import/vite'
import IconsResolver from 'unplugin-icons/resolver'
import Icons from 'unplugin-icons/vite'
import Components from 'unplugin-vue-components/vite'
import { defineConfig } from 'vite'
import SvgLoader from 'vite-svg-loader'

export default defineConfig({
  envPrefix: 'APP_',
  resolve: {
    alias: {},
  },
  build: {
    rollupOptions: {
      output: {
        manualChunks(id) {
          if (id.includes('node_modules')) {
            const modulePath = id.split('node_modules/')[1]
            const topLevelFolder = modulePath.split('/')[0]
            if (topLevelFolder !== '.pnpm') {
              return topLevelFolder
            }
            const scopedPackageName = modulePath.split('/')[1]
            const chunkName =
              scopedPackageName.split('@')[
                scopedPackageName.startsWith('@') ? 1 : 0
              ]
            return chunkName
          }
        },
      },
      onwarn(warning, warn) {
        if (warning.code === 'EMPTY_BUNDLE') return // Ignore empty bundle warnings
        warn(warning)
      },
    },
    chunkSizeWarningLimit: 500,
  },
  plugins: [
    Vue({
      template: {
        transformAssetUrls: {
          // The Vue plugin will re-write asset URLs, when referenced
          // in Single File Components, to point to the Laravel web
          // server. Setting this to `null` allows the Laravel plugin
          // to instead re-write asset URLs to point to the Vite
          // server instead.
          base: null,

          // The Vue plugin will parse absolute URLs and treat them
          // as absolute paths to files on disk. Setting this to
          // `false` will leave absolute URLs un-touched so they can
          // reference assets in the public directory as expected.
          includeAbsolute: false,
        },
      },
    }),
    Laravel({
      input: ['resources/css/app.css', 'resources/js/app.ts'],
      refresh: true,
    }),
    VueI18n(),
    SvgLoader({
      defaultImport: 'url', // or 'raw'
    }),
    Components({
      dts: true,
      extensions: ['vue', 'md'],
      include: [/\.vue$/, /\.vue\?vue/, /\.md$/],
      resolvers: [
        IconsResolver(),
        (name) => {
          if (name === 'Icon') {
            return { name: 'Icon', from: '@iconify/vue' }
          }
          if (name === 'Image') {
            return { name: 'Image', from: '@creopse/vue' }
          }
        },
      ],
      dirs: [
        'resources/js/components/sections',
        'resources/js/components/widgets',
      ],
    }),
    AutoImport({
      // targets to transform
      include: [
        /\.[tj]sx?$/, // .ts, .tsx, .js, .jsx
        /\.vue$/,
        /\.vue\?vue/, // .vue
        /\.md$/, // .md
      ],

      // global imports to register
      imports: [
        // presets
        'vue',
        'pinia',
        // custom
        {
          'laravel-vue-i18n': [
            'trans',
            'wTrans',
            'transChoice',
            'wTransChoice',
            'loadLanguageAsync',
            'getActiveLanguage',
            'isLoaded',
          ],
          '@inertiajs/vue3': ['useForm', 'usePage', 'router'],
          '@creopse/vue': [
            'useApi',
            'useNews',
            'useMenu',
            'useProps',
            'useVideo',
            'useConfig',
            'useHelper',
            'useContent',
            'useNewsletter',
          ],
        },
      ],

      // Auto import for module exports under directories
      // by default it only scan one level of modules under the directory
      dirs: ['./resources/js/stores/**', './resources/js/composables/**'],
      // Auto import inside Vue template
      // see https://github.com/unjs/unimport/pull/15 and https://github.com/unjs/unimport/pull/72
      vueTemplate: true,

      // Include auto-imported packages in Vite's `optimizeDeps` options
      // Recommend to enable
      viteOptimizeDeps: true,

      eslintrc: {
        enabled: true, // Default `false`
        filepath: './.eslintrc-auto-import.json', // Default `./.eslintrc-auto-import.json`
        globalsPropValue: true, // Default `true`, (true | false | 'readonly' | 'readable' | 'writable' | 'writeable')
      },
    }),
    Icons({ compiler: 'vue3', autoInstall: true }),
  ],
})

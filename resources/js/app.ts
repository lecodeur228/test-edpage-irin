import App from './App.vue'

import pinia from '@/stores'

import creopse from '@creopse/vue'

import { i18nVue } from 'laravel-vue-i18n'
import { router, createInertiaApp, Link } from '@inertiajs/vue3'

import { Icon } from 'vue3-icon-picker'
import 'vue3-icon-picker/dist/style.css'

import { LANG_KEY } from './constants'

createInertiaApp({
  title: (title) => title ? `${title} - ${import.meta.env.APP_NAME}` : import.meta.env.APP_NAME,
  resolve: (name) =>
  {
    const pages = import.meta.glob('./pages/**/*.vue', { eager: true })
    const page: any = pages[`./pages/${name}.vue`]
    page.default.layout = App
    return page
  },
  progress: {
    // The delay after which the progress bar will appear, in milliseconds...
    delay: 250,

    // The color of the progress bar...
    color: '#3B82F6',

    // Whether to include the default NProgress styles...
    includeCSS: true,

    // Whether the NProgress spinner will be shown...
    showSpinner: false,
  },
  setup({ el, App, props, plugin }) {

    // Setup language
    const navigatorLanguage =
        // @ts-ignore
        window.navigator.language || window.navigator.userLanguage

    let userLanguage = navigatorLanguage.split('-')[0]

    const userData: any = props.initialPage.props.userData

    if (userData && userData.preferences && userData.preferences.locale) {
        userLanguage = userData.preferences.locale
    }

    // Create vue app instance
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(pinia)
      .use(creopse, {
        initialProps: props.initialPage.props,
        router,
        resolveSections: () => {
          return import.meta.glob('./components/sections/**/*.vue', {
            eager: true,
          })
        },
        config: {
          debug: import.meta.env.DEV,
          appUrl: import.meta.env.APP_URL,
          locale: import.meta.env.APP_LOCALE,
          fallbackLocale: import.meta.env.APP_FALLBACK_LOCALE,
          useUserLocaleAsFallback: true,
          langKey: LANG_KEY
        },
      })
      .use(i18nVue, {
        lang: localStorage.getItem(LANG_KEY) || userLanguage || props.initialPage.props.appLocale || import.meta.env.APP_LOCALE,
        fallbackLang: props.initialPage.props.appFallbackLocale || import.meta.env.APP_FALLBACK_LOCALE,
        resolve: async (lang: string) => {
          const langs: any = import.meta.glob('../../lang/*.json')
          return await langs[`../../lang/${lang}.json`]()
        },
      })
      .component('ContentIcon', Icon)
      .component('Link', Link)
      .mount(el)
  },
})

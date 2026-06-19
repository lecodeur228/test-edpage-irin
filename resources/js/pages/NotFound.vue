<script lang="ts" setup>
  import Error404 from '@/assets/images/404.svg?component'

  import { router } from '@inertiajs/vue3'
  import { trans } from 'laravel-vue-i18n'
</script>

<template>
  <section
    class="tw:flex tw:flex-col tw:items-center tw:justify-center tw:min-h-screen tw:text-center tw:px-6 tw:gap-4">
    <p
      class="tw:text-sm tw:font-semibold tw:tracking-widest tw:text-gray-400 tw:uppercase">
      {{ trans('Error 404') }}
    </p>

    <Error404 class="tw:h-64 tw:w-auto" />

    <h1 class="tw:text-3xl tw:font-bold tw:text-gray-800">
      {{ trans('Page Not Found!') }}
    </h1>

    <p class="tw:max-w-md tw:text-gray-500">
      {{
        trans(
          'Oops! The page you are looking for does not exist. It might have been moved or deleted.'
        )
      }}
    </p>

    <button
      class="tw:mt-2 tw:px-6 tw:py-2.5 tw:rounded-lg tw:bg-[#1E9CD7] tw:text-white tw:text-sm tw:font-semibold tw:tracking-wide tw:transition-opacity hover:tw:opacity-80 tw:cursor-pointer"
      @click="router.get('/', {}, { replace: true })">
      {{ trans('BACK TO HOME') }}
    </button>
  </section>
</template>
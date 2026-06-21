<script setup lang="ts">
  import VoltzChromeBottom from '@/components/layout/VoltzChromeBottom.vue'
  import VoltzChromeTop from '@/components/layout/VoltzChromeTop.vue'
  import { useDataloader } from '@/composables/dataloader'
  import { useVoltzPlugins, hideVoltzPreloader } from '@/composables/useVoltzPlugins'
  import { router } from '@inertiajs/vue3'
  import { onMounted } from 'vue'

  const { initializeData } = useDataloader()
  const { scheduleInit } = useVoltzPlugins()

  onMounted(() => {
    hideVoltzPreloader()
    initializeData()
    scheduleInit()
    router.on('finish', () => scheduleInit())
  })
</script>

<template>
  <div>
    <VoltzChromeTop />
    <slot />
    <VoltzChromeBottom />
  </div>
</template>

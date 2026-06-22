<script setup lang="ts">
  import VoltzChromeBottom from '@/components/layout/VoltzChromeBottom.vue'
  import VoltzChromeTop from '@/components/layout/VoltzChromeTop.vue'
  import { useDataloader } from '@/composables/dataloader'
  import { useVoltzNavigate } from '@/composables/useVoltzNavigate'
  import { useVoltzPlugins, hideVoltzPreloader } from '@/composables/useVoltzPlugins'
  import { router } from '@inertiajs/vue3'
  import { onMounted } from 'vue'

  const { initializeData } = useDataloader()
  const { scheduleInitAfterPaint } = useVoltzPlugins()
  const { scrollToHash } = useVoltzNavigate()

  onMounted(() => {
    hideVoltzPreloader()
    initializeData()
    scheduleInitAfterPaint()

    const hash = window.location.hash.replace('#', '')
    if (hash) {
      scrollToHash(hash)
    }

    router.on('finish', () => {
      scheduleInitAfterPaint()
      const anchor = window.location.hash.replace('#', '')
      if (anchor) {
        scrollToHash(anchor)
      }
    })
  })
</script>

<template>
  <div>
    <VoltzChromeTop />
    <slot />
    <VoltzChromeBottom />
  </div>
</template>

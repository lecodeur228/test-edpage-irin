<script setup lang="ts">
  import { hideVoltzPreloader } from '@/composables/useVoltzPlugins'
  import { voltzAsset } from '@/utils/voltzAsset'
  import { onMounted } from 'vue'

  onMounted(() => {
    requestAnimationFrame(hideVoltzPreloader)
    setTimeout(hideVoltzPreloader, 1500)
  })
</script>

<template>
  <div class="preloader">
    <div class="loading-container">
      <div class="loading"></div>
      <div id="loading-icon">
        <img :src="voltzAsset('assets/img/logo/preloader.png')" alt="">
      </div>
    </div>
  </div>

  <div class="paginacontainer">
    <div class="progress-wrap">
      <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
      </svg>
    </div>
  </div>
</template>

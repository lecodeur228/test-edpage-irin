<script setup lang="ts">
  const { initializeData } = useDataloader()

  initializeData()
</script>

<template>
  <slot></slot>
</template>

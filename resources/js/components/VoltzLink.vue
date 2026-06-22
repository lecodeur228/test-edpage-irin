<script lang="ts" setup>
  const props = defineProps<{
    href?: string | null
    class?: string
  }>()

  const { handleClick, normalizeHref } = useVoltzNavigate()

  const resolvedHref = computed(() => normalizeHref(props.href))
</script>

<template>
  <a
    :href="resolvedHref"
    :class="props.class"
    @click="handleClick($event, resolvedHref)">
    <slot />
  </a>
</template>

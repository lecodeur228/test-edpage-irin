<script lang="ts" setup>
  import type { SectionProps } from '@creopse/utils'

  const props = defineProps<SectionProps>()

  const { getSectionRootData } = useContent()
  const { tr } = useHelper()

  const root = getSectionRootData(props.sectionKey)
</script>

<template>
  <div
    class="all-inner-header-area"
    :style="{
      backgroundImage: `url(${root?.background_image || '/assets/img/all-images/bg/hero-bg1.png'})`,
      backgroundPosition: 'center',
      backgroundRepeat: 'no-repeat',
      backgroundSize: 'cover',
    }">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-xl-8 col-lg-8">
          <div class="heading1">
            <h1>{{ tr(root?.title) || 'About Us' }}</h1>
            <div class="space16"></div>
            <VoltzLink :href="root?.breadcrumb_home_link || '/'">
              {{ tr(root?.breadcrumb_home_label) || 'Home' }}
              <i class="fa-solid fa-angle-right"></i>
              <span>{{ tr(root?.breadcrumb_current) || tr(root?.title) || 'About Us' }}</span>
            </VoltzLink>
          </div>
        </div>
        <div class="col-xl-4 col-lg-4">
          <div class="inner-images-area">
            <img src="/assets/img/elements/elements1.png" alt="" class="elements1">
            <div class="img1">
              <img :src="root?.image || '/assets/img/all-images/hero/hero-img1.png'" :alt="tr(root?.title) || ''">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

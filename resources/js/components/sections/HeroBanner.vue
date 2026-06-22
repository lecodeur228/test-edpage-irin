<script lang="ts" setup>
  import type { SectionProps } from '@creopse/utils'

  const props = defineProps<SectionProps>()

  const { getSectionRootData, getSectionData } = useContent()
  const { tr, rHtml } = useHelper()

  const root = getSectionRootData(props.sectionKey)
  const sectionData = getSectionData(props.sectionKey)
  const slides = computed(() => {
    if (sectionData?.slides?.length) {
      return sectionData.slides
    }
    if (!root) {
      return []
    }
    return [{
      title: root.title,
      description: root.description,
      image: root.image,
      background_image: root.background_image,
      primary_text: root.cta_text,
      primary_link: root.cta_link,
      secondary_text: root.secondary_cta_text,
      secondary_link: root.secondary_cta_link,
    }]
  })
</script>

<template>
  <div class="hero-slider-main-area">
    <div class="hero-main-slider-widget">
      <div v-for="(slide, index) in slides" :key="index" class="hero-main-section-area">
        <img :src="slide.background_image || '/assets/img/all-images/bg/hero-bg1.png'" alt="" class="hero-bg1">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-xl-7">
              <div class="hero1-heading">
                <h1>{{ tr(slide.title) || 'Harness the Future Of Electricity Today!' }}</h1>
                <div class="space16"></div>
                <p v-html="rHtml(slide.description)"></p>
                <div class="space38"></div>
                <div class="btn-area1">
                  <VoltzLink :href="slide.primary_link || '/#services'" class="vl-btn1">
                    {{ tr(slide.primary_text) || 'Explore Our Services' }}
                    <i class="fa-solid fa-arrow-right"></i>
                  </VoltzLink>
                  <VoltzLink :href="slide.secondary_link || '/about'" class="h-btn1">
                    {{ tr(slide.secondary_text) || 'More About Us' }}
                    <i class="fa-solid fa-arrow-right"></i>
                  </VoltzLink>
                </div>
              </div>
            </div>
            <div class="col-xl-5">
              <div class="main-images">
                <img src="/assets/img/elements/elements1.png" alt="" class="elements1">
                <div class="img1">
                  <img :src="slide.image || '/assets/img/all-images/hero/hero-img1.png'" :alt="tr(slide.title) || 'Voltz hero'">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

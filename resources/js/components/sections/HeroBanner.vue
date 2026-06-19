<script lang="ts" setup>
  import type { SectionProps } from '@creopse/utils'

  const props = defineProps<SectionProps>()

  const { getSectionRootData } = useContent()
  const { tr, rHtml } = useHelper()

  const hero = getSectionRootData(props.sectionKey)
  const slides = computed(() => hero?.slides || [
    {
      subtitle: hero?.subtitle,
      title: hero?.title,
      description: hero?.description,
      image: hero?.image || '/assets/img/all-images/hero/hero-img1.png',
      background_image: hero?.background_image || '/assets/img/all-images/bg/hero-bg1.png',
      primary_text: hero?.cta_text,
      primary_link: hero?.cta_link,
      secondary_text: hero?.secondary_cta_text,
      secondary_link: hero?.secondary_cta_link,
    },
  ])
</script>

<template>
  <div class="hero-slider-main-area">
    <div class="hero-main-slider-widget">
      <div v-for="(slide, index) in slides" :key="index" class="hero-main-section-area">
        <img :src="slide.background_image || '/assets/img/all-images/bg/hero-bg1.png'" alt="" class="hero-bg1">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-6">
              <div class="hero1-heading">
                <h5 class="vl-section-subtitle">
                  <img src="/assets/img/elements/elements5.png" alt="">
                  <span>{{ tr(slide.subtitle) || 'Clean Energy Solutions' }}</span>
                  <img src="/assets/img/elements/elements6.png" alt="">
                </h5>
                <div class="space16"></div>
                <h1>{{ tr(slide.title) || 'Power Your Future with Voltz' }}</h1>
                <div class="space16"></div>
                <p v-html="rHtml(slide.description) || 'Renewable energy solutions for a sustainable tomorrow.'"></p>
                <div class="space32"></div>
                <div class="btn-area1">
                  <a :href="slide.primary_link || '/services'" class="vl-btn1">
                    {{ tr(slide.primary_text) || 'Explore Our Services' }}
                    <i class="fa-solid fa-arrow-right"></i>
                  </a>
                  <a :href="slide.secondary_link || '/about'" class="h-btn1">
                    {{ tr(slide.secondary_text) || 'More About Us' }}
                    <i class="fa-solid fa-arrow-right"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="hero-images-area">
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

<script lang="ts" setup>
  import type { SectionProps } from '@creopse/utils'

  const props = defineProps<SectionProps>()

  const { getSectionRootData } = useContent()
  const { tr, rHtml } = useHelper()

  const root = getSectionRootData(props.sectionKey)
</script>

<template>
  <div class="apporch-area sp1">
    <div class="container">
      <div class="row">
        <div class="col-xl-5">
          <div class="heading1">
            <h5 class="vl-section-subtitle" data-aos="fade-left" data-aos-duration="800">
              <img src="/assets/img/elements/elements5.png" alt="">
              <span>{{ tr(root?.subtitle) || 'Our Approach' }}</span>
              <img src="/assets/img/elements/elements6.png" alt="">
            </h5>
            <div class="space16"></div>
            <h2 class="vl-section-title" data-aos="fade-left" data-aos-duration="900">
              {{ tr(root?.title) || 'Powering the Future' }}
            </h2>
            <div class="space24"></div>
            <h3>{{ tr(root?.vision_title) || 'Our Vision' }}</h3>
            <div class="space16"></div>
            <p data-aos="fade-left" data-aos-duration="1000" v-html="rHtml(root?.vision_text)"></p>
            <div class="space30"></div>
            <h3>{{ tr(root?.mission_title) || 'Our Mission' }}</h3>
            <div class="space16"></div>
            <p v-html="rHtml(root?.mission_text)"></p>
            <div class="space38"></div>
            <div class="btn-area1">
              <VoltzLink :href="root?.button_link || '/#projects'" class="vl-btn1">
                {{ tr(root?.button_text) || 'Learn More' }}
                <i class="fa-solid fa-arrow-right"></i>
              </VoltzLink>
            </div>
          </div>
        </div>
        <div class="col-xl-7">
          <div class="images-app-area">
            <div class="img1 text-end">
              <img :src="root?.image_primary || '/assets/img/all-images/about/about-img1.png'" alt="">
            </div>
            <div class="img2">
              <img :src="root?.image_secondary || '/assets/img/all-images/service/s-img1.png'" alt="">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

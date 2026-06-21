<script lang="ts" setup>
  import type { SectionProps } from '@creopse/utils'

  const props = defineProps<SectionProps>()

  const { getSectionRootData, getSectionData } = useContent()
  const { tr, rHtml } = useHelper()

  const root = getSectionRootData(props.sectionKey)
  const sectionData = getSectionData(props.sectionKey)
  const highlights = computed(() => sectionData?.highlights ?? [])
</script>

<template>
  <div class="about1 sp1">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-xl-6">
          <div class="about-heading heading1">
            <h5 class="vl-section-subtitle" data-aos="fade-left" data-aos-duration="800">
              <img src="/assets/img/elements/elements5.png" alt="">
              <span>{{ tr(root?.subtitle) || 'About Our Voltz Company' }}</span>
              <img src="/assets/img/elements/elements6.png" alt="">
            </h5>
            <div class="space16"></div>
            <h2 class="vl-section-title" data-aos="fade-left" data-aos-duration="900">
              {{ tr(root?.title) || 'Redefining Energy Efficiency for Homes and Businesses' }}
            </h2>
            <div class="space16"></div>
            <p data-aos="fade-left" data-aos-duration="1000" v-html="rHtml(root?.description)"></p>
            <div class="space24"></div>
            <template v-for="(item, index) in highlights" :key="index">
              <div
                class="aboput-boxarea"
                data-aos="fade-left"
                :data-aos-duration="1100 + index * 100"
              >
                <div class="icons">
                  <img :src="item.icon || '/assets/img/icons/a-icons1.svg'" alt="">
                </div>
                <div class="content-area">
                  <a :href="item.link || '/about'">{{ tr(item.title) }}</a>
                  <div class="space16"></div>
                  <p v-html="rHtml(item.text)"></p>
                </div>
              </div>
              <div v-if="index < highlights.length - 1" class="space20"></div>
            </template>
            <div class="space38"></div>
            <div class="btn-area1" data-aos="fade-left" data-aos-duration="1300">
              <a :href="root?.button_link || '/about'" class="vl-btn1">
                {{ tr(root?.button_text) || 'Learn More' }}
                <i class="fa-solid fa-arrow-right"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="col-xl-6" data-aos="zoom-in-up" data-aos-duration="1000">
          <div class="about-images-area">
            <img src="/assets/img/elements/elements7.png" alt="" class="elements7">
            <img src="/assets/img/elements/elements8.png" alt="" class="elements8">
            <div class="img1">
              <img :src="root?.image || '/assets/img/all-images/about/about-img1.png'" :alt="tr(root?.title) || 'About Voltz'">
            </div>
            <div class="s-project-box">
              <h3><span class="counter">{{ root?.metric_value || '100' }}</span>+</h3>
              <div class="space16"></div>
              <p>{{ tr(root?.metric_label) || 'Successful Project' }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

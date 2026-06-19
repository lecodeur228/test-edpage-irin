<script lang="ts" setup>
  import type { SectionProps } from '@creopse/utils'

  const props = defineProps<SectionProps>()

  const { getSectionRootData, getSectionData } = useContent()
  const { tr, rHtml } = useHelper()

  const service = getSectionRootData(props.sectionKey)
  const rawData = getSectionData(props.sectionKey)
  const cards = computed(() => service?.cards || rawData || [])
</script>

<template>
  <div class="service1 sp2">
    <div class="container">
      <div class="row">
        <div class="col-xl-7 m-auto">
          <div class="heading1 text-center space-margin60">
            <h5 class="vl-section-subtitle" data-aos="zoom-in" data-aos-duration="800">
              <img src="/assets/img/elements/elements5.png" alt="">
              <span>{{ tr(service?.subtitle) || 'Our Services' }}</span>
              <img src="/assets/img/elements/elements6.png" alt="">
            </h5>
            <div class="space16"></div>
            <h2 class="vl-section-title" data-aos="zoom-in" data-aos-duration="900">
              {{ tr(service?.title) || 'Smart Energy Solutions' }}
            </h2>
            <div class="space16"></div>
            <p v-if="service?.description" v-html="rHtml(service.description)"></p>
          </div>
        </div>
      </div>
      <div class="row">
        <div
          v-for="(item, index) in cards"
          :key="index"
          class="col-xl-4 col-md-6"
          data-aos="fade-up"
          :data-aos-duration="900 + index * 100"
        >
          <div class="service-main-boxarea">
            <img :src="item.image || '/assets/img/all-images/service/s-img1.png'" alt="" class="s-img1">
            <div class="content-area">
              <div class="icons">
                <img :src="item.icon || '/assets/img/icons/s-icons1.svg'" alt="">
              </div>
              <div class="space24"></div>
              <a :href="item.link || '/services'" class="title">{{ tr(item.title) }}</a>
              <div class="space16"></div>
              <p v-html="rHtml(item.description)"></p>
              <div class="space24"></div>
              <a :href="item.link || '/services'" class="readmore">
                {{ tr(item.link_text) || 'Learn More' }}
                <i class="fa-solid fa-arrow-right"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts" setup>
  import type { SectionProps } from '@creopse/utils'

  const props = defineProps<SectionProps>()

  const { getSectionRootData, getSectionData } = useContent()
  const { tr, rHtml } = useHelper()

  const root = getSectionRootData(props.sectionKey)
  const sectionData = getSectionData(props.sectionKey)
  const items = computed(() => sectionData?.items ?? [])
</script>

<template>
  <div class="choose1-inner-widget sp1">
    <div class="container">
      <div class="row">
        <div class="col-xl-6">
          <div class="choose-heading heading1">
            <h5 class="vl-section-subtitle" data-aos="fade-left" data-aos-duration="900">
              <img src="/assets/img/elements/elements5.png" alt="">
              <span>{{ tr(root?.subtitle) || 'WHY CHOOSE US' }}</span>
              <img src="/assets/img/elements/elements6.png" alt="">
            </h5>
            <div class="space16"></div>
            <h2 class="vl-section-title" data-aos="fade-left" data-aos-duration="1000">
              {{ tr(root?.title) || 'Powering the Future with Innovation and Reliability' }}
            </h2>
            <div class="space16"></div>
            <p data-aos="fade-left" data-aos-duration="1000" v-html="rHtml(root?.description)"></p>
            <template v-for="(item, index) in items" :key="index">
              <div class="space24"></div>
              <div class="choose-boxarea" data-aos="fade-left" :data-aos-duration="1100 + index * 100">
                <div class="icons">
                  <img :src="item.icon || `/assets/img/icons/ot-icons${index + 1}.svg`" alt="">
                </div>
                <div class="content-area">
                  <VoltzLink :href="item.link || '/#services'">{{ tr(item.title) }}</VoltzLink>
                  <div class="space16"></div>
                  <p v-html="rHtml(item.text)"></p>
                </div>
              </div>
            </template>
            <div class="space38"></div>
            <div class="btn-area1">
              <VoltzLink :href="root?.button_link || '/#projects'" class="vl-btn1">
                {{ tr(root?.button_text) || 'Learn More' }}
                <i class="fa-solid fa-arrow-right"></i>
              </VoltzLink>
            </div>
          </div>
        </div>
        <div class="col-xl-6">
          <div class="choose-images-area">
            <img src="/assets/img/elements/elements7.png" alt="" class="elements10 aniamtion-key-2">
            <div class="img1" data-aos="fade-right" data-aos-duration="1000">
              <img :src="root?.image_primary || '/assets/img/all-images/about/about-img1.png'" alt="">
            </div>
            <div class="img2 text-end" data-aos="fade-left" data-aos-duration="1000">
              <img :src="root?.image_secondary || '/assets/img/all-images/projects/p-img1.png'" alt="">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

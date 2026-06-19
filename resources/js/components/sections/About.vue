<script lang="ts" setup>
  import type { SectionProps } from '@creopse/utils'

  const props = defineProps<SectionProps>()

  const { getSectionRootData } = useContent()
  const { tr, rHtml } = useHelper()

  const about = getSectionRootData(props.sectionKey)
  const highlights = computed(() => about?.highlights || [])
</script>

<template>
  <div class="about1 sp1">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6">
          <div class="about-heading heading1">
            <h5 class="vl-section-subtitle" data-aos="fade-left" data-aos-duration="800">
              <img src="/assets/img/elements/elements5.png" alt="">
              <span>{{ tr(about?.subtitle) || 'About Our Voltz Company' }}</span>
              <img src="/assets/img/elements/elements6.png" alt="">
            </h5>
            <div class="space16"></div>
            <h2 class="vl-section-title" data-aos="fade-left" data-aos-duration="900">
              {{ tr(about?.title) || 'Sustainable Energy for a Brighter Tomorrow' }}
            </h2>
            <div class="space16"></div>
            <p data-aos="fade-left" data-aos-duration="1000" v-html="rHtml(about?.description)"></p>
            <div class="space32"></div>
            <div
              v-for="(item, index) in highlights"
              :key="index"
              class="about-auhtor-box"
              data-aos="fade-left"
              :data-aos-duration="1100 + index * 100"
            >
              <div class="icons">
                <img :src="item.icon || '/assets/img/icons/a-icons1.svg'" alt="">
              </div>
              <div class="text">
                <a :href="item.link || '/about'">{{ tr(item.title) }}</a>
                <div class="space10"></div>
                <p v-html="rHtml(item.text)"></p>
              </div>
            </div>
            <div class="space32"></div>
            <div class="btn-area1" data-aos="fade-left" data-aos-duration="1300">
              <a :href="about?.button_link || '/about'" class="vl-btn1">
                {{ tr(about?.button_text) || 'Learn More' }}
                <i class="fa-solid fa-arrow-right"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="about-images-area" data-aos="zoom-in" data-aos-duration="1000">
            <div class="img1 image-anime">
              <img :src="about?.image || '/assets/img/all-images/about/about-img1.png'" :alt="tr(about?.title) || 'About Voltz'">
            </div>
            <div class="s-project-box">
              <h3>{{ about?.metric_value || '120+' }}</h3>
              <p>{{ tr(about?.metric_label) || 'Successful Project' }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

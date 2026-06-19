<script lang="ts" setup>
  import type { SectionProps } from '@creopse/utils'

  const props = defineProps<SectionProps>()

  const { getSectionRootData, getSectionData } = useContent()
  const { tr, rHtml } = useHelper()

  const testimonial = getSectionRootData(props.sectionKey)
  const rawData = getSectionData(props.sectionKey)
  const testimonials = computed(() => testimonial?.testimonials || rawData || [])
</script>

<template>
  <section class="testimonials-2 sp6" style="background-image: url(/assets/img/all-images/bg/bg2.html); background-position: center; background-repeat: no-repeat; background-size: cover;">
    <div class="container">
      <div class="row">
        <div class="col-xl-6 m-auto text-center">
          <div class="heading1 text-center space-margin60">
            <h5 class="vl-section-subtitle" data-aos="zoom-in-up" data-aos-duration="900">
              <img src="/assets/img/elements/elements5.png" alt="">
              <span>{{ tr(testimonial?.subtitle) || 'Testimonials' }}</span>
              <img src="/assets/img/elements/elements6.png" alt="">
            </h5>
            <div class="space16"></div>
            <h2 class="vl-section-title" data-aos="zoom-in-up" data-aos-duration="1000">
              {{ tr(testimonial?.title) || 'Testimonials Powering Success' }}
            </h2>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xl-7 col-md-12 left _relative m-auto">
          <div class="swiper swiper-testimonial-2">
            <div class="swiper-wrapper">
              <div v-for="(item, index) in testimonials" :key="index" class="swiper-slide">
                <div class="testimonial-boxarea">
                  <div class="icons"><i class="fa-solid fa-quote-left"></i></div>
                  <ul>
                    <li v-for="star in Number(item.rating || 5)" :key="star"><i class="fa-solid fa-star"></i></li>
                  </ul>
                  <div class="space16"></div>
                  <p v-html="rHtml(item.content)"></p>
                  <div class="space32"></div>
                  <div class="text">
                    <a href="/team">{{ tr(item.author_name) }}</a>
                    <div class="space12"></div>
                    <p>{{ tr(item.author_role) }}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="map-testimonial">
          <div class="swiper swiper-thumb2">
            <div class="swiper-wrapper list-img">
              <div v-for="(item, index) in testimonials" :key="index" class="swiper-slide">
                <div><img :src="item.author_image || '/assets/img/all-images/testimonial/testi-img1.png'" :alt="tr(item.author_name)"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

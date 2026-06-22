<script lang="ts" setup>
  import type { SectionProps } from '@creopse/utils'

  const props = defineProps<SectionProps>()

  const { getSectionRootData, getSectionData } = useContent()
  const { tr, rHtml } = useHelper()

  const root = getSectionRootData(props.sectionKey)
  const sectionData = getSectionData(props.sectionKey)
  const testimonials = computed(() => sectionData?.testimonials ?? [])
</script>

<template>
  <section class="testimonials-2 sp6">
    <div class="container">
      <div class="row">
        <div class="col-xl-6 m-auto text-center">
          <div class="heading1 text-center space-margin60">
            <h5 class="vl-section-subtitle" data-aos="zoom-in-up" data-aos-duration="900">
              <img src="/assets/img/elements/elements5.png" alt="">
              <span>{{ tr(root?.subtitle) || 'Testimonials' }}</span>
              <img src="/assets/img/elements/elements6.png" alt="">
            </h5>
            <div class="space16"></div>
            <h2 class="vl-section-title" data-aos="zoom-in-up" data-aos-duration="1000">
              {{ tr(root?.title) || 'Testimonials Powering Success' }}
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
                  <div class="icons">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="22" viewBox="0 0 32 22" fill="none">
                      <path d="M7.06519 22C5.23303 22.0002 3.47416 21.3388 2.16785 20.1584C0.861544 18.9779 0.112446 17.373 0.0820847 15.6897C-0.0974808 14.1038 -0.0715446 11.7645 1.09563 9.064C2.28874 6.303 4.61512 3.29267 8.86084 0.366671C9.07045 0.222216 9.30897 0.117111 9.56278 0.0573597C9.8166 -0.00238991 10.0807 -0.0156212 10.3401 0.0184269C10.8639 0.0871906 11.3366 0.344351 11.6541 0.733335C11.9716 1.12232 12.1079 1.61127 12.0331 2.09261C11.9582 2.57395 11.6784 3.00826 11.2551 3.3C8.1346 5.4505 6.34693 7.5405 5.3234 9.36833C6.283 9.14189 7.28406 9.10567 8.26007 9.26208C9.23607 9.41848 10.1647 9.76394 10.9842 10.2755C11.8038 10.787 12.4955 11.453 13.0134 12.2291C13.5313 13.0051 13.8635 13.8736 13.9881 14.7768C14.1126 15.6799 14.0266 16.5971 13.7357 17.4673C13.4448 18.3376 12.9557 19.141 12.3009 19.8242C11.6461 20.5074 10.8406 21.0547 9.93789 21.4299C9.03518 21.805 8.05593 21.9994 7.06519 22ZM25.0217 22C23.1896 22.0002 21.4307 21.3388 20.1244 20.1584C18.8181 18.9779 18.069 17.373 18.0386 15.6897C17.8591 14.1038 17.885 11.7645 19.0522 9.064C20.2433 6.303 22.5717 3.29267 26.8174 0.366671C27.027 0.222216 27.2655 0.117111 27.5193 0.0573597C27.7731 -0.00238991 28.0373 -0.0156212 28.2967 0.0184269C28.8205 0.0871906 29.2931 0.344351 29.6106 0.733335C29.9281 1.12232 30.0645 1.61127 29.9896 2.09261C29.9148 2.57395 29.6349 3.00826 29.2116 3.3C26.0912 5.4505 24.3035 7.5405 23.28 9.36833C24.2396 9.14189 25.2406 9.10567 26.2166 9.26208C27.1926 9.41848 28.1212 9.76394 28.9408 10.2755C29.7603 10.787 30.452 11.453 30.9699 12.2291C31.4878 13.0051 31.8201 13.8736 31.9446 14.7768C32.0691 15.6799 31.9831 16.5971 31.6922 17.4673C31.4013 18.3376 30.9122 19.141 30.2575 19.8242C29.6027 20.5074 28.7972 21.0547 27.8944 21.4299C26.9917 21.805 26.0125 21.9994 25.0217 22Z" fill="white" />
                    </svg>
                  </div>
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
          <div class="pagination-buttons">
            <div class="swiper-button-next">
              <button type="button"><i class="fa-solid fa-angle-left"></i></button>
            </div>
            <div class="swiper-button-prev">
              <button type="button"><i class="fa-solid fa-angle-right"></i></button>
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

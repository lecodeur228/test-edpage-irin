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
  <div class="testimonial2 sp1">
    <img src="/assets/img/elements/elements2.png" alt="" class="elements9">
    <div class="container">
      <div class="row">
        <div class="col-xl-6 m-auto">
          <div class="heading1 text-center space-margin60">
            <h5 class="vl-section-subtitle" data-aos="zoom-in-up" data-aos-duration="900">
              <img src="/assets/img/elements/elements5.png" alt="">
              <span>{{ tr(root?.subtitle) || 'TESTIMONIALS' }}</span>
              <img src="/assets/img/elements/elements6.png" alt="">
            </h5>
            <div class="space16"></div>
            <h2 class="vl-section-title" data-aos="zoom-in-up" data-aos-duration="1000">
              {{ tr(root?.title) || 'What Our Customers Say' }}
            </h2>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xl-12">
          <div class="testimonai2-slider-area">
            <div v-for="(item, index) in testimonials" :key="index" class="testimonial-slider-boxarea">
              <ul>
                <li v-for="star in Number(item.rating || 5)" :key="star"><i class="fa-solid fa-star"></i></li>
              </ul>
              <div class="space16"></div>
              <p v-html="rHtml(item.content)"></p>
              <div class="space24"></div>
              <div class="content-man-area">
                <div class="images">
                  <div class="img1">
                    <img :src="item.author_image || '/assets/img/all-images/testimonial/testi-img1.png'" :alt="tr(item.author_name)">
                  </div>
                  <div class="icons">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                      <path d="M13.75 5C14.5152 4.99989 15.2499 5.30054 15.7955 5.83711C16.3411 6.37368 16.654 7.10319 16.6667 7.86833C16.7417 8.58917 16.7308 9.6525 16.2433 10.88C15.745 12.135 14.7733 13.5033 13 14.8333C12.9125 14.899 12.8128 14.9468 12.7068 14.9739C12.6008 15.0011 12.4905 15.0071 12.3822 14.9916C12.1634 14.9604 11.9659 14.8435 11.8333 14.6667C11.7007 14.4899 11.6438 14.2676 11.675 14.0488C11.7063 13.83 11.8232 13.6326 12 13.5C13.3033 12.5225 14.05 11.5725 14.4775 10.7417C14.0767 10.8446 13.6586 10.8611 13.2509 10.79C12.8433 10.7189 12.4554 10.5618 12.1131 10.3293C11.7708 10.0968 11.4819 9.79411 11.2656 9.44134C11.0493 9.08857 10.9105 8.69382 10.8585 8.28329C10.8065 7.87277 10.8424 7.45587 10.9639 7.06031C11.0854 6.66474 11.2897 6.29955 11.5632 5.989C11.8367 5.67846 12.1731 5.42966 12.5501 5.25914C12.9272 5.08862 13.3362 5.00029 13.75 5ZM6.25 5C7.01525 4.99989 7.74988 5.30054 8.29549 5.83711C8.84111 6.37368 9.15399 7.10319 9.16667 7.86833C9.24167 8.58917 9.23083 9.6525 8.74333 10.88C8.24583 12.135 7.27333 13.5033 5.5 14.8333C5.41245 14.899 5.31283 14.9468 5.20682 14.9739C5.10081 15.0011 4.99048 15.0071 4.88215 14.9916C4.66336 14.9604 4.46594 14.8435 4.33333 14.6667C4.20073 14.4899 4.14379 14.2676 4.17504 14.0488C4.2063 13.83 4.32319 13.6326 4.5 13.5C5.80333 12.5225 6.55 11.5725 6.9775 10.7417C6.5767 10.8446 6.15858 10.8611 5.75093 10.79C5.34328 10.7189 4.95542 10.5618 4.61312 10.3293C4.27082 10.0968 3.98191 9.79411 3.7656 9.44134C3.54928 9.08857 3.41051 8.69382 3.35849 8.28329C3.30648 7.87277 3.34241 7.45587 3.46391 7.06031C3.58541 6.66474 3.78968 6.29955 4.06317 5.989C4.33666 5.67846 4.67311 5.42966 5.05015 5.25914C5.42719 5.08862 5.83619 5.00029 6.25 5Z" fill="white" />
                    </svg>
                  </div>
                </div>
                <div class="text">
                  <VoltzLink href="/about">{{ tr(item.author_name) }}</VoltzLink>
                  <div class="space12"></div>
                  <p>{{ tr(item.author_role) }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

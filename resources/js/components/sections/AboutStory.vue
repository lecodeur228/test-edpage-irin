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
  <div class="about2-inner-widget sp1">
    <div class="container">
      <div class="row">
        <div class="col-xl-6">
          <div class="all-images">
            <div class="img1" data-aos="zoom-in" data-aos-duration="900">
              <img :src="root?.image_primary || '/assets/img/all-images/about/about-img1.png'" :alt="tr(root?.title) || ''">
            </div>
            <div class="img2 text-end" data-aos="zoom-in" data-aos-duration="1000">
              <img :src="root?.image_secondary || '/assets/img/all-images/about/about-img1.png'" alt="">
              <div v-if="root?.video_url" class="play-btn-area">
                <a :href="root.video_url" class="popup-youtube"><i class="fa-solid fa-play"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-6">
          <div class="about2-heading heading1">
            <h5 class="vl-section-subtitle" data-aos="fade-left" data-aos-duration="900">
              <img src="/assets/img/elements/elements5.png" alt="">
              <span>{{ tr(root?.subtitle) || 'About Our Voltz' }}</span>
              <img src="/assets/img/elements/elements6.png" alt="">
            </h5>
            <div class="space16"></div>
            <h2 class="vl-section-title" data-aos="fade-left" data-aos-duration="1000">
              {{ tr(root?.title) || 'Smart Energy Solutions For A Sustainable World' }}
            </h2>
            <div class="space16"></div>
            <p data-aos="fade-left" data-aos-duration="1000" v-html="rHtml(root?.description)"></p>
            <div class="row">
              <div
                v-for="(item, index) in highlights"
                :key="index"
                class="col-xl-6 col-md-6">
                <div class="space24"></div>
                <div class="choose-boxarea" data-aos="fade-left" :data-aos-duration="1100 + index * 100">
                  <div class="icons">
                    <img :src="item.icon || `/assets/img/icons/ot-icons${index + 1}.svg`" alt="">
                  </div>
                  <div class="content-area">
                    <VoltzLink :href="item.link || '/about'">{{ tr(item.title) }}</VoltzLink>
                    <div class="space16"></div>
                    <p v-html="rHtml(item.text)"></p>
                  </div>
                </div>
              </div>
            </div>
            <div class="space24"></div>
            <div class="btn-area1" data-aos="fade-left" data-aos-duration="1200">
              <VoltzLink :href="root?.button_link || '/#services'" class="vl-btn1">
                {{ tr(root?.button_text) || 'Learn More' }}
                <i class="fa-solid fa-arrow-right"></i>
              </VoltzLink>
              <div v-if="root?.phone" class="call-boxarea" data-aos="fade-left" data-aos-duration="1100">
                <div class="icons">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M17.751 11.198C17.7508 9.85635 17.2177 8.56973 16.269 7.62104C15.3203 6.67235 14.0337 6.13927 12.692 6.139M21.219 10.844C21.219 9.781 21.0096 8.7284 20.6028 7.74633C20.196 6.76425 19.5997 5.87193 18.848 5.12032C18.0963 4.36871 17.2039 3.77253 16.2218 3.36583C15.2397 2.95913 14.187 2.74987 13.124 2.75M12.531 20.217C12.231 20.08 11.932 19.943 11.633 19.78C10.1664 18.9514 8.81903 17.9273 7.62804 16.736C6.08472 15.2826 4.81669 13.5623 3.88504 11.658C3.38664 10.6351 3.04997 9.54111 2.88704 8.415C2.66722 7.27714 2.7933 6.09953 3.24904 5.034C3.53019 4.57598 3.8697 4.15647 4.25904 3.786C4.41702 3.60924 4.6091 3.46621 4.82372 3.36552C5.03835 3.26482 5.27111 3.20852 5.50804 3.2C6.00104 3.274 6.44804 3.532 6.75604 3.923C7.43004 4.672 8.15304 5.346 8.86404 6.057C9.14404 6.297 9.31904 6.637 9.35104 7.005C9.33904 7.315 9.22004 7.61 9.01404 7.841C8.77704 8.141 8.49004 8.415 8.21604 8.701C8.05035 8.86059 7.9236 9.05614 7.84557 9.27255C7.76754 9.48895 7.74033 9.7204 7.76604 9.949C7.93804 10.484 8.23304 10.972 8.62704 11.372C9.09974 12.0169 9.59505 12.645 10.112 13.255C11.0763 14.3673 12.2185 15.3118 13.492 16.05C13.6684 16.1832 13.8769 16.2672 14.0963 16.2936C14.3157 16.3199 14.5382 16.2876 14.741 16.2C15.164 15.963 15.541 15.65 15.851 15.277C16.1196 14.9503 16.5041 14.74 16.924 14.69C17.298 14.71 17.65 14.87 17.91 15.14C18.246 15.426 18.533 15.763 18.845 16.075C19.157 16.387 19.407 16.612 19.669 16.898C19.983 17.1753 20.278 17.4707 20.554 17.784C20.768 18.061 20.871 18.409 20.841 18.757C20.7296 19.1737 20.4895 19.5446 20.155 19.817C19.684 20.3068 19.1117 20.6878 18.4782 20.9336C17.8447 21.1794 17.1651 21.284 16.487 21.24C15.114 21.1638 13.7688 20.8161 12.531 20.217Z" stroke="#0F0D0D" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" />
                  </svg>
                </div>
                <div class="content-area">
                  <p>{{ tr(root?.phone_label) || 'GIVE US A CALL' }}</p>
                  <div class="space6"></div>
                  <a :href="`tel:${root.phone}`">{{ root.phone }}</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

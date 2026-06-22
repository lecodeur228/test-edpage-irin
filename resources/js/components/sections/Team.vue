<script lang="ts" setup>
  import type { SectionProps } from '@creopse/utils'

  const props = defineProps<SectionProps>()

  const { getSectionRootData, getSectionData } = useContent()
  const { tr } = useHelper()

  const root = getSectionRootData(props.sectionKey)
  const sectionData = getSectionData(props.sectionKey)
  const members = computed(() => sectionData?.members ?? [])
</script>

<template>
  <div class="team5 sp2">
    <div class="container">
      <div class="row">
        <div class="col-xl-6 m-auto">
          <div class="heading1 text-center space-margin60">
            <h5 class="vl-section-subtitle" data-aos="zoom-in-up" data-aos-duration="900">
              <img src="/assets/img/elements/elements6.png" alt="">
              <span>{{ tr(root?.subtitle) || 'Our team' }}</span>
              <img src="/assets/img/elements/elements6.png" alt="">
            </h5>
            <div class="space16"></div>
            <h2 class="vl-section-title" data-aos="zoom-in-up" data-aos-duration="1000">
              {{ tr(root?.title) || 'Meet Our Expert Team' }}
            </h2>
          </div>
        </div>
      </div>
      <div class="row">
        <div
          v-for="(member, index) in members"
          :key="index"
          class="col-xl-4 col-md-6"
          data-aos="fade-up"
          :data-aos-duration="900 + index * 100">
          <div class="team5-boxarea">
            <div class="img1">
              <img :src="member.image || '/assets/img/all-images/testimonial/testi-img1.png'" :alt="tr(member.name)">
            </div>
            <div class="content-area">
              <VoltzLink :href="member.link || '/about'" class="title">{{ tr(member.name) }}</VoltzLink>
              <div class="space12"></div>
              <p>{{ tr(member.role) }}</p>
            </div>
            <ul>
              <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
              <li><a href="#"><i class="fa-brands fa-linkedin-in"></i></a></li>
              <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
              <li><a href="#"><i class="fa-brands fa-youtube"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts" setup>
  import type { SectionProps } from '@creopse/utils'

  const props = defineProps<SectionProps>()

  const { getSectionRootData, getSectionData } = useContent()
  const { tr } = useHelper()

  const root = getSectionRootData(props.sectionKey)
  const sectionData = getSectionData(props.sectionKey)
  const projects = computed(() => sectionData?.projects ?? [])
</script>

<template>
  <div id="projects" class="project1 sp1">
    <div class="container">
      <div class="row">
        <div class="col-xl-6 m-auto">
          <div class="heading1 text-center space-margin60">
            <h5 class="vl-section-subtitle" data-aos="zoom-in-up" data-aos-duration="900">
              <img src="/assets/img/elements/elements5.png" alt="">
              <span>{{ tr(root?.subtitle) || 'our Projects' }}</span>
              <img src="/assets/img/elements/elements6.png" alt="">
            </h5>
            <div class="space16"></div>
            <h2 class="vl-section-title" data-aos="zoom-in-up" data-aos-duration="1000">
              {{ tr(root?.title) || 'Renewable Energy At Work' }}
            </h2>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xl-12">
          <div class="project-slider-area">
            <div v-for="(item, index) in projects" :key="index" class="projects-boxes-area">
              <div class="img1">
                <img :src="item.image || '/assets/img/all-images/projects/p-img1.png'" :alt="tr(item.title)">
              </div>
              <div class="contain-main-area">
                <div class="content-p-area">
                  <span>{{ tr(item.category) || 'Edge energy solutions' }}</span>
                  <div class="space12"></div>
                  <VoltzLink :href="item.link || '/#projects'" class="title">{{ tr(item.title) }}</VoltzLink>
                </div>
                <div class="arrow">
                  <VoltzLink :href="item.link || '/#projects'"><i class="fa-solid fa-arrow-right"></i></VoltzLink>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts" setup>
  import type { SectionProps } from '@creopse/utils'

  const props = defineProps<SectionProps>()

  const { getSectionRootData, getSectionData } = useContent()
  const { tr } = useHelper()

  const project = getSectionRootData(props.sectionKey)
  const rawData = getSectionData(props.sectionKey)
  const projects = computed(() => project?.projects || rawData || [])
</script>

<template>
  <div class="project1 sp1">
    <div class="container">
      <div class="row">
        <div class="col-xl-6 m-auto">
          <div class="heading1 text-center space-margin60">
            <h5 class="vl-section-subtitle" data-aos="zoom-in-up" data-aos-duration="900">
              <img src="/assets/img/elements/elements5.png" alt="">
              <span>{{ tr(project?.subtitle) || 'Our Projects' }}</span>
              <img src="/assets/img/elements/elements6.png" alt="">
            </h5>
            <div class="space16"></div>
            <h2 class="vl-section-title" data-aos="zoom-in-up" data-aos-duration="1000">
              {{ tr(project?.title) || 'Powering Projects With Purpose' }}
            </h2>
          </div>
        </div>
      </div>
      <div class="project-slider-area">
        <div v-for="(item, index) in projects" :key="index" class="projects-boxes-area">
          <div class="img1 image-anime">
            <img :src="item.image || '/assets/img/all-images/projects/p-img1.png'" :alt="tr(item.title)">
          </div>
          <div class="content-area">
            <a :href="item.link || '/projects'" class="title">{{ tr(item.title) }}</a>
            <div class="space12"></div>
            <p>{{ tr(item.category) || 'Renewable Energy' }}</p>
            <a :href="item.link || '/projects'"><i class="fa-solid fa-arrow-right"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

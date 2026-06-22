<script lang="ts" setup>
  import type { SectionProps } from '@creopse/utils'

  const props = defineProps<SectionProps>()

  const { getSectionRootData, getSectionData } = useContent()
  const { tr } = useHelper()

  const root = getSectionRootData(props.sectionKey)
  const sectionData = getSectionData(props.sectionKey)
  const items = computed(() => sectionData?.items ?? [])
</script>

<template>
  <div
    class="others1 sp2"
    :style="{
      backgroundImage: `url(${root?.background_image || '/assets/img/all-images/bg/ot-bg1.png'})`,
      backgroundPosition: 'center',
      backgroundRepeat: 'no-repeat',
      backgroundSize: 'cover',
    }">
    <div class="container">
      <div class="row">
        <div
          v-for="(item, index) in items"
          :key="index"
          class="col-xl-3 col-md-6"
          data-aos="fade-up"
          :data-aos-duration="900 + index * 100"
          :data-aos-offset="80 + index * 20">
          <div class="others-boxarea">
            <div class="icons">
              <img :src="item.icon || `/assets/img/icons/ot-icons${index + 1}.svg`" alt="">
            </div>
            <VoltzLink :href="item.link || '/#services'" class="title">{{ tr(item.title) }}</VoltzLink>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

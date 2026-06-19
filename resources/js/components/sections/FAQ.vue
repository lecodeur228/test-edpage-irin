<script lang="ts" setup>
  import type { SectionProps } from '@creopse/utils'

  const props = defineProps<SectionProps>()

  const { getSectionRootData, getSectionData } = useContent()
  const { tr, rHtml } = useHelper()

  const faq = getSectionRootData(props.sectionKey)
  const rawData = getSectionData(props.sectionKey)
  const faqs = computed(() => faq?.faqs || rawData || [])
</script>

<template>
  <div class="faq1 sp1">
    <div class="container">
      <div class="row">
        <div class="col-xl-6 m-auto">
          <div class="heading1 text-center space-margin60">
            <h5 class="vl-section-subtitle" data-aos="zoom-in-up" data-aos-duration="900">
              <img src="/assets/img/elements/elements5.png" alt="">
              <span>{{ tr(faq?.subtitle) || 'FAQ' }}</span>
              <img src="/assets/img/elements/elements6.png" alt="">
            </h5>
            <div class="space16"></div>
            <h2 class="vl-section-title" data-aos="zoom-in-up" data-aos-duration="1000">
              {{ tr(faq?.title) || 'Energy Solutions Explained' }}
            </h2>
          </div>
        </div>
      </div>
      <div class="col-xl-10 m-auto">
        <div class="faq-main-area">
          <div class="accordion" id="accordionExample">
            <template v-for="(item, index) in faqs" :key="index">
              <div class="accordion-item" data-aos="zoom-in-up" :data-aos-duration="900 + index * 100">
                <h2 class="accordion-header">
                  <button class="accordion-button" :class="{ collapsed: index !== 0 }" type="button" data-bs-toggle="collapse" :data-bs-target="`#faq-${index}`" :aria-expanded="index === 0" :aria-controls="`faq-${index}`">
                    {{ tr(item.question) }}
                    <span class="number">{{ String(index + 1).padStart(2, '0') }}</span>
                  </button>
                </h2>
                <div :id="`faq-${index}`" class="accordion-collapse collapse" :class="{ show: index === 0 }" data-bs-parent="#accordionExample">
                  <div class="accordion-body"><p v-html="rHtml(item.answer)"></p></div>
                </div>
              </div>
              <div class="space24"></div>
            </template>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

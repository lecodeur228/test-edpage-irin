<script lang="ts" setup>
  import type { SectionProps } from '@creopse/utils'

  const props = defineProps<SectionProps>()

  const { getSectionRootData } = useContent()
  const { tr, rHtml } = useHelper()

  const cta = getSectionRootData(props.sectionKey)
</script>

<template>
  <div class="cta1-aection-area">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="cta-bg-area">
            <div class="row align-items-center">
              <div class="col-lg-6">
                <div class="cta-heading">
                  <h2>{{ tr(cta?.title) || 'Ready to Power Your Future?' }}</h2>
                  <div class="space16"></div>
                  <p v-html="rHtml(cta?.description) || 'Talk with our team about your next energy project.'"></p>
                  <div class="space32"></div>
                  <a :href="cta?.button_link || '/contact'" class="vl-btn1">
                    {{ tr(cta?.button_text) || 'Contact Us' }}
                    <i class="fa-solid fa-arrow-right"></i>
                  </a>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="cta-images-area text-end">
                  <img :src="cta?.image || '/assets/img/all-images/cta/cta-img1.png'" :alt="tr(cta?.title) || 'Voltz CTA'">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

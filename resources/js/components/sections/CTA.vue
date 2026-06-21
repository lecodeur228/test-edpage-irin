<script lang="ts" setup>
  import type { SectionProps } from '@creopse/utils'

  const props = defineProps<SectionProps>()

  const { getSectionRootData } = useContent()
  const { tr, rHtml } = useHelper()

  const root = getSectionRootData(props.sectionKey)
</script>

<template>
  <div class="cta1-aection-area">
    <div class="container">
      <div class="row">
        <div class="col-xl-12">
          <div class="cta-bg-area">
            <img src="/assets/img/elements/elements4.png" alt="" class="elements4">
            <div class="row align-items-center">
              <div class="col-xl-6">
                <div class="cta-heading">
                  <h2 data-aos="zoom-in" data-aos-duration="800">{{ tr(root?.title) || 'Secure Reliable Power for Your Home and Business!' }}</h2>
                  <div class="space16"></div>
                  <p data-aos="zoom-in" data-aos-duration="900" v-html="rHtml(root?.description)"></p>
                  <div class="space32"></div>
                  <div class="form-area" data-aos="zoom-in" data-aos-duration="1100">
                    <form>
                      <input type="text" placeholder="Your Email Address">
                      <button class="vl-btn1" type="submit">
                        {{ tr(root?.button_text) || 'Subscribe' }}
                        <i class="fa-solid fa-arrow-right"></i>
                      </button>
                    </form>
                  </div>
                </div>
              </div>
              <div class="col-xl-1"></div>
              <div class="col-xl-5" data-aos="zoom-in" data-aos-duration="1000">
                <div class="cta-images-area text-end">
                  <img :src="root?.image || root?.background_image || '/assets/img/all-images/cta/cta-img1.png'" :alt="tr(root?.title) || 'Voltz CTA'">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

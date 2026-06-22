<script lang="ts" setup>
  import { ref } from 'vue'
  import type { SectionProps } from '@creopse/utils'

  const props = defineProps<SectionProps>()

  const { getSectionRootData } = useContent()
  const { tr, rHtml } = useHelper()

  const root = getSectionRootData(props.sectionKey)

  const sectionClass = computed(() => root?.layout === 'contact2' ? 'contact2 sp1' : 'contact1 sp1')

  const formData = ref({ name: '', email: '', subject: '', message: '' })

  const submitForm = () => {
    formData.value = { name: '', email: '', subject: '', message: '' }
  }
</script>

<template>
  <div id="contact" :class="sectionClass">
    <div class="container">
      <div class="row">
        <div class="col-xl-8 m-auto">
          <div class="heading1 text-center space-margin60">
            <h5 class="vl-section-subtitle" data-aos="zoom-in-up" data-aos-duration="900">
              <img src="/assets/img/elements/elements5.png" alt="">
              <span>{{ tr(root?.subtitle) || 'CONTACT US' }}</span>
              <img src="/assets/img/elements/elements6.png" alt="">
            </h5>
            <div class="space16"></div>
            <h2 class="vl-section-title" data-aos="zoom-in-up" data-aos-duration="1000">
              {{ tr(root?.title) || 'Your Clean Energy Journey Begins Now' }}
            </h2>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xl-6" data-aos="zoom-in-up" data-aos-duration="1000">
          <div class="contact-maps-area">
            <iframe
              :src="root?.map_embed || 'https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d4506257.120552435!2d88.67021924228865!3d21.954385721237916!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1704088968016!5m2!1sen!2sbd'"
              width="600"
              height="450"
              style="border:0;"
              allowfullscreen
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade" />
          </div>
        </div>
        <div class="col-xl-6">
          <div class="contact-widget-area heading3">
            <h4 data-aos="fade-left" data-aos-duration="900">{{ tr(root?.form_title) || 'Send us a Message' }}</h4>
            <div class="space12"></div>
            <p data-aos="fade-left" data-aos-duration="1100" v-html="rHtml(root?.description)"></p>
            <div class="space12"></div>
            <div class="contact-boxarea" data-aos="fade-left" data-aos-duration="1200">
              <form @submit.prevent="submitForm">
                <div class="row">
                  <div class="col-xl-6 col-md-6">
                    <div class="input-area">
                      <input v-model="formData.name" type="text" placeholder="Full Name" required>
                    </div>
                  </div>
                  <div class="col-xl-6 col-md-6">
                    <div class="input-area">
                      <input v-model="formData.email" type="email" placeholder="Email" required>
                    </div>
                  </div>
                  <div class="col-xl-12 col-md-12">
                    <div class="input-area">
                      <input v-model="formData.subject" type="text" placeholder="Subject">
                    </div>
                  </div>
                  <div class="col-xl-12 col-md-12">
                    <div class="input-area">
                      <textarea v-model="formData.message" placeholder="How can we help you?" required></textarea>
                    </div>
                  </div>
                  <div class="col-xl-12 col-md-12">
                    <div class="input-area">
                      <button type="submit" class="vl-btn1">
                        Send Now
                        <i class="fa-solid fa-arrow-right"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

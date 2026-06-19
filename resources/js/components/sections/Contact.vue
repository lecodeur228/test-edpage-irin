<script lang="ts" setup>
  import { ref } from 'vue'
  import type { SectionProps } from '@creopse/utils'

  const props = defineProps<SectionProps>()

  const { getSectionRootData, getSectionData } = useContent()
  const { tr, rHtml } = useHelper()

  const contact = getSectionRootData(props.sectionKey)
  const rawData = getSectionData(props.sectionKey)
  const contactInfo = computed(() => contact?.contact_info || rawData || [])

  const formData = ref({ name: '', email: '', phone: '', message: '' })

  const submitForm = () => {
    formData.value = { name: '', email: '', phone: '', message: '' }
  }
</script>

<template>
  <div class="contact-widget-sec sp1">
    <div class="container">
      <div class="row">
        <div class="col-xl-6 m-auto">
          <div class="heading1 text-center space-margin60">
            <h5 class="vl-section-subtitle" data-aos="zoom-in-up" data-aos-duration="900">
              <img src="/assets/img/elements/elements5.png" alt="">
              <span>{{ tr(contact?.subtitle) || 'Contact Us' }}</span>
              <img src="/assets/img/elements/elements6.png" alt="">
            </h5>
            <div class="space16"></div>
            <h2 class="vl-section-title" data-aos="zoom-in-up" data-aos-duration="1000">{{ tr(contact?.title) || 'Get in Touch' }}</h2>
            <div class="space16"></div>
            <p v-if="contact?.description" v-html="rHtml(contact.description)"></p>
          </div>
        </div>
      </div>
      <div class="row align-items-start">
        <div class="col-lg-5">
          <div class="contact-info-area">
            <div v-for="(info, index) in contactInfo" :key="index" class="contact-auhtor-boxarea">
              <div class="icons"><i :class="info.icon || 'fa-solid fa-location-dot'"></i></div>
              <div class="text">
                <h4>{{ tr(info.title) }}</h4>
                <a :href="info.href || '#'">{{ tr(info.content) }}</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-7">
          <div class="contact-form-area">
            <form @submit.prevent="submitForm">
              <div class="row">
                <div class="col-lg-6"><input v-model="formData.name" type="text" placeholder="Your Name" required></div>
                <div class="col-lg-6"><input v-model="formData.email" type="email" placeholder="Email Address" required></div>
                <div class="col-lg-12"><input v-model="formData.phone" type="tel" placeholder="Phone Number"></div>
                <div class="col-lg-12"><textarea v-model="formData.message" placeholder="Your Message" required></textarea></div>
                <div class="col-lg-12"><button type="submit" class="vl-btn1">Send Message <i class="fa-solid fa-arrow-right"></i></button></div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

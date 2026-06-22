<script lang="ts" setup>
  import type { SectionProps } from '@creopse/utils'

  const props = defineProps<SectionProps>()

  const { getSectionRootData, getSectionData } = useContent()
  const { tr, rHtml } = useHelper()
  const { resolveMenuPath } = useVoltzNavigate()

  const root = getSectionRootData(props.sectionKey)
  const sectionData = getSectionData(props.sectionKey)
  const quickLinks = computed(() => sectionData?.quick_links ?? [])
  const serviceLinks = computed(() => sectionData?.service_links ?? [])
</script>

<template>
  <div class="vl-footer1-section-area">
    <img src="/assets/img/elements/elements2.png" alt="" class="elements2">
    <img src="/assets/img/elements/elements3.png" alt="" class="elements3">
    <div class="container">
      <div class="row">
        <div class="col-xl-3 col-md-6">
          <div class="footer-logo-area">
            <img :src="root?.logo || '/assets/img/logo/logo1.png'" alt="">
            <div class="space16"></div>
            <p v-html="rHtml(root?.description)"></p>
            <div class="space24"></div>
            <ul class="social-links">
              <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
              <li><a href="#"><i class="fa-brands fa-linkedin-in"></i></a></li>
              <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
              <li><a href="#"><i class="fa-brands fa-youtube"></i></a></li>
            </ul>
          </div>
        </div>

        <div class="col-xl col-md-6">
          <div class="space30 d-lg-none d-block"></div>
          <div class="footer-widget-area foot-padding1">
            <h3>{{ tr(root?.quick_links_title) || 'Quick Links' }}</h3>
            <ul>
              <li v-for="(link, index) in quickLinks" :key="index">
                <VoltzLink :href="resolveMenuPath(link.url || '/')">{{ tr(link.title) }}</VoltzLink>
              </li>
            </ul>
          </div>
        </div>

        <div class="col-xl col-md-6">
          <div class="space30 d-lg-none d-block"></div>
          <div class="footer-widget-area foot-padding2">
            <h3>{{ tr(root?.service_links_title) || 'Services' }}</h3>
            <ul>
              <li v-for="(link, index) in serviceLinks" :key="index">
                <VoltzLink :href="link.url || '/#services'">{{ tr(link.title) }}</VoltzLink>
              </li>
            </ul>
          </div>
        </div>

        <div class="col-xl col-md-6">
          <div class="space30 d-lg-none d-block"></div>
          <div class="footer-widget-area">
            <h3>{{ tr(root?.contact_title) || 'Contact Us' }}</h3>
            <ul>
              <li>
                <a href="#">
                  <i class="fa-solid fa-location-dot"></i>
                  {{ tr(root?.address) || '123 Energy Lane, Power City, PC' }}
                </a>
              </li>
              <li>
                <a :href="`tel:${root?.phone || '(123)456-7890'}`">
                  <i class="fa-solid fa-phone"></i>
                  {{ root?.phone || '(123) 456-7890' }}
                </a>
              </li>
              <li>
                <a :href="`mailto:${root?.email || 'info@voltzenergy.com'}`">
                  <i class="fa-regular fa-envelope"></i>
                  {{ root?.email || 'info@voltzenergy.com' }}
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="space60"></div>
      <div class="col-xl-12">
        <div class="copyright-area">
          <a href="#">{{ tr(root?.copyright) || '© 2025 VOLTZ. All Rights Reserved.' }}</a>
        </div>
      </div>
    </div>
  </div>
</template>

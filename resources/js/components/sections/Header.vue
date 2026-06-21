<script lang="ts" setup>
  import { usePage } from '@inertiajs/vue3'
  import type { SectionProps } from '@creopse/utils'

  const props = defineProps<SectionProps>()

  const page = usePage()
  const { getSectionRootData } = useContent()
  const { tr } = useHelper()

  const root = getSectionRootData(props.sectionKey)

  const menuItems = computed(() => {
    const menus = page.props.menus as { name: string; items: { title: string; path: string; isVisible: boolean }[] }[] | undefined
    const mainMenu = menus?.find((menu) => menu.name === 'main')

    return (mainMenu?.items || []).filter((item) => item.isVisible !== false)
  })
</script>

<template>
  <header class="homepage1-body">
    <div id="vl-header-sticky" class="vl-header-area vl-transparent-header">
      <div class="header-top-area">
        <div class="container">
          <div class="row">
            <div class="col-xl-12">
              <div class="header-top-main">
                <ul class="header-list">
                  <li>
                    <a href="#">
                      <i class="fa-solid fa-location-dot"></i>
                      {{ tr(root?.address) || '123 Energy Lane, Power City, PC 12345' }}
                    </a>
                  </li>
                  <li>
                    <a :href="`mailto:${root?.email || 'info@voltzenergy.com'}`">
                      <i class="fa-regular fa-envelope"></i>
                      {{ root?.email || 'info@voltzenergy.com' }}
                    </a>
                  </li>
                </ul>
                <div class="hsocial-phn-area">
                  <ul class="header-links">
                    <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                    <li><a href="#"><i class="fa-brands fa-linkedin-in"></i></a></li>
                    <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                    <li><a href="#"><i class="fa-brands fa-youtube"></i></a></li>
                  </ul>
                  <a :href="`tel:${root?.phone || '(123)456-7890'}`" class="tel-phn">
                    <i class="fa-solid fa-phone"></i>
                    {{ root?.phone || '(123) 456-7890' }}
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="space20"></div>
      <div class="container">
        <div class="row align-items-center">
          <div class="col-xl-2 col-md-6 col-6">
            <div class="vl-logo">
              <a href="/">
                <img :src="root?.logo || '/assets/img/logo/logo1.png'" alt="">
              </a>
            </div>
          </div>
          <div class="col-xl-7 d-none d-xl-block">
            <div class="vl-main-menu text-center">
              <nav class="vl-mobile-menu-active">
                <ul>
                  <li v-for="(item, index) in menuItems" :key="index">
                    <a :href="item.path">{{ tr(item.title) }}</a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
          <div class="col-xl-3 col-md-6 col-6">
            <div class="vl-hero-btn d-none d-xl-block text-end">
              <div class="sidebar_btn-area">
                <div class="btn_area1">
                  <a :href="root?.cta_link || '/contact'" class="vl-btn1">
                    {{ tr(root?.cta_text) || 'Get A Quote' }}
                    <i class="fa-solid fa-arrow-right"></i>
                  </a>
                </div>
                <div class="search-icon header__search header-search-btn">
                  <a href="#"><i class="fa-solid fa-magnifying-glass"></i></a>
                </div>
                <button class="hamburger_menu" type="button">
                  <i class="fa-solid fa-bars"></i>
                </button>
              </div>
            </div>
            <div class="vl-header-action-item d-block d-xl-none">
              <button type="button" class="vl-offcanvas-toggle">
                <i class="fa-solid fa-bars-staggered"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <div class="space20"></div>
    </div>
  </header>

  <!-- Mobile menu — same structure as public/index.html -->
  <div class="homepage1-body">
    <div class="vl-offcanvas">
      <div class="vl-offcanvas-wrapper">
        <div class="vl-offcanvas-header d-flex justify-content-between align-items-center mb-90">
          <div class="vl-offcanvas-logo">
            <a href="/">
              <img :src="root?.logo || '/assets/img/logo/logo1.png'" alt="">
            </a>
          </div>
          <div class="vl-offcanvas-close">
            <button type="button" class="vl-offcanvas-close-toggle"><i class="fa-solid fa-xmark"></i></button>
          </div>
        </div>

        <div class="vl-offcanvas-menu d-xl-none mb-40">
          <nav></nav>
        </div>

        <div class="space20"></div>
        <div class="vl-offcanvas-info">
          <h3 class="vl-offcanvas-sm-title">Contact Us</h3>
          <div class="space20"></div>
          <span>
            <a :href="`tel:${root?.phone || '(123)456-7890'}`">
              <i class="fa-solid fa-phone"></i> {{ root?.phone || '(123) 456-7890' }}
            </a>
          </span>
          <span>
            <a :href="`mailto:${root?.email || 'info@voltzenergy.com'}`">
              <i class="fa-regular fa-envelope"></i> {{ root?.email || 'info@voltzenergy.com' }}
            </a>
          </span>
          <span>
            <a href="#">
              <i class="fa-solid fa-location-dot"></i> {{ tr(root?.address) || '123 Energy Lane, Power City, PC 12345' }}
            </a>
          </span>
        </div>
        <div class="space20"></div>
        <div class="vl-offcanvas-social">
          <h3 class="vl-offcanvas-sm-title">Follow Us</h3>
          <div class="space20"></div>
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-linkedin-in"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
        </div>
      </div>
    </div>
    <div class="vl-offcanvas-overlay"></div>
  </div>
</template>

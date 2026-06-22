<script lang="ts" setup>
  import { usePage } from '@inertiajs/vue3'
  import type { SectionProps } from '@creopse/utils'

  const props = defineProps<SectionProps>()

  const page = usePage()
  const { getSectionRootData } = useContent()
  const { tr } = useHelper()
  const { resolveMenuPath } = useVoltzNavigate()

  const root = getSectionRootData(props.sectionKey)

  const menuItems = computed(() => {
    const menus = page.props.menus as { name: string; items: { title: string; path: string; isVisible: boolean }[] }[] | undefined
    const mainMenu = menus?.find((menu) => menu.name === 'main')

    return (mainMenu?.items || []).filter((item) => item.isVisible !== false)
  })

  const currentPath = computed(() => page.url.split('?')[0].split('#')[0])

  const isActivePath = (path: string) => {
    const target = (path || '/').split('#')[0] || '/'
    return currentPath.value === target
  }
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
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                        <path d="M8 14.5C10.5 11 12.5 8 12.5 6C12.5 4.80653 12.0259 3.66193 11.182 2.81802C10.3381 1.97411 9.19347 1.5 8 1.5C6.80653 1.5 5.66193 1.97411 4.81802 2.81802C3.97411 3.66193 3.5 4.80653 3.5 6C3.5 8 5.5 11 8 14.5Z" stroke="#0F0D0D" />
                        <path d="M10 6C10 6.53043 9.78929 7.03914 9.41421 7.41421C9.03914 7.78929 8.53043 8 8 8C7.46957 8 6.96086 7.78929 6.58579 7.41421C6.21071 7.03914 6 6.53043 6 6C6 5.46957 6.21071 4.96086 6.58579 4.58579C6.96086 4.21071 7.46957 4 8 4C8.53043 4 9.03914 4.21071 9.41421 4.58579C9.78929 4.96086 10 5.46957 10 6Z" stroke="#0F0D0D" />
                      </svg>
                      {{ tr(root?.address) || '123 Energy Lane, Power City, PC 12345' }}
                    </a>
                  </li>
                  <li>
                    <a :href="`mailto:${root?.email || 'info@voltzenergy.com'}`">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                        <g clip-path="url(#clip0_header_email)">
                          <path d="M14.224 2.66602H1.77951C1.54377 2.66602 1.31767 2.75967 1.15097 2.92637C0.984275 3.09306 0.890625 3.31916 0.890625 3.5549V12.4438C0.890625 12.6795 0.984275 12.9056 1.15097 13.0723C1.31767 13.239 1.54377 13.3327 1.77951 13.3327H14.224C14.4597 13.3327 14.6858 13.239 14.8525 13.0723C15.0192 12.9056 15.1128 12.6795 15.1128 12.4438V3.5549C15.1128 3.31916 15.0192 3.09306 14.8525 2.92637C14.6858 2.75967 14.4597 2.66602 14.224 2.66602ZM13.5395 12.4438H2.51729L5.6284 9.22602L4.9884 8.60824L1.77951 11.9282V4.23046L7.30396 9.72824C7.4705 9.89379 7.69579 9.98672 7.93062 9.98672C8.16546 9.98672 8.39075 9.89379 8.55729 9.72824L14.224 4.09268V11.8705L10.9528 8.59935L10.3262 9.22602L13.5395 12.4438ZM2.36174 3.5549H13.504L7.93062 9.09713L2.36174 3.5549Z" fill="#0F0D0D" />
                        </g>
                        <defs>
                          <clipPath id="clip0_header_email">
                            <rect width="16" height="16" fill="white" />
                          </clipPath>
                        </defs>
                      </svg>
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
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                      <path d="M13.3 14C11.9111 14 10.5389 13.6973 9.18333 13.092C7.82778 12.4867 6.59444 11.6282 5.48333 10.5167C4.37222 9.40511 3.514 8.17178 2.90867 6.81667C2.30333 5.46156 2.00044 4.08933 2 2.7C2 2.5 2.06667 2.33333 2.2 2.2C2.33333 2.06667 2.5 2 2.7 2H5.4C5.55556 2 5.69444 2.05289 5.81667 2.15867C5.93889 2.26444 6.01111 2.38933 6.03333 2.53333L6.46667 4.86667C6.48889 5.04444 6.48333 5.19444 6.45 5.31667C6.41667 5.43889 6.35556 5.54444 6.26667 5.63333L4.65 7.26667C4.87222 7.67778 5.136 8.07489 5.44133 8.458C5.74667 8.84111 6.08289 9.21067 6.45 9.56667C6.79444 9.91111 7.15556 10.2307 7.53333 10.5253C7.91111 10.82 8.31111 11.0893 8.73333 11.3333L10.3 9.76667C10.4 9.66667 10.5307 9.59178 10.692 9.542C10.8533 9.49222 11.0116 9.47822 11.1667 9.5L13.4667 9.96667C13.6222 10.0111 13.75 10.0918 13.85 10.2087C13.95 10.3256 14 10.456 14 10.6V13.3C14 13.5 13.9333 13.6667 13.8 13.8C13.6667 13.9333 13.5 14 13.3 14Z" fill="#0F0D0D" />
                    </svg>
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
              <VoltzLink href="/">
                <img :src="root?.logo || '/assets/img/logo/logo1.png'" alt="">
              </VoltzLink>
            </div>
          </div>
          <div class="col-xl-7 d-none d-xl-block">
            <div class="vl-main-menu text-center">
              <nav class="vl-mobile-menu-active">
                <ul>
                  <li v-for="(item, index) in menuItems" :key="index" :class="{ active: isActivePath(item.path) }">
                    <VoltzLink :href="resolveMenuPath(item.path)">{{ tr(item.title) }}</VoltzLink>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
          <div class="col-xl-3 col-md-6 col-6">
            <div class="vl-hero-btn d-none d-xl-block text-end">
              <div class="sidebar_btn-area">
                <div class="btn_area1">
                  <VoltzLink :href="resolveMenuPath(root?.cta_link || '/#contact')" class="vl-btn1">
                    {{ tr(root?.cta_text) || 'Get A Quote' }}
                    <i class="fa-solid fa-arrow-right"></i>
                  </VoltzLink>
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
            <VoltzLink href="/">
              <img :src="root?.logo || '/assets/img/logo/logo1.png'" alt="">
            </VoltzLink>
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

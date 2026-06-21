<script lang="ts" setup>
  import { usePage } from '@inertiajs/vue3'

  const page = usePage()

  const appName = computed(() => {
    const info = page.props.appInformation as { key: string; value: string }[] | undefined
    return info?.find((item) => item.key === 'name')?.value || 'Voltz'
  })
</script>

<template>
  <div class="header-search-form-wrapper">
    <div class="tx-search-close tx-close"><i class="fa-solid fa-xmark"></i></div>
    <div class="header-search-container">
      <form role="search" class="search-form">
        <input type="search" class="search-field" placeholder="Search …" value="" name="s">
        <button type="submit" class="search-submit">
          <img src="/assets/img/icons/search1.svg" alt="">
        </button>
      </form>
    </div>
  </div>
  <div class="body-overlay"></div>

  <div class="header-site-icon">
    <div class="slide-bar slide-bar1">
      <div class="sidebar-info">
        <div class="sidebar-logo">
          <a href="/">
            <img src="/assets/img/logo/logo1.png" :alt="appName">
          </a>
          <div class="close-mobile-menu">
            <a href="#"><i class="fa-solid fa-xmark"></i></a>
          </div>
        </div>
        <div class="space16"></div>
        <div class="sidebar-content">
          <p>We bring the future of energy to your doorstep with cutting-edge, efficient, &amp; eco-friendly power solutions. Whether you're looking.</p>
        </div>
        <div class="space32"></div>
        <div class="btn-area">
          <a href="/contact" class="vl-btn1">Get in touch now <i class="fa-solid fa-arrow-right"></i></a>
        </div>
        <div class="space40"></div>
        <div class="social-link-area">
          <h3 class="sidebar-heading">Social Links</h3>
          <ul>
            <li>
              <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
              <a href="#"><i class="fa-brands fa-instagram"></i></a>
              <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
              <a href="#"><i class="fa-brands fa-pinterest-p"></i></a>
              <a href="#"><i class="fa-brands fa-youtube"></i></a>
            </li>
          </ul>
        </div>
        <div class="space40"></div>
        <div class="form-area">
          <h3>Subscribe To Newsletter</h3>
          <form>
            <input type="text" placeholder="Email Address*">
            <button type="submit" class="vl-btn1">subscribe <i class="fa-solid fa-arrow-right"></i></button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
  const { initializeData } = useDataloader()

  initializeData()
</script>

<template>
  <div class="preloader">
    <div class="loading-container">
      <div class="loading"></div>
      <div id="loading-icon">
        <img src="/assets/img/logo/preloader.png" alt="">
      </div>
    </div>
  </div>

  <div class="paginacontainer">
    <div class="progress-wrap">
      <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
      </svg>
    </div>
  </div>

  <header class="homepage1-body">
    <div id="vl-header-sticky" class="vl-header-area vl-transparent-header">
      <div class="header-top-area">
        <div class="container">
          <div class="row">
            <div class="col-xl-12">
              <div class="header-top-main">
                <ul class="header-list">
                  <li><a href="#"><i class="fa-solid fa-location-dot"></i> 123 Energy Lane, Power City</a></li>
                  <li><a href="mailto:info@voltzenergy.com"><i class="fa-solid fa-envelope"></i> info@voltzenergy.com</a></li>
                </ul>
                <div class="hsocial-phn-area">
                  <ul class="header-links">
                    <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                    <li><a href="#"><i class="fa-brands fa-linkedin-in"></i></a></li>
                    <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                    <li><a href="#"><i class="fa-brands fa-youtube"></i></a></li>
                  </ul>
                  <a href="tel:+11234567890" class="tel-phn"><i class="fa-solid fa-phone"></i> (123) 456-7890</a>
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
              <a href="/"><img src="/assets/img/logo/logo1.png" alt="Voltz"></a>
            </div>
          </div>
          <div class="col-xl-7 d-none d-xl-block">
            <div class="vl-main-menu text-center">
              <nav class="vl-mobile-menu-active">
                <ul>
                  <li><a href="/">Home</a></li>
                  <li><a href="/about">About Us</a></li>
                  <li><a href="/services">Services</a></li>
                  <li><a href="/projects">Projects</a></li>
                  <li><a href="/blog">Blog</a></li>
                  <li><a href="/contact">Contact Us</a></li>
                </ul>
              </nav>
            </div>
          </div>
          <div class="col-xl-3 col-md-6 col-6">
            <div class="vl-hero-btn d-none d-xl-block text-end">
              <a href="/contact" class="vl-btn1">Get A Quote <i class="fa-solid fa-arrow-right"></i></a>
            </div>
            <div class="vl-header-action-item d-block d-xl-none">
              <button type="button" class="vl-offcanvas-toggle">
                <i class="fa-solid fa-bars-staggered"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>

  <div class="vl-offcanvas">
    <div class="vl-offcanvas-wrapper">
      <div class="vl-offcanvas-header d-flex justify-content-between align-items-center mb-90">
        <div class="vl-offcanvas-logo">
          <a href="/"><img src="/assets/img/logo/logo1.png" alt="Voltz"></a>
        </div>
        <div class="vl-offcanvas-close">
          <button class="vl-offcanvas-close-toggle"><i class="fa-solid fa-xmark"></i></button>
        </div>
      </div>
      <div class="vl-offcanvas-menu d-xl-none mb-40">
        <nav></nav>
      </div>
      <div class="space20"></div>
      <div class="vl-offcanvas-info">
        <h3 class="vl-offcanvas-sm-title">Contact Us</h3>
        <div class="space20"></div>
        <a href="tel:+11234567890"><i class="fa-solid fa-phone"></i> (123) 456-7890</a>
        <a href="mailto:info@voltzenergy.com"><i class="fa-solid fa-envelope"></i> info@voltzenergy.com</a>
      </div>
    </div>
  </div>
  <div class="vl-offcanvas-overlay"></div>

  <slot></slot>

  <div class="vl-footer1-section-area">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-6">
          <div class="footer-logo-area">
            <img src="/assets/img/logo/logo1.png" alt="Voltz">
            <div class="space16"></div>
            <p>Renewable energy solutions for homes, businesses, and infrastructure projects.</p>
            <div class="space24"></div>
            <ul>
              <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
              <li><a href="#"><i class="fa-brands fa-linkedin-in"></i></a></li>
              <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
              <li><a href="#"><i class="fa-brands fa-youtube"></i></a></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-2 col-md-6">
          <div class="footer-widget-area foot-padding1">
            <h3>Quick Links</h3>
            <ul>
              <li><a href="/about">About Us</a></li>
              <li><a href="/services">Services</a></li>
              <li><a href="/projects">Projects</a></li>
              <li><a href="/blog">Blog</a></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="footer-widget-area foot-padding2">
            <h3>Services</h3>
            <ul>
              <li><a href="/services">Solar Installation</a></li>
              <li><a href="/services">Energy Consulting</a></li>
              <li><a href="/services">Smart Energy Systems</a></li>
              <li><a href="/faq">Voltz FAQ</a></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="footer-widget-area">
            <h3>Contact Us</h3>
            <ul>
              <li><a href="tel:+11234567890"><i class="fa-solid fa-phone"></i> (123) 456-7890</a></li>
              <li><a href="mailto:info@voltzenergy.com"><i class="fa-solid fa-envelope"></i> info@voltzenergy.com</a></li>
              <li><a href="#"><i class="fa-solid fa-location-dot"></i> 123 Energy Lane, Power City</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="space60"></div>
      <div class="row">
        <div class="col-lg-12">
          <div class="copyright-area">
            <p>Copyright 2026 Voltz. All Rights Reserved.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

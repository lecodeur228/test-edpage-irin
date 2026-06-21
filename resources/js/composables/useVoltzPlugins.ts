/* eslint-disable @typescript-eslint/no-explicit-any */

let testimonialThumbSwiper: { destroy: (a?: boolean, b?: boolean) => void } | null = null
let testimonialMainSwiper: { destroy: (a?: boolean, b?: boolean) => void } | null = null

function get$(): any {
  return (window as any).jQuery
}

function unslick($: any, selector: string) {
  const $el = $(selector)
  if ($el.hasClass('slick-initialized')) {
    $el.slick('unslick')
  }
}

function initSlickSliders($: any) {
  unslick($, '.hero-main-slider-widget')
  if ($('.hero-main-slider-widget').children().length) {
    $('.hero-main-slider-widget').slick({
      autoplay: true,
      autoplaySpeed: 1500,
      speed: 2000,
      slidesToShow: 1,
      slidesToScroll: 1,
      pauseOnHover: false,
      dots: true,
      arrows: false,
      pauseOnDotsHover: true,
      cssEase: 'linear',
      fade: true,
      draggable: true,
    })
  }

  unslick($, '.project-slider-area')
  if ($('.project-slider-area').children().length) {
    $('.project-slider-area').slick({
      slidesToShow: 3,
      slidesToScroll: 1,
      dots: false,
      arrows: false,
      centerMode: false,
      focusOnSelect: true,
      loop: true,
      autoplay: true,
      autoplaySpeed: 2000,
      infinite: true,
      responsive: [
        { breakpoint: 1024, settings: { slidesToShow: 3, slidesToScroll: 1, infinite: true } },
        { breakpoint: 769, settings: { slidesToShow: 2, slidesToScroll: 1 } },
        { breakpoint: 480, settings: { slidesToShow: 1, slidesToScroll: 1 } },
      ],
    })
  }
}

function initMobileMenu($: any) {
  const $sideMenu = $('.vl-offcanvas-menu nav')
  $sideMenu.empty()
  const vlMenuWrap = $('.vl-mobile-menu-active > ul').clone()
  $sideMenu.append(vlMenuWrap)

  if ($sideMenu.find('.sub-menu, .vl-mega-menu').length !== 0) {
    $sideMenu.find('.sub-menu, .vl-mega-menu').parent().append('<button class="vl-menu-close"><i class="fas fa-chevron-right"></i></button>')
  }
}

function bindVoltzUiHandlers($: any) {
  $(document).off('click.voltz', '.vl-offcanvas-toggle').on('click.voltz', '.vl-offcanvas-toggle', (e: Event) => {
    e.preventDefault()
    $('.vl-offcanvas').addClass('vl-offcanvas-open')
    $('.vl-offcanvas-overlay').addClass('vl-offcanvas-overlay-open')
  })

  $(document).off('click.voltz', '.vl-offcanvas-close-toggle, .vl-offcanvas-overlay').on('click.voltz', '.vl-offcanvas-close-toggle, .vl-offcanvas-overlay', (e: Event) => {
    e.preventDefault()
    $('.vl-offcanvas').removeClass('vl-offcanvas-open')
    $('.vl-offcanvas-overlay').removeClass('vl-offcanvas-overlay-open')
  })

  $(document).off('click.voltz', '.header-search-btn').on('click.voltz', '.header-search-btn', (e: Event) => {
    e.preventDefault()
    $('.header-search-form-wrapper').addClass('open')
    $('.header-search-form-wrapper input[type="search"]').trigger('focus')
    $('.body-overlay').addClass('active')
  })

  $(document).off('click.voltz', '.tx-search-close, .body-overlay').on('click.voltz', '.tx-search-close, .body-overlay', (e: Event) => {
    e.preventDefault()
    $('.header-search-form-wrapper').removeClass('open')
    $('.body-overlay').removeClass('active')
  })

  $(document).off('click.voltz', '.hamburger_menu').on('click.voltz', '.hamburger_menu', function (this: HTMLElement, e: Event) {
    e.preventDefault()
    $('.slide-bar').toggleClass('show')
    $('body').addClass('on-side')
    $('.body-overlay').addClass('active')
    $(this).addClass('active')
  })

  $(document).off('click.voltz', '.close-mobile-menu > a').on('click.voltz', '.close-mobile-menu > a', (e: Event) => {
    e.preventDefault()
    $('.slide-bar').removeClass('show')
    $('body').removeClass('on-side')
    $('.body-overlay').removeClass('active')
    $('.hamburger_menu').removeClass('active')
  })
}

function initSwiperSliders() {
  const Swiper = (window as any).Swiper
  if (!Swiper) {
    return
  }

  testimonialThumbSwiper?.destroy(true, true)
  testimonialMainSwiper?.destroy(true, true)
  testimonialThumbSwiper = null
  testimonialMainSwiper = null

  const thumbEl = document.querySelector('.swiper-thumb2')
  const mainEl = document.querySelector('.swiper-testimonial-2')

  if (!thumbEl || !mainEl) {
    return
  }

  testimonialThumbSwiper = new Swiper('.swiper-thumb2', {
    spaceBetween: 10,
    slidesPerView: 6,
    freeMode: true,
    watchSlidesProgress: true,
    autoplay: { delay: 2500, disableOnInteraction: false },
  })

  testimonialMainSwiper = new Swiper('.swiper-testimonial-2', {
    spaceBetween: 10,
    loop: true,
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    autoplay: { delay: 2500, disableOnInteraction: false },
    thumbs: { swiper: testimonialThumbSwiper },
  })
}

function initCounters($: any) {
  const ucounter = $('.counter')
  if (ucounter.length > 0 && typeof ucounter.countUp === 'function') {
    ucounter.countUp()
  }
}

function initAos() {
  const AOS = (window as any).AOS
  if (AOS) {
    AOS.init({ disable: 'mobile' })
    AOS.refresh()
  }
}

function initStickyHeader($: any) {
  const $header = $('#vl-header-sticky')
  if (!$header.length) {
    return
  }

  $(window).off('scroll.voltzHeader').on('scroll.voltzHeader', () => {
    if ($(window).scrollTop() < 100) {
      $header.removeClass('header-sticky')
    } else {
      $header.addClass('header-sticky')
    }
  }).trigger('scroll')
}

export function hideVoltzPreloader() {
  document.querySelectorAll('.preloader').forEach((el) => {
    el.classList.add('is-hidden')
  })
}

export function initVoltzPlugins() {
  hideVoltzPreloader()

  try {
    const $ = get$()
    if (!$) {
      return
    }

    initMobileMenu($)
    bindVoltzUiHandlers($)
    initStickyHeader($)
    initSlickSliders($)
    initSwiperSliders()
    initCounters($)
    initAos()
  } catch (error) {
    console.error('[Voltz] Plugin init failed:', error)
    hideVoltzPreloader()
  }
}

export function useVoltzPlugins() {
  const scheduleInit = (attempt = 0) => {
    if ((window as any).jQuery || attempt >= 30) {
      initVoltzPlugins()
      return
    }
    setTimeout(() => scheduleInit(attempt + 1), 100)
  }

  return { scheduleInit }
}

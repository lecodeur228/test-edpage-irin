import { router, usePage } from '@inertiajs/vue3'

function scrollToHash(hash: string) {
  if (!hash) {
    return
  }

  requestAnimationFrame(() => {
    window.setTimeout(() => {
      document.getElementById(hash)?.scrollIntoView({ behavior: 'smooth', block: 'start' })
    }, 100)
  })
}

export function isExternalHref(href: string) {
  return /^(https?:\/\/|mailto:|tel:)/i.test(href)
}

export function navigateFromHref(href: string) {
  if (!href || href === '#' || isExternalHref(href)) {
    return
  }

  const hashIndex = href.indexOf('#')
  const path = hashIndex === -1 ? href : href.slice(0, hashIndex) || '/'
  const hash = hashIndex === -1 ? '' : href.slice(hashIndex + 1)
  const currentPath = window.location.pathname
  const visitUrl = hash ? `${path}#${hash}` : path

  if (path === currentPath) {
    if (hash) {
      window.history.replaceState(window.history.state, '', visitUrl)
      scrollToHash(hash)
    }
    return
  }

  router.visit(visitUrl, {
    preserveScroll: !hash,
    onFinish: () => scrollToHash(hash),
  })
}

export function useVoltzNavigate() {
  const page = usePage()

  const isExternal = (href: string) => isExternalHref(href)

  const normalizeHref = (href?: string | null) => {
    if (!href) {
      return '#'
    }

    return href
  }

  const navigate = (href: string) => {
    navigateFromHref(href)
  }

  const handleClick = (event: MouseEvent, href?: string | null) => {
    if (event.metaKey || event.ctrlKey || event.shiftKey || event.altKey || event.button !== 0) {
      return
    }

    const target = (event.currentTarget as HTMLAnchorElement | null)?.getAttribute('href')
      || href
      || '#'

    if (target === '#' || target === '') {
      event.preventDefault()
      return
    }

    if (isExternal(target)) {
      return
    }

    if (!target.startsWith('/')) {
      return
    }

    event.preventDefault()
    navigateFromHref(target)
  }

  const isActivePath = (path: string) => {
    const target = (path || '/').split('#')[0] || '/'
    const currentPath = page.url.split('?')[0].split('#')[0]
    return currentPath === target
  }

  const resolveMenuPath = (path: string) => {
    const currentPath = page.url.split('?')[0].split('#')[0] || '/'

    if (path === '/#contact' && currentPath !== '/') {
      return `${currentPath}#contact`
    }

    return path
  }

  return {
    navigate,
    handleClick,
    isExternal,
    normalizeHref,
    scrollToHash,
    isActivePath,
    resolveMenuPath,
  }
}

/**
 * Build a URL for static files in /public (e.g. assets/img/...).
 * Uses APP_URL so paths stay correct if the app is not at the domain root.
 */
export function voltzAsset(path: string): string {
  const base = (import.meta.env.APP_URL || '').replace(/\/$/, '')
  const normalized = path.replace(/^\//, '')

  if (!base) {
    return `/${normalized}`
  }

  return `${base}/${normalized}`
}

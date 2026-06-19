import { getBaseUrl, removeTrailingSlash } from '@creopse/utils'

// Server
export var API_BASE_URL = removeTrailingSlash(
  import.meta.env.APP_URL || getBaseUrl()
)

export var API_URL = `${API_BASE_URL}/api`

// Local Storage Keys
export const LANG_KEY = 'Lang'

// Encryption Keys
export const STORE_ENCRYPTION_KEY = 'fb8c9dd4-fef4-4b88-a9b8-fe5725f9e0c1'

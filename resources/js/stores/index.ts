import { STORE_ENCRYPTION_KEY } from '@/constants'
import { gcm } from '@noble/ciphers/aes.js'
import { randomBytes } from '@noble/ciphers/utils.js'
import { sha256 } from '@noble/hashes/sha2.js'
import { createPinia } from 'pinia'
import { persistencePlugin } from 'pinia-persistence-plugin'

declare module 'pinia' {
  export interface PiniaCustomProperties {
    router: any
  }
}

const getDerivedKey = () =>
  sha256(new TextEncoder().encode(STORE_ENCRYPTION_KEY))

const encrypt = (value: string): string => {
  const nonce = randomBytes(12)
  const cipher = gcm(getDerivedKey(), nonce)
  const encrypted = cipher.encrypt(new TextEncoder().encode(value))

  const combined = new Uint8Array(nonce.length + encrypted.length)
  combined.set(nonce)
  combined.set(encrypted, nonce.length)

  return btoa(String.fromCharCode(...combined))
}

const decrypt = (value: string): string => {
  const combined = Uint8Array.from(atob(value), (c) => c.charCodeAt(0))
  const nonce = combined.slice(0, 12)
  const ciphertext = combined.slice(12)
  const cipher = gcm(getDerivedKey(), nonce)

  return new TextDecoder().decode(cipher.decrypt(ciphertext))
}

export default createPinia().use(
  persistencePlugin({
    storeKeysPrefix: 'creopse-app',
    persistenceDefault: true,
    ensureAsyncStorageUpdateOrder: false,
    storageItemsDefault: [
      {
        storage: {
          getItem: (key: string) => {
            try {
              const encrypted = localStorage.getItem(key)
              return encrypted ? decrypt(encrypted) : encrypted
            } catch (error) {
              console.error(error)
            }
          },
          setItem: (key: string, value: any) => {
            try {
              return localStorage.setItem(key, encrypt(value))
            } catch (error) {
              console.error(error)
            }
          },
          removeItem: (key: string) => {
            try {
              return localStorage.removeItem(key)
            } catch (error) {
              console.error(error)
            }
          },
        },
      },
    ],
  }),
)

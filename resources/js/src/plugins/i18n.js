import { createI18n } from 'vue-i18n'
import en from '@/lang/en.json'


export const messages = {
  en
}

const i18n = createI18n({
  locale: localStorage.getItem('app:locale') || 'en',
  fallbackLocale: 'en',
  silentFallbackWarn: true,
  silentTranslationWarn: true,
  messages
})

window.$trans = function (text, options = null) {
  return i18n.tc(text, 1, options)
}

window.trans = function (text, options = null) {
  return i18n.tc(text, 1, options)
}

window.trans_choice = function (text, count = 1, options = null) {
  return i18n.tc(text, count, options)
}

export default i18n

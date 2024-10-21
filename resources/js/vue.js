import { createApp } from 'vue'
import Counter from './app/components/Counter.vue'

const app = createApp()
app.component('counter', Counter)
app.mount('#app')

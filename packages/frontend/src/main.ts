import { createApp } from 'vue'
import App from './App.vue'
import { store } from './stores/index'
import './assets/main.css'

const app = createApp(App)
app.use(store)

app.mount('#app')

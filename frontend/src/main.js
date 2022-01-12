/**
 * MAIN 
 * 
 * This is the entry-point for the Vuejs application. 
 * All libraries and the main "App" component are 
 * imported and boostrapped here. 
 */
import Vue from 'vue'

/**
 * UI libraries
 * Using bootstrap-vue to make things easier.
 */
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

/**
 * Import service layer.
 * Accessible in any component via this.$http
 */
import service from './services/product.service.js'
Vue.prototype.$http = service
Vue.config.productionTip = false

/**
 * Import App.
 */
import App from './App.vue'

/**
 * Mount the Vue instance.
 */
new Vue({
  render: h => h(App),
}).$mount('#app')

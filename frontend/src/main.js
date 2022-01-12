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
 * Http Client
 * Using axios library.
 * Accessible in any component via this.$http
 */
import client from './plugins/axios'
Vue.prototype.$http = client
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

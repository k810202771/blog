// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import {ajax} from './assets/js/ajax.js'
import {enhtml,dehtml} from './assets/js/htmlcodec.js'

Vue.prototype.$ajax = ajax;
Vue.prototype.$enhtml = enhtml;
Vue.prototype.$dehtml = dehtml;

Vue.config.productionTip = false

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  components: { App },
  template: '<App/>'
})

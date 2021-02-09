import Vue from 'vue'
import App from './App.vue'
import router from "./router"

import 'element-ui/lib/theme-chalk/index.css';
import {
  Backtop,
  Icon,
  Input,
  Pagination,
  Button,
  Divider
} from 'element-ui';

Vue.use(Backtop)
Vue.use(Icon)
Vue.use(Input)
Vue.use(Pagination)
Vue.use(Button)
Vue.use(Divider)

import infiniteScroll from "vue-infinite-scroll";
Vue.use(infiniteScroll);

import VueCookies from 'vue-cookies'
Vue.use(VueCookies)

import "@/assets/scss/common.scss";
import store from "@/assets/vuex/store"

/**
 * 通信
 */
import bus from "./assets/bus/bus"
Vue.prototype.$bus = bus;

Vue.prototype.$api = "https://接口地址/blog/"
Vue.prototype.$host = "https://前台地址/"
Vue.prototype.$wss = "wss://socket地址"

import MetaInfo from 'vue-meta-info'
Vue.use(MetaInfo)

new Vue({
  router,
  store,
  render: h => h(App),
  mounted() {
    document.dispatchEvent(new Event('render-event'))
  }
}).$mount('#app')
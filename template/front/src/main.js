import Vue from 'vue'
import App from './App.vue'
import router from "./router"

// Vue.config.productionTip = false

import {
  MessageBox,
  Input,
  Drawer,
  Tag,
  Backtop,
  Icon,
  Divider,
  Pagination,
  Button,
  Dialog

} from 'element-ui';
Vue.use(Input);
Vue.use(Drawer);
Vue.use(Tag);
Vue.use(Backtop);
Vue.use(Icon);
Vue.use(Divider);
Vue.use(Pagination);
Vue.use(Button);
Vue.use(Dialog);



Vue.prototype.$msgBox = MessageBox;
import {
  msg
} from "@/assets/js/message"
Vue.prototype.$msg = msg


router.beforeEach((to, from, next) => {
  if (to.meta.title) {
    document.title = "糊涂个人博客|" + to.meta.title;
  }
  next();
});


import "@/assets/scss/iconfont.scss";

Vue.prototype.$api = "http://localhost:88/chatroom/public/"

import store from "@/assets/vuex/store"
new Vue({
  router,
  store,
  render: h => h(App),
}).$mount('#app')
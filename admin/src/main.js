import Vue from 'vue'
import App from './App.vue'
import router from "./router"

import 'element-ui/lib/theme-chalk/index.css';
import {
  MessageBox,
  Input,
  Container,
  Button,
  Menu,
  MenuItem,
  Submenu,
  MenuItemGroup,
  Table,
  TableColumn,
  Dialog,
  Tabs,
  TabPane,
  Aside,
  Header,
  Main,
  Footer,
  Switch,
  Pagination,
  Select,
  Option,
  Loading,
  Form,
  FormItem,
  Checkbox,
  CheckboxGroup,
  Drawer,
  Tag,
  Avatar,
  Dropdown,
  DropdownMenu,
  DropdownItem,
  Tooltip,
  DatePicker

} from 'element-ui';
Vue.use(Input);
Vue.use(Container);
Vue.use(Button);
Vue.use(Menu);
Vue.use(MenuItem)
Vue.use(Submenu);
Vue.use(MenuItemGroup);
Vue.use(Table);
Vue.use(TableColumn)
Vue.use(Dialog);
Vue.use(Tabs);
Vue.use(TabPane);
Vue.use(Aside);
Vue.use(Header);
Vue.use(Main);
Vue.use(Footer);
Vue.use(Switch);
Vue.use(Pagination);
Vue.use(Select)
Vue.use(Option)
Vue.use(Loading)
Vue.use(Form)
Vue.use(FormItem)
Vue.use(Checkbox)
Vue.use(CheckboxGroup)
Vue.use(Drawer)
Vue.use(Tag)
Vue.use(Avatar)
Vue.use(Avatar)
Vue.use(Dropdown)
Vue.use(DropdownMenu)
Vue.use(DropdownItem)
Vue.use(Tooltip)
Vue.use(DatePicker)
Vue.prototype.$msgBox = MessageBox;


let echarts = require("echarts/lib/echarts")
// import "@/assets/js/wonderland.js";
import 'echarts/lib/chart/line' // 折线图
import 'echarts/lib/chart/bar' // 柱形图
import 'echarts/lib/chart/pie' // 饼状图
import 'echarts/lib/component/title'
import 'echarts/lib/component/legend'
import 'echarts/lib/component/tooltip'
import 'echarts/lib/component/dataZoom'
import 'echarts/lib/component/toolbox'
import 'echarts/lib/component/markLine'
import 'echarts/lib/component/markPoint'
import 'zrender/lib/svg/svg'
import "echarts/map/js/china"

import VueCookies from 'vue-cookies'
Vue.use(VueCookies)

Vue.prototype.$echarts = echarts
router.beforeEach((to, from, next) => {
  if (to.meta.title) {
    document.title = "糊涂个人博客后台管理系统|" + to.meta.title;
  }
  next();
});

import "@/assets/scss/common.scss";
import store from "@/assets/vuex/store"
import "@/assets/js/directives.js"

Vue.prototype.$wss = "wss://socket地址"

new Vue({
  router,
  store,
  render: h => h(App),
}).$mount('#app')
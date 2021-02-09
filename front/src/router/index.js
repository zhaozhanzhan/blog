import Vue from "vue";
import Router from "vue-router"
Vue.use(Router)

const routerPush = Router.prototype.push
Router.prototype.push = function push(location) {
    return routerPush.call(this, location).catch(error => error)
}

const router = new Router({
    mode: "history",
    base: "v1",
    routes: [{
        path: '/',
        name: 'index',
        component: () => import("@/components/Index.vue"),
        meta: {
            title: "首页"
        },
        children: [{
            path: '/home',
            name: 'home',
            component: () => import("../components/Home.vue"),
            meta: {
                title: "首页"
            },
        }, {
            path: '/message',
            name: 'message',
            component: () => import("../components/Message.vue"),
            meta: {
                title: "留言板"
            },
        }, {
            path: '/link',
            name: 'link',
            component: () => import("../components/Link.vue"),
            meta: {
                title: "友链"
            },
        }, {
            path: '/about',
            name: 'about',
            component: () => import("../components/About.vue"),
            meta: {
                title: "关于"
            },
        }, {
            path: '/article-detail',
            name: 'article-detail',
            component: () => import("../components/ArticleDetail.vue"),
            meta: {
                title: "文章详情"
            },
        }, ]
    }, ]
})

export default router;
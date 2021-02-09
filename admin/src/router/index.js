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
        name: 'login',
        component: () => import("@/components/Login.vue"),
        meta: {
            title: "欢迎回来！"
        },
    }, {
        path: '/home',
        name: 'home',
        component: () => import("@/components/Home.vue"),
        meta: {
            title: "首页"
        },
        children: [{
            path: '/panel',
            name: 'panel',
            component: () => import("@/components/Panel.vue"),
            meta: {
                title: "控制面板"
            },
        }, {
            path: '/statistics',
            name: 'statistics',
            component: () => import("@/components/Statistics.vue"),
            meta: {
                title: "统计分析"
            },
        }, {
            path: '/user-pc',
            name: 'user-pc',
            component: () => import("@/components/UserPc.vue"),
            meta: {
                title: "PC端用户"
            },
        }, {
            path: '/user-wechat',
            name: 'user-wechat',
            component: () => import("@/components/UserWechat.vue"),
            meta: {
                title: "WeChat端用户"
            },
        }, {
            path: '/article',
            name: 'article',
            component: () => import("@/components/Article.vue"),
            meta: {
                title: "文章列表"
            },
        }, {
            path: '/comment',
            name: 'comment',
            component: () => import("@/components/Comment.vue"),
            meta: {
                title: "评论管理"
            },
        }, {
            path: '/message',
            name: 'message',
            component: () => import("@/components/Message.vue"),
            meta: {
                title: "留言列表"
            },
        }, {
            path: '/type-article',
            name: 'type-article',
            component: () => import("@/components/TypeArticle.vue"),
            meta: {
                title: "文章类别"
            },
        }, {
            path: '/type-log',
            name: 'type-log',
            component: () => import("@/components/TypeLog.vue"),
            meta: {
                title: "日志类别"
            },
        }, {
            path: '/link',
            name: 'link',
            component: () => import("@/components/Link.vue"),
            meta: {
                title: "链接列表"
            },
        }, {
            path: '/resources',
            name: 'resources',
            component: () => import("@/components/Resources.vue"),
            meta: {
                title: "静态资源"
            },
        }, {
            path: '/info',
            name: 'info',
            component: () => import("@/components/Info.vue"),
            meta: {
                title: "关于"
            },
        }, {
            path: '/log',
            name: 'log',
            component: () => import("@/components/Log.vue"),
            meta: {
                title: "日志"
            },
        }]
    }, ]
})

router.beforeEach((to, from, next) => {
    if (to.path === "/") {
        next();
    } else {
        const token = localStorage.getItem('authExpiresTime');
        if (token === null || token === '') {
            next('/');
        } else {
            next();
        }
    }
});

export default router;
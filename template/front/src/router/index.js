import Vue from "vue";
import Router from "vue-router";

Vue.use(Router)

const routerPush = Router.prototype.push
Router.prototype.push = function push(location) {
    return routerPush.call(this, location).catch(error => error)
}

const router = new Router({
    mode: "history",
    base: process.env.BASE_URL,
    routes: [
        //     {
        //     path: '/',
        //     name: 'home',
        //     component: () => import("@/components/home.vue"),
        //     meta: {
        //         title: "首页"
        //     },
        // },
    ]
})
// router.beforeEach((to, from, next) => {
//     if (to.path === '/login' || to.path === "/" || to.path === "/register") {
//         next();
//     } else {
//         let token = localStorage.getItem('Authorization');
//         if (token === null || token === '') {
//             next('/');
//         } else {
//             next();
//         }
//     }
// });

export default router;
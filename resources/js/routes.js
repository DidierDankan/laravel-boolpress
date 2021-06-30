// Dipendenze
import Vue from "vue";
import VueRouter from "vue-router";
import Home from "./pages/Home.vue";
import About from "./pages/About.vue";
import Blog from "./pages/Blog.vue";
import PostDetail from "./pages/PostDetail.vue";
import NotFound from "./pages/NotFound.vue";

//attivazzione
Vue.use(VueRouter);

//definizzione delle routes
const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/",
            component: Home,
            name: "home"
        },
        {
            path: "/about",
            component: About,
            name: "about"
        },
        {
            path: "/blog",
            component: Blog,
            name: "blog"
        },
        {
            path: "/blog/:slug",
            component: PostDetail,
            name: "post-detail"
        },
        {
            path: "*",
            component: NotFound // questa è la route per il 404 not found
        }
    ]
});
export default router;

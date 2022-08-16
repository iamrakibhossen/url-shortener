import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

import Index from "./pages/Index";
import About from "./pages/About";
import Login from "./pages/Login";
import Register from "./pages/Register";
import ForgotPassword from "./pages/forgotPassword";
import ResetPassword from "./pages/resetPassword";

const routes = [
    { path: "/", component: Index },
    { path: "/about", component: About },
    { path: "/login", component: Login },
    { path: "/register", component: Register },
    { path: "/forgot-password", component: ForgotPassword },
    { path: "/password/reset/:token", component: ResetPassword },
];

const router = new VueRouter({
    routes,
    hashbang: false,
    mode: "history",
});

router.beforeEach((to, from, next) => {
    let middelware = to.matched[0].components.default.middelware;

    if (middelware == "guest") {
        if (window.loggedIn) {
            next("/");
        } else {
            next();
        }
    }

    if (middelware == "auth") {
        if (window.loggedIn) {
            next();
        } else {
            next("/login");
        }
    }

    next();
});

export default router;

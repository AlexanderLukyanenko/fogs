import VueRouter from 'vue-router'
import Home from "../components/Home";
import News from "../components/News/News";
import ShowNews from "../components/News/ShowNews";
import Login from "../components/Auth/Login";
import Register from "../components/Auth/Register";
import NotFound from "../components/Layouts/NotFound";
import Profile from "../components/Profile";

const routes = [
    {
        path: '/',
        name: 'home',
        component: Home,
    },
    {
        path: '/news',
        name: 'news',
        component: News,
    },
    {
        path: '/news/:id',
        name: 'showNews',
        component: ShowNews,
    },
    {
        path: '/profile',
        name: 'profile',
        component: Profile,
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
    },
    {
        path: '/register',
        name: 'register',
        component: Register,
    },
    {
        path: '/404',
        name: '404',
        component: NotFound,
    },
    {
        path: '*',
        redirect: '/404'
    }
];

const router = new VueRouter({
    history: true,
    mode: 'history',
    routes,
});

export default router

import { createRouter, createWebHistory } from 'vue-router';

const Login = () => import("./Pages/Login.vue");
const IndexUser = () => import("./Pages/Users/IndexUser.vue");
const IndexVisit = () => import("./Pages/Visits/IndexVisit.vue");
const Index = () => import("./Pages/Index.vue")
import checkAuth from "./Utils/ValidarToken.js"
import ShowUser from './Pages/Users/ShowUser.vue';
const routes = [
    { name: 'login', path: '/', component: Login },
    { name: 'dashboard', path: '/dashboard', component: Index, meta: { requiresAuth: true } },
    { name: 'users', path: '/users', component: IndexUser },
    { name: 'visits', path: '/visits', component: IndexVisit },
    // { name: 'users/show', path: '/users/:id', component: ShowUser }
];

// Crear la instancia del router
const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});
router.beforeEach(async (to, from, next) => {
    console.log('Navegando a:', to.fullPath)

    const isAuthenticated = await checkAuth();
    console.log(isAuthenticated)

    if (to.meta.requiresAuth && !isAuthenticated) {
        next({ name: 'login' })
    } else {
        next()
    }
})



// 👇 Finalmente se exporta el router
export default router


import { createRouter, createWebHistory } from 'vue-router';

const Login = () => import("./Pages/Login.vue");
const IndexUser = () => import("./Pages/Users/IndexUser.vue");
const Index =()=>import("./Pages/Index.vue")

const routes=[
    {name:'login',path:'/',component:Login},
    {name:'dashboard',path:'/dashboard',component:Index,meta:{requiresAuth: true }},
    {name:'show',path:'/users/:id',component:IndexUser}
];

// Crear la instancia del router
const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});
router.beforeEach(async (to, from, next) => {
  console.log('Navegando a:', to.fullPath)

  const isAuthenticated = await checkAuth()
  console.log('¿Está autenticado?', isAuthenticated)

  if (to.meta.requiresAuth && !isAuthenticated) {
    next({ name: 'login' })
  } else {
    next()
  }
})

async function checkAuth() {
  try {
    const response = await fetch('/api/user', {
      credentials: 'include',
      headers: {
        Accept: 'application/json'
      }
    })

    return response.ok
  } catch (error) {
    return false
  }
}

// 👇 Finalmente se exporta el router
export default router


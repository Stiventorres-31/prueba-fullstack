const Login = () => import("./Pages/Login.vue");
const IndexUser = () => import("./Pages/Users/IndexUser.vue");
const Index =()=>import("./Pages/Index.vue")


export const routes=[
    {name:'login',path:'/',component:Login},
    {name:'dashboard',path:'/dashboard',component:Index,meta:{requiresAuth: true }},
    {name:'show',path:'/users/:id',component:IndexUser}
];

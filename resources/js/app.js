// main.js

import './bootstrap';
import { createApp } from 'vue';
import App from './App.vue';

import { createRouter, createWebHistory } from 'vue-router';
import { routes } from './routes.js';

// Crear la instancia del router
const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

// Crear y montar la app
const app = createApp(App);
app.use(router);
app.mount('#app');

// import { createApp } from 'vue';
// import AppLayout from './Layouts/AppLayout.vue';
// import VisitMap from './Pages/VisitMap.vue';


// createApp(VisitMap).mount('#app');

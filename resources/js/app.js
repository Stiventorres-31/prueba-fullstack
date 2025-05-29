// main.js

import './bootstrap';
import { createApp } from 'vue';
import App from './App.vue';


import router  from './routes.js';


// Crear y montar la app
const app = createApp(App);
app.use(router)
app.mount('#app');


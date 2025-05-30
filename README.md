# Prueba Fullstack

Este proyecto consiste en el desarrollo de una API RESTful y una interfaz web construidas con Laravel 12, MySQL y Vue.js, orientadas a la gestión de visitas de clientes. La solución incluye un sistema de autenticación segura y una visualización de ubicaciones en un mapa interactivo.

## Funcionalidades
- Autenticación de usuarios con protección de rutas API.
- CRUD completo para la gestión de visitas:
    - Crear nuevas visitas.
    - Consultar todas las visitas o una visita específica.
    - Actualizar información de visitas.
    - Eliminar visitas registradas.

- Visualización en mapa:

    - Renderizado de las visitas como marcadores.
    - Popups interactivos mostrando nombre y correo electrónico.

- Comando Artisan:
    - Crear visitas desde consola con validación de datos.

## Características

- **Frontend:** Construido con tecnologías modernas para una experiencia de usuario óptima.
- **Backend:** API robusta para gestionar datos y lógica de negocio.
- **Base de datos:** Integre la base de datos de MySQl
- **Autenticación:** La autenticacion es con sanctum

## Instalación

1. Clona el repositorio:
    ```bash
    git clone https://github.com/tu-usuario/prueba-fullstack.git
    ```
2. Instala las dependencias:
    ```bash
    npm install
    composer install
    ```

## Uso

1. Inicia el backend:
    ```bash
    php artisan serve
    ```
2. Inicia el frontend:
    ```bash
    npm run dev
    ```

## Tecnologías utilizadas

- Vuejs
- Laravel 12
- Leaflet
- Mysql
- Sanctum
- Tailwindcss

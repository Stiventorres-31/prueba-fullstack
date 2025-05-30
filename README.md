# Prueba Fullstack

Este proyecto consiste en el desarrollo de una API RESTful y una interfaz web construidas con Laravel 12, MySQL y Vue.js, orientadas a la gestión de visitas de clientes.

## Arquitectura del Proyecto

El proyecto fue desarrollado utilizando una **Arquitectura en Capas**, implementando el **Patrón Service-Repository**, siguiendo principios de diseño limpio y buenas prácticas:

- **Capa de Controladores**: Manejo de solicitudes HTTP y delegación de la lógica a servicios.
- **Capa de Servicios**: Contiene la lógica de negocio, aislada de los controladores y de la base de datos.
- **Capa de Repositorios**: Encapsula el acceso a datos, interactuando directamente con los modelos.
- **Capa de Interfaces**: Define contratos (interfaces) que deben cumplir los servicios y repositorios, facilitando el desacoplamiento y la inyección de dependencias.
- **Capa de Modelos**: Representaciones de las entidades y su mapeo a las tablas de la base de datos.
- **Capa de Helpers**: Funciones utilitarias que apoyan a diferentes componentes de la aplicación.


## Funcionalidades
- Autenticación de usuarios con protección de rutas API.
- CRUD completo para la gestión de visitas:
    - Crear nuevas visitas.
    - Consultar todas las visitas o una visita específica.
    - Paginacion para mostrar todas las visitas
    - Actualizar información de visitas.
    - Eliminar visitas registradas.

- CRUD completo para la gestión de usuarios:
    - Crear un usuario.
    - Consultar todos los usuarios o un usuario específico.
    - Actualizar información del usuario.
    - Eliminar usuarios registrados.
- Visualización en mapa:

    - Renderizado de las visitas como marcadores.
    - Popups interactivos mostrando nombre y correo electrónico.

- Comando Artisan:
    - Crear visitas desde consola con validación de datos.
- Testing
    - Testing unit
    - Testing Feature

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
Lo primero es correr las migraciones y los seeders
1. Migraciones y Seeders
    ```bash
    php artisan migrate --seed
    ```
2. Inicia el backend:
    ```bash
    php artisan serve
    ```
3. Inicia el frontend:
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

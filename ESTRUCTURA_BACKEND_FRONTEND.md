# Estructura Backend y Frontend

Este proyecto mantiene la estructura original de Laravel. No conviene separar fisicamente `backend/` y `frontend/` porque romperia rutas, autoload, vistas y despliegue.

## Backend

- `app/app/Http/Controllers`: controladores y logica HTTP
- `app/app/Http/Middleware`: middlewares y control de acceso
- `app/app/Models`: modelos Eloquent
- `app/routes`: rutas web y consola
- `app/database/migrations`: estructura de base de datos
- `app/database/seeders`: datos iniciales
- `app/database/factories`: fabricas para pruebas o seeders
- `app/bootstrap`: arranque de Laravel

## Frontend

- `app/resources/views`: vistas Blade
- `app/resources/views/layouts`: layouts base
- `app/resources/views/partials`: componentes visuales compartidos
- `app/resources/views/components`: modales y fragmentos reutilizables
- `app/resources/css`: fuentes de estilos
- `app/resources/js`: scripts fuente
- `app/public/css`: CSS publico servido al navegador
- `app/public/build`: assets compilados para produccion

## Puente del Proyecto

- `index.php`: redirige hacia `app/public/index.php`
- `.htaccess`: resuelve el acceso publico desde la raiz del proyecto
- `app/public/index.php`: punto de entrada real de Laravel

## Regla Practica

- Si cambia logica, validaciones, rutas o base de datos: es backend
- Si cambia vistas, estilos, modales o interacciones del navegador: es frontend
- Si cambia `public/`: es entrega final al navegador
- Si cambia `resources/`: es fuente de frontend

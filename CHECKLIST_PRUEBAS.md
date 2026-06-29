# Checklist de Pruebas: Pantallas Emergentes (Modales)

## Pruebas de Productos

### ✅ Visualizar Producto
- [ ] Hacer clic en botón "Ver" en la tabla de productos
- [ ] Verificar que se abre modal con título "Detalles del Producto"
- [ ] Verificar que se muestra: SKU, nombre, categoría, precio, stock, estado
- [ ] Verificar que se muestra información de auditoría (fechas)
- [ ] Hacer clic en "Cerrar" para cerrar el modal
- [ ] Verificar que la página no se recarga

### ✅ Editar Producto
- [ ] Hacer clic en botón "Editar" en la tabla de productos
- [ ] Verificar que se abre modal con formulario rellenable
- [ ] Verificar que todos los campos están precargados con datos actuales
- [ ] Modificar un campo (ej: nombre)
- [ ] Hacer clic en "Guardar cambios"
- [ ] Verificar que se muestra mensaje de éxito
- [ ] Verificar que la tabla se actualiza automáticamente
- [ ] Verificar que el cambio persiste al recargar la página

### ✅ Eliminar Producto
- [ ] Hacer clic en botón "Eliminar" en la tabla de productos
- [ ] Verificar que se abre modal de confirmación con diseño de alerta roja
- [ ] Verificar que muestra nombre del producto a eliminar
- [ ] Hacer clic en "Cancelar"
- [ ] Verificar que el modal se cierra sin eliminar
- [ ] Hacer clic nuevamente en "Eliminar"
- [ ] Hacer clic en "Eliminar" en el modal de confirmación
- [ ] Verificar que el producto se elimina
- [ ] Verificar que la tabla se actualiza automáticamente
- [ ] Verificar que el producto no aparece más en la lista

---

## Pruebas de Perfil Administrador

### ✅ Visualizar Perfil
- [ ] Navegar a la página de perfil
- [ ] Verificar que muestra información actual del usuario en tarjeta
- [ ] Verificar que muestra rol del usuario (admin)
- [ ] Verificar que hay botón "Editar" en Información Personal
- [ ] Verificar que hay botón "Eliminar" en Eliminar Cuenta

### ✅ Editar Perfil
- [ ] Hacer clic en "Editar" en Información Personal
- [ ] Verificar que se abre modal "Perfil del Administrador"
- [ ] Verificar que campos están precargados (nombre, email, rol)
- [ ] Modificar nombre
- [ ] Hacer clic en "Guardar cambios"
- [ ] Verificar que se muestra mensaje de éxito
- [ ] Verificar que la información se actualiza en la tarjeta
- [ ] Verificar que el nombre cambió en la barra superior

### ✅ Cambiar Contraseña
- [ ] Abrir modal de perfil (clic en "Editar")
- [ ] Dejar campos de contraseña vacíos
- [ ] Hacer clic en "Guardar cambios"
- [ ] Verificar que no pide contraseña actual
- [ ] Llenar campo "Contraseña actual"
- [ ] Llenar campo "Nueva contraseña"
- [ ] Dejar "Confirmar nueva contraseña" en blanco
- [ ] Hacer clic en "Guardar cambios"
- [ ] Verificar que muestra error de validación
- [ ] Llenar "Confirmar nueva contraseña" (distinto a "Nueva contraseña")
- [ ] Hacer clic en "Guardar cambios"
- [ ] Verificar que muestra error: las contraseñas no coinciden
- [ ] Llenar "Confirmar nueva contraseña" correctamente (igual a "Nueva contraseña")
- [ ] Hacer clic en "Guardar cambios"
- [ ] Verificar que se actualiza correctamente
- [ ] Cerrar sesión e iniciar sesión con nueva contraseña

### ✅ Eliminar Cuenta
- [ ] Hacer clic en "Eliminar" en Eliminar Cuenta
- [ ] Verificar que se abre modal de confirmación
- [ ] Verificar que muestra "¿Está seguro de que desea eliminar la cuenta...?"
- [ ] Hacer clic en "Cancelar"
- [ ] Verificar que el modal se cierra sin eliminar cuenta
- [ ] Hacer clic nuevamente en "Eliminar"
- [ ] Hacer clic en "Eliminar" en el modal de confirmación
- [ ] Verificar que se redirige a página de inicio
- [ ] Verificar que se muestra mensaje de éxito
- [ ] Intentar iniciar sesión con la cuenta eliminada
- [ ] Verificar que no se puede iniciar sesión

---

## Pruebas de Responsividad

### ✅ Desktop (1920x1080)
- [ ] Todos los modales se abren correctamente
- [ ] Los formularios se ven bien
- [ ] Los botones son clickeables

### ✅ Tablet (768x1024)
- [ ] Los modales se ajustan al tamaño de pantalla
- [ ] El contenido es legible
- [ ] Los botones son clickeables

### ✅ Móvil (375x667)
- [ ] Los modales ocupan casi toda la pantalla
- [ ] El contenido es scrollable si es necesario
- [ ] Los botones son clickeables (no muy pequeños)
- [ ] Los campos del formulario son fáciles de rellenar

---

## Pruebas de Seguridad

### ✅ CSRF Protection
- [ ] Verificar que todos los formularios tienen token CSRF
- [ ] Intentar completar formulario sin token (no debería funcionar)

### ✅ Validación Backend
- [ ] Intentar enviar producto con nombre vacío desde modal
- [ ] Verificar que se muestra error de validación
- [ ] Intentar enviar producto con SKU duplicado
- [ ] Verificar que se muestra error de validación

### ✅ Autorización
- [ ] Cerrar sesión
- [ ] Intentar acceder a /products/1/show
- [ ] Verificar que redirige a login

---

## Pruebas de Manejo de Errores

### ✅ Error de Conexión
- [ ] Simular error de red (DevTools)
- [ ] Intentar abrir modal de visualización
- [ ] Verificar que muestra mensaje de error

### ✅ Error del Servidor
- [ ] Modificar producto con datos inválidos (si hay validación backend)
- [ ] Verificar que muestra mensaje de error apropiado

---

## Pruebas de Rendimiento

### ✅ Carga de Modales
- [ ] Abrir y cerrar modal rápidamente 10 veces
- [ ] Verificar que no hay memory leaks
- [ ] Verificar que los modales se cargan instantáneamente

### ✅ AJAX Requests
- [ ] Abrir Developer Tools -> Network
- [ ] Hacer click en "Ver" producto
- [ ] Verificar que solo se hace 1 request AJAX
- [ ] Verificar que el request completa en menos de 100ms

---

## Pruebas de Compatibilidad de Navegadores

- [ ] Chrome/Edge (Chromium)
- [ ] Firefox
- [ ] Safari (si es posible)

---

## Notas Finales

Si todas las pruebas pasan:
✅ La implementación de modales está completa y funcionando correctamente
✅ La seguridad está garantizada
✅ La UX es óptima
✅ Está listo para producción

Si hay algún fallo:
📝 Revisar los logs del servidor
📝 Verificar la consola de JavaScript (F12)
📝 Revisar los requests AJAX en Network
📝 Contactar al equipo de desarrollo

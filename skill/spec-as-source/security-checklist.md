# Checklist — Capa de seguridad

Aplicar al final de **cada etapa** antes de avanzar. Todo ítem marcado "N/A" debe justificarse en la spec.

## Entradas y validación

- [ ] Todas las entradas de usuario están validadas (tipo, longitud, formato)
- [ ] No se confía en datos del cliente para autorización
- [ ] Mensajes de error no exponen stack traces ni datos internos en producción

## Autenticación y autorización

- [ ] Rutas/endpoints protegidos verifican identidad cuando aplica
- [ ] Permisos verificados en servidor, no solo en UI
- [ ] Sesiones/tokens con expiración y revocación consideradas

## Inyección y XSS

- [ ] Consultas parametrizadas o ORM seguro (sin concatenación SQL)
- [ ] Salida HTML escapada o sanitizada
- [ ] Comandos de sistema no construidos con input de usuario

## Secretos y configuración

- [ ] Sin credenciales, API keys ni tokens en código fuente
- [ ] Variables sensibles en `.env` (y `.env` en `.gitignore`)
- [ ] `spec/` y `skill/` no contienen secretos

## Dependencias y archivos

- [ ] Dependencias nuevas justificadas en la spec
- [ ] Sin archivos de backup ni temporales con datos sensibles
- [ ] Uploads validados (tipo, tamaño, ubicación) si aplica

## CSRF y transporte

- [ ] Formularios/acciones mutables protegidos contra CSRF cuando aplica
- [ ] HTTPS asumido en despliegue; sin datos sensibles en query strings

## Criterio de bloqueo

**No avanzar de etapa** si:

- Se detecta secreto hardcodeado
- Existe vector de inyección sin mitigación
- Endpoint expone datos sin control de acceso definido en la spec

## Registro de hallazgos

```markdown
| Fecha | Etapa | Hallazgo | Severidad | Estado |
|-------|-------|----------|-----------|--------|
| YYYY-MM-DD | N | [Descripción] | Alta/Media/Baja | Abierto/Corregido |
```

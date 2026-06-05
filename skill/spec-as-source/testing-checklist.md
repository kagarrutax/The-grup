# Checklist — Capa de testing

Aplicar al final de **cada etapa** antes de avanzar. Marcar en la spec o en el reporte al usuario.

## Definición de pruebas (en la spec)

- [ ] La etapa declara pruebas unitarias concretas
- [ ] La etapa declara pruebas funcionales concretas
- [ ] Cada prueba tiene resultado esperado explícito

## Ejecución

- [ ] Pruebas unitarias implementadas o actualizadas en `app/`
- [ ] Pruebas funcionales implementadas o actualizadas en `app/`
- [ ] Todas las pruebas de la etapa pasan localmente
- [ ] No se introdujeron regresiones en pruebas previas

## Cobertura mínima por tipo de cambio

| Tipo de cambio | Unitarias | Funcionales |
|----------------|-----------|-------------|
| Nueva función/método | Casos normales + borde | Flujo que la usa |
| Corrección de bug | Caso que reproduce el bug | Escenario end-to-end |
| API/endpoint | Request/response válidos e inválidos | Cliente o integración |
| UI/componente | Render y eventos clave | Flujo de usuario crítico |

## Criterio de bloqueo

**No avanzar de etapa** si:

- Falta alguna prueba declarada en la spec
- Alguna prueba falla sin causa documentada
- El cambio no tiene al menos una prueba que valide el comportamiento nuevo

## Registro

Documentar en la spec:

```markdown
| Fecha | Etapa | Pruebas ejecutadas | Resultado |
|-------|-------|-------------------|-----------|
| YYYY-MM-DD | N | unit: X, func: Y | PASS / FAIL |
```

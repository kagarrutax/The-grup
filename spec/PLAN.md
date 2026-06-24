# PLAN — spec/ y organización del repositorio

## Encargado

| Integrante | Rol | Responsabilidad |
|------------|-----|-----------------|
| **Adrian** | GitHub y organización | Repo, ramas, README raíz, `.gitignore`, releases |
| **Adrian** | Revisión e integración de código | PRs, merges, tests en verde |

## Participación GitHub y documentación

| Integrante | Rol | Participación en esta carpeta |
|------------|-----|-------------------------------|
| **Yadira** | Documentación y presentación | Verificar que specs y docs estén alineados |
| **Verenice** | Líder y desarrolladora principal | Mantener spec 001 actualizada por fase |

## Despliegue Railway (documentar en README)

1. Proyecto en GitHub
2. railway.app → Deploy from GitHub
3. Servicio MySQL en panel
4. Variables: `DATABASE_URL`, `APP_KEY`
5. Start command:
   ```
   php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=$PORT
   ```

## Convenciones Git

| Elemento | Convención |
|----------|------------|
| Ramas | `feat/categories`, `feat/stock`, `feat/dashboard` |
| Commits | `feat:`, `fix:`, `docs:`, `test:` |
| Merge | Solo con PR revisado y tests OK |

## Spec activa

[`001-inventario-supermercado.md`](001-inventario-supermercado.md)

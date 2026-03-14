# Contribuir al ECF DGII PHP SDK

Gracias por tu interes en contribuir! Aqui te explicamos como hacerlo.

## Reportar Bugs

Usa [GitHub Issues](https://github.com/SSD-Smart-Software-Development-SRL/ecf-dgii-php/issues) con la plantilla de bug report. Incluye:

- Version de PHP y del SDK
- Ambiente (Test/Cert/Prod)
- Codigo minimo para reproducir el problema
- Respuesta del API si aplica

## Sugerir Mejoras

Abre un issue con la plantilla de feature request describiendo el problema que quieres resolver y la solucion propuesta.

## Desarrollo

### Requisitos

- PHP 8.1+
- Composer

### Setup

```bash
git clone https://github.com/SSD-Smart-Software-Development-SRL/ecf-dgii-php.git
cd ecf-dgii-php
composer install
```

### Tests

```bash
vendor/bin/phpunit
```

### Code Style

```bash
vendor/bin/php-cs-fixer fix
```

## Pull Requests

1. Fork el repositorio
2. Crea un branch desde `main` (`git checkout -b feature/mi-cambio`)
3. Haz tus cambios
4. Asegurate de que los tests pasen (`vendor/bin/phpunit`)
5. Commit siguiendo el [estandar de commits](#estandar-de-commits)
6. Push y abre un Pull Request contra `main`

### Lineamientos

- Los tests deben pasar antes de hacer merge
- Sigue el estilo de codigo existente
- Un PR por funcionalidad o fix
- Documenta cambios en el README si afectan el uso publico

## Estandar de Commits

Usamos [Conventional Commits](https://www.conventionalcommits.org/) para que el versionamiento automatico funcione correctamente. Cada mensaje de commit debe seguir este formato:

```
<tipo>(alcance opcional): descripcion corta
```

### Tipos permitidos

| Tipo | Descripcion | Efecto en version |
|------|-------------|-------------------|
| `feat` | Nueva funcionalidad | Minor (1.0.0 → 1.**1**.0) |
| `fix` | Correccion de bug | Patch (1.0.0 → 1.0.**1**) |
| `docs` | Solo documentacion | Sin release |
| `style` | Formato, punto y coma, etc. (sin cambio de logica) | Sin release |
| `refactor` | Cambio de codigo que no agrega funcionalidad ni corrige bug | Sin release |
| `perf` | Mejora de rendimiento | Patch |
| `test` | Agregar o corregir tests | Sin release |
| `chore` | Cambios al build, CI, dependencias, etc. | Sin release |

### Breaking changes

Para cambios que rompen compatibilidad, agrega `!` despues del tipo o `BREAKING CHANGE:` en el footer:

```
feat!: cambiar firma de sendEcf para aceptar opciones

BREAKING CHANGE: sendEcf ahora requiere un array de opciones como segundo parametro.
```

Esto genera un bump de version **major** (1.0.0 → **2**.0.0).

### Ejemplos

```bash
git commit -m "feat: agregar soporte para ECF tipo 45"
git commit -m "fix: corregir timeout en polling de respuesta"
git commit -m "docs: actualizar ejemplo de ECF32 en README"
git commit -m "chore: actualizar dependencia guzzlehttp a v7.9"
git commit -m "feat(service): agregar metodo para consultar estado de ECF"
```

## Codigo Generado

La mayor parte del codigo en `src/Model/` y `src/Api/` es auto-generado desde la especificacion OpenAPI. No edites estos archivos directamente -- los cambios se perderian al regenerar.

Archivos escritos a mano que si puedes modificar:
- `src/EcfService.php`
- `src/EcfFrontendClient.php`
- `src/EcfProcessingException.php`
- `src/EcfPollingTimeoutException.php`

## Contacto

- Email: contacto@ssd.com.do
- Issues: [GitHub Issues](https://github.com/SSD-Smart-Software-Development-SRL/ecf-dgii-php/issues)

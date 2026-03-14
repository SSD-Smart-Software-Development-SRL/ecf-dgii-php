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
5. Commit con un mensaje descriptivo
6. Push y abre un Pull Request contra `main`

### Lineamientos

- Los tests deben pasar antes de hacer merge
- Sigue el estilo de codigo existente
- Un PR por funcionalidad o fix
- Documenta cambios en el README si afectan el uso publico

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

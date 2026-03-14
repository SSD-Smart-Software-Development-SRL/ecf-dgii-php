# ECF DGII PHP SDK

<p align="center">
  <strong>PHP SDK para integrar la facturacion electronica (e-CF) en Republica Dominicana a traves de <a href="https://ecf.ssd.com.do">ECF SSD</a>.</strong>
</p>

<p align="center">
  <a href="https://packagist.org/packages/ecfx/ecf-dgii-php"><img src="https://img.shields.io/packagist/v/ecfx/ecf-dgii-php" alt="Packagist Version"></a>
  <a href="https://packagist.org/packages/ecfx/ecf-dgii-php"><img src="https://img.shields.io/packagist/dt/ecfx/ecf-dgii-php" alt="Packagist Downloads"></a>
  <a href="https://github.com/SSD-Smart-Software-Development-SRL/ecf-dgii-php/actions"><img src="https://github.com/SSD-Smart-Software-Development-SRL/ecf-dgii-php/actions/workflows/ci.yml/badge.svg" alt="CI"></a>
  <a href="LICENSE"><img src="https://img.shields.io/badge/license-MIT-blue.svg" alt="License"></a>
</p>

---

## Que es ECF SSD

[ECF SSD](https://ecf.ssd.com.do) es una plataforma que simplifica la emision de comprobantes fiscales electronicos (e-CF) en Republica Dominicana. En vez de que cada empresa implemente todo el proceso de comunicacion con la DGII (firmado XML, autenticacion por semilla, manejo de certificados, reintentos, almacenamiento, etc.), **ECF SSD lo hace por ti**.

Tu solo envias el comprobante en JSON a traves de este SDK, y el servicio se encarga de:

- Firmar el comprobante electronicamente (XML signing con tu certificado digital)
- Autenticar con la DGII (semilla -> token)
- Enviar el e-CF a la DGII
- Validar emisor-receptor
- Almacenar los comprobantes de forma segura
- Reintentar automaticamente en caso de fallos
- Gestionar tus certificados digitales

## Instalacion

```bash
composer require ecfx/ecf-dgii-php
```

### Requisitos

- PHP 8.1+
- ext-curl
- ext-json
- ext-mbstring

## Como Empezar

### Paso 1: Registrate en ECF SSD

Visita [https://ecf.ssd.com.do](https://ecf.ssd.com.do) y crea tu cuenta.

### Paso 2: Obten tu API Key

1. Una vez logueado, selecciona el ambiente **Test** en el selector de ambientes (esquina superior derecha)
2. Ve a **Settings > API Key > Generate API Key**
3. Copia tu API Key -- la usaras como bearer token para autenticarte con el SDK

### Paso 3: Contacta a ECF SSD para la Integracion

Contacta al equipo de ECF SSD (contacto@ssd.com.do) para iniciar el proceso de integracion y certificacion de tu **sistema** (no de las empresas de tus clientes -- la certificacion es para tu plataforma). El equipo te guiara a traves del proceso usando el ambiente de **certificacion** (`Cert`).

### Paso 4: Usa Produccion

Una vez que tu sistema este integrado y certificado, podras usar el ambiente de **produccion** (`Prod`) para emitir comprobantes fiscales electronicos reales.

> **Vienes de otro proveedor?** ECF SSD soporta migracion desde otros proveedores de facturacion electronica. Contacta al equipo para coordinar la transicion.

## Configuracion

```php
use Ecfx\EcfDgii\Configuration;

$config = Configuration::getDefaultConfiguration()
    ->setHost('https://api.test.ecfx.ssd.com.do')
    ->setAccessToken('your-api-key-here');
```

### Ambientes

| Ambiente | URL | Uso |
|----------|-----|-----|
| **Test** | `https://api.test.ecfx.ssd.com.do` | Desarrollo y pruebas internas |
| **Cert** | `https://api.cert.ecfx.ssd.com.do` | Proceso de certificacion con la DGII |
| **Prod** | `https://api.prod.ecfx.ssd.com.do` | Produccion |

### Autenticacion

El SDK utiliza **JWT Bearer Token**. Puedes configurar el token de dos formas:

1. **Directamente en el codigo:** pasando el API Key con `setAccessToken()`
2. **Variable de entorno:** `ECF_DGII_TOKEN`

## Ejemplo: Factura de Consumo (ECF 32)

Cada tipo de ECF tiene su propio conjunto de clases con el prefijo del tipo (ej. `Ecf32ECF`, `Ecf32Encabezado`, `Ecf32Item` para Factura de Consumo).

```php
<?php

require_once 'vendor/autoload.php';

use GuzzleHttp\Client;
use Ecfx\EcfDgii\Configuration;
use Ecfx\EcfDgii\Api\EcfApi;
use Ecfx\EcfDgii\ApiException;
use Ecfx\EcfDgii\Model\Ecf32ECF;
use Ecfx\EcfDgii\Model\Ecf32Encabezado;
use Ecfx\EcfDgii\Model\Ecf32IdDoc;
use Ecfx\EcfDgii\Model\Ecf32Emisor;
use Ecfx\EcfDgii\Model\Ecf32Comprador;
use Ecfx\EcfDgii\Model\Ecf32Totales;
use Ecfx\EcfDgii\Model\Ecf32Item;
use Ecfx\EcfDgii\Model\Ecf32FormaDePago;
use Ecfx\EcfDgii\Model\Ecf32VersionType;
use Ecfx\EcfDgii\Model\Ecf32TipoPagoType;
use Ecfx\EcfDgii\Model\Ecf32FormaPagoType;
use Ecfx\EcfDgii\Model\Ecf32IndicadorFacturacionType;
use Ecfx\EcfDgii\Model\Ecf32IndicadorBienoServicioType;
use Ecfx\EcfDgii\Model\Ecf32TipoIngresosValidationType;
use Ecfx\EcfDgii\Model\TipoeCFType;
use Ecfx\EcfDgii\Model\IndicadorMontoGravadoType;
use Ecfx\EcfDgii\Model\UnidadMedidaType;

// 1. Configurar
$config = Configuration::getDefaultConfiguration()
    ->setHost('https://api.test.ecfx.ssd.com.do')
    ->setAccessToken(getenv('ECF_DGII_TOKEN'));

// 2. Crear el cliente API
$ecfApi = new EcfApi(new Client(), $config);

// 3. Construir el ECF 32 (Factura de Consumo)
$ecf = new Ecf32ECF([
    'encabezado' => new Ecf32Encabezado([
        'version' => Ecf32VersionType::VERSION1_0,
        'id_doc' => new Ecf32IdDoc([
            'tipoe_cf' => TipoeCFType::FACTURA_DE_CONSUMO_ELECTRONICA,
            'encf' => 'E320000000019',
            'indicador_monto_gravado' => IndicadorMontoGravadoType::CON_ITBIS_INCLUIDO,
            'tipo_ingresos' => Ecf32TipoIngresosValidationType::_01,
            'tipo_pago' => Ecf32TipoPagoType::CONTADO,
            'tabla_formas_pago' => [
                new Ecf32FormaDePago([
                    'forma_pago' => Ecf32FormaPagoType::EFECTIVO,
                    'monto_pago' => 590,
                ]),
            ],
        ]),
        'emisor' => new Ecf32Emisor([
            'rnc_emisor' => 'TODO_YOUR_RNC',           // TODO: Reemplaza con tu RNC
            'razon_social_emisor' => 'TODO_YOUR_RAZON_SOCIAL', // TODO: Reemplaza con tu razon social
            'direccion_emisor' => 'TODO_YOUR_ADDRESS',  // TODO: Reemplaza con tu direccion
            'numero_factura_interna' => '21',
            'fecha_emision' => new \DateTime('2026-03-13'),
        ]),
        'comprador' => new Ecf32Comprador(),
        'totales' => new Ecf32Totales([
            'monto_gravado_total' => 500,
            'monto_gravado_i1' => 500,
            'itbi_s1' => 18,
            'total_itbis' => 90,
            'total_itbis1' => 90,
            'monto_total' => 590,
            'monto_periodo' => 590,
        ]),
    ]),
    'detalles_items' => [
        new Ecf32Item([
            'numero_linea' => 1,
            'indicador_facturacion' => Ecf32IndicadorFacturacionType::ITBIS1_18_PERCENT,
            'nombre_item' => 'Servicio Digital',
            'indicador_bieno_servicio' => Ecf32IndicadorBienoServicioType::SERVICIO,
            'cantidad_item' => 1,
            'unidad_medida' => UnidadMedidaType::UNIDAD,
            'precio_unitario_item' => 500,
            'monto_item' => 500,
        ]),
    ],
]);

// 4. Enviar el ECF
try {
    $result = $ecfApi->recepcionEcf32($ecf);

    echo "ECF enviado!\n";
    echo "Message ID: " . $result->getMessageId() . "\n";
} catch (ApiException $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "Response: " . $e->getResponseBody() . "\n";
}
```

### Usando EcfService (auto-routing + polling)

El `EcfService` enruta automaticamente al endpoint correcto segun el tipo de ECF y hace polling hasta que la DGII termine de procesar:

```php
use Ecfx\EcfDgii\EcfService;
use Ecfx\EcfDgii\EcfProcessingException;
use Ecfx\EcfDgii\EcfPollingTimeoutException;

$service = new EcfService($ecfApi, pollingMaxAttempts: 30, pollingIntervalSeconds: 2);

try {
    $result = $service->sendEcf($ecf);

    echo "ECF aceptado!\n";
    echo "Status: " . $result->getEstatus() . "\n";
    echo "ENCF: " . $result->getEncf() . "\n";
} catch (EcfProcessingException $e) {
    echo "ECF rechazado: " . $e->getMessage() . "\n";
} catch (EcfPollingTimeoutException $e) {
    echo "Polling timeout: " . $e->getMessage() . "\n";
}
```

## Como Funciona `sendEcf`

```
Tu sistema                          ECF SSD                         DGII
   |                                   |                              |
   |-- sendEcf(ecf) ----------------->|                              |
   |                                   |-- firma XML ----------------|
   |                                   |-- autenticacion (semilla) ->|
   |                                   |-- envio e-CF -------------->|
   |                                   |<-- trackId ----------------|
   |                                   |-- polling estado ---------->|
   |                                   |<-- resultado final --------|
   |<-- EcfResponse ------------------|                              |
   |                                   |                              |
```

1. **Enrutamiento automatico:** Determina el endpoint correcto (`/ecf/31`, `/ecf/32`, etc.) basandose en el `tipoeCF`
2. **Envio:** POST al endpoint correspondiente
3. **Polling:** Consulta periodicamente el estado hasta que la DGII responda (`Finished` o `Error`)
4. **Resultado:** Retorna el `EcfResponse` con el estado final, codigo de seguridad, URL de impresion, etc.

## Respuesta (`EcfResponse`)

Al completarse el envio, recibes un `EcfResponse` con los datos necesarios para cumplir con los requisitos de impresion de la DGII:

| Campo | Descripcion |
|-------|-------------|
| `ImpresionUrl` | URL para generar el codigo QR requerido por la DGII en el comprobante impreso |
| `CodSec` | Codigo de seguridad -- debe aparecer en el comprobante impreso |
| `FechaFirma` | Fecha y hora de la firma digital del comprobante |
| `Estatus` | Estado DGII: `Aceptado`, `AceptadoCondicional`, `Rechazado` |
| `Progress` | Estado del procesamiento: `Queued`, `Sending`, `Polling`, `Finished`, `Error` |
| `Encf` | Numero de comprobante fiscal electronico (eNCF) |
| `Mensaje` | Mensaje de respuesta de la DGII |
| `Errors` | Detalle de errores (si los hay) |
| `MontoTotal` | Monto total del comprobante |

### QR e Impresion

La DGII requiere que todo comprobante impreso incluya un **codigo QR**. El campo `ImpresionUrl` contiene la URL que debe codificarse como QR. Adicionalmente, el `CodSec` (codigo de seguridad) y la `FechaFirma` deben aparecer impresos en el comprobante.

```php
$result = $service->sendEcf($ecf);

$urlQr = $result->getImpresionUrl();         // codificar como QR
$codigoSeguridad = $result->getCodSec();     // imprimir en el comprobante
$fechaFirma = $result->getFechaFirma();      // fecha de firma digital
```

## Tipos de Comprobantes (ECF)

Cada tipo de ECF tiene su propio conjunto de clases. Usa las clases que correspondan a tu tipo de documento:

| Tipo | Prefijo | eNCF | Descripcion | Endpoint |
|------|---------|------|-------------|----------|
| 31 | `Ecf31*` | E31 | Factura de Credito Fiscal | `recepcionEcf31()` |
| 32 | `Ecf32*` | E32 | Factura de Consumo | `recepcionEcf32()` |
| 33 | `Ecf33*` | E33 | Nota de Debito | `recepcionEcf33()` |
| 34 | `Ecf34*` | E34 | Nota de Credito | `recepcionEcf34()` |
| 41 | `Ecf41*` | E41 | Compras | `recepcionEcf41()` |
| 43 | `Ecf43*` | E43 | Gastos Menores | `recepcionEcf43()` |
| 44 | `Ecf44*` | E44 | Regimenes Especiales | `recepcionEcf44()` |
| 45 | `Ecf45*` | E45 | Gubernamental | `recepcionEcf45()` |
| 46 | `Ecf46*` | E46 | Exportaciones | `recepcionEcf46()` |
| 47 | `Ecf47*` | E47 | Pagos al Exterior | `recepcionEcf47()` |

Por ejemplo, para enviar una Factura de Credito Fiscal usa `Ecf31ECF`, `Ecf31Encabezado`, `Ecf31Item`, etc. y llama `$ecfApi->recepcionEcf31($ecf)`.

## Funcionalidades del API

Ademas de enviar comprobantes, el SDK expone todos los endpoints del API:

| Clase | Descripcion |
|-------|-------------|
| `EcfService` | Envio de ECF con auto-routing y polling |
| `EcfApi` | Envio de ECF (tipos 31-47), consultas, busquedas, anulaciones |
| `CompanyApi` | CRUD de empresas y gestion de certificados |
| `DgiiApi` | Consultas DGII (directorio, estado, timbre, track IDs, etc.) |
| `RecepcionApi` | Seguimiento de solicitudes de recepcion |
| `ApiKeyApi` | Gestion de API keys |

### Funcionalidades adicionales

| Funcionalidad | Descripcion |
|--------------|-------------|
| **Empresas** | Crear, consultar y eliminar empresas registradas |
| **Certificados** | Subir y consultar certificados digitales |
| **Consulta de e-CF** | Buscar comprobantes por RNC, eNCF, fecha, monto, etc. |
| **Aprobacion Comercial** | Enviar aprobacion/rechazo comercial (ACECF) |
| **Anulacion de Rangos** | Solicitar anulacion de secuencias de eNCF |
| **Consultas DGII** | Directorio, estado, resultado, timbre, RFCE, track IDs |
| **Estatus de Servicios** | Verificar disponibilidad de servicios DGII |
| **API Keys** | Crear API keys para acceso programatico |

## Uso Directo de los Clientes API

Para control total, usa las clases API generadas directamente:

```php
use GuzzleHttp\Client;
use Ecfx\EcfDgii\Configuration;
use Ecfx\EcfDgii\Api\CompanyApi;
use Ecfx\EcfDgii\Api\EcfApi;
use Ecfx\EcfDgii\Api\DgiiApi;
use Ecfx\EcfDgii\Api\RecepcionApi;
use Ecfx\EcfDgii\Api\ApiKeyApi;

$config = Configuration::getDefaultConfiguration()
    ->setHost('https://api.prod.ecfx.ssd.com.do')
    ->setAccessToken('your-api-key');

$client = new Client();

// Operaciones de empresas
$companyApi = new CompanyApi($client, $config);
$companies = $companyApi->getCompanies();
$company = $companyApi->getCompanyByRnc('123456789');

// Operaciones de ECF
$ecfApi = new EcfApi($client, $config);
$response = $ecfApi->recepcionEcf31($ecf);           // Factura de credito fiscal
$response = $ecfApi->recepcionEcf32($ecf);           // Factura de consumo
$results = $ecfApi->searchEcfs('123456789');           // Buscar ECFs por RNC
$ecfById = $ecfApi->getEcfById('123456789', $msgId);  // Obtener ECF por message ID
$ecfApi->aprobacionComercial('123456789', $encf, $acecfRequest); // Aprobacion comercial

// Consultas DGII
$dgiiApi = new DgiiApi($client, $config);
$directorio = $dgiiApi->consultaDirectorioListado('123456789');
$estado = $dgiiApi->consultaEstado('123456789', $rncEmisor, $ncf, $rncComprador, $codSeg);
$timbre = $dgiiApi->consultaTimbre('123456789', $rncEmisor, $encf, $monto, $codSeg);
$servicios = $dgiiApi->estatusServiciosObtenerEstatus('123456789');

// Seguimiento de recepcion
$recepcionApi = new RecepcionApi($client, $config);
$requests = $recepcionApi->searchEcfReceptionRequests();
```

## Manejo de Errores

| Excepcion | Cuando |
|-----------|--------|
| `EcfProcessingException` | La DGII rechaza el ECF durante el procesamiento |
| `EcfPollingTimeoutException` | El polling excede el maximo de intentos sin resultado final |
| `ApiException` | Errores HTTP/red al comunicarse con el API |

```php
use Ecfx\EcfDgii\ApiException;
use Ecfx\EcfDgii\EcfProcessingException;
use Ecfx\EcfDgii\EcfPollingTimeoutException;

try {
    $result = $service->sendEcf($ecf);
} catch (EcfProcessingException $e) {
    // ECF rechazado por la DGII
    $response = $e->getEcfResponse();
    if ($response) {
        echo "Errores: " . $response->getErrors() . "\n";
    }
} catch (EcfPollingTimeoutException $e) {
    // El polling no obtuvo resultado a tiempo
    echo "Timeout: " . $e->getMessage() . "\n";
} catch (ApiException $e) {
    // Error HTTP (4xx, 5xx, red)
    echo "HTTP Error: " . $e->getCode() . "\n";
    echo "Body: " . $e->getResponseBody() . "\n";
}
```

## Variables de Entorno

| Variable | Descripcion |
|----------|-------------|
| `ECF_DGII_TOKEN` | API key para autenticacion (desde ecf.ssd.com.do Settings > API Key) |

## Ejemplos

- [`examples/ecf32-factura-consumo.json`](examples/ecf32-factura-consumo.json) -- Factura de Consumo (ECF 32) con ITBIS
- [`examples/ecf31-factura-credito-fiscal.json`](examples/ecf31-factura-credito-fiscal.json) -- Factura de Credito Fiscal (ECF 31) con ITBIS, impuestos adicionales y descuentos

## Regenerar desde OpenAPI Spec

```bash
openapi-generator generate \
  -i path/to/openapi/v1.json \
  -g php \
  -c openapi-generator-config.json \
  -o . \
  --skip-validate-spec
```

## Contribuir

1. Fork el repositorio
2. Crea tu feature branch (`git checkout -b feature/mi-feature`)
3. Haz commit de tus cambios (`git commit -m 'Agregar mi feature'`)
4. Push al branch (`git push origin feature/mi-feature`)
5. Abre un Pull Request

Los tests corren automaticamente via GitHub Actions en cada push y PR.

## Soporte

- Documentacion: [https://ecf.ssd.com.do](https://ecf.ssd.com.do)
- Contacto: contacto@ssd.com.do
- Issues: [GitHub Issues](https://github.com/SSD-Smart-Software-Development-SRL/ecf-dgii-php/issues)

## Otros SDKs

Este SDK es parte de una coleccion de SDKs oficiales para multiples plataformas:

| Plataforma | Paquete | Instalacion |
|-----------|---------|-------------|
| .NET | [NuGet](https://www.nuget.org/packages/SSDDO.ECF_DGII.SDK) | `dotnet add package SSDDO.ECF_DGII.SDK` |
| TypeScript | [npm](https://www.npmjs.com/) | `npm install ecf-dgii-client` |
| Python | [PyPI](https://pypi.org/) | `pip install ecf-dgii-client` |
| **PHP** | [Packagist](https://packagist.org/packages/ecfx/ecf-dgii-php) | `composer require ecfx/ecf-dgii-php` |
| Java | [Maven Central](https://central.sonatype.com/) | Ver documentacion |
| Kotlin | [Maven Central](https://central.sonatype.com/) | Ver documentacion |

## Licencia

[MIT](LICENSE)

---

Hecho con platano power por [SSD Smart Software Development SRL](https://ssd.com.do)

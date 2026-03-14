# ECF DGII PHP SDK

PHP SDK for the ECF DGII electronic fiscal receipt API (Dominican Republic).

Generated from the [OpenAPI specification](https://api.prod.ecfx.ssd.com.do) using [OpenAPI Generator](https://openapi-generator.tech), with a high-level `EcfService` for simplified ECF submission with automatic routing and polling.

## Installation

```bash
composer require ecfx/ecf-dgii-php
```

### Requirements

- PHP 8.1+
- ext-curl
- ext-json
- ext-mbstring

## Getting Started

### 1. Create an Account

1. Go to [ecf.ssd.com.do](https://ecf.ssd.com.do) and create a new account
2. Once logged in, select the **Test** environment in the top-right environment selector
3. Navigate to **Settings > API Key > Generate API Key**
4. Copy your API key -- you'll use it as the bearer token

### 2. Configure the SDK

```php
use Ecfx\EcfDgii\Configuration;

$config = Configuration::getDefaultConfiguration()
    ->setHost('https://api.test.ecfx.ssd.com.do')
    ->setAccessToken('your-api-key-here');
```

Available environments:
- **Test:** `https://api.test.ecfx.ssd.com.do`
- **Certification:** `https://api.cert.ecfx.ssd.com.do`
- **Production:** `https://api.prod.ecfx.ssd.com.do`

### 3. Send a Factura de Consumo (ECF 32)

Each ECF type has its own set of classes prefixed with the type number (e.g. `Ecf32ECF`, `Ecf32Encabezado`, `Ecf32Item` for Factura de Consumo).

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

// 1. Configure
$config = Configuration::getDefaultConfiguration()
    ->setHost('https://api.test.ecfx.ssd.com.do')
    ->setAccessToken(getenv('ECF_DGII_TOKEN'));

// 2. Create the API client
$ecfApi = new EcfApi(new Client(), $config);

// 3. Build the ECF 32 (Factura de Consumo)
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
            'rnc_emisor' => 'TODO_YOUR_RNC',           // TODO: Replace with your RNC
            'razon_social_emisor' => 'TODO_YOUR_RAZON_SOCIAL', // TODO: Replace with your company name
            'direccion_emisor' => 'TODO_YOUR_ADDRESS',  // TODO: Replace with your address
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

// 4. Send the ECF
try {
    $result = $ecfApi->recepcionEcf32($ecf);

    echo "ECF sent!\n";
    echo "Message ID: " . $result->getMessageId() . "\n";
} catch (ApiException $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "Response: " . $e->getResponseBody() . "\n";
}
```

### Using EcfService (auto-routing + polling)

The `EcfService` handles routing to the correct endpoint by ECF type and polls until DGII finishes processing:

```php
use Ecfx\EcfDgii\EcfService;
use Ecfx\EcfDgii\EcfProcessingException;
use Ecfx\EcfDgii\EcfPollingTimeoutException;

$service = new EcfService($ecfApi, pollingMaxAttempts: 30, pollingIntervalSeconds: 2);

try {
    $result = $service->sendEcf($ecf);

    echo "ECF accepted!\n";
    echo "Status: " . $result->getEstatus() . "\n";
    echo "ENCF: " . $result->getEncf() . "\n";
} catch (EcfProcessingException $e) {
    echo "ECF rejected: " . $e->getMessage() . "\n";
} catch (EcfPollingTimeoutException $e) {
    echo "Polling timed out: " . $e->getMessage() . "\n";
}
```

## ECF Types and Classes

Each ECF type has its own set of model classes. Use the classes matching your document type:

| Type | Class Prefix | eNCF Prefix | Description |
|------|-------------|-------------|-------------|
| 31 | `Ecf31*` | E31 | Factura de Credito Fiscal |
| 32 | `Ecf32*` | E32 | Factura de Consumo |
| 33 | `Ecf33*` | E33 | Nota de Debito |
| 34 | `Ecf34*` | E34 | Nota de Credito |
| 41 | `Ecf41*` | E41 | Compras |
| 43 | `Ecf43*` | E43 | Gastos Menores |
| 44 | `Ecf44*` | E44 | Regimenes Especiales |
| 45 | `Ecf45*` | E45 | Gubernamental |
| 46 | `Ecf46*` | E46 | Exportaciones |
| 47 | `Ecf47*` | E47 | Pagos al Exterior |

For example, to send a Factura de Credito Fiscal, use `Ecf31ECF`, `Ecf31Encabezado`, `Ecf31Item`, etc. and call `$ecfApi->recepcionEcf31($ecf)`.

## Low-Level: Use API Clients Directly

For full control, use the generated API classes directly:

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

// Company operations
$companyApi = new CompanyApi($client, $config);
$companies = $companyApi->getCompanies();
$company = $companyApi->getCompanyByRnc('123456789');

// ECF operations
$ecfApi = new EcfApi($client, $config);
$response = $ecfApi->recepcionEcf31($ecf);           // Submit factura de credito fiscal
$response = $ecfApi->recepcionEcf32($ecf);           // Submit factura de consumo
$results = $ecfApi->searchEcfs('123456789');           // Search ECFs by RNC
$ecfById = $ecfApi->getEcfById('123456789', $msgId);  // Get ECF by message ID

// DGII consultations
$dgiiApi = new DgiiApi($client, $config);
$directorio = $dgiiApi->consultaDirectorioListado('123456789');
$estado = $dgiiApi->consultaEstado('123456789', $rncEmisor, $ncf, $rncComprador, $codSeg);
$timbre = $dgiiApi->consultaTimbre('123456789', $rncEmisor, $encf, $monto, $codSeg);

// Reception tracking
$recepcionApi = new RecepcionApi($client, $config);
$requests = $recepcionApi->searchEcfReceptionRequests();
```

## API Reference

| Class | Description |
|-------|-------------|
| `EcfService` | High-level ECF submission with auto-routing and polling |
| `CompanyApi` | Company CRUD and certificate management |
| `EcfApi` | ECF submission (types 31-47), queries, searches, anulaciones |
| `DgiiApi` | DGII consultations (directorio, estado, timbre, track IDs, etc.) |
| `RecepcionApi` | Reception request tracking |
| `ApiKeyApi` | API key management |

## Examples

- [`examples/ecf32-factura-consumo.json`](examples/ecf32-factura-consumo.json) -- Factura de Consumo (ECF 32) with ITBIS
- [`examples/ecf31-factura-credito-fiscal.json`](examples/ecf31-factura-credito-fiscal.json) -- Factura de Credito Fiscal (ECF 31) with ITBIS, additional taxes, and discounts

## Error Handling

| Exception | When |
|-----------|------|
| `EcfProcessingException` | DGII rejects the ECF during processing |
| `EcfPollingTimeoutException` | Polling exceeds max attempts without a final result |
| `ApiException` | HTTP/network errors communicating with the API |

## Environment Variables

| Variable | Description |
|----------|-------------|
| `ECF_DGII_TOKEN` | API key for authentication (from ecf.ssd.com.do Settings > API Key) |

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/my-feature`)
3. Commit your changes (`git commit -m 'Add my feature'`)
4. Push to the branch (`git push origin feature/my-feature`)
5. Open a Pull Request

Tests run automatically via GitHub Actions on every push and PR.

## Regenerating from OpenAPI Spec

```bash
openapi-generator generate \
  -i path/to/openapi/v1.json \
  -g php \
  -c openapi-generator-config.json \
  -o . \
  --skip-validate-spec
```

## License

MIT

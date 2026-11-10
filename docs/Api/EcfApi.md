# Ecfx\EcfDgii\EcfApi



All URIs are relative to https://api.test.ecfx.ssd.com.do, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**anulacionRangos()**](EcfApi.md#anulacionRangos) | **POST** /ecf/anularrango/{rnc} |  |
| [**firmarSemilla()**](EcfApi.md#firmarSemilla) | **POST** /ecf/FirmarSemilla/{rnc} |  |
| [**getEcfById()**](EcfApi.md#getEcfById) | **GET** /ecf/{rnc}/message/{id} |  |
| [**listAnulaciones()**](EcfApi.md#listAnulaciones) | **GET** /ecf/anulaciones |  |
| [**queryEcf()**](EcfApi.md#queryEcf) | **GET** /ecf/{rnc}/{encf} |  |
| [**recepcionEcf31()**](EcfApi.md#recepcionEcf31) | **POST** /ecf/31 |  |
| [**recepcionEcf32()**](EcfApi.md#recepcionEcf32) | **POST** /ecf/32 |  |
| [**recepcionEcf33()**](EcfApi.md#recepcionEcf33) | **POST** /ecf/33 |  |
| [**recepcionEcf34()**](EcfApi.md#recepcionEcf34) | **POST** /ecf/34 |  |
| [**recepcionEcf41()**](EcfApi.md#recepcionEcf41) | **POST** /ecf/41 |  |
| [**recepcionEcf43()**](EcfApi.md#recepcionEcf43) | **POST** /ecf/43 |  |
| [**recepcionEcf44()**](EcfApi.md#recepcionEcf44) | **POST** /ecf/44 |  |
| [**recepcionEcf45()**](EcfApi.md#recepcionEcf45) | **POST** /ecf/45 |  |
| [**recepcionEcf46()**](EcfApi.md#recepcionEcf46) | **POST** /ecf/46 |  |
| [**recepcionEcf47()**](EcfApi.md#recepcionEcf47) | **POST** /ecf/47 |  |
| [**searchAllEcfs()**](EcfApi.md#searchAllEcfs) | **GET** /ecf |  |
| [**searchEcfs()**](EcfApi.md#searchEcfs) | **GET** /ecf/{rnc} |  |


## `anulacionRangos()`

```php
anulacionRangos($rnc, $anulacion_request): \Ecfx\EcfDgii\Model\RespuestaAnulacionRango
```



Anula rangos de e-NCF no utilizados enviando un ANECF a la DGII. Si la DGII rechaza la anulación responde con el mismo código HTTP de la DGII y su respuesta en la extensión dgiiResponse.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: Bearer
$config = Ecfx\EcfDgii\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Ecfx\EcfDgii\Api\EcfApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$rnc = 'rnc_example'; // string
$anulacion_request = new \Ecfx\EcfDgii\Model\AnulacionRequest(); // \Ecfx\EcfDgii\Model\AnulacionRequest

try {
    $result = $apiInstance->anulacionRangos($rnc, $anulacion_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EcfApi->anulacionRangos: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **rnc** | **string**|  | |
| **anulacion_request** | [**\Ecfx\EcfDgii\Model\AnulacionRequest**](../Model/AnulacionRequest.md)|  | |

### Return type

[**\Ecfx\EcfDgii\Model\RespuestaAnulacionRango**](../Model/RespuestaAnulacionRango.md)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`, `text/xml`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `firmarSemilla()`

```php
firmarSemilla($rnc, $xml)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: Bearer
$config = Ecfx\EcfDgii\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Ecfx\EcfDgii\Api\EcfApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$rnc = 'rnc_example'; // string
$xml = '/path/to/file.txt'; // \SplFileObject

try {
    $apiInstance->firmarSemilla($rnc, $xml);
} catch (Exception $e) {
    echo 'Exception when calling EcfApi->firmarSemilla: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **rnc** | **string**|  | |
| **xml** | **\SplFileObject****\SplFileObject**|  | |

### Return type

void (empty response body)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: `multipart/form-data`
- **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getEcfById()`

```php
getEcfById($rnc, $id, $include_ecf_content): \Ecfx\EcfDgii\Model\EcfResponse[]
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: Bearer
$config = Ecfx\EcfDgii\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Ecfx\EcfDgii\Api\EcfApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$rnc = 'rnc_example'; // string
$id = 'id_example'; // string
$include_ecf_content = false; // bool

try {
    $result = $apiInstance->getEcfById($rnc, $id, $include_ecf_content);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EcfApi->getEcfById: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **rnc** | **string**|  | |
| **id** | **string**|  | |
| **include_ecf_content** | **bool**|  | [optional] [default to false] |

### Return type

[**\Ecfx\EcfDgii\Model\EcfResponse[]**](../Model/EcfResponse.md)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listAnulaciones()`

```php
listAnulaciones($tipo_ecf, $rncs, $fecha_desde, $fecha_hasta, $page, $limit): \Ecfx\EcfDgii\Model\PaginatedApiResultOfAnulacionListResponse
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: Bearer
$config = Ecfx\EcfDgii\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Ecfx\EcfDgii\Api\EcfApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$tipo_ecf = array(new \Ecfx\EcfDgii\Model\\Ecfx\EcfDgii\Model\ECFType()); // \Ecfx\EcfDgii\Model\ECFType[]
$rncs = array('rncs_example'); // string[]
$fecha_desde = new \DateTime('2013-10-20T19:20:30+01:00'); // \DateTime
$fecha_hasta = new \DateTime('2013-10-20T19:20:30+01:00'); // \DateTime
$page = new \Ecfx\EcfDgii\Model\\Ecfx\EcfDgii\Model\GetCompaniesPageParameter(); // \Ecfx\EcfDgii\Model\GetCompaniesPageParameter
$limit = new \Ecfx\EcfDgii\Model\\Ecfx\EcfDgii\Model\GetCompaniesLimitParameter(); // \Ecfx\EcfDgii\Model\GetCompaniesLimitParameter

try {
    $result = $apiInstance->listAnulaciones($tipo_ecf, $rncs, $fecha_desde, $fecha_hasta, $page, $limit);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EcfApi->listAnulaciones: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **tipo_ecf** | [**\Ecfx\EcfDgii\Model\ECFType[]**](../Model/\Ecfx\EcfDgii\Model\ECFType.md)|  | [optional] |
| **rncs** | [**string[]**](../Model/string.md)|  | [optional] |
| **fecha_desde** | **\DateTime**|  | [optional] |
| **fecha_hasta** | **\DateTime**|  | [optional] |
| **page** | **\Ecfx\EcfDgii\Model\GetCompaniesPageParameter**|  | [optional] [default to 1] |
| **limit** | **\Ecfx\EcfDgii\Model\GetCompaniesLimitParameter**|  | [optional] [default to 25] |

### Return type

[**\Ecfx\EcfDgii\Model\PaginatedApiResultOfAnulacionListResponse**](../Model/PaginatedApiResultOfAnulacionListResponse.md)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `queryEcf()`

```php
queryEcf($rnc, $encf, $include_ecf_content): \Ecfx\EcfDgii\Model\EcfResponse[]
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: Bearer
$config = Ecfx\EcfDgii\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Ecfx\EcfDgii\Api\EcfApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$rnc = 'rnc_example'; // string
$encf = 'encf_example'; // string
$include_ecf_content = false; // bool

try {
    $result = $apiInstance->queryEcf($rnc, $encf, $include_ecf_content);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EcfApi->queryEcf: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **rnc** | **string**|  | |
| **encf** | **string**|  | |
| **include_ecf_content** | **bool**|  | [optional] [default to false] |

### Return type

[**\Ecfx\EcfDgii\Model\EcfResponse[]**](../Model/EcfResponse.md)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `recepcionEcf31()`

```php
recepcionEcf31($ecf31_ecf): \Ecfx\EcfDgii\Model\EcfResponse
```



Envía el e-CF a la DGII. Reenviar un e-NCF ya recibido devuelve el envío existente si el JSON es idéntico, o 409 si es distinto. Excepción: si la DGII rechazó todos los envíos anteriores de ese e-NCF sin utilizar la secuencia (secuenciaUtilizada = false), el e-NCF sigue libre y se acepta como un envío nuevo (idéntico o corregido) con su propio messageId; los envíos anteriores se conservan como historial.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: Bearer
$config = Ecfx\EcfDgii\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Ecfx\EcfDgii\Api\EcfApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$ecf31_ecf = new \Ecfx\EcfDgii\Model\Ecf31ECF(); // \Ecfx\EcfDgii\Model\Ecf31ECF

try {
    $result = $apiInstance->recepcionEcf31($ecf31_ecf);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EcfApi->recepcionEcf31: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **ecf31_ecf** | [**\Ecfx\EcfDgii\Model\Ecf31ECF**](../Model/Ecf31ECF.md)|  | |

### Return type

[**\Ecfx\EcfDgii\Model\EcfResponse**](../Model/EcfResponse.md)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `recepcionEcf32()`

```php
recepcionEcf32($ecf32_ecf): \Ecfx\EcfDgii\Model\EcfResponse
```



Envía el e-CF a la DGII. Reenviar un e-NCF ya recibido devuelve el envío existente si el JSON es idéntico, o 409 si es distinto. Excepción: si la DGII rechazó todos los envíos anteriores de ese e-NCF sin utilizar la secuencia (secuenciaUtilizada = false), el e-NCF sigue libre y se acepta como un envío nuevo (idéntico o corregido) con su propio messageId; los envíos anteriores se conservan como historial.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: Bearer
$config = Ecfx\EcfDgii\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Ecfx\EcfDgii\Api\EcfApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$ecf32_ecf = new \Ecfx\EcfDgii\Model\Ecf32ECF(); // \Ecfx\EcfDgii\Model\Ecf32ECF

try {
    $result = $apiInstance->recepcionEcf32($ecf32_ecf);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EcfApi->recepcionEcf32: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **ecf32_ecf** | [**\Ecfx\EcfDgii\Model\Ecf32ECF**](../Model/Ecf32ECF.md)|  | |

### Return type

[**\Ecfx\EcfDgii\Model\EcfResponse**](../Model/EcfResponse.md)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `recepcionEcf33()`

```php
recepcionEcf33($ecf33_ecf): \Ecfx\EcfDgii\Model\EcfResponse
```



Envía el e-CF a la DGII. Reenviar un e-NCF ya recibido devuelve el envío existente si el JSON es idéntico, o 409 si es distinto. Excepción: si la DGII rechazó todos los envíos anteriores de ese e-NCF sin utilizar la secuencia (secuenciaUtilizada = false), el e-NCF sigue libre y se acepta como un envío nuevo (idéntico o corregido) con su propio messageId; los envíos anteriores se conservan como historial.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: Bearer
$config = Ecfx\EcfDgii\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Ecfx\EcfDgii\Api\EcfApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$ecf33_ecf = new \Ecfx\EcfDgii\Model\Ecf33ECF(); // \Ecfx\EcfDgii\Model\Ecf33ECF

try {
    $result = $apiInstance->recepcionEcf33($ecf33_ecf);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EcfApi->recepcionEcf33: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **ecf33_ecf** | [**\Ecfx\EcfDgii\Model\Ecf33ECF**](../Model/Ecf33ECF.md)|  | |

### Return type

[**\Ecfx\EcfDgii\Model\EcfResponse**](../Model/EcfResponse.md)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `recepcionEcf34()`

```php
recepcionEcf34($ecf34_ecf): \Ecfx\EcfDgii\Model\EcfResponse
```



Envía el e-CF a la DGII. Reenviar un e-NCF ya recibido devuelve el envío existente si el JSON es idéntico, o 409 si es distinto. Excepción: si la DGII rechazó todos los envíos anteriores de ese e-NCF sin utilizar la secuencia (secuenciaUtilizada = false), el e-NCF sigue libre y se acepta como un envío nuevo (idéntico o corregido) con su propio messageId; los envíos anteriores se conservan como historial.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: Bearer
$config = Ecfx\EcfDgii\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Ecfx\EcfDgii\Api\EcfApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$ecf34_ecf = new \Ecfx\EcfDgii\Model\Ecf34ECF(); // \Ecfx\EcfDgii\Model\Ecf34ECF

try {
    $result = $apiInstance->recepcionEcf34($ecf34_ecf);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EcfApi->recepcionEcf34: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **ecf34_ecf** | [**\Ecfx\EcfDgii\Model\Ecf34ECF**](../Model/Ecf34ECF.md)|  | |

### Return type

[**\Ecfx\EcfDgii\Model\EcfResponse**](../Model/EcfResponse.md)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `recepcionEcf41()`

```php
recepcionEcf41($ecf41_ecf): \Ecfx\EcfDgii\Model\EcfResponse
```



Envía el e-CF a la DGII. Reenviar un e-NCF ya recibido devuelve el envío existente si el JSON es idéntico, o 409 si es distinto. Excepción: si la DGII rechazó todos los envíos anteriores de ese e-NCF sin utilizar la secuencia (secuenciaUtilizada = false), el e-NCF sigue libre y se acepta como un envío nuevo (idéntico o corregido) con su propio messageId; los envíos anteriores se conservan como historial.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: Bearer
$config = Ecfx\EcfDgii\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Ecfx\EcfDgii\Api\EcfApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$ecf41_ecf = new \Ecfx\EcfDgii\Model\Ecf41ECF(); // \Ecfx\EcfDgii\Model\Ecf41ECF

try {
    $result = $apiInstance->recepcionEcf41($ecf41_ecf);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EcfApi->recepcionEcf41: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **ecf41_ecf** | [**\Ecfx\EcfDgii\Model\Ecf41ECF**](../Model/Ecf41ECF.md)|  | |

### Return type

[**\Ecfx\EcfDgii\Model\EcfResponse**](../Model/EcfResponse.md)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `recepcionEcf43()`

```php
recepcionEcf43($ecf43_ecf): \Ecfx\EcfDgii\Model\EcfResponse
```



Envía el e-CF a la DGII. Reenviar un e-NCF ya recibido devuelve el envío existente si el JSON es idéntico, o 409 si es distinto. Excepción: si la DGII rechazó todos los envíos anteriores de ese e-NCF sin utilizar la secuencia (secuenciaUtilizada = false), el e-NCF sigue libre y se acepta como un envío nuevo (idéntico o corregido) con su propio messageId; los envíos anteriores se conservan como historial.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: Bearer
$config = Ecfx\EcfDgii\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Ecfx\EcfDgii\Api\EcfApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$ecf43_ecf = new \Ecfx\EcfDgii\Model\Ecf43ECF(); // \Ecfx\EcfDgii\Model\Ecf43ECF

try {
    $result = $apiInstance->recepcionEcf43($ecf43_ecf);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EcfApi->recepcionEcf43: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **ecf43_ecf** | [**\Ecfx\EcfDgii\Model\Ecf43ECF**](../Model/Ecf43ECF.md)|  | |

### Return type

[**\Ecfx\EcfDgii\Model\EcfResponse**](../Model/EcfResponse.md)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `recepcionEcf44()`

```php
recepcionEcf44($ecf44_ecf): \Ecfx\EcfDgii\Model\EcfResponse
```



Envía el e-CF a la DGII. Reenviar un e-NCF ya recibido devuelve el envío existente si el JSON es idéntico, o 409 si es distinto. Excepción: si la DGII rechazó todos los envíos anteriores de ese e-NCF sin utilizar la secuencia (secuenciaUtilizada = false), el e-NCF sigue libre y se acepta como un envío nuevo (idéntico o corregido) con su propio messageId; los envíos anteriores se conservan como historial.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: Bearer
$config = Ecfx\EcfDgii\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Ecfx\EcfDgii\Api\EcfApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$ecf44_ecf = new \Ecfx\EcfDgii\Model\Ecf44ECF(); // \Ecfx\EcfDgii\Model\Ecf44ECF

try {
    $result = $apiInstance->recepcionEcf44($ecf44_ecf);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EcfApi->recepcionEcf44: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **ecf44_ecf** | [**\Ecfx\EcfDgii\Model\Ecf44ECF**](../Model/Ecf44ECF.md)|  | |

### Return type

[**\Ecfx\EcfDgii\Model\EcfResponse**](../Model/EcfResponse.md)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `recepcionEcf45()`

```php
recepcionEcf45($ecf45_ecf): \Ecfx\EcfDgii\Model\EcfResponse
```



Envía el e-CF a la DGII. Reenviar un e-NCF ya recibido devuelve el envío existente si el JSON es idéntico, o 409 si es distinto. Excepción: si la DGII rechazó todos los envíos anteriores de ese e-NCF sin utilizar la secuencia (secuenciaUtilizada = false), el e-NCF sigue libre y se acepta como un envío nuevo (idéntico o corregido) con su propio messageId; los envíos anteriores se conservan como historial.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: Bearer
$config = Ecfx\EcfDgii\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Ecfx\EcfDgii\Api\EcfApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$ecf45_ecf = new \Ecfx\EcfDgii\Model\Ecf45ECF(); // \Ecfx\EcfDgii\Model\Ecf45ECF

try {
    $result = $apiInstance->recepcionEcf45($ecf45_ecf);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EcfApi->recepcionEcf45: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **ecf45_ecf** | [**\Ecfx\EcfDgii\Model\Ecf45ECF**](../Model/Ecf45ECF.md)|  | |

### Return type

[**\Ecfx\EcfDgii\Model\EcfResponse**](../Model/EcfResponse.md)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `recepcionEcf46()`

```php
recepcionEcf46($ecf46_ecf): \Ecfx\EcfDgii\Model\EcfResponse
```



Envía el e-CF a la DGII. Reenviar un e-NCF ya recibido devuelve el envío existente si el JSON es idéntico, o 409 si es distinto. Excepción: si la DGII rechazó todos los envíos anteriores de ese e-NCF sin utilizar la secuencia (secuenciaUtilizada = false), el e-NCF sigue libre y se acepta como un envío nuevo (idéntico o corregido) con su propio messageId; los envíos anteriores se conservan como historial.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: Bearer
$config = Ecfx\EcfDgii\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Ecfx\EcfDgii\Api\EcfApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$ecf46_ecf = new \Ecfx\EcfDgii\Model\Ecf46ECF(); // \Ecfx\EcfDgii\Model\Ecf46ECF

try {
    $result = $apiInstance->recepcionEcf46($ecf46_ecf);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EcfApi->recepcionEcf46: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **ecf46_ecf** | [**\Ecfx\EcfDgii\Model\Ecf46ECF**](../Model/Ecf46ECF.md)|  | |

### Return type

[**\Ecfx\EcfDgii\Model\EcfResponse**](../Model/EcfResponse.md)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `recepcionEcf47()`

```php
recepcionEcf47($ecf47_ecf): \Ecfx\EcfDgii\Model\EcfResponse
```



Envía el e-CF a la DGII. Reenviar un e-NCF ya recibido devuelve el envío existente si el JSON es idéntico, o 409 si es distinto. Excepción: si la DGII rechazó todos los envíos anteriores de ese e-NCF sin utilizar la secuencia (secuenciaUtilizada = false), el e-NCF sigue libre y se acepta como un envío nuevo (idéntico o corregido) con su propio messageId; los envíos anteriores se conservan como historial.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: Bearer
$config = Ecfx\EcfDgii\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Ecfx\EcfDgii\Api\EcfApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$ecf47_ecf = new \Ecfx\EcfDgii\Model\Ecf47ECF(); // \Ecfx\EcfDgii\Model\Ecf47ECF

try {
    $result = $apiInstance->recepcionEcf47($ecf47_ecf);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EcfApi->recepcionEcf47: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **ecf47_ecf** | [**\Ecfx\EcfDgii\Model\Ecf47ECF**](../Model/Ecf47ECF.md)|  | |

### Return type

[**\Ecfx\EcfDgii\Model\EcfResponse**](../Model/EcfResponse.md)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `searchAllEcfs()`

```php
searchAllEcfs($encfs, $ids, $tipos_ecfs, $include_ecf_content, $from_fecha_emision, $to_fecha_emision, $amount_from, $amount_to, $progresses, $dgii_estados, $page, $limit): \Ecfx\EcfDgii\Model\PaginatedApiResultOfEcfResponse
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: Bearer
$config = Ecfx\EcfDgii\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Ecfx\EcfDgii\Api\EcfApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$encfs = array('encfs_example'); // string[]
$ids = array('ids_example'); // string[]
$tipos_ecfs = array(new \Ecfx\EcfDgii\Model\\Ecfx\EcfDgii\Model\AllTipoECFTypes()); // \Ecfx\EcfDgii\Model\AllTipoECFTypes[]
$include_ecf_content = false; // bool
$from_fecha_emision = new \DateTime('2013-10-20T19:20:30+01:00'); // \DateTime
$to_fecha_emision = new \DateTime('2013-10-20T19:20:30+01:00'); // \DateTime
$amount_from = new \Ecfx\EcfDgii\Model\\Ecfx\EcfDgii\Model\SearchEcfsAmountFromParameter(); // \Ecfx\EcfDgii\Model\SearchEcfsAmountFromParameter
$amount_to = new \Ecfx\EcfDgii\Model\\Ecfx\EcfDgii\Model\SearchEcfsAmountFromParameter(); // \Ecfx\EcfDgii\Model\SearchEcfsAmountFromParameter
$progresses = array(new \Ecfx\EcfDgii\Model\\Ecfx\EcfDgii\Model\EcfProgress()); // \Ecfx\EcfDgii\Model\EcfProgress[]
$dgii_estados = array(new \Ecfx\EcfDgii\Model\\Ecfx\EcfDgii\Model\EcfEstado()); // \Ecfx\EcfDgii\Model\EcfEstado[]
$page = new \Ecfx\EcfDgii\Model\\Ecfx\EcfDgii\Model\GetCompaniesPageParameter(); // \Ecfx\EcfDgii\Model\GetCompaniesPageParameter
$limit = new \Ecfx\EcfDgii\Model\\Ecfx\EcfDgii\Model\GetCompaniesLimitParameter(); // \Ecfx\EcfDgii\Model\GetCompaniesLimitParameter

try {
    $result = $apiInstance->searchAllEcfs($encfs, $ids, $tipos_ecfs, $include_ecf_content, $from_fecha_emision, $to_fecha_emision, $amount_from, $amount_to, $progresses, $dgii_estados, $page, $limit);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EcfApi->searchAllEcfs: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **encfs** | [**string[]**](../Model/string.md)|  | [optional] |
| **ids** | [**string[]**](../Model/string.md)|  | [optional] |
| **tipos_ecfs** | [**\Ecfx\EcfDgii\Model\AllTipoECFTypes[]**](../Model/\Ecfx\EcfDgii\Model\AllTipoECFTypes.md)|  | [optional] |
| **include_ecf_content** | **bool**|  | [optional] [default to false] |
| **from_fecha_emision** | **\DateTime**|  | [optional] |
| **to_fecha_emision** | **\DateTime**|  | [optional] |
| **amount_from** | **\Ecfx\EcfDgii\Model\SearchEcfsAmountFromParameter**|  | [optional] |
| **amount_to** | **\Ecfx\EcfDgii\Model\SearchEcfsAmountFromParameter**|  | [optional] |
| **progresses** | [**\Ecfx\EcfDgii\Model\EcfProgress[]**](../Model/\Ecfx\EcfDgii\Model\EcfProgress.md)|  | [optional] |
| **dgii_estados** | [**\Ecfx\EcfDgii\Model\EcfEstado[]**](../Model/\Ecfx\EcfDgii\Model\EcfEstado.md)|  | [optional] |
| **page** | **\Ecfx\EcfDgii\Model\GetCompaniesPageParameter**|  | [optional] [default to 1] |
| **limit** | **\Ecfx\EcfDgii\Model\GetCompaniesLimitParameter**|  | [optional] [default to 25] |

### Return type

[**\Ecfx\EcfDgii\Model\PaginatedApiResultOfEcfResponse**](../Model/PaginatedApiResultOfEcfResponse.md)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `searchEcfs()`

```php
searchEcfs($rnc, $encfs, $ids, $tipos_ecfs, $include_ecf_content, $from_fecha_emision, $to_fecha_emision, $amount_from, $amount_to, $progresses, $dgii_estados, $page, $limit): \Ecfx\EcfDgii\Model\PaginatedApiResultOfEcfResponse
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: Bearer
$config = Ecfx\EcfDgii\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Ecfx\EcfDgii\Api\EcfApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$rnc = 'rnc_example'; // string
$encfs = array('encfs_example'); // string[]
$ids = array('ids_example'); // string[]
$tipos_ecfs = array(new \Ecfx\EcfDgii\Model\\Ecfx\EcfDgii\Model\AllTipoECFTypes()); // \Ecfx\EcfDgii\Model\AllTipoECFTypes[]
$include_ecf_content = false; // bool
$from_fecha_emision = new \DateTime('2013-10-20T19:20:30+01:00'); // \DateTime
$to_fecha_emision = new \DateTime('2013-10-20T19:20:30+01:00'); // \DateTime
$amount_from = new \Ecfx\EcfDgii\Model\\Ecfx\EcfDgii\Model\SearchEcfsAmountFromParameter(); // \Ecfx\EcfDgii\Model\SearchEcfsAmountFromParameter
$amount_to = new \Ecfx\EcfDgii\Model\\Ecfx\EcfDgii\Model\SearchEcfsAmountFromParameter(); // \Ecfx\EcfDgii\Model\SearchEcfsAmountFromParameter
$progresses = array(new \Ecfx\EcfDgii\Model\\Ecfx\EcfDgii\Model\EcfProgress()); // \Ecfx\EcfDgii\Model\EcfProgress[]
$dgii_estados = array(new \Ecfx\EcfDgii\Model\\Ecfx\EcfDgii\Model\EcfEstado()); // \Ecfx\EcfDgii\Model\EcfEstado[]
$page = new \Ecfx\EcfDgii\Model\\Ecfx\EcfDgii\Model\GetCompaniesPageParameter(); // \Ecfx\EcfDgii\Model\GetCompaniesPageParameter
$limit = new \Ecfx\EcfDgii\Model\\Ecfx\EcfDgii\Model\GetCompaniesLimitParameter(); // \Ecfx\EcfDgii\Model\GetCompaniesLimitParameter

try {
    $result = $apiInstance->searchEcfs($rnc, $encfs, $ids, $tipos_ecfs, $include_ecf_content, $from_fecha_emision, $to_fecha_emision, $amount_from, $amount_to, $progresses, $dgii_estados, $page, $limit);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EcfApi->searchEcfs: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **rnc** | **string**|  | |
| **encfs** | [**string[]**](../Model/string.md)|  | [optional] |
| **ids** | [**string[]**](../Model/string.md)|  | [optional] |
| **tipos_ecfs** | [**\Ecfx\EcfDgii\Model\AllTipoECFTypes[]**](../Model/\Ecfx\EcfDgii\Model\AllTipoECFTypes.md)|  | [optional] |
| **include_ecf_content** | **bool**|  | [optional] [default to false] |
| **from_fecha_emision** | **\DateTime**|  | [optional] |
| **to_fecha_emision** | **\DateTime**|  | [optional] |
| **amount_from** | **\Ecfx\EcfDgii\Model\SearchEcfsAmountFromParameter**|  | [optional] |
| **amount_to** | **\Ecfx\EcfDgii\Model\SearchEcfsAmountFromParameter**|  | [optional] |
| **progresses** | [**\Ecfx\EcfDgii\Model\EcfProgress[]**](../Model/\Ecfx\EcfDgii\Model\EcfProgress.md)|  | [optional] |
| **dgii_estados** | [**\Ecfx\EcfDgii\Model\EcfEstado[]**](../Model/\Ecfx\EcfDgii\Model\EcfEstado.md)|  | [optional] |
| **page** | **\Ecfx\EcfDgii\Model\GetCompaniesPageParameter**|  | [optional] [default to 1] |
| **limit** | **\Ecfx\EcfDgii\Model\GetCompaniesLimitParameter**|  | [optional] [default to 25] |

### Return type

[**\Ecfx\EcfDgii\Model\PaginatedApiResultOfEcfResponse**](../Model/PaginatedApiResultOfEcfResponse.md)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

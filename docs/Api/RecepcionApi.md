# Ecfx\EcfDgii\RecepcionApi



All URIs are relative to https://api.test.ecfx.ssd.com.do, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**getEcfReceptionRequest()**](RecepcionApi.md#getEcfReceptionRequest) | **GET** /recepcion/{messageId} |  |
| [**getEcfReceptorByMessageId()**](RecepcionApi.md#getEcfReceptorByMessageId) | **GET** /recepcion/{rnc}/{messageId} |  |
| [**searchEcfReceptionRequests()**](RecepcionApi.md#searchEcfReceptionRequests) | **GET** /recepcion |  |
| [**searchEcfReceptionRequestsByRnc()**](RecepcionApi.md#searchEcfReceptionRequestsByRnc) | **GET** /recepcion/{rnc} |  |
| [**sendAprobacionComercial()**](RecepcionApi.md#sendAprobacionComercial) | **POST** /recepcion/{messageId}/acecf |  |


## `getEcfReceptionRequest()`

```php
getEcfReceptionRequest($message_id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: Bearer
$config = Ecfx\EcfDgii\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Ecfx\EcfDgii\Api\RecepcionApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$message_id = 'message_id_example'; // string

try {
    $apiInstance->getEcfReceptionRequest($message_id);
} catch (Exception $e) {
    echo 'Exception when calling RecepcionApi->getEcfReceptionRequest: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **message_id** | **string**|  | |

### Return type

void (empty response body)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getEcfReceptorByMessageId()`

```php
getEcfReceptorByMessageId($rnc, $message_id): \Ecfx\EcfDgii\Model\EcfReceptorDto
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: Bearer
$config = Ecfx\EcfDgii\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Ecfx\EcfDgii\Api\RecepcionApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$rnc = 'rnc_example'; // string
$message_id = 'message_id_example'; // string

try {
    $result = $apiInstance->getEcfReceptorByMessageId($rnc, $message_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling RecepcionApi->getEcfReceptorByMessageId: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **rnc** | **string**|  | |
| **message_id** | **string**|  | |

### Return type

[**\Ecfx\EcfDgii\Model\EcfReceptorDto**](../Model/EcfReceptorDto.md)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `searchEcfReceptionRequests()`

```php
searchEcfReceptionRequests($message_ids, $encfs, $rncs, $rnc_emisors, $tipos_ecfs, $progresses, $from_date, $to_date, $amount_from, $amount_to, $ocultar_no_recibidas, $page, $limit): \Ecfx\EcfDgii\Model\PaginatedApiResultOfEcfReceptionRequestDto
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: Bearer
$config = Ecfx\EcfDgii\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Ecfx\EcfDgii\Api\RecepcionApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$message_ids = array('message_ids_example'); // string[]
$encfs = array('encfs_example'); // string[]
$rncs = array('rncs_example'); // string[]
$rnc_emisors = array('rnc_emisors_example'); // string[]
$tipos_ecfs = array(new \Ecfx\EcfDgii\Model\\Ecfx\EcfDgii\Model\SearchEcfReceptionRequestsTiposEcfsParameterInner()); // \Ecfx\EcfDgii\Model\SearchEcfReceptionRequestsTiposEcfsParameterInner[]
$progresses = array(new \Ecfx\EcfDgii\Model\\Ecfx\EcfDgii\Model\SearchEcfReceptionRequestsTiposEcfsParameterInner()); // \Ecfx\EcfDgii\Model\SearchEcfReceptionRequestsTiposEcfsParameterInner[]
$from_date = 'from_date_example'; // string
$to_date = 'to_date_example'; // string
$amount_from = new \Ecfx\EcfDgii\Model\\Ecfx\EcfDgii\Model\SearchEcfsAmountFromParameter(); // \Ecfx\EcfDgii\Model\SearchEcfsAmountFromParameter
$amount_to = new \Ecfx\EcfDgii\Model\\Ecfx\EcfDgii\Model\SearchEcfsAmountFromParameter(); // \Ecfx\EcfDgii\Model\SearchEcfsAmountFromParameter
$ocultar_no_recibidas = True; // bool
$page = new \Ecfx\EcfDgii\Model\\Ecfx\EcfDgii\Model\GetCompaniesPageParameter(); // \Ecfx\EcfDgii\Model\GetCompaniesPageParameter
$limit = new \Ecfx\EcfDgii\Model\\Ecfx\EcfDgii\Model\GetCompaniesLimitParameter(); // \Ecfx\EcfDgii\Model\GetCompaniesLimitParameter

try {
    $result = $apiInstance->searchEcfReceptionRequests($message_ids, $encfs, $rncs, $rnc_emisors, $tipos_ecfs, $progresses, $from_date, $to_date, $amount_from, $amount_to, $ocultar_no_recibidas, $page, $limit);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling RecepcionApi->searchEcfReceptionRequests: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **message_ids** | [**string[]**](../Model/string.md)|  | [optional] |
| **encfs** | [**string[]**](../Model/string.md)|  | [optional] |
| **rncs** | [**string[]**](../Model/string.md)|  | [optional] |
| **rnc_emisors** | [**string[]**](../Model/string.md)|  | [optional] |
| **tipos_ecfs** | [**\Ecfx\EcfDgii\Model\SearchEcfReceptionRequestsTiposEcfsParameterInner[]**](../Model/\Ecfx\EcfDgii\Model\SearchEcfReceptionRequestsTiposEcfsParameterInner.md)|  | [optional] |
| **progresses** | [**\Ecfx\EcfDgii\Model\SearchEcfReceptionRequestsTiposEcfsParameterInner[]**](../Model/\Ecfx\EcfDgii\Model\SearchEcfReceptionRequestsTiposEcfsParameterInner.md)|  | [optional] |
| **from_date** | **string**|  | [optional] |
| **to_date** | **string**|  | [optional] |
| **amount_from** | **\Ecfx\EcfDgii\Model\SearchEcfsAmountFromParameter**|  | [optional] |
| **amount_to** | **\Ecfx\EcfDgii\Model\SearchEcfsAmountFromParameter**|  | [optional] |
| **ocultar_no_recibidas** | **bool**|  | [optional] |
| **page** | **\Ecfx\EcfDgii\Model\GetCompaniesPageParameter**|  | [optional] [default to 1] |
| **limit** | **\Ecfx\EcfDgii\Model\GetCompaniesLimitParameter**|  | [optional] [default to 25] |

### Return type

[**\Ecfx\EcfDgii\Model\PaginatedApiResultOfEcfReceptionRequestDto**](../Model/PaginatedApiResultOfEcfReceptionRequestDto.md)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `searchEcfReceptionRequestsByRnc()`

```php
searchEcfReceptionRequestsByRnc($rnc, $message_ids, $encfs, $rnc_emisors, $tipos_ecfs, $progresses, $from_date, $to_date, $amount_from, $amount_to, $ocultar_no_recibidas, $page, $limit): \Ecfx\EcfDgii\Model\PaginatedApiResultOfEcfReceptionRequestDto
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: Bearer
$config = Ecfx\EcfDgii\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Ecfx\EcfDgii\Api\RecepcionApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$rnc = 'rnc_example'; // string
$message_ids = array('message_ids_example'); // string[]
$encfs = array('encfs_example'); // string[]
$rnc_emisors = array('rnc_emisors_example'); // string[]
$tipos_ecfs = array(new \Ecfx\EcfDgii\Model\\Ecfx\EcfDgii\Model\SearchEcfReceptionRequestsTiposEcfsParameterInner()); // \Ecfx\EcfDgii\Model\SearchEcfReceptionRequestsTiposEcfsParameterInner[]
$progresses = array(new \Ecfx\EcfDgii\Model\\Ecfx\EcfDgii\Model\SearchEcfReceptionRequestsTiposEcfsParameterInner()); // \Ecfx\EcfDgii\Model\SearchEcfReceptionRequestsTiposEcfsParameterInner[]
$from_date = 'from_date_example'; // string
$to_date = 'to_date_example'; // string
$amount_from = new \Ecfx\EcfDgii\Model\\Ecfx\EcfDgii\Model\SearchEcfsAmountFromParameter(); // \Ecfx\EcfDgii\Model\SearchEcfsAmountFromParameter
$amount_to = new \Ecfx\EcfDgii\Model\\Ecfx\EcfDgii\Model\SearchEcfsAmountFromParameter(); // \Ecfx\EcfDgii\Model\SearchEcfsAmountFromParameter
$ocultar_no_recibidas = True; // bool
$page = new \Ecfx\EcfDgii\Model\\Ecfx\EcfDgii\Model\GetCompaniesPageParameter(); // \Ecfx\EcfDgii\Model\GetCompaniesPageParameter
$limit = new \Ecfx\EcfDgii\Model\\Ecfx\EcfDgii\Model\GetCompaniesLimitParameter(); // \Ecfx\EcfDgii\Model\GetCompaniesLimitParameter

try {
    $result = $apiInstance->searchEcfReceptionRequestsByRnc($rnc, $message_ids, $encfs, $rnc_emisors, $tipos_ecfs, $progresses, $from_date, $to_date, $amount_from, $amount_to, $ocultar_no_recibidas, $page, $limit);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling RecepcionApi->searchEcfReceptionRequestsByRnc: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **rnc** | **string**|  | |
| **message_ids** | [**string[]**](../Model/string.md)|  | [optional] |
| **encfs** | [**string[]**](../Model/string.md)|  | [optional] |
| **rnc_emisors** | [**string[]**](../Model/string.md)|  | [optional] |
| **tipos_ecfs** | [**\Ecfx\EcfDgii\Model\SearchEcfReceptionRequestsTiposEcfsParameterInner[]**](../Model/\Ecfx\EcfDgii\Model\SearchEcfReceptionRequestsTiposEcfsParameterInner.md)|  | [optional] |
| **progresses** | [**\Ecfx\EcfDgii\Model\SearchEcfReceptionRequestsTiposEcfsParameterInner[]**](../Model/\Ecfx\EcfDgii\Model\SearchEcfReceptionRequestsTiposEcfsParameterInner.md)|  | [optional] |
| **from_date** | **string**|  | [optional] |
| **to_date** | **string**|  | [optional] |
| **amount_from** | **\Ecfx\EcfDgii\Model\SearchEcfsAmountFromParameter**|  | [optional] |
| **amount_to** | **\Ecfx\EcfDgii\Model\SearchEcfsAmountFromParameter**|  | [optional] |
| **ocultar_no_recibidas** | **bool**|  | [optional] |
| **page** | **\Ecfx\EcfDgii\Model\GetCompaniesPageParameter**|  | [optional] [default to 1] |
| **limit** | **\Ecfx\EcfDgii\Model\GetCompaniesLimitParameter**|  | [optional] [default to 25] |

### Return type

[**\Ecfx\EcfDgii\Model\PaginatedApiResultOfEcfReceptionRequestDto**](../Model/PaginatedApiResultOfEcfReceptionRequestDto.md)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `sendAprobacionComercial()`

```php
sendAprobacionComercial($message_id, $send_acecf_request)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: Bearer
$config = Ecfx\EcfDgii\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Ecfx\EcfDgii\Api\RecepcionApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$message_id = 'message_id_example'; // string
$send_acecf_request = new \Ecfx\EcfDgii\Model\SendAcecfRequest(); // \Ecfx\EcfDgii\Model\SendAcecfRequest

try {
    $apiInstance->sendAprobacionComercial($message_id, $send_acecf_request);
} catch (Exception $e) {
    echo 'Exception when calling RecepcionApi->sendAprobacionComercial: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **message_id** | **string**|  | |
| **send_acecf_request** | [**\Ecfx\EcfDgii\Model\SendAcecfRequest**](../Model/SendAcecfRequest.md)|  | |

### Return type

void (empty response body)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

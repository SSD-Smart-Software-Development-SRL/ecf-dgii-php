# Ecfx\EcfDgii\AprobacionComercialApi



All URIs are relative to https://api.test.ecfx.ssd.com.do, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**getAcecfReceptionRequest()**](AprobacionComercialApi.md#getAcecfReceptionRequest) | **GET** /recepcion/acecf/{messageId} |  |
| [**searchAcecfReceptionRequests()**](AprobacionComercialApi.md#searchAcecfReceptionRequests) | **GET** /recepcion/acecf |  |


## `getAcecfReceptionRequest()`

```php
getAcecfReceptionRequest($message_id)
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: Bearer
$config = Ecfx\EcfDgii\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Ecfx\EcfDgii\Api\AprobacionComercialApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$message_id = 'message_id_example'; // string

try {
    $apiInstance->getAcecfReceptionRequest($message_id);
} catch (Exception $e) {
    echo 'Exception when calling AprobacionComercialApi->getAcecfReceptionRequest: ', $e->getMessage(), PHP_EOL;
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

## `searchAcecfReceptionRequests()`

```php
searchAcecfReceptionRequests($message_ids, $encfs, $rncs, $progresses, $page, $limit): \Ecfx\EcfDgii\Model\PaginatedApiResultOfAcecfReceptionRequestDto
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: Bearer
$config = Ecfx\EcfDgii\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Ecfx\EcfDgii\Api\AprobacionComercialApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$message_ids = array('message_ids_example'); // string[]
$encfs = array('encfs_example'); // string[]
$rncs = array('rncs_example'); // string[]
$progresses = array(new \Ecfx\EcfDgii\Model\\Ecfx\EcfDgii\Model\SearchEcfReceptionRequestsTiposEcfsParameterInner()); // \Ecfx\EcfDgii\Model\SearchEcfReceptionRequestsTiposEcfsParameterInner[]
$page = new \Ecfx\EcfDgii\Model\\Ecfx\EcfDgii\Model\GetCompaniesPageParameter(); // \Ecfx\EcfDgii\Model\GetCompaniesPageParameter
$limit = new \Ecfx\EcfDgii\Model\\Ecfx\EcfDgii\Model\GetCompaniesLimitParameter(); // \Ecfx\EcfDgii\Model\GetCompaniesLimitParameter

try {
    $result = $apiInstance->searchAcecfReceptionRequests($message_ids, $encfs, $rncs, $progresses, $page, $limit);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AprobacionComercialApi->searchAcecfReceptionRequests: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **message_ids** | [**string[]**](../Model/string.md)|  | [optional] |
| **encfs** | [**string[]**](../Model/string.md)|  | [optional] |
| **rncs** | [**string[]**](../Model/string.md)|  | [optional] |
| **progresses** | [**\Ecfx\EcfDgii\Model\SearchEcfReceptionRequestsTiposEcfsParameterInner[]**](../Model/\Ecfx\EcfDgii\Model\SearchEcfReceptionRequestsTiposEcfsParameterInner.md)|  | [optional] |
| **page** | **\Ecfx\EcfDgii\Model\GetCompaniesPageParameter**|  | [optional] [default to 1] |
| **limit** | **\Ecfx\EcfDgii\Model\GetCompaniesLimitParameter**|  | [optional] [default to 25] |

### Return type

[**\Ecfx\EcfDgii\Model\PaginatedApiResultOfAcecfReceptionRequestDto**](../Model/PaginatedApiResultOfAcecfReceptionRequestDto.md)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

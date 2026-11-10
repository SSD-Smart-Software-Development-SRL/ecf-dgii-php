# # CompanyResponse

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**rnc** | **string** |  | [optional]
**legal_name** | **string** |  | [optional]
**name** | **string** |  | [optional]
**created_on** | **\DateTime** |  | [optional]
**updated_on** | **\DateTime** |  | [optional]
**created_by** | **string** |  | [optional]
**updated_by** | **string** |  | [optional]
**tenant_id** | **string** |  | [optional]
**receptor_id** | **string** |  | [optional]
**urls** | [**\Ecfx\EcfDgii\Model\CompanyUrlsResponse**](CompanyUrlsResponse.md) |  | [optional]
**certification** | [**\Ecfx\EcfDgii\Model\CertificationStateResponse**](CertificationStateResponse.md) | CERT-01: the company&#39;s certification state. | [optional]
**archived_at** | **\DateTime** | When the company was archived; null while it is active. | [optional]
**archived_by** | **string** | Who archived it and why, the last time it was archived; kept after a restore as history. | [optional]
**archive_reason** | **string** |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)

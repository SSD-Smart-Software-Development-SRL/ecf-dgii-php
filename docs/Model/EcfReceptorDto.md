# # EcfReceptorDto

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**ecf_receptor_id** | **string** |  | [optional]
**tenant_id** | **string** |  | [optional]
**company_rnc** | **string** |  | [optional]
**encf** | **string** |  | [optional]
**rnc_emisor** | **string** |  | [optional]
**rnc_receptor** | **string** |  | [optional]
**tipo_ecf** | [**\Ecfx\EcfDgii\Model\AllTipoECFTypes**](AllTipoECFTypes.md) |  | [optional]
**monto_total** | [**\Ecfx\EcfDgii\Model\SearchEcfsAmountFromParameter**](SearchEcfsAmountFromParameter.md) |  | [optional]
**fecha_emision** | **\DateTime** |  | [optional]
**file_name** | **string** |  | [optional]
**raw_json_data** | **string** |  | [optional]
**created_on** | **\DateTime** |  | [optional]
**fecha_firma** | **\DateTime** |  | [optional]
**cod_sec** | **string** |  | [optional]
**estado** | [**\Ecfx\EcfDgii\Model\EcfReceptorDtoEstado**](EcfReceptorDtoEstado.md) |  | [optional]
**progress** | [**\Ecfx\EcfDgii\Model\EcfReceptorDtoProgress**](EcfReceptorDtoProgress.md) |  | [optional]
**ambiente** | **string** | DGII environment serving this tenant (\&quot;Test\&quot;/\&quot;Certification\&quot;/\&quot;Production\&quot;). | [optional]
**url_impresion** | **string** | DGII consulta-timbre URL with QR query string. | [optional]
**acecfs** | [**\Ecfx\EcfDgii\Model\AcecfSummaryDto[]**](AcecfSummaryDto.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)

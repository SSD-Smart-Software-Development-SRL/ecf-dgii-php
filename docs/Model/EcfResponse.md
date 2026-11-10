# # EcfResponse

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**message_id** | **string** |  |
**timestamp** | **\DateTime** |  |
**fecha_emision** | **\DateTime** |  |
**queue_name** | **string** |  |
**include_ecf_content** | **bool** |  |
**ecf_content** | **string** |  |
**tipo_ecf** | [**\Ecfx\EcfDgii\Model\AllTipoECFTypes**](AllTipoECFTypes.md) |  |
**encf** | **string** |  |
**rnc_emisor** | **string** |  |
**rnc_receptor** | **string** |  |
**monto_total** | [**\Ecfx\EcfDgii\Model\SearchEcfsAmountFromParameter**](SearchEcfsAmountFromParameter.md) |  |
**file_name** | **string** |  |
**tenant_id** | **string** |  |
**estatus** | [**\Ecfx\EcfDgii\Model\EcfEstado**](EcfEstado.md) |  |
**cod_sec** | **string** |  |
**fecha_firma** | **\DateTime** |  |
**mensaje** | **string** |  |
**errors** | **string** |  |
**progress** | [**\Ecfx\EcfDgii\Model\EcfProgress**](EcfProgress.md) |  |
**emisor_receptor_errors** | **string** |  |
**secuencia_utilizada** | **bool** |  |
**dgii_environment** | [**\Ecfx\EcfDgii\Model\DGIIEnvironment**](DGIIEnvironment.md) |  |
**acecfs** | [**\Ecfx\EcfDgii\Model\AcecfSummaryDto[]**](AcecfSummaryDto.md) | ACECFs received from the receptor for this outbound ECF. | [optional]
**receptor_directory_status** | [**\Ecfx\EcfDgii\Model\ReceptorDirectoryStatus**](ReceptorDirectoryStatus.md) |  | [optional]
**dgii_submission_state** | [**\Ecfx\EcfDgii\Model\DgiiSubmissionState**](DgiiSubmissionState.md) | Where the DGII transmission of this ECF stands. Null for documents created before durable submission. &#x60;PendingReconciliation&#x60;: DGII&#39;s answer is not confirmed yet; do not resend or reuse the eNCF. &#x60;NotReceived&#x60;: DGII confirmed it has no record of the document (Progress is Error, Estatus is null and SecuenciaUtilizada is false); the same eNCF may be submitted again as a new request. | [optional]
**impresion_url** | **string** |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)

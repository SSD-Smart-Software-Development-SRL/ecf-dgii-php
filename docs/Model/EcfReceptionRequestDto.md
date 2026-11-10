# # EcfReceptionRequestDto

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**message_id** | **string** |  | [optional]
**tenant_id** | **string** |  | [optional]
**company_rnc** | **string** |  | [optional]
**file_name** | **string** |  | [optional]
**progress** | [**\Ecfx\EcfDgii\Model\SearchEcfReceptionRequestsTiposEcfsParameterInner**](SearchEcfReceptionRequestsTiposEcfsParameterInner.md) |  | [optional]
**created_on** | **\DateTime** |  | [optional]
**updated_on** | **\DateTime** |  | [optional]
**error_message** | **string** |  | [optional]
**encf** | **string** |  | [optional]
**rnc_emisor** | **string** |  | [optional]
**tipo_ecf** | [**\Ecfx\EcfDgii\Model\AllTipoECFTypes**](AllTipoECFTypes.md) |  | [optional]
**result_internal_file_name** | **string** |  | [optional]
**monto_total** | [**\Ecfx\EcfDgii\Model\EcfReceptionRequestDtoMontoTotal**](EcfReceptionRequestDtoMontoTotal.md) |  | [optional]
**reprocessed_on** | **\DateTime** | When the reception was run again after it ended without registering the e-CF. | [optional]
**recuperada** | **bool** | True when the first reception failed and the e-CF was registered by running it again, so the UI can flag it as recovered. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)

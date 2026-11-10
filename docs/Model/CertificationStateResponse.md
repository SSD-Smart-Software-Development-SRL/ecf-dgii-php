# # CertificationStateResponse

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**state** | **string** | One of CertificationStates. | [optional]
**source** | **string** | One of CertificationStateSources; null while not started. | [optional]
**step** | [**\Ecfx\EcfDgii\Model\CertificationStep**](CertificationStep.md) | Internal step (in progress, error). | [optional]
**step_number** | [**\Ecfx\EcfDgii\Model\CertificationStateResponseStepNumber**](CertificationStateResponseStepNumber.md) |  | [optional]
**total_steps** | [**\Ecfx\EcfDgii\Model\SearchEcfReceptionRequestsTiposEcfsParameterInner**](SearchEcfReceptionRequestsTiposEcfsParameterInner.md) |  | [optional]
**responsible** | **string** | One of CertificationResponsibles while in progress. | [optional]
**stalled** | **bool** | In progress without any activity for int CertificationStateCalculator.StalledAfterDays days. | [optional]
**last_activity_on** | **\DateTime** |  | [optional]
**certified_on** | **\DateTime** | DGII authorisation date, when known (DGII listing or declared by the customer). | [optional]
**changed_on** | **\DateTime** | When the stored state last changed. | [optional]
**signature_review_pending** | **bool** | A step was signed outside the platform and the signature could not be verified (CERT-04). | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)

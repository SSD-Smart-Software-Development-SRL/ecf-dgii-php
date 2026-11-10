<?php

declare(strict_types=1);

namespace Ecfx\EcfDgii\Tests;

use Ecfx\EcfDgii\EcfService;
use Ecfx\EcfDgii\Model\DgiiSubmissionState;
use Ecfx\EcfDgii\Model\EcfProgress;
use Ecfx\EcfDgii\Model\EcfResponse;
use Ecfx\EcfDgii\ObjectSerializer;
use PHPUnit\Framework\TestCase;

final class DgiiSubmissionStateTest extends TestCase
{
    private static function deserialize(array $json): EcfResponse
    {
        $data = json_decode(json_encode($json), false);

        /** @var EcfResponse $response */
        $response = ObjectSerializer::deserialize($data, EcfResponse::class, []);

        return $response;
    }

    public function testNotReceivedIsResubmittable(): void
    {
        $response = self::deserialize([
            'messageId' => 'm-1',
            'encf' => 'E320000000001',
            'progress' => 'Error',
            'estatus' => null,
            'secuenciaUtilizada' => false,
            'errors' => 'La DGII no tiene registro de este comprobante.',
            'dgiiSubmissionState' => 'NotReceived',
        ]);

        $this->assertSame(DgiiSubmissionState::NOT_RECEIVED, $response->getDgiiSubmissionState());
        $this->assertSame(EcfProgress::ERROR, $response->getProgress());
        $this->assertNull($response->getEstatus());
        $this->assertFalse($response->getSecuenciaUtilizada());
        $this->assertTrue(EcfService::canResubmitSameEncf($response));
        $this->assertFalse(EcfService::isPendingReconciliation($response));
    }

    public function testPendingReconciliationIsInProgress(): void
    {
        $response = self::deserialize([
            'messageId' => 'm-1',
            'progress' => 'UploadedToDgii',
            'estatus' => 'EnProceso',
            'dgiiSubmissionState' => 'PendingReconciliation',
        ]);

        $this->assertSame(DgiiSubmissionState::PENDING_RECONCILIATION, $response->getDgiiSubmissionState());
        $this->assertTrue(EcfService::isPendingReconciliation($response));
        $this->assertFalse(EcfService::canResubmitSameEncf($response));
    }

    public function testNullAndMissingStateDeserializeToNull(): void
    {
        $explicitNull = self::deserialize(['messageId' => 'm-1', 'dgiiSubmissionState' => null]);
        $missing = self::deserialize(['messageId' => 'm-1']);

        $this->assertNull($explicitNull->getDgiiSubmissionState());
        $this->assertNull($missing->getDgiiSubmissionState());
        $this->assertFalse(EcfService::canResubmitSameEncf($missing));
        $this->assertFalse(EcfService::isPendingReconciliation($missing));
    }

    public function testUnknownEnumValuesPassThroughWithoutThrowing(): void
    {
        $response = self::deserialize([
            'messageId' => 'm-1',
            'progress' => 'SomeFutureProgress',
            'dgiiSubmissionState' => 'SomeFutureState',
        ]);

        $this->assertSame('SomeFutureState', $response->getDgiiSubmissionState());
        $this->assertSame('SomeFutureProgress', $response->getProgress());
        $this->assertFalse(EcfService::canResubmitSameEncf($response));
    }
}

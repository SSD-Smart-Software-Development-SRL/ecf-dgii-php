<?php

declare(strict_types=1);

namespace Ecfx\EcfDgii;

use Ecfx\EcfDgii\Model\EcfResponse;

/**
 * Thrown when polling for ECF processing result exceeds the maximum number of attempts.
 *
 * If the last response is PendingReconciliation, DGII's result is not confirmed
 * yet: do not resend or reuse the eNCF; query it again later.
 */
class EcfPollingTimeoutException extends ApiException
{
    private ?EcfResponse $lastResponse;

    public function __construct(string $message, ?\Throwable $previous = null, ?EcfResponse $lastResponse = null)
    {
        $this->lastResponse = $lastResponse;
        parent::__construct($message, 0, null, null, $previous);
    }

    /**
     * The last ECF response seen while polling, if any.
     */
    public function getLastResponse(): ?EcfResponse
    {
        return $this->lastResponse;
    }
}

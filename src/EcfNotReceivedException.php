<?php

declare(strict_types=1);

namespace Ecfx\EcfDgii;

/**
 * Thrown when DGII confirms it has no record of the submitted document
 * (dgiiSubmissionState = NotReceived).
 *
 * The eNCF was not used (secuenciaUtilizada = false): the same eNCF may be
 * submitted again as a new request. Extends EcfProcessingException so existing
 * catch blocks keep working.
 */
class EcfNotReceivedException extends EcfProcessingException
{
}

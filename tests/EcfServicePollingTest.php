<?php

declare(strict_types=1);

namespace Ecfx\EcfDgii\Tests;

use Ecfx\EcfDgii\Api\EcfApi;
use Ecfx\EcfDgii\Configuration;
use Ecfx\EcfDgii\EcfFrontendClient;
use Ecfx\EcfDgii\EcfNotReceivedException;
use Ecfx\EcfDgii\EcfPollingTimeoutException;
use Ecfx\EcfDgii\EcfProcessingException;
use Ecfx\EcfDgii\EcfService;
use Ecfx\EcfDgii\Model\DgiiSubmissionState;
use Ecfx\EcfDgii\Model\Ecf32ECF;
use Ecfx\EcfDgii\Model\Ecf32Emisor;
use Ecfx\EcfDgii\Model\Ecf32Encabezado;
use Ecfx\EcfDgii\Model\Ecf32IdDoc;
use Ecfx\EcfDgii\Model\TipoeCFType;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

final class EcfServicePollingTest extends TestCase
{
    private const RNC = '131887651';
    private const ENCF = 'E320000000001';

    /** @var array<int, array{request: \Psr\Http\Message\RequestInterface}> */
    private array $history = [];

    private function client(array $responses): array
    {
        $this->history = [];
        $stack = HandlerStack::create(new MockHandler($responses));
        $stack->push(Middleware::history($this->history));

        $client = new Client(['handler' => $stack]);
        $config = (new Configuration())->setHost('https://api.test.local');

        return [$client, $config];
    }

    private function service(array $responses): EcfService
    {
        [$client, $config] = $this->client($responses);

        return new EcfService(new EcfApi($client, $config), pollingMaxAttempts: 3, pollingIntervalSeconds: 0);
    }

    private static function ecf32(): Ecf32ECF
    {
        return new Ecf32ECF([
            'encabezado' => new Ecf32Encabezado([
                'id_doc' => new Ecf32IdDoc(['tipoe_cf' => TipoeCFType::FACTURA_DE_CONSUMO_ELECTRONICA]),
                'emisor' => new Ecf32Emisor(['rnc_emisor' => self::RNC]),
            ]),
        ]);
    }

    private static function json(array|object $body): Response
    {
        return new Response(200, ['Content-Type' => 'application/json'], json_encode($body));
    }

    private static function accepted(): Response
    {
        return self::json(['messageId' => 'msg-1', 'encf' => self::ENCF, 'progress' => 'New']);
    }

    private static function pending(): Response
    {
        return self::json([[
            'messageId' => 'msg-1',
            'encf' => self::ENCF,
            'progress' => 'UploadedToDgii',
            'estatus' => 'EnProceso',
            'dgiiSubmissionState' => 'PendingReconciliation',
        ]]);
    }

    public function testPendingReconciliationKeepsPollingUntilFinished(): void
    {
        $service = $this->service([
            self::accepted(),
            self::pending(),
            self::json([[
                'messageId' => 'msg-1',
                'encf' => self::ENCF,
                'progress' => 'Finished',
                'estatus' => 'Aceptado',
                'dgiiSubmissionState' => 'Accepted',
            ]]),
        ]);

        $result = $service->sendEcf(self::ecf32());

        $this->assertSame(DgiiSubmissionState::ACCEPTED, $result->getDgiiSubmissionState());
        $this->assertCount(3, $this->history);
        $this->assertSame('/ecf/32', $this->history[0]['request']->getUri()->getPath());
        $this->assertSame('/ecf/' . self::RNC . '/message/msg-1', $this->history[1]['request']->getUri()->getPath());
    }

    public function testNotReceivedThrowsResubmittableException(): void
    {
        $service = $this->service([
            self::accepted(),
            self::pending(),
            self::json([[
                'messageId' => 'msg-1',
                'encf' => self::ENCF,
                'progress' => 'Error',
                'estatus' => null,
                'secuenciaUtilizada' => false,
                'errors' => 'La DGII no tiene registro de este comprobante.',
                'dgiiSubmissionState' => 'NotReceived',
            ]]),
        ]);

        try {
            $service->sendEcf(self::ecf32());
            $this->fail('Expected EcfNotReceivedException');
        } catch (EcfNotReceivedException $e) {
            $this->assertInstanceOf(EcfProcessingException::class, $e);
            $this->assertTrue(EcfService::canResubmitSameEncf($e->getEcfResponse()));
            $this->assertFalse($e->getEcfResponse()->getSecuenciaUtilizada());
            $this->assertStringContainsString(self::ENCF, $e->getMessage());
        }
    }

    public function testPlainErrorStillThrowsProcessingException(): void
    {
        $service = $this->service([
            self::accepted(),
            self::json([[
                'messageId' => 'msg-1',
                'encf' => self::ENCF,
                'progress' => 'Error',
                'errors' => 'Rechazado',
                'dgiiSubmissionState' => 'Rejected',
            ]]),
        ]);

        try {
            $service->sendEcf(self::ecf32());
            $this->fail('Expected EcfProcessingException');
        } catch (EcfNotReceivedException $e) {
            $this->fail('Rejected must not be reported as NotReceived');
        } catch (EcfProcessingException $e) {
            $this->assertStringContainsString('Rechazado', $e->getMessage());
        }
    }

    public function testTimeoutWhilePendingReconciliationWarnsNotToResend(): void
    {
        $service = $this->service([self::accepted(), self::pending(), self::pending(), self::pending()]);

        try {
            $service->sendEcf(self::ecf32());
            $this->fail('Expected EcfPollingTimeoutException');
        } catch (EcfPollingTimeoutException $e) {
            $this->assertStringContainsString('PendingReconciliation', $e->getMessage());
            $this->assertNotNull($e->getLastResponse());
            $this->assertTrue(EcfService::isPendingReconciliation($e->getLastResponse()));
        }
    }

    public function testFrontendClientSendsPageAndLimitToTheRightQueryParams(): void
    {
        [$client, $config] = $this->client([
            self::json(['items' => [], 'page' => 2, 'limit' => 50, 'totalCount' => 0]),
            self::json(['items' => [], 'page' => 1, 'limit' => 25, 'totalCount' => 0]),
        ]);
        $frontend = new EcfFrontendClient($client, $config);

        $frontend->searchEcfs(self::RNC, includeEcfContent: true, page: 2, limit: 50);
        $frontend->getCompanies(search: 'ssd');

        parse_str($this->history[0]['request']->getUri()->getQuery(), $query);
        $this->assertSame('2', $query['Page'] ?? null);
        $this->assertSame('50', $query['Limit'] ?? null);
        $this->assertSame('true', $query['IncludeEcfContent'] ?? null);
        $this->assertArrayNotHasKey('Progresses', $query);

        parse_str($this->history[1]['request']->getUri()->getQuery(), $query);
        $this->assertSame('ssd', $query['Search'] ?? null);
    }
}

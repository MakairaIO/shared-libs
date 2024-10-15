<?php

namespace Makaira\Test\HttpClient;

use Makaira\HttpClient;
use Makaira\HttpClient\Signing;
use PHPUnit\Framework\TestCase;

class SigningTest extends TestCase
{
    public function testSignEmptyBody()
    {
        $aggregate = $this->createMock(HttpClient::class);
        $signer = new Signing($aggregate, 'secret', [$this, 'generateNonce']);

        mt_srand(42);
        $aggregate
            ->method('request')
            ->with('GET', 'http://example.com/', null, [
                'X-Makaira-Nonce: 1608637542',
                'X-Makaira-Hash: f5b12e9f076a338e6da032750c6fa8f09d97e15523198027b66227b16ba7365c'
            ]);

        $response = $signer->request('GET', 'http://example.com/');

        static::assertEquals(200, $response->status);
        static::assertEquals('{"ok":true}', $response->body);
    }

    public function testSignContentBody()
    {
        $aggregate = $this->createMock(HttpClient::class);
        $signer = new Signing($aggregate, 'secret', [$this, 'generateNonce']);

        $aggregate
            ->method('request')
            ->with('GET', 'http://example.com/', '{}', [
                'Content-Type: application/json',
                'X-Makaira-Nonce: 1608637542',
                'X-Makaira-Hash: a1dbdee6e7fb519e9d8ae88c31b73d517cacb27d1ae7610bf794d258dde99515'
            ])
            ->willReturn('{"ok":true}');

        $response = $signer->request('GET', 'http://example.com/', '{}', ['Content-Type: application/json']);

        static::assertEquals(200, $response->status);
        static::assertEquals('{"ok":true}', $response->body);
    }

    public function generateNonce(): int
    {
        return 1608637542;
    }
}

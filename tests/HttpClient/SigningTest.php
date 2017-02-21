<?php

namespace Makaira\HttpClient;

use Makaira\HttpClient;

class SigningTest extends \PHPUnit_Framework_TestCase
{
    public function testSignEmptyBody()
    {
        $aggregate = $this->getMock(HttpClient::class);
        $signer = new Signing($aggregate, 'secret');

        mt_srand(42);
        $aggregate
            ->expects($this->once())
            ->method('request')
            ->with('GET', 'http://example.com/', null, [
                'X-Makaira-Nonce: 1354439493',
                'X-Makaira-Hash: 21cc646f4c2033297b02e2936a9d10d114e599b880bc8066dad019b9a407ea0b'
            ]);

        $signer->request('GET', 'http://example.com/');
    }

    public function testSignContentBody()
    {
        $aggregate = $this->getMock(HttpClient::class);
        $signer = new Signing($aggregate, 'secret');

        mt_srand(42);
        $aggregate
            ->expects($this->once())
            ->method('request')
            ->with('GET', 'http://example.com/', '{}', [
                'Content-Type: application/json',
                'X-Makaira-Nonce: 1354439493',
                'X-Makaira-Hash: 0feefe399121d740eab47f9d226c466bdf8b4dde898b3580f0253d25a027c3ab'
            ]);

        $signer->request('GET', 'http://example.com/', '{}', ['Content-Type: application/json']);
    }
}

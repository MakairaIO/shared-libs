<?php

namespace Makaira\HttpClient;

use Exception;
use Makaira\HttpClient;

use function bin2hex;
use function random_bytes;

class Signing extends HttpClient
{
    /**
     * @var HttpClient
     */
    private $aggregate;

    /**
     * @var string
     */
    private $sharedSecret;

    private $randomNumberGenerator;

    public function __construct(HttpClient $aggregate, string $sharedSecret, callable $rng = null)
    {
        $this->aggregate = $aggregate;
        $this->sharedSecret = $sharedSecret;

        if (null === $rng) {
            $rng = static function () {
                return bin2hex(random_bytes(16));
            };
        }
        $this->randomNumberGenerator = $rng;
    }

    /**
     * Execute a HTTP request to the remote server
     *
     * @param string $method
     * @param string $url
     * @param mixed  $body
     * @param array  $headers
     *
     * @return HttpClient\Response
     * @throws Exception
     */
    public function request($method, $url, $body = null, array $headers = array())
    {
        $nonce = ($this->randomNumberGenerator)();
        $hash = hash_hmac('sha256', $nonce . ':' . $body, $this->sharedSecret);
        $headers[] = 'X-Makaira-Nonce: ' . $nonce;
        $headers[] = 'X-Makaira-Hash: ' . $hash;

        return $this->aggregate->request($method, $url, $body, $headers);
    }

    /**
     * @param int $timeoutMs
     */
    public function setTimeoutMs(int $timeoutMs)
    {
        $this->aggregate->setTimeoutMs($timeoutMs);
    }

    /**
     * @param int $connectTimeoutMs
     */
    public function setConnectTimeoutMs(int $connectTimeoutMs)
    {
        $this->aggregate->setConnectTimeoutMs($connectTimeoutMs);
    }
}

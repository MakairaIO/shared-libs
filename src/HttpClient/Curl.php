<?php
/**
 * Created by PhpStorm.
 * User: support
 * Date: 09.08.17
 * Time: 16:37
 */

namespace Makaira\HttpClient;

use Makaira\HttpClient;

class Curl extends HttpClient
{
    /**
     * Optional default headers for each request.
     *
     * @var array
     */
    private $headers = [];

    /**
     * socket timeout
     *
     * @var float
     */
    private $timeout;

    public function __construct($timeout = 1)
    {
        $this->timeout = $timeout;
    }

    /**
     * Add default headers
     *
     * @param array $headers
     *
     * @return void
     */
    public function addDefaultHeaders(array $headers)
    {
        $this->headers = array_merge(
            $this->headers,
            $headers
        );
    }

    /**
     * Execute a HTTP request to the remote server
     *
     * @param string $method
     * @param string $url
     * @param mixed  $body
     * @param array  $headers
     *
     * @return HttpClient\Reponse
     */
    public function request($method, $url, $body = null, array $headers = [])
    {
        $ch           = curl_init();
        $headerBuffer = fopen('php://memory', 'w+');
        $options      = [];
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array_merge($this->headers, $headers));
        curl_setopt($ch, CURLOPT_WRITEHEADER, $headerBuffer);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $this->timeout);

        $curlResponse = curl_exec($ch);

        if (false === $curlResponse) {
            $error = curl_error($ch);
            curl_close($ch);
            throw new \RuntimeException(
                "Could not connect to server {$url}: " . $error
            );
        }

        curl_close($ch);

        fseek($headerBuffer, 0, SEEK_SET);
        $responseHeaders = stream_get_contents($headerBuffer);
        fclose($headerBuffer);

        $response       = new HttpClient\Response();
        $response->body = $curlResponse;

        $this->parseResponseHeaders($responseHeaders, $response);


        return $response;
    }

    private function parseResponseHeaders($responseHeaders, $response)
    {
        $response->headers = [];
        $rawHeader         = trim($responseHeaders);

        foreach (explode("\r\n", $rawHeader) as $i => $line) {
            if (0 == strlen($line)) {
                continue;
            }

            if (0 === strpos($line, 'HTTP/')) {
                preg_match('(^HTTP/(?P<version>\d+\.\d+)\s+(?P<status>\d+))S', $line, $match);
                $response->status = $match['status'];
            } else {
                list ($key, $value) = explode(': ', $line, 2);

                $response->headers[strtolower($key)] = $value;
            }
        }
    }
}

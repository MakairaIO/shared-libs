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
    private $headers = array();

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
     * @param mixed $body
     * @param array $headers
     * @return HttpClient\Reponse
     */
    public function request($method, $url, $body = null, array $headers = array())
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array_merge($this->headers, $headers));
        curl_setopt($ch, CURLOPT_HEADER, true);
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

        $response = new HttpClient\Response();
        $response->body = $this->get_body_from_curl_response($curlResponse);
        $response->headers = $this->get_headers_from_curl_response($curlResponse);

        preg_match('(^HTTP/(?P<version>\d+\.\d+)\s+(?P<status>\d+))S', $response->headers['http_code'], $match);
        $response->status = $match['status'];

        return $response;
    }

    private function get_body_from_curl_response($response){
        list($header, $body) = explode("\r\n\r\n", $response, 2);
        return $body;
    }

    private function get_headers_from_curl_response($response)
    {
        $headers = array();
        $header_text = substr($response, 0, strpos($response, "\r\n\r\n"));
        foreach (explode("\r\n", $header_text) as $i => $line)
            if ($i === 0)
                $headers['http_code'] = $line;
            else
            {
                list ($key, $value) = explode(': ', $line);

                $headers[$key] = $value;
            }
        return $headers;
    }
}
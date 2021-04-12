<?php

namespace Makaira;

abstract class HttpClient
{
    /**
     * Execute a HTTP request to the remote server
     *
     * @param string $method
     * @param string $url
     * @param mixed $body
     * @param array $headers
     * @return HttpClient\Response
     */
    abstract public function request($method, $url, $body = null, array $headers = array());

    /**
     * Add default headers
     *
     * @param array $headers
     *
     * @return void
     */
    abstract public function addDefaultHeaders(array $headers);

    /**
     * @param int $timeoutMs
     * 
     * @return void
     */
    abstract public function setTimeoutMs(int $timeoutMs);

    /**
     * @param int $connectTimeoutMs
     * 
     * @return void
     */
    abstract public function setConnectTimeoutMs(int $connectTimeoutMs);
}

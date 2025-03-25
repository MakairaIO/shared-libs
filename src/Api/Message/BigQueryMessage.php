<?php

namespace Makaira\Api\Message;

use JsonSerializable;

class BigQueryMessage implements JsonSerializable
{
    /**
     * @var string
     */
    private $requestType;

    /**
     * @var array
     */
    private $data;

    /**
     * @param string $requestType
     * @param array  $data
     */
    public function __construct($requestType, $data)
    {
        $this->data        = $data;
        $this->requestType = $requestType;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'requestType' => $this->requestType,
            'data'        => $this->data,
        ];
    }

    /**
     * @return string
     */
    public function getRequestType()
    {
        return $this->requestType;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }
}

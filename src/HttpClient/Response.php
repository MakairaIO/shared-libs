<?php

namespace Makaira\HttpClient;

class Response extends \Kore\DataObject\DataObject
{
    public $time;
    public $status;
    public $headers;
    public $body;
}

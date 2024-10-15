<?php

namespace Makaira\HttpClient;

use Makaira\DataObject;

class Response extends DataObject
{
    public $totalTime;
    public $status;
    public $headers;
    public $body;
}

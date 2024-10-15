<?php

namespace Makaira\Import;

use Makaira\DataObject;

class Change extends DataObject
{
    public $id;
    public $path;
    public $sequence;
    public $deleted;
    public $type;
    public $data;
}

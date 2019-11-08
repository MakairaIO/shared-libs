<?php
/**
 * Created by PhpStorm.
 * User: tom
 * Date: 25.06.18
 * Time: 12:48
 */

namespace Makaira\Api\Exceptions\Index;

use Makaira\Api\Exception as ApiException;

/**
 * exception thrown if an index is locked
 * error can only be found on runtime occurs
 */
class IndexException extends ApiException
{

}

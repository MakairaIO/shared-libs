<?php
/**
 * Created by PhpStorm.
 * User: tom
 * Date: 25.06.18
 * Time: 12:48
 */

namespace Makaira\Api\Exceptions\Index;

/**
 * exception thrown if index alias has changed since getLastRevision
 * error can only be found on runtime occurs
 */
class IndexAliasChangedException extends IndexException
{

}

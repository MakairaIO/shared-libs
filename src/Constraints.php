<?php
/**
 * This file is part of a marmalade GmbH project
 * It is not Open Source and may not be redistributed.
 * For contact information please visit http://www.marmalade.de
 * Version:    1.0
 * Author:     Jens Richter <richter@marmalade.de>
 * Author URI: http://www.marmalade.de
 */

namespace Makaira;

final class Constraints
{
    /**
     * Use stock information to filter search results.
     */
    const USE_STOCK = 'query.use_stock';

    /**
     * Filter search result by category id.
     */
    const CATEGORY = 'query.category_id';

    /**
     * Filter search result by manufacturer id.
     */
    const MANUFACTURER = 'query.manufacturer_id';
}
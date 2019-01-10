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

    /**
     * Only search in the specified shop.
     */
    const SHOP = 'query.shop_id';

    /**
     * Language used in this query.
     */
    const LANGUAGE = 'query.language';

    /**
     * Vendor used in this query.
     */
    const VENDOR = 'vendor';

    /**
     * OI User-ID used in this query.
     */
    const OI_USER_ID = 'oi.user.id';

    /**
     * OI User-IP used in this query.
     */
    const OI_USER_IP = 'oi.user.ip';

    /**
     * OI User-Agent-String used in this query.
     */
    const OI_USER_AGENT = 'oi.user.agent';

    /**
     * OI User-Timezone used in this query.
     */
    const OI_USER_TIMEZONE = 'oi.user.timezone';

    /**
     *  Use machine learning in this query.
     */
    const MACHINE_LEARNING = 'query.machine_learning';

    /**
     * Array of product ids to exclude from result
     */
    const PLACED_PRODUCT_IDS = 'placed_ids.product';

    /**
     * Array of product ids used for aggragation
     */
    const PLACED_PRODUCT_IDS_AGGS = 'placed_ids.product.aggs';

    /**
     * Array of category ids to exclude from result
     */
    const PLACED_CATEGORY_IDS = 'placed_ids.category';

    /**
     * Array of manufacturer ids to exclude from result
     */
    const PLACED_MANUFACTURER_IDS = 'placed_ids.manufacturer';

    /**
     * Array of econda session data to use for resort the elastic result
     */
    const ECONDA_DATA = 'econda.data';
}

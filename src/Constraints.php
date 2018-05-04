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
     * Recommendation used in this query
     */
    const RECOMMENDATION = 'recommendation.recommendation_id';

    /**
     * Request ID used in this query (currently not used).
     */
    const RECOMMENDATION_REQUEST = 'recommendation.request_id';

    /**
     * Product used in this query.
     */
    const RECOMMENDATION_PRODUCT = 'recommendation.product_id';

    /**
     * Category used in this query.
     */
    const RECOMMENDATION_CATEGORY = 'recommendation.category_id';

    /**
     * Manufacturer used in this query.
     */
    const RECOMMENDATION_MANUFACTURER = 'recommendation.manufacturer_id';

    /**
     * Price range used in this query.
     */
    const RECOMMENDATION_PRICE_RANGE_MIN = 'recommendation.price_range.min';

    /**
     * Price range used in this query.
     */
    const RECOMMENDATION_PRICE_RANGE_MAX = 'recommendation.price_range.max';

    /**
     * Time range used in this query.
     */
    const RECOMMENDATION_TIME_RANGE_MIN = 'recommendation.time_range.min';

    /**
     * Time range used in this query.
     */
    const RECOMMENDATION_TIME_RANGE_MAX = 'recommendation.time_range.max';
}

<?php
/**
 * This file is part of a marmalade GmbH project
 * It is not Open Source and may not be redistributed.
 * For contact information please visit http://www.marmalade.de
 *
 * @version 0.1
 * @author  Stefan Krenz <krenz@marmalade.de>
 * @link    http://www.marmalade.de
 */

namespace Makaira;

use Makaira\Exceptions\DomainException;

class RecommendationQuery extends AbstractQuery
{
    /**
     * @var string
     */
    public $recommendationId;

    /**
     * @var string
     */
    public $requestId;

    /**
     * @var string
     */
    public $productId;

    /**
     * @var string
     */
    public $categoryId;

    /**
     * @var string
     */
    public $manufacturerId;

    /**
     * @var string
     */
    public $priceRangeMin;

    /**
     * @var string
     */
    public $priceRangeMax;

    /**
     * @var string
     */
    public $timeRangeMin;

    /**
     * @var string
     */
    public $timeRangeMax;

    /**
     * @var string[]
     */
    public $attributes;

    /**
     * @var string[]
     */
    public $filterAttributes;

    /**
     * @return string[]
     */
    public function getMandatoryConstraints()
    {
        return [
            Constraints::LANGUAGE => 'language',
            Constraints::SHOP => 'shop identifier',
        ];
    }

    public function verify()
    {
        parent::verify();

        if (null === $this->recommendationId) {
            throw new DomainException('recommendationId (identifier) must be set!');
        }

        if (null === $this->count) {
            throw new DomainException('Count must be set!');
        }

        if (1 > $this->count) {
            throw new DomainException('Count must be greater than 0!');
        }
    }
}

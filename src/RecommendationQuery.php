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
     * @var array|string
     */
    public $productId;

    /**
     * @var array
     */
    public $boosting;

    /**
     * @var array
     */
    public $filter;

    /**
     * @var boolean
     */
    public $randomness;

    /**
     * @var boolean
     */
    public $isUseMachineLearning;

    /**
     * @var boolean
     */
    public $isUseRankingMix;

    /**
     * @var string
     */
    public $recommendationType;

    /**
     * @var boolean
     */
    public $isActive;

    /**
     * @var boolean
     */
    public $isPopulateTextSimilarity;

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
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

class Query extends AbstractQuery
{
    /**
     * @var string
     */
    public $searchPhrase;

    /**
     * @var boolean
     */
    public $enableAggregations = true;

    /**
     * @var boolean
     */
    public $isSearch = true;

    /**
     * @var array
     */
    public $aggregations = [];

    /**
     * @var array
     */
    public $customFilter = [];

    /**
     * @var array
     */
    public $sorting = [];

    /**
     * @var string
     */
    public $apiVersion;

    /**
     * @return string[]
     */
    public function getMandatoryConstraints(): array
    {
        return [
            Constraints::LANGUAGE => 'language',
            Constraints::SHOP => 'shop identifier'
        ];
    }

    /**
     * Check query data.
     */
    public function verify()
    {
        parent::verify();

        if (false === is_bool($this->enableAggregations)) {
            throw new \DomainException('Field $enableAggregations must be a boolean value.');
        }

        if (false === is_bool($this->isSearch)) {
            throw new \DomainException('Field $isSearch must be a boolean value.');
        }
    }
}

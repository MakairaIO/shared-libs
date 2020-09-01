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

use Makaira\Exceptions\DomainException;

use function sprintf;

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
     * @var string
     */
    public $state;


    /**
     * @return string[]
     */
    public function getMandatoryConstraints()
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
            throw new DomainException('Field $enableAggregations must be a boolean value.');
        }

        if (false === is_bool($this->isSearch)) {
            throw new DomainException('Field $isSearch must be a boolean value.');
        }

        $hasDataType = isset($this->constraints[Constraints::DATA_TYPE]);
        $hasDataIds  = isset($this->constraints[Constraints::DATA_IDS]);

        if ($hasDataType && !$hasDataIds) {
            throw new DomainException(
                sprintf(
                    "Constraint '%s' must be used together with '%s'!",
                    Constraints::DATA_TYPE,
                    Constraints::DATA_IDS
                )
            );
        }

        if (!$hasDataType && $hasDataIds) {
            throw new DomainException(
                sprintf(
                    "Constraint '%s' must be used together with '%s'!",
                    Constraints::DATA_IDS,
                    Constraints::DATA_TYPE
                )
            );
        }
    }
}

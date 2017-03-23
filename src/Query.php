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

use Kore\DataObject\DataObject;

class Query extends DataObject
{
    /**
     * @var string
     */
    public $searchPhrase;

    /**
     * @var array
     */
    public $constraints = [];

    /**
     * @var boolean
     */
    public $enableAggregations = true;

    /**
     * @var array
     */
    public $aggregations = [];

    /**
     * @var array
     */
    public $sorting = [];

    /**
     * @var integer
     */
    public $count;

    /**
     * @var integer
     */
    public $offset;

    /**
     * @param string $constraint
     * @return string
     */
    public function getConstraint($constraint)
    {
        if (isset($this->constraints[$constraint])) {
            return $this->constraints[$constraint];
        }
        return null;
    }

    /**
     * @throws \DomainException
     */
    public function verify()
    {
        $mandatoryConstraints = array(
            Constraints::LANGUAGE => 'language',
            Constraints::SHOP => 'shop identifier'
        );

        foreach ($mandatoryConstraints as $key => $label) {
            if (!isset($this->constraints[$key])) {
                throw new \DomainException(sprintf('Missing mandatory %s constraint.', $label));
            }
        }

        if (0 === preg_match('(^[a-z]{2}$)', $this->constraints[Constraints::LANGUAGE])) {
            throw new \DomainException('Language constraint must be two letters in lowercase.');
        }
        
        if (false === is_bool($this->enableAggregations)) {
            throw new \DomainException('Field $enableAggregations must be a boolean value.');
        }
    }
}

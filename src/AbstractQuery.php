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

use Kore\DataObject\DataObject;
use Makaira\Exceptions\DomainException;

abstract class AbstractQuery extends DataObject
{
    /**
     * @var array
     */
    public $constraints = [];

    /**
     * @var array
     */
    public $fields;

    /**
     * @var integer
     */
    public $count;

    /**
     * @var integer
     */
    public $offset;

    const PRIVATE_CONSTRAINTS = [
        Constraints::RAW_QUERY
    ];

    private $isGetPrivate = false;

    /**
     * @param string $constraint
     *
     * @return string|array
     */
    public function getConstraint($constraint)
    {
        if (in_array($constraint, self::PRIVATE_CONSTRAINTS) && $this->isGetPrivate === false) {
            return null;
        }
        if (isset($this->constraints[$constraint])) {
            return $this->constraints[$constraint];
        }

        return null;
    }

    public function setIsGetPrivate($bool)
    {
        $this->isGetPrivate = $bool;
    }

    /**
     * @param string $constraint
     * @param string|array $value
     *
     * @return boolean
     */
    public function setConstraint($constraint, $value)
    {
        $this->constraints[$constraint] = $value;

        return true;
    }

    /**
     * @throws \DomainException
     */
    public function verify()
    {
        foreach ($this->getMandatoryConstraints() as $key => $label) {
            if (!isset($this->constraints[$key])) {
                throw new DomainException(sprintf('Missing mandatory %s constraint.', $label));
            }
        }

        if (0 === preg_match('(^[a-z]{2}$)', $this->constraints[Constraints::LANGUAGE])) {
            throw new DomainException('Language constraint must be two letters in lowercase.');
        }
    }

    /**
     * @return string[]
     */
    abstract public function getMandatoryConstraints();
}

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

use function preg_replace;
use function sprintf;
use function strlen;
use function strtolower;
use function strtoupper;
use function substr;
use function trim;

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

    /**
     * @param string $constraint
     *
     * @return string|array
     */
    public function getConstraint($constraint)
    {
        if (isset($this->constraints[$constraint])) {
            return $this->constraints[$constraint];
        }

        return null;
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
     * @throws DomainException
     */
    public function verify()
    {
        foreach ($this->getMandatoryConstraints() as $key => $label) {
            if (empty($this->constraints[$key])) {
                throw new DomainException(sprintf('Missing mandatory %s constraint.', $label));
            }
        }

        $trimmed  = trim($this->constraints[Constraints::LANGUAGE]);
        $lowered  = strtolower($trimmed);
        $replaced = preg_replace('/\W/', '-', $lowered);

        switch (strlen($replaced)) {
            case 2:
                $language = $replaced;
                break;
            case 4:
                $language = sprintf('%s-%s', substr($replaced, 0, 2), strtoupper(substr($replaced, 2, 2)));
                break;
            case 5:
                $language = sprintf('%s-%s', substr($replaced, 0, 2), strtoupper(substr($replaced, 3, 2)));
                break;
            default:
                throw new DomainException(
                    sprintf("The language constraint must be a language or a locale, but it contains '%s'.", $trimmed)
                );
        }

        $this->constraints[Constraints::LANGUAGE] = $language;

        return $this;
    }

    /**
     * @return string[]
     */
    abstract public function getMandatoryConstraints();

    /**
     * Filter out all constraints that not exist in Constrains::class.
     */
    public function filterConstraints()
    {
        $constrainsReflection = new \ReflectionClass(Constraints::class);
        $constants = $constrainsReflection->getConstants();
        $filteredConstraints = [];
        foreach ($this->constraints as $key => $value) {
            if (in_array($key, $constants)) {
                $filteredConstraints[$key] = $value;
            }
        }
        $this->constraints = $filteredConstraints;
        return $this;
    }

    /**
     * Create a new instance based on request data.
     *
     * @param array $data
     *
     * @return static
     * @throws DomainException
     */
    public static function createFromRequest($data)
    {
        return (new static($data))
            ->verify()
            ->filterConstraints();
    }
}

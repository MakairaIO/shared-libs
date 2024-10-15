<?php

namespace Makaira;

use JsonSerializable;

use function get_class;
use function get_object_vars;
use function is_array;
use function is_object;

class DataObject implements JsonSerializable
{
    /**
     * Array containing additional values.
     *
     * @var array
     */
    private $additional = [];

    /**
     * Set class properties from array.
     *
     * @param array $values
     * @return void
     */
    public function __construct(array $values = [])
    {
        foreach ($values as $name => $value) {
            $this->{$name} = $value;
        }
    }

    /**
     * Get a value.
     *
     * @param string $name
     *
     * @return mixed
     */
    public function __get(string $name)
    {
        return $this->additional[$name] ?? null;
    }

    /**
     * Set a value.
     *
     * @param string $name
     * @param mixed  $value
     *
     * @return void
     */
    public function __set(string $name, $value)
    {
        $this->additional[$name] = $value;
    }

    /**
     * Check whether a value is set or not.
     *
     * @param string $name
     *
     * @return bool
     */
    public function __isset(string $name)
    {
        return isset($this->additional[$name]);
    }

    /**
     * Unset a value
     * @param string $name
     *
     * @return void
     */
    public function __unset(string $name)
    {
        unset($this->additional[$name]);
    }

    /**
     * Deep clone for structs
     *
     * @return void
     */
    public function __clone()
    {
        foreach (get_object_vars($this) as $property => $value) {
            if (is_object($value)) {
                $this->$property = clone $value;
            }

            if (is_array($value)) {
                $this->cloneArray($this->$property);
            }
        }
    }

    /**
     * Clone array
     *
     * @param array $array
     */
    private function cloneArray(array &$array)
    {
        foreach ($array as $key => $value) {
            if (is_object($value)) {
                $array[$key] = clone $value;
            }

            if (is_array($value)) {
                $this->cloneArray($array[$key]);
            }
        }
    }

    /**
     * Restore object from var_export
     *
     * @param array $values
     *
     * @return DataObject
     */
    public static function __set_state(array $values)
    {
        return new static($values);
    }

    /**
     * Merge additional vars together with class properties.
     *
     * @return array
     */
    public function jsonSerialize(): array
    {
        $vars = get_class_vars(get_class($this));
        unset($vars['additional']);

        return array_merge($vars, $this->additional);
    }
}

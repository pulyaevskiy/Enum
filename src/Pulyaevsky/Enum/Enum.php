<?php
namespace Pulyaevsky\Enum;

abstract class Enum
{
    /**
     * @var mixed
     */
    private $value;

    /**
     * @var array
     */
    private static $cachedConstantsByClass = array();

    /**
     * @param mixed $value
     */
    final public function __construct($value)
    {
        $this->setValue($value);
    }

    final public static function __callStatic($name, $arguments)
    {
        if (!in_array($name, self::getValues())) {
            throw new \UnexpectedValueException("Unexpected method '{$name}' called.");
        }

        $class = get_called_class();
        return new $class($name);
    }

    final private function setValue($value)
    {
        if (!$this->hasValue($value)) {
            throw new \UnexpectedValueException("Unexpected value '{$value}' provided.");
        }
        $this->value = $value;
    }

    final private function hasValue($value)
    {
        return in_array($value, self::getValues(), true);
    }

    final public static function getValues()
    {
        return array_values(self::getConstants());
    }

    final public static function getConstants()
    {
        static::ensureInitialized();
        $class = get_called_class();
        return self::$cachedConstantsByClass[$class];
    }

    final private static function ensureInitialized()
    {
        $class = get_called_class();
        if (!isset(self::$cachedConstantsByClass[$class])) {
            $reflectionClass = new \ReflectionClass($class);
            self::$cachedConstantsByClass[$class] = $reflectionClass->getConstants();
        }
    }

    final public function getValue()
    {
        return $this->value;
    }

    final public static function getConstantNames() {
        return array_keys(self::getConstants());
    }
    
    final public function getName()
    {
        return array_search($this->value, self::getConstants(), true);
    }

    final public function __toString()
    {
        return $this->getName();
    }
}

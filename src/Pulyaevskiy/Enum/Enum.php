<?php
namespace Pulyaevskiy\Enum;

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
     * @var array
     */
    private static $instanceMapByClass = array();

    /**
     * @param mixed $value
     */
    final private function __construct($value)
    {
        $this->setValue($value);
    }

    /**
     * @param mixed $value
     *
     * @return Enum
     */
    final public static function fromValue($value)
    {
        return self::getInstanceForValue($value);
    }

    /**
     * @param $value
     * @param $arguments
     *
     * @return Enum
     */
    final public static function __callStatic($value, $arguments)
    {
        if (!in_array($value, self::getValues())) {
            throw new \UnexpectedValueException("Unexpected method '{$value}' called.");
        }

        return self::getInstanceForValue($value);
    }

    /**
     * @param mixed $value
     *
     * @return Enum
     */
    final private static function getInstanceForValue($value)
    {
        $class = get_called_class();
        if (!isset(self::$instanceMapByClass[$class][$value])) {
            self::$instanceMapByClass[$class][$value] = new $class($value);
        }

        return self::$instanceMapByClass[$class][$value];
    }

    /**
     * @param mixed $value
     */
    final private function setValue($value)
    {
        if (!$this->hasValue($value)) {
            throw new \UnexpectedValueException("Unexpected value '{$value}' provided.");
        }
        $this->value = $value;
    }

    /**
     * @param mixed $value
     *
     * @return bool
     */
    final private function hasValue($value)
    {
        return in_array($value, self::getValues(), true);
    }

    /**
     * @return array
     */
    final public static function getValues()
    {
        return array_values(self::getConstants());
    }

    /**
     * @return array
     */
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

    /**
     * @return mixed
     */
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

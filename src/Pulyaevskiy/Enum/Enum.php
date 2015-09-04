<?php
namespace Pulyaevskiy\Enum;

abstract class Enum implements \JsonSerializable
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
        return static::getInstanceForValue($value);
    }

    /**
     * @param $name
     * @param $arguments
     *
     * @return Enum
     */
    final public static function __callStatic($name, $arguments)
    {
        $constantName = strtoupper($name);
        if (!in_array($constantName, static::getConstantNames())) {
            throw new \UnexpectedValueException("Enum: unexpected method '{$name}' called.");
        }

        return static::getInstanceForValue(static::getConstantValue($constantName));
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

    final private static function getConstantValue($name)
    {
        $constants = static::getConstants();

        return $constants[$name];
    }

    /**
     * @param mixed $value
     *
     * @throws InvalidEnumValueException
     */
    final private function setValue($value)
    {
        if (!$this->hasValue($value)) {
            $class = (new \ReflectionClass($this))->getShortName();
            throw new InvalidEnumValueException("'{$value}' is not a valid value for $class.");
        }

        $this->value = static::getConstantValue($this->getConstantNameFromValue($value));
    }

    final private function getConstantNameFromValue($value)
    {
        foreach (static::getConstants() as $name => $cValue) {
            if ($cValue == $value) {
                return $name;
            }
        }
        throw new \UnexpectedValueException("Unexpected value '{$value}' provided.");
    }

    /**
     * @param mixed $value
     *
     * @return bool
     */
    final private function hasValue($value)
    {
        return in_array($value, static::getValues());
    }

    /**
     * @return array
     */
    final public static function getValues()
    {
        return array_values(static::getConstants());
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

    /**
     * @return array
     */
    final public static function getConstantNames() {
        return array_keys(static::getConstants());
    }

    /**
     * @return string
     */
    final public function getName()
    {
        return array_search($this->value, static::getConstants());
    }

    /**
     * @return string
     */
    final public function __toString()
    {
        return (string) $this->getName();
    }

    /**
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed Data which can be serialized by json_encode.
     */
    function jsonSerialize()
    {
        return $this->value;
    }
}

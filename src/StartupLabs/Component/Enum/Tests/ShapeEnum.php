<?php


namespace StartupLabs\Component\Enum\Tests;


use StartupLabs\Component\Enum\Enum;

class ShapeEnum extends Enum {

    const TRIANGLE = 'triangle';
    const SQUARE = 'square';
    const PENTAGON = 'pentagon';
    const HEXAGON = 'hexagon';

    public static function triangle()
    {
        return new self(self::TRIANGLE);
    }

    public static function square()
    {
        return new self(self::SQUARE);
    }

    public static function pentagon()
    {
        return new self(self::PENTAGON);
    }

    public static function hexagon()
    {
        return new self(self::HEXAGON);
    }

}

<?php


namespace StartupLabs\Component\Enum\Tests;


/**
 * @method static type triangle()
 * @method static type square()
 * @method static type pentagon()
 * @method static type hexagon()
 */
use StartupLabs\Component\Enum\Enum;

class ShapeEnum extends Enum {

    const TRIANGLE = 'triangle';
    const SQUARE = 'square';
    const PENTAGON = 'pentagon';
    const HEXAGON = 'hexagon';
}

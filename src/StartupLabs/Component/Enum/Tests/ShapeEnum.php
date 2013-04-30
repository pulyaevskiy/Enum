<?php


namespace StartupLabs\Component\Enum\Tests;


/**
 * @method static ShapeEnum triangle()
 * @method static ShapeEnum square()
 * @method static ShapeEnum pentagon()
 * @method static ShapeEnum hexagon()
 */
use StartupLabs\Component\Enum\Enum;

class ShapeEnum extends Enum {

    const TRIANGLE = 'triangle';
    const SQUARE = 'square';
    const PENTAGON = 'pentagon';
    const HEXAGON = 'hexagon';
}

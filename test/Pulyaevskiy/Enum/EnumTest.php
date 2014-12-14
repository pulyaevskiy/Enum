<?php
namespace Pulyaevskiy\Enum;

/**
 * @method static ShapeEnum triangle()
 * @method static ShapeEnum square()
 * @method static ShapeEnum pentagon()
 * @method static ShapeEnum hexagon()
 */
class ShapeEnum extends Enum
{
    const TRIANGLE = 'triangle';
    const SQUARE = 'square';
    const PENTAGON = 'pentagon';
    const HEXAGON = 'hexagon';
}

class EnumTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        try {
            $fail = ShapeEnum::fromValue('FAIL!');
            $this->fail("Creation of enum with invalid value must throw an exception.");
        } catch (\Exception $e) {
            $this->assertInstanceOf('UnexpectedValueException', $e);
            $this->assertEquals("Unexpected value 'FAIL!' provided.", $e->getMessage());
        }
    }

    public function testCallStatic()
    {
        $square = ShapeEnum::square();

        $this->assertInstanceOf('Pulyaevskiy\Enum\ShapeEnum', $square);
        $this->assertEquals('SQUARE', $square->getName());

        $this->setExpectedException('\UnexpectedValueException');
        ShapeEnum::squareFail();
    }

    public function testGetValues()
    {
        $expected = array('triangle', 'square', 'pentagon', 'hexagon');
        $this->assertEquals($expected, ShapeEnum::getValues());
    }

    public function testGetConstants()
    {
        $expected = array(
            'TRIANGLE' => 'triangle',
            'SQUARE' => 'square',
            'PENTAGON' => 'pentagon',
            'HEXAGON' => 'hexagon',
        );
        $this->assertEquals($expected, ShapeEnum::getConstants());
    }

    public function testGetConstantNames()
    {
        $expected = array('TRIANGLE', 'SQUARE', 'PENTAGON', 'HEXAGON');
        $this->assertEquals($expected, ShapeEnum::getConstantNames());
    }

    public function testGetName()
    {
        $square = ShapeEnum::fromValue(ShapeEnum::SQUARE);
        $this->assertEquals('SQUARE', $square->getName());
    }

    public function testToString()
    {
        $square = ShapeEnum::fromValue(ShapeEnum::SQUARE);
        $this->assertEquals('SQUARE', (string) $square);
    }

    public function testGetValue()
    {
        $square = ShapeEnum::fromValue(ShapeEnum::SQUARE);
        $this->assertEquals('square', $square->getValue());
    }

    public function testEqualityComparison()
    {
        $square1 = ShapeEnum::square();
        $square2 = ShapeEnum::square();
        $triangle = ShapeEnum::triangle();

        $this->assertTrue($square1 == $square2);
        $this->assertTrue($square1 === $square2);
        $this->assertFalse($square1 == $triangle);
    }
}

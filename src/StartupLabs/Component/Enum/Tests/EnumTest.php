<?php


namespace StartupLabs\Component\Enum\Tests;


class EnumTest extends \PHPUnit_Framework_TestCase {

    public function testConstructor()
    {
        $square = new ShapeEnum(ShapeEnum::SQUARE);
        $this->assertEquals(ShapeEnum::SQUARE, $square->getValue());

        try {
            $fail = new ShapeEnum('BadValue');
            $this->fail("Creation of enum with invalid value must throw an exception.");
        } catch (\Exception $e) {
            $this->assertInstanceOf('UnexpectedValueException', $e);
            $this->assertEquals("Unexpected value 'BadValue' provided.", $e->getMessage());
        }
    }

    public function testCallStatic()
    {
        $square = new ShapeEnum(ShapeEnum::SQUARE);
        $triangle = new ShapeEnum(ShapeEnum::TRIANGLE);
        $newTriangle = $square::triangle();

        $this->assertTrue($triangle == $newTriangle);
        $this->assertFalse($triangle === $newTriangle);
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
        $square = new ShapeEnum(ShapeEnum::SQUARE);
        $this->assertEquals('SQUARE', $square->getName());
    }

    public function testToString()
    {
        $square = new ShapeEnum(ShapeEnum::SQUARE);
        $this->assertEquals('SQUARE', (string) $square);
    }

    public function testEqualityComparison()
    {
        $square1 = ShapeEnum::square();
        $square2 = ShapeEnum::square();
        $triangle = ShapeEnum::triangle();

        $this->assertTrue($square1 == $square2);
        $this->assertFalse($square1 === $square2);
        $this->assertFalse($square1 == $triangle);
    }

}

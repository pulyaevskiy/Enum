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
    const TRIANGLE = 1;
    const SQUARE = 2;
    const PENTAGON = 3;
    const HEXAGON = 4;
}

/**
 * @method static Zombie undead()
 */
class Zombie extends Enum
{
    const UNDEAD = 'undead';
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
            $this->assertEquals("Pulyaevskiy\Enum\ShapeEnum: unexpected value 'FAIL!' provided.", $e->getMessage());
        }
    }

    public function testNonStrictTypeBehavior()
    {
        $shape = ShapeEnum::fromValue('2');
        $this->assertEquals(ShapeEnum::square(), $shape);
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
        $expected = array(1, 2, 3, 4);
        $this->assertEquals($expected, ShapeEnum::getValues());
    }

    public function testGetConstants()
    {
        $expected = array(
            'TRIANGLE' => 1,
            'SQUARE' => 2,
            'PENTAGON' => 3,
            'HEXAGON' => 4,
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
        $this->assertSame(2, $square->getValue());
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

    public function testJsonSerialize()
    {
        $square = ShapeEnum::square();
        $result = json_encode(array('value' => $square));
        $this->assertEquals('{"value":2}', $result);

        $undead = Zombie::undead();
        $result = json_encode(array('value' => $undead));
        $this->assertEquals('{"value":"undead"}', $result);
    }
}

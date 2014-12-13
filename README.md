Enum
==========================

[![Build Status](https://travis-ci.org/pulyaevsky/Enum.svg?branch=master)](https://travis-ci.org/pulyaevsky/Enum)

Enum component enables developers to define strict enumerated types based on standard PHP classes.
Usage of this component is a little bit verbose but it allows you to get rid of constant validation of every enum field in your entities.
This implementation is pretty much similar to all those you can find out there (including SplEnum) but pretends to be more accurate.

This is a fork from `startuplabs/enum` since original repository is not maintained anymore. 

Usage
=====

### 1. Define an ancestor of the Enum class. For example:

```php
<?php
namespace Acme\Example;

use Pulyaevsky\Enum;

/**
 * @method static Shape triangle()
 * @method static Shape square()
 * @method static Shape pentagon()
 * @method static Shape hexagon()
 */
class Shape extends Enum 
{
    const TRIANGLE = 'triangle';
    const SQUARE = 'square';
    const PENTAGON = 'pentagon';
    const HEXAGON = 'hexagon';
}
```

### 2. Use it with type-hinting in your classes:

```php
<?php
namespace Acme\Example;

class Model 
{
    /** @var Shape */
    private $shape;

    public function setShape(Shape $value)
    {
        // Here it is guaranteed that the $value has already been validated
        $this->shape = $value;
    }
}
```

### 3. Create new instances using static methods:

```php
<?php
namespace Acme\Example;

class Application 
{
    public function changeShapeToSquare(Model $model)
    {
        // Enum class has __callStatic method that checks if there is constant with name of called function
        // and then create instance of Shape class with this value
        $shape = Shape::square();
        $model->setShape($shape);
    }
}
```

Contributors
============

* Alexey Tihomirov
* Anatoly Pulyaevskiy

License
=======

This library is under MIT license. Please see the complete license in the LICENSE file provided with the library source code.

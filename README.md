StartupLabs Enum Component
==========================

Enum component enables developers to define strict enumerated types based on standard PHP classes.
Usage of this component is a little bit verbose but it allows you to get rid of constant validation of every enum field in your entities.
This implementation is pretty much similar to all those you can find out there (including SplEnum) but pretends to be more accurate.


Usage
=====

### 1. Define an ancestor of the Enum class. For example:
```php
<?php

namespace StartupLabs\Example;

use StartupLabs\Component\Enum\Enum;

class Shape extends Enum {

    const TRIANGLE = 'triangle';
    const SQUARE = 'square';
    const PENTAGON = 'pentagon';
    const HEXAGON = 'hexagon';

}
```

### 2. Use it with type-hinting in your classes:
```php
<?php

namespace StartupLabs\Example;

class Model {

    /** @var Shape */
    private $shape;

    public function setShape(Shape $value)
    {
        // Here it is guaranteed that the $value has already been validated
        $this->shape = $value;
    }

}
```

Extended usage: shortcut methods
================================

Below code sample shows how Enums are used most of the times:
```php
<?php

$model = new Model();
$model->setShape(new Shape(Shape::TRIANGLE));
```
To simplify usage of enums the component implements magic method __callStatic() and allows developers to create Enum instances via calls to static methods which names equals to values of class constants.
So example above can be transformed like this:
```php
<?php

$model = new Model();
$model->setShape(Shape::triangle());
```

To enable your IDE autocomplete features for these shortcut methods you can add PHPDoc to your enum class as follows:
```php
<?php

/**
 * @method static Shape triangle()
 * @method static Shape square()
 * @method static Shape pentagon()
 * @method static Shape hexagon()
 */
use StartupLabs\Component\Enum\Enum;

class Shape extends Enum {

    const TRIANGLE = 'triangle';
    const SQUARE = 'square';
    const PENTAGON = 'pentagon';
    const HEXAGON = 'hexagon';
}
```

Contributors
============

* Alexey Tihomirov
* Anatoly Pulyaevsky
* Tania Goncharonok

License
=======

This library is under MIT license. Please see the complete license in the LICENSE file provided with the library source code.

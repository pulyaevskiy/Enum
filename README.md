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

Contributors
============

* Alexey Tihomirov
* Anatoly Pulyaevsky

License
=======

This library is under MIT license. Please see the complete license in the LICENSE file provided with the library source code.

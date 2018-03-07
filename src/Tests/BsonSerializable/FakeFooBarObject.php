<?php

/*
 * This file is part of the Runalyze BSON.
 * (c) RUNALYZE <mail@runalyze.com>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Runalyze\BSON\Tests\BsonSerializable;

use Runalyze\BSON\BsonSerializable\AbstractBsonSerializableObject;

class FakeFooBarObject extends AbstractBsonSerializableObject
{
    /** @var mixed */
    public $Foo;

    /** @var mixed */
    public $Bar;

    public function getSerializableProperties()
    {
        return [
            'Foo',
            'Bar',
        ];
    }
}

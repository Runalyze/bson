<?php

/*
 * This file is part of the Runalyze BSON.
 * (c) RUNALYZE <mail@runalyze.com>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Runalyze\BSON\Tests\LazyFilesystemObject;

use League\Flysystem\Filesystem;
use League\Flysystem\Memory\MemoryAdapter;
use Runalyze\BSON\LazyFilesystemObject\DefaultHashToPathMapper;
use Runalyze\BSON\LazyFilesystemObject\LazyFilesystemObjectStorage;
use Runalyze\BSON\Tests\BsonSerializable\FakeFooBarObject;

class LazyFilesystemObjectStorageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return LazyFilesystemObjectStorage
     */
    protected function getDefaultStorage()
    {
        return new LazyFilesystemObjectStorage(
            new Filesystem(new MemoryAdapter()),
            new DefaultHashToPathMapper()
        );
    }

    public function testDefaultStorage()
    {
        $storage = $this->getDefaultStorage();

        $object = new FakeFooBarObject();
        $object->Foo = 'foo';

        $storage->storeObject('abcdef0987654321', $object);

        $storedObject = $storage->getObject('abcdef0987654321', FakeFooBarObject::class);

        $this->assertInstanceOf(\ProxyManager\Proxy\ProxyInterface::class, $storedObject);
        $this->assertInstanceOf(FakeFooBarObject::class, $storedObject);

        $this->assertEquals('foo', $storedObject->Foo);
        $this->assertNotSame($object, $storedObject);
    }
}

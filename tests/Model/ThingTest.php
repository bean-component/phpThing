<?php

namespace App\Tests\Entity;

use Bean\Thing\Model\Thing;
use PHPUnit\Framework\TestCase;
use Symfony\Component\PropertyAccess\Exception\NoSuchPropertyException;

class ThingTest extends TestCase
{
    public function testClone()
    {
        $thing = new Thing();
        $createdAt = $thing->getCreatedAt();

        $reflection = new \ReflectionClass($thing);
        $property = $reflection->getProperty('id');
        $property->setAccessible(true);
        $property->setValue($thing, 100);
        $this->assertNotEmpty($createdAt);

        $property->setAccessible(false);
        $clone = clone $thing;
        $this->assertEquals(100, $thing->getId());
        $this->assertEmpty($clone->getId());
        $this->assertEquals($createdAt, $clone->getCreatedAt());

    }

    public function testInitSlug()
    {
        $thing = new ThingModel();
        $thing->setName('ဟယ်လို-ông-anh-đáng-yêu');
        $thing->initSlug();
        $this->assertEquals('helo-ong-anh-dang-yeu', $thing->getSlug());
    }

    public function test__GetMagicMethodException()
    {
        $thing = new ThingModel();
        $this->expectException(NoSuchPropertyException::class);
        $thing->nonExistentProperty;
    }

    public function test__GetSetMagicMethod()
    {
        $thing = new ThingModel();
        $thing->nonExistentProperty = 'value-of-non-existent-property';
        $this->assertEquals('value-of-non-existent-property', $thing->nonExistentProperty);

        $this->address = 'My Address';
        $this->assertEquals('My Address', $this->{ThingModel::DATA_ADDRESS});
    }
}
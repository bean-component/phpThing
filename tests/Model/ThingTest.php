<?php

namespace Bean\Tests\Thing\Model;

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

    public function test__GetMagicMethodException()
    {
        $thing = new Thing();
        $this->expectException(NoSuchPropertyException::class);
        $thing->nonExistentProperty;
    }

    public function test__GetSetMagicMethod()
    {
        $thing = new Thing();
        $thing->nonExistentProperty = 'value-of-non-existent-property';
        $this->assertEquals('value-of-non-existent-property', $thing->nonExistentProperty);

        $this->address = 'My Address';
        $this->assertEquals('My Address', $this->{'address'});
    }

    public function testLogUpdateEvent()
    {
        $thing = new Thing();
        $thing->logUpdateEvent('name', 'old name', 'new name');
        $eventLog = $thing->getEventLog();

        $this->assertNotEmpty($eventLog);

        $this->assertArrayHasKey('name', $eventLog);
        $namePropertyLog = $eventLog['name'];
        $lastNamePropertyLog_Entry = end($namePropertyLog);
        $this->assertArrayHasKey('newValue', $lastNamePropertyLog_Entry);
        $this->assertArrayHasKey('time', $lastNamePropertyLog_Entry);
        $this->assertArrayHasKey('timeZone', $lastNamePropertyLog_Entry);
        $namePropertyLog_UpdatedAt = \DateTime::createFromFormat('Y-m-d H:i:s.v', $lastNamePropertyLog_Entry['time']);
        $this->assertInstanceOf(\DateTime::class, $namePropertyLog_UpdatedAt);
        $this->assertEquals('old name', $lastNamePropertyLog_Entry['oldValue']);
        $this->assertEquals('new name', $lastNamePropertyLog_Entry['newValue']);

    }
}
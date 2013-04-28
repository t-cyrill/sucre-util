<?php
namespace Sucre;

class SucreObjectTest extends \PHPUnit_Framework_TestCase
{
    public function testFactory()
    {
        $actual = SucreObject::factory();
        self::assertInstanceOf('Sucre\\SucreObject', $actual);
    }

    public function testAttach()
    {
        $class = new self;
        SucreObject::attach($class);
        $actual = SucreObject::factory();
        self::assertInstanceOf('Sucre\\SucreObjectTest', $actual);
    }

    public function testDetach()
    {
        $class = new self;
        SucreObject::attach($class);
        $actual = SucreObject::factory();
        self::assertInstanceOf('Sucre\\SucreObjectTest', $actual);
    }
}

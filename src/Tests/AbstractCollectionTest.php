<?php
namespace SoampliApps\Core\Tests;

use SoampliApps\Core\Collection;

/**
 * @small
 */
class AbstractCollectionTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        $stub = $this->getMockForAbstractClass('\SoampliApps\Core\AbstractCollection');
        $this->_object = $stub;
    }

    /**
     * @covers SoampliApps\Core\AbstractCollection::add
     */
    public function testAdd()
    {
        $class = new \ReflectionClass("\SoampliApps\Core\AbstractCollection");
        $property = $class->getProperty('objects');
        $property->setAccessible(true);
        $value = $property->getValue($this->_object);
        $this->assertEquals(0, count($value), "The collection was not empty by default");
        $this->_object->add("test");
        $value = $property->getValue($this->_object);
        $this->assertEquals(1, count($value), "After adding to the collection, the count was not 1");
      }

    /**
     * @covers SoampliApps\Core\AbstractCollection::count
     */
    public function testCount()
    {
        $this->assertEquals(0, count($this->_object), "Empty collection not empty by default");
        $class = new \ReflectionClass("\SoampliApps\Core\AbstractCollection");
        $property = $class->getProperty('objects');
        $property->setAccessible(true);
        $property->setValue($this->_object, array(""));
        $this->assertEquals(1, count($this->_object), "Adding to the collection didn't increase the count");
    }

    /**
     * @covers SoampliApps\Core\AbstractCollection::pop
     */
    public function testPop()
    {
        $class = new \ReflectionClass("\SoampliApps\Core\AbstractCollection");
        $property = $class->getProperty('objects');
        $property->setAccessible(true);
        $property->setValue($this->_object, array("a", "b"));
        $popped = $this->_object->pop();
        $this->assertTrue(($popped == "b"), "Popped value wasn't as expected");
    }

    /**
     * @covers SoampliApps\Core\AbstractCollection::getIterator
     */
    public function testGetIterator()
    {
        $class = new \ReflectionClass("\SoampliApps\Core\AbstractCollection");
        $property = $class->getProperty('objects');
        $property->setAccessible(true);
        $property->setValue($this->_object, array("a", "b"));
        $foundA = false;
        $foundB = false;
        foreach ($this->_object as $item) {
            if ($item == 'a') {
                $foundA = true;
            } elseif ($item == 'b') {
                $foundB = true;
            }
        }

        $this->assertTrue(($foundA && $foundB), "Didn't iterate and find A and B");
    }

}

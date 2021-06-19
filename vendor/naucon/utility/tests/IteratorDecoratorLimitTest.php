<?php
/*
 * Copyright 2015 Sven Sanzenbacher
 *
 * This file is part of the naucon package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Naucon\Utility\Tests;

use Naucon\Utility\Iterator;
use Naucon\Utility\IteratorDecoratorLimit;

class IteratorDecoratorLimitTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return    IteratorDecoratorLimit
     */
    public function testInit()
    {
        $array = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21);

        $iteratorLimitObject = new IteratorDecoratorLimit(new Iterator($array), 0, 10);

        $this->assertEquals(0, $iteratorLimitObject->getItemOffset());
        $this->assertEquals(10, $iteratorLimitObject->getItemCount());

        return $iteratorLimitObject;
    }

    /**
     * @depends  testInit
     * @param    IteratorDecoratorLimit     $iteratorLimitObject
     * @return   void
     */
    public function testCount(IteratorDecoratorLimit $iteratorLimitObject)
    {
        $this->assertEquals(10, count($iteratorLimitObject));
    }

    /**
     * @depends  testInit
     * @param    IteratorDecoratorLimit     $iteratorLimitObject
     * @return   IteratorDecoratorLimit
     */
    public function testCurrent(IteratorDecoratorLimit $iteratorLimitObject)
    {
        $this->assertEquals(1, $iteratorLimitObject->current());
        return $iteratorLimitObject;
    }

    /**
     * @depends  testCurrent
     * @param    IteratorDecoratorLimit     $iteratorLimitObject
     * @return   IteratorDecoratorLimit
     */
    public function testNext(IteratorDecoratorLimit $iteratorLimitObject)
    {
        $this->assertTrue($iteratorLimitObject->hasNext());
        $iteratorLimitObject->next(); // 2
        $this->assertEquals(2, $iteratorLimitObject->current());

        $this->assertTrue($iteratorLimitObject->hasNext());
        $iteratorLimitObject->next(); // 3
        $this->assertEquals(3, $iteratorLimitObject->current());

        $this->assertTrue($iteratorLimitObject->hasNext());
        $iteratorLimitObject->next(); // 4
        $this->assertEquals(4, $iteratorLimitObject->current());

        $this->assertTrue($iteratorLimitObject->hasNext());
        $iteratorLimitObject->next(); // 5
        $this->assertEquals(5, $iteratorLimitObject->current());

        $this->assertTrue($iteratorLimitObject->hasNext());
        $iteratorLimitObject->next(); // 6
        $this->assertEquals(6, $iteratorLimitObject->current());

        $this->assertTrue($iteratorLimitObject->hasNext());
        $iteratorLimitObject->next(); // 7
        $this->assertEquals(7, $iteratorLimitObject->current());

        $this->assertTrue($iteratorLimitObject->hasNext());
        $iteratorLimitObject->next(); // 8
        $this->assertEquals(8, $iteratorLimitObject->current());

        $this->assertTrue($iteratorLimitObject->hasNext());
        $iteratorLimitObject->next(); // 9
        $this->assertEquals(9, $iteratorLimitObject->current());

        $this->assertTrue($iteratorLimitObject->hasNext());
        $iteratorLimitObject->next(); // 10
        $this->assertEquals(10, $iteratorLimitObject->current());

        $this->assertFalse($iteratorLimitObject->hasNext());

        return $iteratorLimitObject;
    }

    /**
     * @depends  testNext
     * @param    IteratorDecoratorLimit     $iteratorLimitObject
     * @return   IteratorDecoratorLimit
     */
    public function testPrev(IteratorDecoratorLimit $iteratorLimitObject)
    {
        $this->assertTrue($iteratorLimitObject->hasPrevious());
        $iteratorLimitObject->previous(); // 9
        $this->assertEquals(9, $iteratorLimitObject->current());

        $this->assertTrue($iteratorLimitObject->hasPrevious());
        $iteratorLimitObject->previous(); // 8
        $this->assertEquals(8, $iteratorLimitObject->current());

        $this->assertTrue($iteratorLimitObject->hasPrevious());
        $iteratorLimitObject->previous(); // 7
        $this->assertEquals(7, $iteratorLimitObject->current());

        $this->assertTrue($iteratorLimitObject->hasPrevious());
        $iteratorLimitObject->previous(); // 6
        $this->assertEquals(6, $iteratorLimitObject->current());

        $this->assertTrue($iteratorLimitObject->hasPrevious());
        $iteratorLimitObject->previous(); // 5
        $this->assertEquals(5, $iteratorLimitObject->current());

        $this->assertTrue($iteratorLimitObject->hasPrevious());
        $iteratorLimitObject->previous(); // 4
        $this->assertEquals(4, $iteratorLimitObject->current());

        $this->assertTrue($iteratorLimitObject->hasPrevious());
        $iteratorLimitObject->previous(); // 3
        $this->assertEquals(3, $iteratorLimitObject->current());

        $this->assertTrue($iteratorLimitObject->hasPrevious());
        $iteratorLimitObject->previous(); // 2
        $this->assertEquals(2, $iteratorLimitObject->current());

        $this->assertTrue($iteratorLimitObject->hasPrevious());
        $iteratorLimitObject->previous(); // 1
        $this->assertEquals(1, $iteratorLimitObject->current());

        $this->assertFalse($iteratorLimitObject->hasPrevious());

        return $iteratorLimitObject;
    }

    /**
     * @depends  testPrev
     * @param    IteratorDecoratorLimit     $iteratorLimitObject
     * @return   IteratorDecoratorLimit
     */
    public function testLast(IteratorDecoratorLimit $iteratorLimitObject)
    {
        $iteratorLimitObject->last();
        $this->assertEquals(10, $iteratorLimitObject->current());

        return $iteratorLimitObject;
    }

    /**
     * @depends  testLast
     * @param    IteratorDecoratorLimit     $iteratorLimitObject
     * @return   IteratorDecoratorLimit
     */
    public function testFirst(IteratorDecoratorLimit $iteratorLimitObject)
    {
        $iteratorLimitObject->first();
        $this->assertEquals(1, $iteratorLimitObject->current());

        return $iteratorLimitObject;
    }

    /**
     * @depends  testInit
     * @param    IteratorDecoratorLimit     $iteratorLimitObject
     * @return   IteratorDecoratorLimit
     */
    public function testIteration(IteratorDecoratorLimit $iteratorLimitObject)
    {
        $array = array();
        foreach ($iteratorLimitObject as $key => $value) {
            $array[] = $value;
        }
        $this->assertEquals(10, count($array));

        $this->assertEquals(1, $array[0]);
        $this->assertEquals(3, $array[2]);
        $this->assertEquals(5, $array[4]);
        $this->assertEquals(8, $array[7]);
        $this->assertEquals(10, $array[9]);
    }

    /**
     * @depends  testInit
     * @param    IteratorDecoratorLimit     $iteratorLimitObject
     * @return   void
     */
    public function testIterationWithOffset(IteratorDecoratorLimit $iteratorLimitObject)
    {
        $iteratorLimitObject->setItemOffset(10);
        $iteratorLimitObject->setItemCount(10);

        $this->assertEquals(10, $iteratorLimitObject->getItemOffset());
        $this->assertEquals(10, $iteratorLimitObject->getItemCount());

        $this->assertEquals(10, count($iteratorLimitObject));

        $array = array();
        foreach ($iteratorLimitObject as $key => $value) {
            $array[] = $value;
        }
        $this->assertEquals(10, count($array));

        $this->assertEquals(11, $array[0]);
        $this->assertEquals(13, $array[2]);
        $this->assertEquals(15, $array[4]);
        $this->assertEquals(18, $array[7]);
        $this->assertEquals(20, $array[9]);
    }

    /**
     * @depends  testInit
     * @param    IteratorDecoratorLimit     $iteratorLimitObject
     * @return   void
     */
    public function testIterationWithOffset2(IteratorDecoratorLimit $iteratorLimitObject)
    {
        $iteratorLimitObject->setItemOffset(20);
        $iteratorLimitObject->setItemCount(10);

        $this->assertEquals(20, $iteratorLimitObject->getItemOffset());
        $this->assertEquals(10, $iteratorLimitObject->getItemCount());

        $this->assertEquals(1, count($iteratorLimitObject));

        $array = array();
        foreach ($iteratorLimitObject as $key => $value) {
            $array[] = $value;
        }
        $this->assertEquals(1, count($array));

        $this->assertEquals(21, $array[0]);
    }
}
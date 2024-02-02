<?php

namespace Alister\MotionPictureSolutions\Tests;

use Alister\MotionPictureSolutions\CategoryTree;
use PHPUnit\Framework\TestCase;

class InvalidCategoryTest extends TestCase
{
    public function testRootAlreadyExists(): void
    {
        $c = new CategoryTree;
        $c->addCategory('A', null);

        $this->expectException(\InvalidArgumentException::class);

        $c->addCategory('A', null);
        //$c->addCategory('W', 'V'); // InvalidArgumentException
    }
    
    public function testParentDoesNotExist(): void
    {
        $c = new CategoryTree;

        $this->expectException(\InvalidArgumentException::class);
        
        $c->addCategory('Z2', 'A'); // 
        //$c->addCategory('W', 'V'); // InvalidArgumentException
    }

    public function testNodeAlreadyExists(): void
    {
        $c = new CategoryTree;
        $c->addCategory('A', null);

        $this->expectException(\InvalidArgumentException::class);
        
        $c->addCategory('B', 'A');
        $c->addCategory('B', 'A');
    }
}

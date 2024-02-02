<?php

namespace Alister\MotionPictureSolutions\Tests;

use Alister\MotionPictureSolutions\CategoryTree;
use PHPUnit\Framework\TestCase;

class CategoryTreeTest extends TestCase
{
    public function testMakeTree(): void
    {
        $c = new CategoryTree;

        $c->addCategory('A', NULL);
        $c->addCategory('B', 'A');
        $c->addCategory('C', 'A');
        $c->addCategory('D', 'C');
        $c->addCategory('E', 'C');
        $c->addCategory('F', 'C');
        $c->addCategory('G', 'C');
        $c->addCategory('H', 'G');
        $c->addCategory('X', NULL);
        $c->addCategory('Y', 'X');
        $c->addCategory('Z1', 'Y');
        $c->addCategory('Z2', 'Y');

        $this->assertEquals('H,G,C,A', implode(',', $c->getPath('H')));
        
        // $this->assertEquals('B,C', implode(',', $c->getChildren('A')));
        // $this->assertEquals('D,E,F,G', implode(',', $c->getChildren('C')));
        // $this->assertEquals('Z1,Z2', implode(',', $c->getChildren('Y')));
    }
}

<?php

namespace Alister\MotionPictureSolutions\Tests;

use Alister\MotionPictureSolutions\CategoryTree;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class CategoryTreeTest extends TestCase
{
    public static function providerChildrenExpected(): \Generator
    {
        yield 'Immediate children of A' => [
            'A',
            ['B','C']
        ];
        yield 'Immediate children of C' => [
            'C',
            ['D','E','F','G']
        ];
        yield 'Immediate children of Y' => [
            'Y',
            ['Z1','Z2']
        ];
    }

    public function testTreePath(): void
    {
        $c = $this->dataFullTree();

        $pathForCategoryName = $c->getPath('H');
        $this->assertEquals(['H','G','C','A'], $pathForCategoryName);
        $this->assertEquals('H,G,C,A', implode(',', $pathForCategoryName));
    }

    public function testTreePathStartDoesNotExist(): void
    {
        $c = $this->dataFullTree();

        $this->expectException(\InvalidArgumentException::class);
        
        $c->getPath('DOES_NOT_EXIST');
    }

    public function testTreeChildStartDoesNotExist(): void
    {
        $c = $this->dataFullTree();

        $this->expectException(\InvalidArgumentException::class);
        
        $c->getChildren('DOES_NOT_EXIST');
    }

    /**
     * Use the dataProvider for the sets of test data.
     */
    #[DataProvider('providerChildrenExpected')]
    public function testTreeChildren(string $categoryNameStart, array $childrenList): void
    {
        $c = $this->dataFullTree();
        
        $this->assertEquals($childrenList, $c->getChildren($categoryNameStart));
    }

    public function dataFullTree(): CategoryTree
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

        return $c;
    }
}

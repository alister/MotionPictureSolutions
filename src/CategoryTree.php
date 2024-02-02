<?php

namespace Alister\MotionPictureSolutions;

/**
 * Create your own implementation of a CategoryTree class shown below, which represents all
 * categories used in some online shop. Categories are unique and can have parent assigned.
 *
 * Category without parent is called root category and there can be multiple root categories.
 *
 * Adding new category requires the name and the parent name. However, adding new root
 * category requires parent to be null. Additionally, InvalidArgumentException is expected
 * when category already exists anywhere in the category tree or when parent doesn’t exist.
 *
 * * getChildren method should return all direct children of the category.
 * * getPath method should return all parents and the category name together.
 *
 * Use best OOP practises, design patterns and unit tests. Tip: avoid duplicating stored data.
 */
class CategoryTree
{
    /** @var array<CategoryItem> */
    private array $categoryRoots = [];

    /**
     * Keep a note of what we already have.
     * 
     * We don't want to have to search the entire tree to find something, but 
     * we can traverse the tree up & down.
     * 
     * If there was so many more, it would be in a DB, or something like a Bloom filter.
     * 
     * @var array<string>
     */
    private array $knownCategories = [];

    public function addCategory(string $categoryName, string $parentName = null): void
    {
        if ($parentName === null) {
            $this->createRoot($categoryName);

            return;
        }
        $this->assertCategoryExists($parentName);
        $this->assertCategoryDoesNotExist($categoryName);
        
        $parent = $this->knownCategories[$parentName];
        $this->knownCategories[$categoryName] = new CategoryItem($categoryName, $parent);
    }

    public function getChildren(string $parent): array
    {
        return [];
    }
    
    public function getPath(string $category): array
    {
        return [];
    }

    private function createRoot(string $category): void
    {
        $this->assertCategoryDoesNotExist($category);

        // $this->categoryRoots[$category] = true;
        $this->knownCategories[$category] = new CategoryItem($category);
    }

    private function assertCategoryExists(string $categoryName): void
    {
        if (!isset($this->knownCategories[$categoryName])) {
            // would normally `sprintf()` it, or better, log it (with a context).
            throw new \InvalidArgumentException('Category ' . $categoryName . ' does not exist.');
        }
    }

    private function assertCategoryDoesNotExist(string $category): void
    {
        if (isset($this->knownCategories[$category])) {
            // would normally `sprintf()` it, or better, log it (with a context).
            throw new \InvalidArgumentException('Category ' . $category . ' already exists.');
        }
    }
}

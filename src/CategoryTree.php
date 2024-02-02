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

    /**
     * To save some complexity (and large, complex, object trees), store most of the individual 
     * CategoryItems by name, and lookup via `$this->knownCategories[name]`.
     * 
     * I do store the parent-category as the object though, show show how easy it is to access.
     */
    public function addCategory(string $categoryName, string $parentName = null): void
    {
        if ($parentName === null) {
            $this->createRoot($categoryName);

            return;
        }

        $this->assertCategoryExists($parentName);
        $this->assertCategoryDoesNotExist($categoryName);
        
        $parent = $this->knownCategories[$parentName];
        $categoryItem = new CategoryItem($categoryName, $parent);
        $this->knownCategories[$categoryName] = $categoryItem;
        $parent->addChild($categoryName);
    }

    /** 
     * Get the immediate children of a category. 
     */
    public function getChildren(string $parentName): array
    {
        $parent = $this->knownCategories[$parentName];

        $children = [];
        foreach($parent->subCategories as $categoryName) {
            // could just `yield $categoryName;`, if the return was `iterable`.
            $children[] = $categoryName;
        }
        return $children;
    }

    /**
     * Traverse up from the current category, through parent(s) to the root.
     * 
     * This uses the categoryParent which is stored as a CategoryItem object.
     * Elsewhere, we look up via the name.
     */
    public function getPath(string $categoryName): array
    {
        $this->assertCategoryExists($categoryName);

        $item = $this->knownCategories[$categoryName];
        do  {
            $path[] = $item->name;
            $item = $item->categoryParent;
        } while($item !== null);

        return $path;
    }

    private function createRoot(string $categoryName): void
    {
        $this->assertCategoryDoesNotExist($categoryName);

        $this->knownCategories[$categoryName] = new CategoryItem($categoryName);
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

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
    public function addCategory(string $category, string $parent = null): void
    {
    }

    public function getChildren(string $parent) : array
    {
        return [];
    }

    public function getPath(string $category) : array
    {
        return [];
    }
}

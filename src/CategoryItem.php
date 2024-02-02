<?php

namespace Alister\MotionPictureSolutions;

class CategoryItem
{
    /**
     * @var string[]
     * actually its more like array<string,string>
     */
    public array $subCategories = [];

    public function __construct(
        public string $name,
        public ?self $categoryParent = null,
    )
    {
    }

    public function addChild(string $categoryName): void
    {
        // use the key to avoid dupes.
        $this->subCategories[$categoryName] = $categoryName;
    }

    /**
     * Simplify the category item for debugging with `dump()`/`var_dump()`.
     * 
     * @return array|null
     * @see https://lornajane.net/posts/2017/removing-object-properties-before-var_dumping-them
     */
    public function __debugInfo(): ?array
    {
        return [
            'name' => $this->name,
            'parent' => $this->categoryParent->name ?? '<null>',
        ];
    }
}

<?php

namespace Alister\MotionPictureSolutions;

class CategoryItem
{
    public array $subCategories = [];

    public function __construct(
        public string $name,
        public ?self $categoryParent = null,
    )
    {
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

<?php

namespace AndeCollege\AndeCollege\Repository;

use AndeCollege\Resource;
use AndeCollege\Category;

class ResourceRepository
{
    /**
     * Find Users by their Emails
     * @param  string $email
     * @return Collection
     */
    public function findResourcesByCategory(Category $category)
    {
        return Resource::where('cat_id', '=', $category->id)->get();
    }
}

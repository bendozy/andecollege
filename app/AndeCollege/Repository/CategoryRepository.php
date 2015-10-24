<?php

namespace AndeCollege\AndeCollege\Repository;

use AndeCollege\Category;

class CategoryRepository
{
    /**
     * Find Users by their Emails
     * @param  string $email
     * @return Collection
     */
    public function findCategoryByName($name)
    {
        return Category::where('name', '=', $name)->first();
    }
}

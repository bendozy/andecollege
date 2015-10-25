<?php

namespace AndeCollege\AndeCollege\Repository;

use AndeCollege\User;
use AndeCollege\Resource;
use AndeCollege\Category;

class ResourceRepository
{
    /**
     * Find Resources by their Category
     * @param  Category $category
     * @return Collection
     */
    public function findResourcesByCategory(Category $category)
    {
        return Resource::where('cat_id', '=', $category->id)->get();
    }

    /**
     * Find Resources by their User
     * @param  Category $category
     * @return Collection
     */
    public function findResourcesByUser(User $user)
    {
        return Resource::where('user_id', '=', $user->id)->get();
    }
}

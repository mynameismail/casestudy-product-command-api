<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    public function add($payload): Category
    {
        $category = new Category;
        $category->name = $payload['name'];
        $category->created_at = time();
        $category->save();

        return $category;
    }
}

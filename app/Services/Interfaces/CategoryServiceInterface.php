<?php

namespace App\Services\Interfaces;

use App\Models\Category;

interface CategoryServiceInterface
{
    public function getCategories($request);
    public function getCategory($id);
    public function changeStatus(Category $category);
    public function create(array $data);
    public function update(Category $category,array $data);
    public function destroy(Category $category);
    public function getCategoryMainServicePluckName(Category $category);
    
}
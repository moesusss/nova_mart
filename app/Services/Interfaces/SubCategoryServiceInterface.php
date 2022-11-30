<?php

namespace App\Services\Interfaces;

use App\Models\SubCategory;

interface SubCategoryServiceInterface
{
    public function getSubCategories();
    public function getSubCategory($id);
    public function changeStatus(SubCategory $sub_category);
    public function create(array $data);
    public function update(SubCategory $sub_category,array $data);
    public function destroy(SubCategory $sub_category);
    public function getSubCategoryCategoryPluckName(SubCategory $sub_category);
    
}
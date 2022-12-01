<?php

namespace App\Services\Interfaces;

use App\Models\Brand;

interface BrandServiceInterface
{
    public function getBrands();
    public function getBrand($id);
    public function changeStatus(Brand $brand);
    public function create(array $data);
    public function update(Brand $brand,array $data);
    public function destroy(Brand $brand);
    public function getBrandSubCategoryPluckName(Brand $brand);
    
}
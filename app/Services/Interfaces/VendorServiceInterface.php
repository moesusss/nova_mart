<?php

namespace App\Services\Interfaces;

use App\Models\Vendor;

interface VendorServiceInterface
{
    public function getVendors();
    public function getVendor($id);
    public function create(array $data);
    public function update(Vendor $vendor,array $data);
    public function destroy(Vendor $vendor);
    
}
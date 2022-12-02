<?php

namespace App\Services\Interfaces;

use App\Models\HubVendor;

interface HubVendorServiceInterface
{
    public function getHubVendors($request);
    public function getHubVendor($id);
    public function changeStatus(HubVendor $hub_vendor);
    public function create(array $data);
    public function update(HubVendor $hub_vendor,array $data);
    public function destroy(HubVendor $hub_vendor);
}
<?php

namespace App\Services\Interfaces;

use App\Models\MainService;

interface MainServiceInterface
{
    public function getMainServices();
    public function getMainService(MainService $main_service);
    public function create(array $data);
    public function update(MainService $main_service,array $data);
    public function destroy(MainService $main_service);
}
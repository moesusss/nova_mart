<?php

namespace App\Repositories\Backend;

use App\Models\Lookup;
use Illuminate\Support\Facades\DB;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Backend\ImageRepository;

class LookupRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Lookup::class;
    }

    public function getLookups($key,$value)
    {
        $lookups = Lookup::where($key,$value)->get();
        return $lookups;
    }
    /**
     * @param array $data
     *
     * @return Lookup
     */
}

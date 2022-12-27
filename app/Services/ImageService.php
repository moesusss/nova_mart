<?php

namespace App\Services;

use App\Models\Image;
use Exception;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\Backend\ImageRepository;
use App\Services\Interfaces\ImageServiceInterface;

class ImageService implements ImageServiceInterface
{
    protected $imageRepository;

    public function __construct(ImageRepository $imageRepository)
    {
        $this->imageRepository = $imageRepository;
    }

    public function getImages()
    {
        if( request()->is('api/*')){
            return $this->imageRepository->getImages();
        }
        return $this->imageRepository->orderBy('created_at','desc')->get();
        
    }

    public function getImage($id)
    {
        return $this->imageRepository->getImage($id);
    }
    


    public function create(array $data)
    {        
        $result = $this->imageRepository->create($data);
        return $result;
    }

    public function update(Image $image,array $data)
    {
        DB::beginTransaction();
        try {
            $result = $this->imageRepository->update($image, $data);
        }
        catch(Exception $exc){
            DB::rollBack();
            Log::error($exc->getMessage());
            throw new InvalidArgumentException('Unable to update image');
        }
        DB::commit();

        return $result;
    }

    public function destroy(Image $image)
    {
        DB::beginTransaction();
        try {
            $result = $this->imageRepository->destroy($image);
        }
        catch(Exception $exc){
            DB::rollBack();
            Log::error($exc->getMessage());
            throw new InvalidArgumentException('Unable to delete image');
        }
        DB::commit();
        
        return $result;
    }

}
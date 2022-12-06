<?php

namespace App\Repositories\Backend;

use App\Models\Image;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Storage;

class ImageRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Image::class;
    }

    public function getImages()
    {
        $images = Image::orderBy('id','desc');
         if (request()->has('paginate')) {
            $images = $images->paginate(request()->get('paginate'));
        } else {
            $images = $images->get();
        }
        return $images;
    }
    /**
     * @param array $data
     *
     * @return Image
     */
    public function create(array $data) : Image
    {
        $image = Image::create([
           
        ]);
        return $image;
    }

    public function create_file($file, $path)
    {
        $file_name = null;
        if ($file) {
            if (gettype($file) == 'string') {
                $file_name = uniqid(). time(). '_' . '.' . 'png';
                Storage::disk('public')->put($path . '/' . $file_name, base64_decode($file),'public');
            } else {
                $file_name = time() . '_' . $file->getClientOriginalName();
                $content = file_get_contents($file);
                Storage::disk('public')->put($path . '/' . $file_name, $content, 'public');
            }
            Storage::setVisibility($path . '/' . $file_name, "public");
        }
         return $file_name;
    }

   
    /**
     * @param Image $image
     */
    public function destroy(Image $image)
    {
       
    }

   
}

<?php

namespace App\Http\Controllers;

use App\Models\ImagesSize;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use SplFileInfo;

class ImagesSizeController extends ImageController
{
    /**
     * Set uploaded file and check if it's valid after this converts to webp format and all availables size
     * @version     1.0.0
     * @author      Anderson Arruda < andmarruda@gmail.com >
     * @param       private ?\Illuminate\Http\UploadedFile $file
     * @param       ?string $oldFile=NULL
     * @return      void
     */
    public function __construct(UploadedFile $file, ?string $oldFile=NULL)
    {
        parent::__construct($file, $oldFile, false);
    }

    /**
     * Get all availables sizes
     * @version     1.0.0
     * @author      Anderson Arruda < andmarruda@gmail.com >
     * @param       
     * @return      \Illuminate\Database\Eloquent\Collection
     */
    public function getSizes(): \Illuminate\Database\Eloquent\Collection
    {
        return ImagesSize::all();
    }

    /**
     * Delete all files including the resizables ones
     * @version     1.0.0
     * @author      Anderson Arruda < andmarruda@gmail.com >
     * @param
     * @return      void
     */
    public function deleteCascade() : void
    {
        $this->deleteOldFile();
        $sizes = $this->getSizes();
        foreach($sizes as $size)
        {
            $filename = public_path($size->id. '_'. basename($this->oldFile));
            if(file_exists($filename)){
                unlink($filename);
            }
        }
    }

    /**
     * Resizes a image
     * @version     1.0.0
     * @author      Anderson Arruda < andmarruda@gmail.com >
     * @param       $imagesSize
     * @return      void
     */
    public function resizeImage($imagesSize)
    {
        $ext=$this->getExtension($this->uploaded);
        $func = $this->gdLibrary[$ext];
        if(!is_null($func)){
            $image = $func(Storage::path($this->uploaded));
            $dir = dirname(Storage::path($this->uploaded));
            $name = $imagesSize->id. '_'. str_replace($ext, 'webp', basename($this->uploaded));
            $image = imagescale($image, $imagesSize->max_width);
            imagewebp($image, $dir.'/'.$name);
            imagedestroy($image);
        }
    }

    /**
     * Resize image to all availables sizes
     * @version     1.0.0
     * @author      Anderson Arruda < andmarruda@gmail.com >
     * @param
     * @return      void
     */
    public function resize(): void
    {
        $sizes = $this->getSizes();
        foreach($sizes as $size)
        {
            $this->resizeImage($size);
        }
        $this->convertWebp($this->uploaded, 60);
    }

    /**
     * Get all image as html5 img srcset
     * @version     1.0.0
     * @author      Anderson Arruda < andmarruda@gmail.com >
     * @param       string $file
     * @return      string
     */
    public static function getImgSrcSet(string $file) : string
    {
        $sizes = ImagesSize::all();
        $srcset = '';
        foreach($sizes as $size)
        {
            $srcset .= asset('storage/'. $size->id. '_'. $file). ' '. $size->max_width. 'w, ';
        }
        return rtrim($srcset, ', ');
    }
}

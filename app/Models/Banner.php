<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Controllers\ImagesSizeController;

class Banner extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['alt', 'image', 'link', 'name'];

    /**
     * Returns complete path for banner image
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @return          string
     */
    public function getImage()
    {
        return strpos($this->image, '/') > -1 ? $this->image : 'storage/' . $this->image;
    }

    /**
     * Returns complete path for banner image resized
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           int $size_id
     * @return          string
     */
    public function getResizedImage(int $size_id)
    {
        return strpos($this->image, '/') > -1 ? $this->image : 'storage/'. $size_id. '_'. $this->image;
    }

    /**
     * Returns html 5 img srcset for the loaded model
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @return          string
     */
    public function getImgSrcSet() : string
    {
        return ImagesSizeController::getImgSrcSet($this->image);
    }
}

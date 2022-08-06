<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
}

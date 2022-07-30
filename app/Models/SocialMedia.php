<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'icon'];

    /**
     * Get all social media urls
     * @version     1.0.0
     * @author      Anderson Arruda < andmarruda@gmail.com >
     * @param       
     * @return      \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function urls() : \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(SocialMediaUrl::class);
    }
}

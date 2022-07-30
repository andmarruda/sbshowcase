<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMediaUrl extends Model
{
    use HasFactory;
    protected $fillable = ['url', 'social_media_id'];

    /**
     * Get the social media name and icon
     * @version     1.0.0
     * @author      Anderson Arruda < andmarruda@gmail.com >
     * @param       
     * @return      \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function socialMedia() : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(SocialMedia::class);
    }
}

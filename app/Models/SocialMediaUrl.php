<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMediaUrl extends Model
{
    use HasFactory;
    protected $fillable = ['social_media_id', 'url'];
}

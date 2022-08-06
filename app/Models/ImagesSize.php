<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ImagesSize extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['min_width', 'max_width', 'description'];
}

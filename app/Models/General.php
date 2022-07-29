<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class General extends Model
{
    use HasFactory;
    protected $fillable = ['brand', 'brand_image', 'slogan', 'section', 'google_analytics', 'google_optimize_script', 'highlight_img_1', 'highlight_text_1', 'highlight_img_2', 'highlight_text_2', 'company_name', 'company_doc', 'blog_url'];
}

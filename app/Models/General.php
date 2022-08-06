<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class General extends Model
{
    use HasFactory;
    protected $fillable = ['brand', 'brand_image', 'slogan', 'section', 'google_analytics', 'google_optimize_script', 'highlight_img_1', 'highlight_text_1', 'highlight_img_2', 'highlight_text_2', 'company_name', 'company_doc', 'blog_url', 'whatsapp_number'];

    /**
     * Returns complete path for brand image
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @return          string
     */
    public function getBrandImage()
    {
        return strpos($this->brand_image, '/') > -1 ? $this->brand_image : 'storage/' . $this->brand_image;
    }

    /**
     * Returns complete path for highlight image 1
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @return          string
     */
    public function getHighlightImage1()
    {
        return strpos($this->highlight_img_1, '/') > -1 ? $this->highlight_img_1 : 'storage/' . $this->highlight_img_1;
    }

    /**
     * Returns complete path for highlight image 2
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @return          string
     */
    public function getHighlightImage2()
    {
        return strpos($this->highlight_img_2, '/') > -1 ? $this->highlight_img_2 : 'storage/' . $this->highlight_img_2;
    }
}

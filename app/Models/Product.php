<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Controllers\ImagesSizeController;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['name', 'description', 'image', 'price', 'old_price', 'percentage_discount', 'installments_limit', 'quantity', 'promotion_flag', 'category_id', 'measure_id', 'color_id', 'brand_id', 'type_id'];

    /**
     * Get the product's image
     * @version     1.0.0
     * @author      Anderson Arruda < andmarruda@gmail.com >
     * @param
     * @return string
     */
    public function getImage() : string
    {
        return strpos($this->image, '/') > -1 ? $this->image : 'storage/' . $this->image;
    }

    /**
     * Get category information that belongs to
     * @version     1.0.0
     * @author      Anderson Arruda < andmarruda@gmail.com >
     * @param       
     * @return      \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category() : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get measure information that belongs to
     * @version     1.0.0
     * @author      Anderson Arruda < andmarruda@gmail.com >
     * @param
     * @return      \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function measure() : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Measure::class);
    }

    /**
     * Get color information that belongs to
     * @version     1.0.0
     * @author      Anderson Arruda < andmarruda@gmail.com >
     * @param
     * @return      \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function color() : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Color::class);
    }

    /**
     * Get brand information that belongs to
     * @version     1.0.0
     * @author      Anderson Arruda < andmarruda@gmail.com >
     * @param
     * @return      \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brand() : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * Get type information that belongs to
     * @version     1.0.0
     * @author      Anderson Arruda < andmarruda@gmail.com >
     * @param
     * @return      \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type() : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Type::class);
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

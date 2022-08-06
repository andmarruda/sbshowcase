<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Measure extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['width', 'height', 'length'];

    /**
     * Get the measure label
     * @version     1.0.0
     * @author      Anderson Arruda < andmarruda@gmail.com >
     * @param
     * @return string
     */
    public function getLabel() : string
    {
        $label = (($this->width > 0) ? $this->width . 'x' : ''). (($this->length > 0) ? $this->length . 'x' : ''). (($this->height > 0) ? $this->height . 'x' : '');
        return rtrim($label, 'x');
    }
}

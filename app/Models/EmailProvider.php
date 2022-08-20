<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmailProvider extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['host', 'port', 'email', 'password', 'secure'];
}

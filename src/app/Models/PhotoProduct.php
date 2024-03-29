<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotoProduct extends Model
{
    use HasFactory;

    protected $table = 'photo_products';

    protected $fillable = [
        'id',
        'product_id',
        'path'
    ];
}

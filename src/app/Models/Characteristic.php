<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Characteristic extends Model
{
    use HasFactory;

    protected $table = 'characteristics';

    protected $guarded = false;

    protected $fillable = [
        'id',
        'product_id',
        'key',
        'value'
    ];
}

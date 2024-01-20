<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* Класс характеристик продукта представляет модель для хранения характеристик в базе данных. */

class Characteristic extends Model
{
    use HasFactory;

    protected $table = 'characteristics';

    protected $fillable = [
        'id',
        'product_id',
        'key',
        'value'
    ];
}

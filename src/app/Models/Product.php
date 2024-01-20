<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/* Класс продукта представляет модель для продуктов в базе данных. */

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'product_id',
        'name',
        'price',
        'discount',
        'description',
        'type',
        'external_code',
        'barcode_ean_thirteen',
        'barcode_ean_eight',
        'barcode_code',
        'barcode_ean_upc',
        'barcode_ean_gtin',
        'additional_features',
    ];

    public function characteristics(): BelongsToMany
    {
        return $this->belongsToMany(Characteristic::class, 'characteristics', 'product_id');
    }
}

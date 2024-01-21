<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

/* Класс продукта представляет модель для продуктов в базе данных. */

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'id',
        'name',
        'price',
        'discount',
        'description',
        'type',
        'external_code',
        'barcode_ean_thirteen',
        'barcode_ean_eight',
        'barcode_code', // Code128
        'barcode_ean_upc',
        'barcode_ean_gtin',
        'additional_features',
    ];

    public function characteristics(): BelongsToMany
    {
        return $this->belongsToMany(Characteristic::class, 'characteristics');
    }

    public function getFirstLetterDescriptionAttribute(): string
    {
        return Str::words($this->description, 10);
    }
}

<?php

namespace App\Imports\Product;

use App\Models\Characteristic;
use App\Models\PhotoProduct;
use App\Models\Product;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Events\BeforeImport;
class ProductImport implements ToModel, WithEvents, WithHeadingRow, WithValidation
{
    public function registerEvents(): array
    {
        return [
            BeforeImport::class => function (BeforeImport $event) {
                $rows = $event->getReader()->getDelegate()->getActiveSheet()->getRowIterator();

                foreach ($rows as $row) {
                    $cellIterator = $row->getCellIterator();
                    $cellIterator->setIterateOnlyExistingCells(false);

                    $emptyCellCount = 0;

                    foreach ($cellIterator as $cell) {
                        if ($cell->getValue() === null) {
                            $emptyCellCount++;
                        } else {
                            $emptyCellCount = 0;
                        }

                        if ($emptyCellCount >= 5) {
                            session(['count' => "В файле обнаружено $emptyCellCount пустых ячеек. Пожалуйста исправьте это!"]);
                        }
                    }
                }
            },
        ];
    }

    public function rules(): array
    {
        return [
            'vnesnii_kod' => [
                'required',
                Rule::unique('products', 'external_code')
            ]
        ];
    }

    // Колонки: Категории, Бренд.
    public function model(array $row): Product
    {
        /** @var Product $product */
        $product = Product::query()->create([
            // Название товара
            'name' => $row['naimenovanie'],
            // Внешний код
            'external_code' => $row['vnesnii_kod'],
            // EAN13
            'barcode_ean_thirteen' => $row['strixkod_ean13'],
            // EAN8
            'barcode_ean_eight' => $row['strixkod_ean8'],
            // Code128
            'barcode_code' => $row['strixkod_code128'],
            // UPC
            'barcode_ean_upc' => $row['strixkod_upc'],
            // GTIN
            'barcode_ean_gtin' => $row['strixkod_gtin'],
            // Description
            'description' => $row['opisanie'],
            //price
            'price' => $row['cena_cena_prodazi'],
        ]);

        $product_id = $product->id;

        // Фото
        $photos = explode(', ', $row['dop_pole_ssylki_na_foto']);
        foreach ($photos as $photo) {
            PhotoProduct::query()->create([
                'product_id' => $product_id,
                'path' => $photo,
            ]);
        }

        // Характеристики в формате k, v
        Characteristic::query()->create(['product_id' => $product_id, 'key' => $row['tip'], 'value' => $row['gruppy']]);

        return $product;
    }
}

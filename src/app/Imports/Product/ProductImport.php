<?php

namespace App\Imports\Product;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Events\BeforeImport;

class ProductImport implements ToModel, WithEvents, WithHeadingRow
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
                            //throw ValidationException::withMessages(['import_file' => 'В файле обнаружены пустые ячейки! Удалите их и попробуйте сделать импорт снова']);
                        }
                    }
                }
            },
        ];
    }

    // Колонки: Категории, Бренд, Фото, - - Характеристики в формате k, v.
    public function model(array $row): Product
    {
        //tip
        //gruppy
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

//        $photos = explode(';', $row['dop_pole_ssylki_na_foto']);
//
//        $product->characteristics()->attach($photos);

        // TODO: Подумать над сохранением фотографий, модель

        return $product;
    }
}

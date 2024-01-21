<?php

namespace App\Service\Product;

use App\Imports\Product\ProductImport;
use App\Interfaces\ImportInterface;
use Illuminate\Http\UploadedFile;
use Maatwebsite\Excel\Facades\Excel;

class ServiceImport implements ImportInterface
{

    public function import(UploadedFile $file): void
    {
        Excel::import(new ProductImport, $file);
    }
}

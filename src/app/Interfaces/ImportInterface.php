<?php

namespace App\Interfaces;

use Illuminate\Http\UploadedFile;

interface ImportInterface
{
    public function import(UploadedFile $file): void;
}

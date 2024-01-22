<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Import\ImportRequest;
use App\Interfaces\ImportInterface;
use App\Models\Product;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\View\View;

class ProductController extends Controller
{
    protected ImportInterface $product;

    public function __construct(ImportInterface $product)
    {
        $this->product = $product;
    }

    public function store(ImportRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $file = Arr::get($data, 'import_file');

        try {
            $this->product->import($file);
            return redirect()->route('index')->with('success', 'Импорт данных выполнен успешно');
        } catch (Exception $exception) {
            return redirect()->back()->withErrors(['import_file' => "$exception"])->withInput();
        }
    }

    public function show(Product $product): View
    {
        $photos = $product->photos()->get();
        return view('show', compact('product', 'photos'));
    }
}

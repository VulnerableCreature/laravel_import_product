<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $products = Product::all();
        return view('welcome', compact('products'));
    }

    public function import(): View
    {
        return view('import');
    }
}

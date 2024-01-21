<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('welcome');
    }

    public function import(): View
    {
        return view('import');
    }
}

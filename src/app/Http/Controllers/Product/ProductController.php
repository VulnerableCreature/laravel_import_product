<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Import\ImportRequest;
use Exception;

class ProductController extends Controller
{
    public function store(ImportRequest $request)
    {
        $data = $request->validated();
        dd($data);
        /*try{

        }catch (Exception $exception){
            return redirect()->back()->withErrors(['file' => $exception])->withInput();
        }*/
    }
}

<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function allBrand()
    {
        $brands = Brand::latest()->get();

        return view('backend.brand.all_brand',compact('brands'));
    }
}

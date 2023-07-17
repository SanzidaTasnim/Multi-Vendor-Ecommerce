<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    public function allBrand()
    {
        $brands = Brand::latest()->get();

        return view('backend.brand.all_brand',compact('brands'));
    }
    public function addBrand()
    {
        return view('backend.brand.add_brand');
    }
    public function storeBrand(Request $request)
    {
        $img = $request->file('brand_img');
        $name_gen = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
        Image::make($img)->resize(300,300)->save('upload/brand/'.$name_gen);
        $img_url = "upload/brand/".$name_gen;

        Brand::insert([
            "brand_name" => $request->brand_name,
            "brand_slug" => strtolower(str_replace(' ', '-',$request->brand_name)),
            "brand_img" => $img_url
        ]);

        $notification = array(
            "message" => "Brand Inserted Successfully",
            "alert-type" => "success",
        );
        return redirect()->route('all.brands')->with($notification);
    }
}

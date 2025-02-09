<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\BrandModel;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{

    public function addBrand(Request $request)
    {
        if (Brand::where('name', $request->name)->first()) {
            return response()->json(['message' => 'name is taken'], 400);
        }

        if (!$request->file('image')) {
            return response()->json(['message' => 'image is required'], 400);
        }


        $brand = new Brand;
        $image = $request->file('image')->store('public');
        $brand->image = basename($image);
        $brand->name = $request->name;
        $brand = $brand->save();
        if ($brand) {
            return response()->json([], 200);
        }

        return response()->json([], 500);
    }


    public function getBrands()
    {
        $brands = Brand::all();
        if ($brands) {
            return response()->json($brands, 200);
        }
        return response()->json([], 500);
    }


    public function updateBrand(Request $request)
    {

        $brand =  Brand::find($request->id);

        if ($request->name) {
            if (Brand::where('name', $request->name)->first()) {
                return response()->json(['message' => 'name is taken'], 400);
            }
            $brand->name = $request->name;
        }

        if ($request->file('image')) {
            Storage::delete('public/' . $brand->image);
            $image = $request->file('image')->store('public');
            $brand->image = basename($image);
        }
        $brand = $brand->save();

        if ($brand) {
            return response()->json([], 200);
        }

        return response()->json([], 500);
    }


    public function deleteBrand(Request $request)
    {
        $brand =  Brand::find($request->id);
        $brand = $brand->delete();
        if ($brand) {
            return response()->json([], 200);
        }

        return response()->json([], 500);
    }
}

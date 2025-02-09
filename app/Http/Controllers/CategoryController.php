<?php

namespace App\Http\Controllers;

use App\Models\BrandModel;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{

    public function addCategory(Request $request)
    {
        if (Category::where('name', $request->name)->first()) {
            return response()->json(['message' => 'name is taken'], 400);
        }

      

        $category = new Category;
        $category->name = $request->name;
    
        $category = $category->save();
        if ($category) {
            return response()->json([], 200);
        }

        return response()->json([], 500);
    }


    public function getCategories()
    {
        $brands = Category::all();
        if ($brands) {
            return response()->json($brands, 200);
        }
        return response()->json([], 500);
    }


    public function updateCategory(Request $request)
    {

        $category =  Category::find($request->id);

        if ($request->name) {
            if (Category::where('name', $request->name)->first()) {
                return response()->json(['message' => 'name is taken'], 400);
            }
            $category->name = $request->name;
        }

        // if ($request->file('image')) {
        //     Storage::delete('public/' . $category->image);
        //     $image = $request->file('image')->store('public');
        //     $category->image = basename($image);
        // }
        $category = $category->save();

        if ($category) {
            return response()->json([], 200);
        }

        return response()->json([], 500);
    }


    public function deleteCategory(Request $request)
    {
        $category =  Category::find($request->id);
        $category = $category->delete();
        if ($category) {
            return response()->json([], 200);
        }

        return response()->json([], 500);
    }
}

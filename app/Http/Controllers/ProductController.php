<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\BrandModel;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{


    //   $table->id();
    //             $table->string('name');
    //             $table->string('price');
    //             $table->string('imageUrl');
    //             $table->integer('quantity')->default(0);
    //             $table->foreignId('storeId')->constrained('store')->onDelete('cascade');
    //             $table->foreignId('brandId')->constrained('brand')->onDelete('cascade');
    //             $table->foreignId('categoryId')->constrained('category')->onDelete('cascade');
    public function addProduct(Request $request)
    {

        if (!$request->file('imageUrl')) {
            return response()->json(['message' => 'imageUrl is required'], 400);
        }


        $store = new Product;
        $imageUrl = $request->file('imageUrl')->store('public');
        $store->imageUrl = basename($imageUrl);
        $store->name = $request->name;
        $store->quantity = $request->quantity;
        $store->price = $request->price;
        $store->storeId = $request->storeId;
        $store->categoryId = $request->categoryId;
        $store->brandId = $request->brandId;
        $store = $store->save();
        if ($store) {
            return response()->json([], 200);
        }

        return response()->json([], 500);
    }


    public function getProducts()
    {
        $products = Product::all();
        if ($products) {
            return response()->json($products, 200);
        }
        return response()->json([], 500);
    }

    public function getProductByCategoryId(Request $request)
    {
        $products = Product::where('categoryId', $request->categoryId)->get();

        if ($products) {
            return response()->json($products, 200);
        }
        return response()->json([], 500);
    }
    public function getProductByBrandId(Request $request)
    {
        $products = Product::where('brandId', $request->brandId)->get();
        if ($products) {
            return response()->json($products, 200);
        }
        return response()->json([], 500);
    }

    public function getProductByStoreId(Request $request)
    {
        $products = Product::where('storeId', $request->storeId)->get();
        if ($products) {
            return response()->json($products, 200);
        }
        return response()->json([], 500);
    }

    public function updateProduct(Request $request)
    {

        $store =  Product::find($request->id);

        if ($request->name) {
            if (Product::where('name', $request->name)->first()) {
                return response()->json(['message' => 'name is taken'], 400);
            }
            $store->name = $request->name;
        }

        if ($request->quantity) {
            $store->quantity = $request->quantity;
        }
        if ($request->price) {
            $store->price = $request->price;
        }

        if ($request->file('imageUrl')) {
            Storage::delete('public/' . $store->imageUrl);
            $imageUrl = $request->file('imageUrl')->store('public');
            $store->imageUrl = basename($imageUrl);
        }
        $store = $store->save();

        if ($store) {
            return response()->json([], 200);
        }

        return response()->json([], 500);
    }


    public function deleteProduct(Request $request)
    {
        $store =  Product::find($request->id);
        $store = $store->delete();
        if ($store) {
            return response()->json([], 200);
        }

        return response()->json([], 500);
    }
}

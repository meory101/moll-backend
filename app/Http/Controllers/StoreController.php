<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\BrandModel;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{

    //   $table->id();
    //     $table->string('name');
    //     $table->string('desc');
    //     $table->string('imageUrl');
    //     $table->foreignId('mollId')

    public function addStore(Request $request)
    {

        if (!$request->file('imageUrl')) {
            return response()->json(['message' => 'imageUrl is required'], 400);
        }


        $store = new Store;
        $imageUrl = $request->file('imageUrl')->store('public');
        $store->imageUrl = basename($imageUrl);
        $store->name = $request->name;
        $store->desc = $request->desc;
        $store->mollId = $request->mollId;
        $store = $store->save();
        if ($store) {
            return response()->json([], 200);
        }

        return response()->json([], 500);
    }


    public function getStores()
    {
        $stores = Store::all();
        if ($stores) {
            return response()->json($stores, 200);
        }
        return response()->json([], 500);
    }


    public function updateStore(Request $request)
    {

        $store =  Store::find($request->id);

        if ($request->name) {
            if (Store::where('name', $request->name)->first()) {
                return response()->json(['message' => 'name is taken'], 400);
            }
            $store->name = $request->name;
        }

        if ($request->desc) {
            $store->desc = $request->desc;
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


    public function deleteStore(Request $request)
    {
        $store =  Store::find($request->id);
        $store = $store->delete();
        if ($store) {
            return response()->json([], 200);
        }

        return response()->json([], 500);
    }
}

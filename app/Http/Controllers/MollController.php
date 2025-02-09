<?php

namespace App\Http\Controllers;

use App\Models\Moll;
use App\Models\BrandModel;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class MollController extends Controller
{

    public function addMoll(Request $request)
    {
        if (Moll::where('name', $request->name)->first()) {
            return response()->json(['message' => 'name is taken'], 400);
        }

        if (!$request->file('imageUrl')) {
            return response()->json(['message' => 'imageUrl is required'], 400);
        }


        $moll = new Moll;
        $imageUrl = $request->file('imageUrl')->store('public');
        $moll->imageUrl = basename($imageUrl);
        $moll->name = $request->name;
        $moll->desc = $request->desc;
        $moll->location = $request->location;
        $moll = $moll->save();
        if ($moll) {
            return response()->json([], 200);
        }

        return response()->json([], 500);
    }


    public function getMolls()
    {
        $molls = Moll::all();
        if ($molls) {
            return response()->json($molls, 200);
        }
        return response()->json([], 500);
    }


    public function updateMoll(Request $request)
    {


        $moll =  Moll::find($request->id);


        if ($request->name) {
            if (Moll::where('name', $request->name)->first()) {
                return response()->json(['message' => 'name is taken'], 400);
            }
            $moll->name = $request->name;
        }

        if ($request->desc) {

            $moll->desc = $request->desc;
        }
        if ($request->location) {

            $moll->location = $request->location;
        }
        if ($request->file('imageUrl')) {
            Storage::delete('public/' . $moll->imageUrl);
            $imageUrl = $request->file('imageUrl')->store('public');
            $moll->imageUrl = basename($imageUrl);
        }
        $moll = $moll->save();

        if ($moll) {
            return response()->json([], 200);
        }

        return response()->json([], 500);
    }


    public function deleteMoll(Request $request)
    {
        $moll =  Moll::find($request->id);
        $moll = $moll->delete();
        if ($moll) {
            return response()->json([], 200);
        }

        return response()->json([], 500);
    }
}

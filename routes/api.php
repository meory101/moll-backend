<?php

use App\Http\Controllers\addressController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ClientDeliveryController;
use App\Http\Controllers\MainBranchController;
use App\Http\Controllers\MainCategoryController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\MollController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OTPController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\SubBranchCotroller;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\WasityAccountController;
use App\Models\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



//brand

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


//brand
Route::post('addBrand', [BrandController::class, 'addBrand']);
Route::get('getBrands', [BrandController::class, 'getBrands']);
Route::post('updateBrand', [BrandController::class, 'updateBrand']);
Route::post('deleteBrand', [BrandController::class, 'deleteBrand']);





//category
Route::post('addCategory', [CategoryController::class, 'addCategory']);
Route::get('getCategories', [CategoryController::class, 'getCategories']);
Route::post('updateCategory', [CategoryController::class, 'updateCategory']);
Route::post('deleteCategory', [CategoryController::class, 'deleteCategory']);


//moll
Route::post('addMoll', [MollController::class, 'addMoll']);
Route::get('getMolls', [MollController::class, 'getMolls']);
Route::post('updateMoll', [MollController::class, 'updateMoll']);
Route::post('deleteMoll', [MollController::class, 'deleteMoll']);

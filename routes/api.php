<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\addressController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CashAccountController;
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
use App\Http\Controllers\StoreController;
use App\Http\Controllers\SubBranchCotroller;
use App\Http\Controllers\SubCategoryController;
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


//store
Route::post('addStore', [StoreController::class, 'addStore']);
Route::get('getStores', [StoreController::class, 'getStores']);
Route::post('updateStore', [StoreController::class, 'updateStore']);
Route::post('deleteStore', [StoreController::class, 'deleteStore']);


//product
Route::post('addProduct', [ProductController::class, 'addProduct']);
Route::get('getProducts', [ProductController::class, 'getProducts']);
Route::post('updateProduct', [ProductController::class, 'updateProduct']);
Route::post('deleteProduct', [ProductController::class, 'deleteProduct']);

Route::post('getProductByCategoryId', [ProductController::class, 'getProductByCategoryId']);
Route::post('getProductByBrandId', [ProductController::class, 'getProductByBrandId']);
Route::post('getProductByStoreId', [ProductController::class, 'getProductByStoreId']);



Route::post('getProductByCategoryId', [ProductController::class, 'getProductByCategoryId']);
Route::post('getProductByBrandId', [ProductController::class, 'getProductByBrandId']);
Route::post('getProductByStoreId', [ProductController::class, 'getProductByStoreId']);


Route::post('changeBalance', [CashAccountController::class, 'changeBalance']);
Route::post('getAccount', [CashAccountController::class, 'getAccount']);
Route::post('getUsers', [CashAccountController::class, 'getUsers']);


Route::post('getClientOrders', [OrderController::class, 'getClientOrders']);
Route::post('addOrder', [OrderController::class, 'addOrder']);

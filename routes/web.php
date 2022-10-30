<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::get('/product/view', [ProductController::class, 'View']);
    Route::get('/product/add', [ProductController::class, 'Create']);
     Route::post('/product/store', [ProductController::class, 'Store']);
    Route::get('/product/delete/{id}', [ProductController::class, 'Delete']);
    Route::get('/subcat/filter/{sub_cat_id}', [ProductController::class, 'SubcatFilter']);
    Route::get('/cat/filter/{cat_id}', [ProductController::class, 'CatFilter']);
    Route::get('/product/filter/{product_id}', [ProductController::class, 'ProductFilter']);
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

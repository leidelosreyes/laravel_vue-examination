<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('product')->group(function (){
    Route::get('/view', [App\Http\Controllers\Api\ProductController::class, 'index'])->name('admin.view');
    Route::post('/store', [App\Http\Controllers\Api\ProductController::class, 'store'])->name('admin.store');
    Route::get('/edit/{id}', [App\Http\Controllers\Api\ProductController::class, 'edit'])->name('admin.edit');
    Route::post('/update/{id}', [App\Http\Controllers\Api\ProductController::class, 'update'])->name('admin.update');
    Route::delete('/delete/{id}', [App\Http\Controllers\Api\ProductController::class, 'delete'])->name('admin.delete');
    Route::get('/search', [App\Http\Controllers\Api\ProductController::class, 'search'])->name('admin.search');
    Route::get('/category',[App\Http\Controllers\Api\ProductController::class, 'getCategory'])->name('admin.category');
    Route::get('/category/show',[App\Http\Controllers\Api\ProductController::class, 'show_category'])->name('admin.show_category');
});

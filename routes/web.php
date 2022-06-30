<?php

use App\Http\Controllers\Administrator\CategoryController;
use App\Http\Controllers\Administrator\SubCategoryController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
require __DIR__.'/administrator.php';


Route::middleware('auth:administrator')->prefix('administrator')->name('administrator.')->group(function(){
    Route::prefix('category')->name('category.')->group(function(){
        Route::get('/' , [CategoryController::class,'index'])->name('view');
        Route::post('/store' , [CategoryController::class,'store'])->name('store');
        Route::delete('/{category}/delete' ,[CategoryController::class ,'destroy'])->name('delete');
        Route::put('/{category}/update' , [CategoryController::class,'update'])->name('update');
    });
    Route::prefix('sub-category')->name('sub-category.')->group(function(){
        Route::get('/' , [SubCategoryController::class,'index'])->name('view');
    });
});
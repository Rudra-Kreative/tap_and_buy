<?php

use App\Http\Controllers\Administrator\AdminOwnerController;
use App\Http\Controllers\Administrator\AdminUserController;
use App\Http\Controllers\Administrator\CategoryController;
use App\Http\Controllers\Administrator\SubCategoryController;
use App\Http\Controllers\EventCategoryController;
use App\Http\Controllers\EventController;
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
    
    //category
    
    Route::prefix('category')->name('category.')->group(function(){
        Route::get('/' , [CategoryController::class,'index'])->name('view');
        Route::post('/store' , [CategoryController::class,'store'])->name('store');
        Route::delete('/{category}/delete' ,[CategoryController::class ,'destroy'])->name('delete');
        Route::put('/{category}/update' , [CategoryController::class,'update'])->name('update');
        Route::put('/{category}/suspend' , [CategoryController::class,'deactive'])->name('suspend');
    });


    //sub-category
    Route::prefix('sub-category')->name('sub-category.')->group(function(){
        Route::get('/' , [SubCategoryController::class,'index'])->name('view');
        Route::post('/store' , [SubCategoryController::class,'store'])->name('store');
        Route::delete('/{category}/delete' ,[SubCategoryController::class ,'destroy'])->name('delete');
        Route::put('/{category}/update' ,[SubCategoryController::class ,'update'])->name('update');
        Route::put('/{category}/suspend' , [SubCategoryController::class,'deactive'])->name('suspend');

    });

    //owner

    Route::prefix('owner')->name('owner.')->group(function(){

        Route::get('/',[AdminOwnerController::class,'index'])->name('view');
        Route::post('/store',[AdminOwnerController::class,'store'])->name('store');
        Route::get('/{user}/edit',[AdminOwnerController::class,'edit'])->name('edit');
        Route::post('/{user}/update',[AdminOwnerController::class,'update'])->name('update');
        Route::delete('/{user}/delete' ,[AdminOwnerController::class ,'destroy'])->name('delete');
        Route::put('/{user}/suspend' , [AdminOwnerController::class,'deactive'])->name('suspend');
    });

    //users
    Route::prefix('user')->name('user.')->group(function(){

        Route::get('/owner',[AdminOwnerController::class,'index'])->name('owner.list');
       
        
    });

    Route::prefix('event')->name('event.')->group(function(){
        //category
        Route::prefix('/category')->name('category.')->group(function(){
            Route::get('/', [EventCategoryController::class ,'index'])->name('view');
            Route::post('/store', [EventCategoryController::class ,'store'])->name('store');

            Route::put('/{eventCategory}/suspend' , [EventCategoryController::class,'deactive'])->name('suspend');
        });
       
        //event
        Route::get('/',[EventController::class ,'index'])->name('view');
        Route::post('/store',[EventController::class ,'store'])->name('store');
        
    });
    
});
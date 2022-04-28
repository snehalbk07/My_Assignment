<?php

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

Route::get('/', 'App\Http\Controllers\LoginController@login');

Route::middleware('IsGuestUser')->group(function(){
    Route::get('/login','App\Http\Controllers\LoginController@login')->name('login');
    Route::post('/login_details','App\Http\Controllers\LoginController@login_details')->name('login_details');
   
    Route::get('/register','App\Http\Controllers\LoginController@register')->name('register');
    Route::post('/insert_register_details','App\Http\Controllers\LoginController@insert_register_details')->name('insert_register_details');

});
Route::get('/logout','App\Http\Controllers\LoginController@logout')->name('logout');


Route::middleware('IsValidUser')->group(function () {
    Route::get('/dashboard', function () {
        $category_count = \App\Models\Category::get();
        $product_count = \App\Models\Product::get();
        return view('dashboard',compact('category_count','product_count'));
    });

    Route::get('category','App\Http\Controllers\CategoryController@index')->name('category');
    Route::get('cat_add','App\Http\Controllers\CategoryController@create')->name('cat_add');
    Route::post('cat_add','App\Http\Controllers\CategoryController@store')->name('cat_add');
    Route::get('cat_edit/{id}','App\Http\Controllers\CategoryController@edit')->name('cat_edit');
    Route::post('cat_edit/{id}','App\Http\Controllers\CategoryController@update')->name('cat_edit');
    Route::get('cat_delete/{id}','App\Http\Controllers\CategoryController@destroy')->name('cat_delete');


    Route::get('product','App\Http\Controllers\ProductController@index')->name('product');
    Route::get('prod_add','App\Http\Controllers\ProductController@create')->name('prod_add');
    Route::post('prod_add','App\Http\Controllers\ProductController@store')->name('prod_add');
    Route::get('prod_edit/{id}','App\Http\Controllers\ProductController@edit')->name('prod_edit');
    Route::post('prod_edit/{id}','App\Http\Controllers\ProductController@update')->name('prod_edit');
    Route::get('prod_delete/{id}','App\Http\Controllers\ProductController@destroy')->name('prod_delete');

    

});





// Route::get('/category','App\Http\Controllers\CategoryController@category')->name('category');








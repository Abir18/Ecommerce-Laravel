<?php

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

// Frontend Routes ......................
Route::get('/', 'HomeController@index');

//Category wise Product Related Routes
Route::get('/product-by-category/{category_id}', 'HomeController@show_product_by_category');
Route::get('/product-by-manufacture/{manufacture_id}', 'HomeController@show_product_by_manufacture');
Route::get('/view-product/{product_id}', 'HomeController@product_details_by_id');
Route::post('/add-to-cart', 'CartController@add_to_cart');
Route::get('/show-cart', 'CartController@show_cart');






// Backend Routes(Admin) ......................

//Admin Routes
Route::get('/admin', 'AdminController@index');
Route::get('/dashboard', 'SuperAdminController@index');
Route::post('/admin-dashboard', 'AdminController@dashboard');
Route::get('/logout', 'SuperAdminController@logout');


// Category Related Routes
Route::get('/add-category', 'CategoryController@index')->name('add-category');
Route::get('/all-category', 'CategoryController@all_category')->name('all-category');
Route::post('/save-category', 'CategoryController@save_category');
Route::get('/edit-category/{category_id}', 'CategoryController@edit_category');
Route::post('/update-category/{category_id}', 'CategoryController@update_category');
Route::get('/delete-category/{category_id}', 'CategoryController@delete_category');
Route::get('/inactive-category/{category_id}', 'CategoryController@inactive_category');
Route::get('/active-category/{category_id}', 'CategoryController@active_category')->name('active_category');


// Manufacture or Brand Related Routes
Route::get('/add-manufacture', 'ManufactureController@index');
Route::post('/save-manufacture', 'ManufactureController@save_manufacture');
Route::get('/all-manufacture', 'ManufactureController@all_manufacture');
Route::get('/edit-manufacture/{manufacture_id}', 'ManufactureController@edit_manufacture');
Route::post('/update-manufacture/{manufacture_id}', 'ManufactureController@update_manufacture');
Route::get('/delete-manufacture/{manufacture_id}', 'ManufactureController@delete_manufacture');
Route::get('/inactive-manufacture/{manufacture_id}', 'ManufactureController@inactive_manufacture');
Route::get('/active-manufacture/{manufacture_id}', 'ManufactureController@active_manufacture');


// Products Related Routes
Route::get('/add-product', 'ProductController@index');
Route::post('/save-product', 'ProductController@save_product');
Route::get('/all-product', 'ProductController@all_product');
Route::get('/inactive-product/{product_id}', 'ProductController@inactive_product');
Route::get('/active-product/{product_id}', 'ProductController@active_product');
Route::get('/edit-product/{product_id}', 'ProductController@edit_product');
Route::post('/update-product/{product_id}', 'ProductController@update_product');
Route::get('/delete-product/{product_id}', 'ProductController@delete_product');

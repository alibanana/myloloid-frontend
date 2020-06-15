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

Auth::routes();

Route::get('/', 'PagesController@home');

// Product / Catalogue Page
Route::get('/catalogue', 'CatalogueController@index');
Route::get('/catalogue/{category}', 'CatalogueController@subindex')->name('catalogue.category');
Route::get('/catalogue/products/{product}', 'CatalogueController@show')->name('catalogue.show');
Route::post('/catalogue/products/{product}', 'CatalogueController@addtocart')->name('catalogue.addtocart');

// Cart Page
Route::get('/cart', 'CartController@index')->name('cart.index');
Route::get('/cart/checkout', 'CartController@indexCheckout')->name('cart.checkout');
Route::put('/cart/update', 'CartController@update')->name('cart.update');
Route::post('/cart', 'CartController@store')->name('cart.store');

// Invoice Page
Route::get('/invoice/{invoice_no}', 'CartController@indexInvoice')->name('invoice.index');

// Confirmation Page
Route::get('/confirmation', 'CartController@indexConfirmation')->name('confirmation.index');
Route::post('/confirmation', 'CartController@storeConfirmation')->name('confirmation.store');

// User Dashboard
Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');
Route::get('/dashboard/orders', 'DashboardController@show')->name('dashboard.show');

// Admin Routes
Route::get('/admin/dashboard', 'Admin\AdminPagesController@index')->name('admin.dashboard')->middleware('is_admin');
Route::get('/admin/sales', 'Admin\AdminPagesController@sales')->name('admin.sales')->middleware('is_admin');
Route::get('/admin/reports', 'Admin\AdminPagesController@reports')->name('admin.reports')->middleware('is_admin');  
Route::get('/admin/profile', 'Admin\AdminPagesController@profile')->name('admin.profile')->middleware('is_admin');

// Transaction Routes
Route::resource('/admin/transactions', 'Admin\TransactionController', ['as' => 'admin'])->middleware('is_admin');

// Products Routes
Route::resource('/admin/products', 'Admin\ProductController', ['as' => 'admin'])->middleware('is_admin');
Route::get('/admin/products/category/{category}', 'Admin\ProductController@subindex')->name('admin.product.category')->middleware('is_admin');

// User Routes
Route::resource('/admin/users', 'Admin\UserController')->middleware('is_admin');
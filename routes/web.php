<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use \App\Http\Controllers\HomeController;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\ProductController;
use \App\Http\Controllers\TableController;
use \App\Http\Controllers\OrderController;

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

/******************** Auth ********************/
Route::get('/', function () {
    return redirect(route('web.public.login.in'));
});
Route::get('/forbidden', [LoginController::class, 'forbidden'])->name('web.forbidden');

Route::get('/login', [LoginController::class, 'index'])->name('web.public.login.in')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->name('web.public.login.in');
Route::get('/logout', [LoginController::class, 'logout'])->name('web.public.login.out');

/******************** Admin ********************/
Route::get('/admin/home', [HomeController::class, 'admin'])->name('web.admin.home')->middleware('auth.admin');
Route::post('/admin/home/graphics', [HomeController::class, 'graphics'])->name('web.admin.home.graphics')->middleware('auth.admin');

Route::get('/admin/users', [UserController::class, 'index'])->name('web.admin.users')->middleware('auth.admin');
Route::post('/admin/users', [UserController::class, 'list'])->name('web.admin.users.list')->middleware('auth.admin');
Route::get('/admin/users/view/{id}', [UserController::class, 'view'])->name('web.admin.users.view')->middleware('auth.admin');
Route::get('/admin/users/create-view', [UserController::class, 'createView'])->name('web.admin.users.create-view')->middleware('auth.admin');
Route::post('/admin/users/create', [UserController::class, 'create'])->name('web.admin.users.create')->middleware('auth.admin');
Route::get('/admin/users/edit-view/{id}', [UserController::class, 'editView'])->name('web.admin.users.edit-view')->middleware('auth.admin');
Route::post('/admin/users/edit', [UserController::class, 'edit'])->name('web.admin.users.edit')->middleware('auth.admin');
Route::post('/admin/users/delete', [UserController::class, 'delete'])->name('web.admin.users.delete')->middleware('auth.admin');

Route::get('/admin/products', [ProductController::class, 'index'])->name('web.admin.products')->middleware('auth.admin');
Route::post('/admin/products', [ProductController::class, 'list'])->name('web.admin.products.list')->middleware('auth.admin');
Route::get('/admin/products/view/{id}', [ProductController::class, 'view'])->name('web.admin.products.view')->middleware('auth.admin');
Route::get('/admin/products/create-view', [ProductController::class, 'createView'])->name('web.admin.products.create-view')->middleware('auth.admin');
Route::post('/admin/products/create', [ProductController::class, 'create'])->name('web.admin.products.create')->middleware('auth.admin');
Route::get('/admin/products/edit-view/{id}', [ProductController::class, 'editView'])->name('web.admin.products.edit-view')->middleware('auth.admin');
Route::post('/admin/products/edit', [ProductController::class, 'edit'])->name('web.admin.products.edit')->middleware('auth.admin');
Route::post('/admin/products/delete', [ProductController::class, 'delete'])->name('web.admin.products.delete')->middleware('auth.admin');

Route::get('/admin/tables', [TableController::class, 'index'])->name('web.admin.tables')->middleware('auth.admin');
Route::post('/admin/tables', [TableController::class, 'list'])->name('web.admin.tables.list')->middleware('auth.admin');
Route::get('/admin/tables/view/{id}', [TableController::class, 'view'])->name('web.admin.tables.view')->middleware('auth.admin');
Route::get('/admin/tables/create-view', [TableController::class, 'createView'])->name('web.admin.tables.create-view')->middleware('auth.admin');
Route::post('/admin/tables/create', [TableController::class, 'create'])->name('web.admin.tables.create')->middleware('auth.admin');
Route::get('/admin/tables/edit-view/{id}', [TableController::class, 'editView'])->name('web.admin.tables.edit-view')->middleware('auth.admin');
Route::post('/admin/tables/edit', [TableController::class, 'edit'])->name('web.admin.tables.edit')->middleware('auth.admin');
Route::post('/admin/tables/delete', [TableController::class, 'delete'])->name('web.admin.tables.delete')->middleware('auth.admin');

/******************** Manager ********************/
Route::get('/manager/home', [HomeController::class, 'manager'])->name('web.manager.home')->middleware('auth.manager');

Route::get('/manager/orders', [OrderController::class, 'index'])->name('web.manager.orders')->middleware('auth.manager');
Route::post('/manager/orders', [OrderController::class, 'list'])->name('web.manager.orders.list')->middleware('auth.manager');
Route::get('/manager/orders/view/{id}', [OrderController::class, 'view'])->name('web.manager.orders.view')->middleware('auth.manager');
Route::get('/manager/orders/edit-view/{id}', [OrderController::class, 'editView'])->name('web.manager.orders.edit-view')->middleware('auth.manager');
Route::post('/manager/orders/edit', [OrderController::class, 'edit'])->name('web.manager.orders.edit')->middleware('auth.manager');
Route::post('/manager/orders/delete', [OrderController::class, 'delete'])->name('web.manager.orders.delete')->middleware('auth.manager');
Route::post('/manager/orders/collect', [OrderController::class, 'collect'])->name('web.manager.orders.collect')->middleware('auth.manager');

/******************** Waiter ********************/
Route::get('/waiter/home', [HomeController::class, 'waiter'])->name('web.waiter.home')->middleware('auth.waiter');

Route::get('/waiter/orders', [OrderController::class, 'index'])->name('web.waiter.orders')->middleware('auth.waiter');
Route::post('/waiter/orders', [OrderController::class, 'list'])->name('web.waiter.orders.list')->middleware('auth.waiter');
Route::get('/waiter/orders/view/{id}', [OrderController::class, 'view'])->name('web.waiter.orders.view')->middleware('auth.waiter');
Route::get('/waiter/orders/create-view', [OrderController::class, 'createView'])->name('web.waiter.orders.create-view')->middleware('auth.waiter');
Route::post('/waiter/orders/create', [OrderController::class, 'create'])->name('web.waiter.orders.create')->middleware('auth.waiter');

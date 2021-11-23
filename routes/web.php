<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;use Illuminate\Auth\Middleware\Authenticate;
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

Route::get('/', [AuthController::class, 'index'])->name("login")->middleware("guest");
Route::post('/auth', [AuthController::class, 'Auth'])->middleware("guest");

Route::middleware([Authenticate::class])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::resources([
        '/dashboard' => Dashboard::class,
        '/product' => ProductController::class,
        '/category' => CategoryController::class,
        '/setting' => SettingController::class,
    ]);
    Route::post('storeUser', [ProductController::class, 'storeUser'])->name("user.add");
    Route::get('cek', [ProductController::class, 'cekHarga'])->name("product.cek");
    Route::get('produk', [ProductController::class, 'validasi'])->name("product.validasi");
    Route::get('contoh', [SettingController::class, 'contoh']);
});

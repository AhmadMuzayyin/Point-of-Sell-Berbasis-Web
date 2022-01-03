<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Models\Setting;
use Illuminate\Auth\Middleware\Authenticate;
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
        '/transaction' => TransactionController::class,
        '/laporan' => LaporanController::class,
        '/user' => UserController::class,
        '/members' => MemberController::class,
        '/notif' => NotificationController::class,
    ]);
    Route::post('user-edit', [UserController::class, 'editUser'])->name('user-edit');
    Route::get('cetak-member', [MemberController::class, 'cetak'])->name("cetak.member");
    Route::get('cetak-member/{member}', [MemberController::class, 'cetakMember'])->name("cetak.mem");

    Route::get('settingEdit/{setting}', [SettingController::class, 'edit']);
    Route::get('cek', [ProductController::class, 'cekHarga'])->name("product.cek");
    Route::get('cekstok', [ProductController::class, 'cekstok'])->name("product.stok");
    Route::get('produk', [ProductController::class, 'validasi'])->name("product.validasi");

    // Transaksi
    Route::get('product/{product}', [ProductController::class, 'destroy']);
    Route::get('get-product', [TransactionController::class, 'getProduct'])->name('get.product');
    Route::get('delete-product', [TransactionController::class, 'delete'])->name('delete.product');
    Route::get('update-product', [TransactionController::class, 'updateProduct'])->name('update.product');
    Route::get('diskon-update-product', [TransactionController::class, 'diskonProduct'])->name('diskon.product');
    Route::get('selesai-product', [TransactionController::class, 'selesaiProduct'])->name('selesai.product');
    Route::get('cetak-transaksi', [TransactionController::class, 'cetakTransaksi'])->name('cetak.transaksi');
    Route::get('cek-member', [TransactionController::class, 'cekMember'])->name('cek.member');

    // Laporan
    Route::get('laporan-data', [LaporanController::class, 'getLaporan'])->name('data.laporan');
    Route::get('cetak-laporan', [LaporanController::class, 'cetakLaporan'])->name('cetak.laporan');
});

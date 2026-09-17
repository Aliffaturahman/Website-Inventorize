<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\TableController;

use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\TintaController;

use App\Http\Controllers\StokKainController;
use App\Http\Controllers\KainController;
use App\Http\Controllers\ProduksiController;
use App\Http\Controllers\RollController;

use App\Http\Controllers\StokTintaController;
use App\Http\Controllers\KertasController;
use App\Http\Controllers\BeratController;

use App\Http\Controllers\StokKertasController;
use App\Http\Controllers\WarnaController;
use App\Http\Controllers\VolumeController;

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

Route::group([
    'prefix' => config('admin.prefix'),
    'namespace' => 'App\\Http\\Controllers',
], function () {

    Route::get('login', 'LoginAdminController@formLogin')->name('admin.login');
    Route::post('login', 'LoginAdminController@login');

    Route::middleware(['auth:admin'])->group(function () {
        Route::post('logout', 'LoginAdminController@logout')->name('admin.logout');
        Route::view('/post', 'data-post')->name('post')->middleware('can:role,"admin","operator"');
        Route::view('/admin', 'data-admin')->name('admin')->middleware('can:role,"admin"');

        // Route::view(
        //     '/',
        //     '/page/dashboard',
        //     data: ["title" => "Dashboard"]
        // )->name('dashboard')->middleware('can:role,"admin","operator"');
        Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard')->middleware('can:role,"admin","operator"');

        // FORM
        Route::get('/form/{slug}', [FormController::class, 'index'])->middleware('can:role, "admin"');
        Route::get('/get-rolls', [RollController::class, 'getRolls'])->name('get-rolls')->middleware('can:role, "admin"');
        Route::get('/get-panjang', [StokKertasController::class, 'getPanjang'])->name('get-panjang')->middleware('can:role, "admin"');
        
        // TABLE
        Route::get('/table/{link}', [TableController::class, 'show'])->middleware('can:role,"admin","operator"')->name('table.show');

        // POST
        Route::post('/form/Tinta', [TintaController::class, 'store'])
            ->name('tinta.store')
            ->middleware('can:role,"admin"');
        Route::post('/form/Transaksi', [TransaksiController::class, 'store'])
            ->name('transaksi.store')
            ->middleware('can:role,"admin"');
        
        Route::post('/form/Stok_Kain', [StokKainController::class, 'store'])
            ->name('stok_kain.store')
            ->middleware('can:role,"admin"');
        Route::post('/form/Kain', [KainController::class, 'store'])
            ->name('kain.store')
            ->middleware('can:role,"admin"');
        Route::post('/form/Produksi', [ProduksiController::class, 'store'])
            ->name('produksi.store')
            ->middleware('can:role,"admin"');
        Route::post('/form/Roll', [RollController::class, 'store'])
            ->name('roll.store')
            ->middleware('can:role,"admin"');

        Route::post('/form/Stok_Kertas', [StokKertasController::class, 'store'])
            ->name('stok_kertas.store')
            ->middleware('can:role,"admin"');
        Route::post('/form/Kertas', [KertasController::class, 'store'])
            ->name('kertas.store')
            ->middleware('can:role,"admin"');
        Route::post('/form/Berat', [BeratController::class, 'store'])
            ->name('berat.store')
            ->middleware('can:role,"admin"');

        Route::post('/form/Stok_Tinta', [StokTintaController::class, 'store'])
            ->name('stok_tinta.store')
            ->middleware('can:role,"admin"');
        Route::post('/form/Warna', [WarnaController::class, 'store'])
            ->name('warna.store')
            ->middleware('can:role,"admin"');
        Route::post('/form/Volume', [VolumeController::class, 'store'])
            ->name('volume.store')
            ->middleware('can:role,"admin"');
    });
});
Route::get('/', function () {
    return redirect()->route('admin.login');
});
// Route::get('/', function () {
//     return 'Laravel OK';
// });




// Route::get('/', function () {
//     return view('/page/home');
// });

// Route::get('/login', function () {
//     return 'halaman login';
// });

// Route::get('/dashboard', function () {
//     return view('/page/dashboard', [
//         "user1" => "Admin",
//         "user2" => "Karyawan",
//         "title" => "Dashboard"
//     ]);
// });

// Route::get('/riwayatMasuk', function () {
//     return 'Halaman riwayat barang masuk';
// });

// Route::get('/riwayatKeluar', function () {
//     return 'Halaman riwayat barang keluar';
// });

// // FORM
// Route::get('/form/{slug}', [FormController::class, 'index']);
// Route::get('/get-rolls/{idStokKain}', [RollController::class, 'getRolls']);
// Route::get('/get-panjang', [StokKertasController::class, 'getPanjang']);

// // TABLE
// Route::get('/table/{link}', [TableController::class, 'show']);

// // POST
// Route::post('/form/Stok_Kain', [StokKainController::class, 'store'])->name('stok_kain.store');
// Route::post('/form/Stok_Kertas', [StokKertasController::class, 'store'])->name('stok_kertas.store');
// Route::post('/form/Stok_Tinta', [StokTintaController::class, 'store'])->name('stok_tinta.store');
// Route::post('/form/Tinta', [TintaController::class, 'store'])->name('tinta.store');
// Route::post('/form/Transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');

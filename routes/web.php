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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/administrator/dashboard', function () {
//     return view('backend.dashboard');
// })->middleware(['auth'])->name('dashboard');

// backend
Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'administrator'], function () {
        Route::get('dashboard', function(){
            return view('backend.dashboard', ['pageTitle' => 'Dashboard', 'pageIcon' => 'tachometer-alt', 'title' => 'Dashboard']);
        })->name('dashboard');
        Route::resource('user', 'Backend\UserController');
        Route::resource('profil', 'Backend\ProfilController');
        Route::resource('kebijakan-privasi', 'Backend\KebijakanPrivasiController');
        Route::resource('sk', 'Backend\SyaratDanKetentuanController');
        Route::resource('bunga', 'Backend\BungaController');
        Route::resource('tenor', 'Backend\TenorController');
        Route::resource('kota', 'Backend\KotaController');
        Route::resource('about', 'Backend\AboutController');
        Route::resource('jenis-produk-layanan', 'Backend\JenisProdukLayananController');
        Route::resource('berita-info', 'Backend\JenisProdukLayananController');
        Route::get('pengaduan-nasabah', 'Backend\PengaduanNasabahController@index')->name('pengaduan-nasabah');
        Route::get('pengaduan-nasabah/{id}', 'Backend\PengaduanNasabahController@show')->name('detail-pengaduan-nasabah');
        Route::resource('peta-cabang', 'Backend\PetaCabangController');
        Route::resource('karier', 'Backend\KarierController');
        Route::resource('pengumuman-lelang-jaminan', 'Backend\PengumumanLelangJaminanController');
        Route::resource('item-produk-layanan', 'Backend\ItemProdukLayananController');
        Route::resource('about', 'Backend\AboutController')->except([
            'show',
            'store',
            'create',
            'edit',
            'destroy'
        ]);
        Route::resource('umkm-binaan', 'Backend\UmkmBinaanController');

    });

});

require __DIR__.'/auth.php';

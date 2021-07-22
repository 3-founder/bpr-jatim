<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
/** Home */
Route::get('get-bunga', 'API\HomeController@getBunga');
Route::get('get-tenor', 'API\HomeController@getTenor');
Route::get('get-berita-home', 'API\HomeController@getBerita');
Route::get('get-profil-home', 'API\HomeController@getProfil');
/** END Home */

/** Tentang */
Route::get('get-about/{tipe}', 'API\AboutController@getAboutByTipe');
/** END Tentang */

/** Produk & Layanan */
Route::get('get-nav-menu-produk-layanan', 'API\ProdukLayananController@getMenuProdukLayanan');
Route::get('get-nav-item-produk-layanan/{id_jenis}', 'API\ProdukLayananController@getItemProdukLayananByJenis');
Route::get('get-konten-produk-layanan/{slug}', 'API\ProdukLayananController@getKontenProdukLayananBySlug');
/** END Produk & Layanan */

/** Produk & Layanan */
Route::get('get-cabang', 'API\UmkmBinaanController@getCabang');
Route::get('get-umkm-binaan/{id_kota}', 'API\UmkmBinaanController@getUmkmBinaanByKota');
Route::get('get-detail-umkm-binaan/{slug}', 'API\UmkmBinaanController@getUmkmBinaanBySlug');
/** END Produk & Layanan */

/** Berita */
Route::get('get-berita', 'API\BeritaController@getBerita');
Route::get('get-detail-berita/{slug}', 'API\BeritaController@detailBerita');
/** END Berita */

/** Promo */
Route::get('get-promo', 'API\PromoController@getPromo');
Route::get('get-detail-promo/{slug}', 'API\PromoController@detailPromo');
/** END Promo */

/** Epaper */
Route::get('get-epaper', 'API\EpaperController@getEpaper');
Route::get('get-detail-epaper/{slug}', 'API\EpaperController@detailEpaper');
/** END Epaper */

/** Penghargaan */
Route::get('get-penghargaan', 'API\PenghargaanController@getPenghargaan');
Route::get('get-detail-penghargaan/{slug}', 'API\PenghargaanController@detailPenghargaan');
/** END Penghargaan */

/** Karier*/
Route::get('get-karier', 'API\KarierController@getKarier');
/** END Karier*/

/** Jaringan Kantor Kas*/
Route::get('get-jaringan-kantor', 'API\JaringanKantorController@getJaringanKantor');
/** END Jaringan Kantor Kas*/

/** Pengumuman Lelang Jaminan */
Route::get('get-pengumuman-lelang-jaminan', 'API\PengumumanLelangJaminanController@getPengumumanLelangJaminan');
/** END Pengumuman Lelang Jaminan */
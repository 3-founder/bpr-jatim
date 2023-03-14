<?php

use App\Http\Controllers\API\FAQController;
use App\Http\Controllers\API\PengajuanKreditController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\TanggungJawabPerusahaanController as tjController;

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
Route::get('get-bunga-home', 'API\HomeController@getBunga');
Route::get('get-tenor-home', 'API\HomeController@getTenor');
Route::get('get-kurs-home', 'API\HomeController@getKurs');
Route::get('get-grafik-kurs-home/{nama}', 'API\HomeController@getGrafikKurs');
Route::get('get-berita-home', 'API\HomeController@getBerita');
Route::get('get-profil-home', 'API\HomeController@getProfil');
Route::get('get-video-home', 'API\HomeController@getVideo');
Route::get('get-promo-home', 'API\HomeController@getPromo');
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
Route::get('get-umkm-binaan', 'API\UmkmBinaanController@getUmkmBinaan');
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
Route::get('get-promo/popup', 'API\PromoController@popupPromo');
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

/** Tips Keamanan & Info*/
Route::get('get-tips-info', 'API\TipsInfoController@getTipsInfo');
/** END Keamanan & Info*/

/** Peta Cabang*/
Route::get('get-peta-cabang', 'API\PetaCabangController@getPetaCabang');
/** END Peta Cabang*/

/** Jaringan Kantor Kas*/
Route::get('get-jaringan-kantor', 'API\JaringanKantorController@getJaringanKantor');
/** END Jaringan Kantor Kas*/

/** Pengaduan Nasabah*/
Route::post('add-pengaduan-nasabah', 'API\PengaduanNasabahController@store');
/** END Pengaduan Nasabah*/

/** Pengumuman Lelang Jaminan */
Route::get('get-pengumuman-lelang-jaminan', 'API\PengumumanLelangJaminanController@getPengumumanLelangJaminan');
/** END Pengumuman Lelang Jaminan */

/** Laporan Keuangan */
Route::get('get-laporan-keuangan', 'API\LaporanKeuanganController@getLaporan');
/** END Laporan Keuangan */

Route::get('jumbotron', 'API\JumbotronController@index');

/**
 * GET tanggung-jawab-perusahaan
 */

Route::get('get-tanggung-jawab-perusahaan/{tahun}', [tjController::class, 'getIndex']);
Route::get('get-tahun-tanggung-jawab-perusahaan', [tjController::class, 'getTahun']);
Route::get('get-default-tanggung-jawab-perusahaan/{tahun}', [tjController::class, 'getDefaultContent']);
Route::get('get-selected-tanggung-jawab-perusahaan/{tahun}/{id}', [tjController::class, 'getDefaultContent']);

// Get FAQ
Route::get('get-kategori-faq', [FAQController::class, 'getKategoriIndex']);
Route::get('get-items-faq/{kategori}', [FAQController::class, 'getItemsByKategori']);

// Post Pengajuan Kredit
Route::post('post-pengajuan-kredit', [PengajuanKreditController::class, 'postPengajuanKredit']);
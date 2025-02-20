<?php

use App\Http\Controllers\Backend\DashboardController;
use Backend\JumbotronController;
use Illuminate\Support\Facades\Route;
use Backend\TanggungJawabPerusahaanController as TgControlller;

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
    return view('auth.login');
});

// backend
Route::group(['middleware' => ['auth']], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('ganti-password/{id}', 'Backend\UserController@gantiPassword');
    Route::put('save-password/{id}', 'Backend\UserController@savePassword')->name('save-password');
    Route::group(['prefix' => 'master'], function () {
        Route::resource('user', 'Backend\UserController');
        Route::resource('role', 'Backend\RoleController');
        Route::resource('profil', 'Backend\ProfilController');
        Route::resource('intro-vidio', 'Backend\IntroVidioController');
        Route::resource('kebijakan-privasi', 'Backend\KebijakanPrivasiController');
        Route::resource('sk', 'Backend\SyaratDanKetentuanController');
        Route::resource('bunga', 'Backend\BungaController');
        Route::resource('tenor', 'Backend\TenorController');
        Route::resource('kota', 'Backend\KotaController');
        Route::resource('kurs', 'Backend\KursController');
        Route::resource('laporan-keuangan', 'Backend\LaporanKeuanganController');
        Route::resource('tata-kelola-perusahaan', 'Backend\TataKelolaPerusahaanController');
        Route::resource('tanggung-jawab-perusahaan', TgControlller::class);
        Route::resource('jumbotrons', JumbotronController::class);
    });
    Route::prefix('tentang-bpr')->group(function() {
        Route::resource('about', 'Backend\AboutController');
        Route::resource('komposisi-saham', 'Backend\KomposisiSahamController');
    });
    Route::resource('kategori-faq', 'Backend\KategoriFaqController');
    Route::post('items-faq/upload', 'Backend\ItemsFaqController@upload')->name('items-faq.upload');
    Route::resource('items-faq', 'Backend\ItemsFaqController');
    Route::resource('pengajuan-kredit', 'Backend\PengajuanKreditController');
    Route::prefix('produk-layanan')->group(function() {
        Route::resource('jenis-produk-layanan', 'Backend\JenisProdukLayananController');
        Route::resource('item-produk-layanan', 'Backend\ItemProdukLayananController');
    });
    Route::resource('umkm-binaan', 'Backend\UmkmBinaanController');
    Route::prefix('berita-info')->group(function () {
        Route::resource('jaringan-kantor', 'Backend\JaringanKantorController');
        Route::resource('kategori-berita', 'Backend\KategoriBeritaController');
        Route::resource('berita', 'Backend\BeritaController');
        Route::resource('promo', 'Backend\PromoController');
        Route::resource('penghargaan', 'Backend\PenghargaanController');
        Route::resource('epaper', 'Backend\EpaperController');
        Route::get('pengaduan-nasabah', 'Backend\PengaduanNasabahController@index')->name('pengaduan-nasabah');
        Route::get('pengaduan-nasabah/{id}', 'Backend\PengaduanNasabahController@show')->name('detail-pengaduan-nasabah');
        Route::resource('peta-cabang', 'Backend\PetaCabangController');
        Route::resource('karier', 'Backend\KarierController');
        Route::resource('pengumuman-lelang-jaminan', 'Backend\PengumumanLelangJaminanController');
        Route::resource('tips-info-terkini', 'Backend\TipsInfoTerkiniController');
        Route::resource('about', 'Backend\AboutController')->except([
            'show',
            'store',
            'create',
            'edit',
            'destroy'
        ]);
    });
});

require __DIR__ . '/auth.php';

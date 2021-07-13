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
            return view('backend.dashboard', ['pageTitle' => 'Dashboard', 'title' => 'Dashboard']);
        })->name('dashboard');
        Route::resource('user', 'Backend\UserController');
        Route::resource('slider', 'Backend\SliderController');
        Route::resource('partner', 'Backend\PartnerController');
        Route::resource('galeri', 'Backend\GaleriController');
        Route::resource('informasi', 'Backend\InformasiController');
        Route::resource('contact', 'Backend\ContactController');
        Route::resource('blog', 'Backend\BlogController');
        Route::resource('package', 'Backend\PackageController');
        Route::resource('package-item', 'Backend\PackageItemController');
        Route::resource('about', 'Backend\AboutController');
        Route::get('timeline', 'Backend\TimelineController@index');
        Route::put('timeline/{timeline}', 'Backend\TimelineController@updateTimelineTitle')->name('updateTimelineTitle');
        Route::resource('detail-timeline', 'Backend\TimelineController');
    });

});

require __DIR__.'/auth.php';

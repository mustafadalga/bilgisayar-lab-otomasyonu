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

//Auth::routes();
Auth::routes(['verify' => true]);

//Yönetici Paneli
Route::prefix('dashboard')->group(function () {
    Route::get('/', 'LaboratuvarlarController@home');
    Route::get('login', 'DashboardController@login');
    Route::get('dersler', 'DerslerController@home');
    Route::get('egitmenler', 'EgitmenlerController@home');
    Route::get('egitmen/{slug}','EgitmenlerController@show');
    Route::get('egitmen/duzenle/{slug}', 'EgitmenlerController@edit');
    Route::get('laboratuvarlar', 'LaboratuvarlarController@home');
    Route::get('laboratuvar/{slug}','LaboratuvarlarController@show');
    Route::get('yoneticiler', 'DashboardController@yoneticiler');
    Route::get('ayarlar', 'DashboardController@ayarlar');
    Route::post('post-login','DashboardController@postLogin');
});

// Yönetici Ayarlar
Route::prefix('yonetici')->group(function (){
    Route::post('ekle', 'DashboardController@yoneticiekle');
    Route::get('list', 'DashboardController@yoneticiList');
    Route::put('guncelle/{id}', 'DashboardController@ayarlarUpdate');
    Route::delete('sil/{id}', 'DashboardController@destroy');
});

//Laboratuvarlar
Route::prefix('lab')->group(function () {
    Route::get('list', 'LaboratuvarlarController@labs');
    Route::post('ekle', 'LaboratuvarlarController@store');
    Route::put('guncelle/{id}', 'LaboratuvarlarController@update');
    Route::delete('sil/{id}', 'LaboratuvarlarController@destroy');
});

//Oturumlar
Route::prefix('oturum')->group(function (){
    Route::post('ekle', 'OturumlarController@store');
    Route::get('list/{id}', 'OturumlarController@oturumlar');
    Route::put('guncelle/{id}', 'OturumlarController@update');
    Route::delete('sil/{id}', 'OturumlarController@destroy');
});

// Dersler
Route::prefix('ders')->group(function (){
    Route::post('ekle', 'DerslerController@store');
    Route::get('list', 'DerslerController@dersler');
    Route::put('guncelle/{id}', 'DerslerController@update');
    Route::delete('sil/{id}', 'DerslerController@destroy');
});

//Eğitmenler
Route::prefix('egitmen')->group(function (){
    Route::get('list', 'EgitmenlerController@egitmenler');
    Route::put('guncelle/{id}', 'EgitmenlerController@update');
    Route::delete('sil/{id}', 'EgitmenlerController@destroy');
});

// Eğitmen Paneli
Route::get('/home', 'HomeController@laboratuvarlar')->name('home');
Route::get('/', 'HomeController@laboratuvarlar')->name('home');
Route::get('/dersler', 'HomeController@dersler');
Route::get('/egitmenler', 'HomeController@egitmenler');
Route::get('/laboratuvarlar', 'HomeController@laboratuvarlar');
Route::get('/laboratuvar/{slug}', 'HomeController@laboratuvarShow');
Route::get('/egitmen/{slug}', 'HomeController@profilShow');
Route::get('/egitmen/duzenle/{slug}','HomeController@profilEdit');
Route::get('/ayarlar','HomeController@settings');
Route::get('/egitmen/detay/aktif-egitmen','HomeController@aktifProfil');
Route::put('/ayarlar/parola-degistir/{id}', 'HomeController@parolaDegistir');
Route::delete('/ayarlar/hesap-sil/{id}', 'HomeController@hesapSil');

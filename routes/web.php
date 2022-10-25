<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Panel\HomeController;
use App\Http\Controllers\Panel\KaryawanController;
use App\Http\Controllers\Panel\KaryawanVaksinController;
use App\Http\Controllers\Panel\KaryawanKeluargaVaksinController;

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
Route::view('/', 'pages.auth.login')->name('login.index');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth')->group(function ()
{
    Route::resource('home', HomeController::class);

    Route::resource('karyawan', KaryawanController::class);
    
    Route::get('karyawan/covid/{id}', [KaryawanController::class, 'covid'])->name('karyawan.covid.index');
    Route::post('karyawan/covid/{id}', [KaryawanController::class, 'covidStore'])->name('karyawan.covid.store');
    Route::get('karyawan/covid/{id}/edit', [KaryawanController::class, 'covidEdit'])->name('karyawan.covid.edit');
    Route::put('karyawan/covid/{id}', [KaryawanController::class, 'covidUpdate'])->name('karyawan.covid.update');
    Route::get('karyawan/covid/{id}/log', [KaryawanController::class, 'covidLogCreate'])->name('karyawan.covid.log.create');
    Route::post('karyawan/covid/{id}/log', [KaryawanController::class, 'covidLogStore'])->name('karyawan.covid.log.store');
    
    Route::resource('karyawan-vaksin', KaryawanVaksinController::class);
    Route::resource('karyawan-keluarga-vaksin', KaryawanKeluargaVaksinController::class);
});
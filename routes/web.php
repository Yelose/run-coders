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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route Hooks - Do not delete//
	Route::view('entrenadors', 'livewire.entrenadors.index')->middleware('auth');
	Route::view('enlaces', 'livewire.enlaces.index')->middleware('auth');
	Route::view('cronologias', 'livewire.cronologias.index')->middleware('auth');
	Route::view('historiabanners', 'livewire.historiabanners.index')->middleware('auth');
	Route::view('noticias', 'livewire.noticias.index')->middleware('auth');
	Route::view('patrocinadors', 'livewire.patrocinadors.index')->middleware('auth');
	Route::view('testimonios', 'livewire.testimonios.index')->middleware('auth');
	Route::view('banners', 'livewire.banners.index')->middleware('auth');
	Route::view('atletas', 'livewire.atletas.index')->middleware('auth');
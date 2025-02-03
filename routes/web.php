<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home;

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

//view

Route::get('home/dashboard', [Home::class, 'dashboard'])->name('dashboard');

Route::get('home/login',  [Home::class, 'login'])->name('login');

Route::get('home/setting', [Home::class, 'setting'])->name('setting');

Route::get('home/logout', [Home::class, 'logout'])->name('logout');

Route::get('home/activity', [Home::class, 'activity'])->name('activity');

Route::get('home/hapus_activity/{id}', [Home::class, 'hapus_activity'])->name('hapus_activity');

Route::get('home/profile', [Home::class, 'profile'])->name('profile');

Route::post('home/aksi_login', [Home::class, 'aksi_login'])->name('aksi_login');

Route::post('home/aksi_e_setting', [Home::class, 'aksi_e_setting'])->name('aksi_e_setting');

Route::post('home/editfoto', [Home::class, 'editfoto'])->name('editfoto');

Route::get('home/user',  [Home::class, 'user'])->name('user');


//aksi

Route::post('home/aksi_login', [Home::class, 'aksi_login'])->name('aksi_login');

Route::post('home/aksi_e_setting', [Home::class, 'aksi_e_setting'])->name('aksi_e_setting');

Route::post('home/editfoto', [Home::class, 'editfoto'])->name('editfoto');

Route::post('home/aksi_e_profile', [Home::class, 'aksi_e_profile'])->name('aksi_e_profile');

Route::post('home/aksi_changepass', [Home::class, 'aksi_changepass'])->name('aksi_changepass');
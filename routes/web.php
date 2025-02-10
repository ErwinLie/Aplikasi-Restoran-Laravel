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

Route::get('home/hapus_user/{id}', [Home::class, 'hapus_user'])->name('hapus_user');

Route::get('home/member',  [Home::class, 'member'])->name('member');

Route::get('home/hapus_member/{id}', [Home::class, 'hapus_member'])->name('hapus_member');

Route::get('home/voucher',  [Home::class, 'voucher'])->name('voucher');

Route::get('home/hapus_voucher/{id}', [Home::class, 'hapus_voucher'])->name('hapus_voucher');

Route::get('home/menu_kfc',  [Home::class, 'menu_kfc'])->name('menu_kfc');

Route::get('home/hapus_menu_kfc/{id}', [Home::class, 'hapus_menu_kfc'])->name('hapus_menu_kfc');

Route::get('home/kasir',  [Home::class, 'kasir'])->name('kasir');

Route::get('home/transaksi',  [Home::class, 'transaksi'])->name('transaksi');

Route::get('/filter_transaksi', [Home::class, 'filterTransaksi'])->name('filter_transaksi');

Route::get('/get_detail_transaksi', [Home::class, 'get_detail_transaksi'])->name('get_detail_transaksi');

Route::get('home/laporan',  [Home::class, 'laporan'])->name('laporan');

//aksi

Route::post('home/aksi_login', [Home::class, 'aksi_login'])->name('aksi_login');

Route::post('home/aksi_e_setting', [Home::class, 'aksi_e_setting'])->name('aksi_e_setting');

Route::post('home/editfoto', [Home::class, 'editfoto'])->name('editfoto');

Route::post('home/aksi_e_profile', [Home::class, 'aksi_e_profile'])->name('aksi_e_profile');

Route::post('home/aksi_changepass', [Home::class, 'aksi_changepass'])->name('aksi_changepass');

Route::post('home/aksi_t_user', [Home::class, 'aksi_t_user'])->name('aksi_t_user');

Route::post('home/aksi_e_user', [Home::class, 'aksi_e_user'])->name('aksi_e_user');

Route::post('home/aksi_t_member', [Home::class, 'aksi_t_member'])->name('aksi_t_member');

Route::post('home/aksi_e_member', [Home::class, 'aksi_e_member'])->name('aksi_e_member');

Route::post('home/aksi_t_voucher', [Home::class, 'aksi_t_voucher'])->name('aksi_t_voucher');

Route::post('home/aksi_e_voucher', [Home::class, 'aksi_e_voucher'])->name('aksi_e_voucher');

Route::post('home/aksi_t_menu', [Home::class, 'aksi_t_menu'])->name('aksi_t_menu');

Route::post('home/aksi_e_menu', [Home::class, 'aksi_e_menu'])->name('aksi_e_menu');

Route::post('/cekMembership', [Home::class, 'cekMembership']);

Route::post('/cekVoucher', [Home::class, 'cekVoucher']);

Route::post('/simpanTransaksi', [Home::class, 'simpanTransaksi']);

Route::post('/aksi_t_transaksi', [Home::class, 'aksi_t_transaksi']);
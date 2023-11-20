<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

// Login & Register
Route::get('login', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [\App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login_store');
// Route::get('register', [\App\Http\Controllers\Auth\LoginController::class, 'showRegisterForm'])->name('register');
// Route::post('register', [\App\Http\Controllers\Auth\LoginController::class, 'register'])->name('register_store');


Route::middleware(['auth'])->group(function(){
    // Home Page or Dashboard
    Route::get('home', function(){
        return view('admin.home',[
            'userCount' => \App\Models\User::count(),
            'smCount' => \App\Models\SuratMasuk::whereMonth('created_at', '=', date('m'))->count(),
            'skAcc' => \App\Models\SuratKeluar::whereNull('sk_no_surat')->whereMonth('created_at', '=', date('m'))->count(),
            'skWait' => \App\Models\SuratKeluar::whereNotNull('sk_no_surat')->whereMonth('created_at', '=', date('m'))->count(),
        ]);
    })->name('home');

    // Archive
    Route::get('archive', [\App\Http\Controllers\Admin\ArchiveController::class, 'index'])->name('archives');

    // Bidang
    Route::resource('bidang', \App\Http\Controllers\Admin\BidangController::class)->except(['show']);

    // Sub Bidang
    Route::resource('sub_bidang', \App\Http\Controllers\Admin\SubBidangController::class)->except(['show']);

    // Company
    Route::resource('perusahaan', \App\Http\Controllers\Admin\CompanyController::class)->except(['show']);

    // Jenis Surat
    Route::resource('jenis_surat', \App\Http\Controllers\Admin\JenisSuratController::class)->except(['show']);
    Route::resource('surat_masuk', \App\Http\Controllers\Admin\SuratMasukController::class);
    Route::resource('surat_keluar', \App\Http\Controllers\Admin\SuratKeluarController::class);

    // Role
    Route::resource('role', \App\Http\Controllers\Admin\GroupController::class)->except(['show']);

    // User
    Route::resource('user', \App\Http\Controllers\Admin\UserController::class)->except(['show']);

    // Logout
    Route::post('logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
});


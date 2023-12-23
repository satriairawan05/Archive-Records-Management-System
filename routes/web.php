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

Route::middleware(['auth'])->group(function () {
    // Home Page or Dashboard
    Route::get('home', function () {
        return view('admin.home', [
            'name' => 'Home',
            'surat' => \App\Models\JenisSurat::all(),
            'count' => \App\Models\JenisSurat::count(),
            'smCount' => \App\Models\SuratMasuk::whereMonth('created_at', '=', date('m'))->count(),
            'skAcc' => \App\Models\SuratKeluar::whereMonth('created_at', '=', date('m'))->where('sk_remark','Accepted')->count(),
            'skWait' => \App\Models\SuratKeluar::whereMonth('created_at', '=', date('m'))->whereNull('sk_remark')->count(),
        ]);
    })->name('home');

    // Archive
    Route::get('archive', [\App\Http\Controllers\Admin\ArchiveController::class, 'index'])->name('archives');

    // Approval
    Route::resource('approval', \App\Http\Controllers\Admin\ApprovalController::class);

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
    Route::get('surat_keluar/{surat_keluar}/document', [\App\Http\Controllers\Admin\SuratKeluarController::class, 'print'])->name('surat_keluar.print');
    Route::put('surat_keluar/{surat_keluar}/approval', [\App\Http\Controllers\Admin\SuratKeluarController::class, 'updateApprovalStep'])->name('surat_keluar.approval');

    // Role
    Route::resource('role', \App\Http\Controllers\Admin\GroupController::class)->except(['show']);

    // User
    Route::resource('user', \App\Http\Controllers\Admin\UserController::class)->except(['show']);

    // Logout
    Route::post('logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
});

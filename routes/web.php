<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CalonKetuaController;
use App\Http\Controllers\PemilihanController;
use App\Http\Controllers\PemilihController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
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
    return redirect()->route('dashboard');
});

// Route login untuk semua user (baik user biasa atau admin)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route group that checks user type first
// Route::group(['middleware' => ['auth', 'check.user.type']], function () {

// Admin routes
Route::group(['middleware' => ['auth.admin']], function () {
    Route::get('admin/dashboard', function () {
        return view('admin.index');
    })->name('admin.dashboard');

    Route::resource('sessions', SessionController::class);

    Route::resource('users', UserController::class);

    Route::resource('calon_ketua', CalonKetuaController::class);
    Route::get('/pemilih', [PemilihController::class, 'index'])->name('pemilih.index');
    Route::get('/pemilih/create', [PemilihController::class, 'create'])->name('pemilih.create');
    Route::post('/pemilih', [PemilihController::class, 'store'])->name('pemilih.store');
    Route::post('/pemilih/import', [PemilihController::class, 'importCsv'])->name('pemilih.import');
    Route::get('/pemilih/{pemilih}/edit', [PemilihController::class, 'edit'])->name('pemilih.edit');
    Route::put('/pemilih/{pemilih}', [PemilihController::class, 'update'])->name('pemilih.update');
    Route::delete('/pemilih/{pemilih}', [PemilihController::class, 'destroy'])->name('pemilih.destroy');
});

// User routes
Route::group(['middleware' => ['auth']], function () {

    // Add other user-specific routes here...
    Route::get('/dashboard', function () {
        return view('index');
    })->name('dashboard');

    Route::get('/sesi/open', [SessionController::class, 'indexMulaiSession'])->name('sesi.indexMulai');


    Route::get('/pemilihan/login', [PemilihanController::class, 'showLoginForm'])->name('pemilihan.login');
    Route::post('/pemilihan/login', [PemilihanController::class, 'processLogin'])->name('pemilihan.login.submit');

    // Halaman vote setelah login berhasil
    Route::get('/pemilihan/vote', [PemilihanController::class, 'showVoteForm'])->name('pemilihan.vote');
    Route::post('/pemilihan/vote/submit', [PemilihanController::class, 'submitVote'])->name('pemilihan.vote.submit');

    // Halaman statis tujuan setelah login berhasil
    Route::get('/pemilihan/success', function () {
        return view('pemilihan.success');
    })->name('pemilihan.success');


    Route::get('/sesi', [UserController::class, 'showSesiForm'])->name('sesi.form');
    Route::post('/sesi/join', [UserController::class, 'joinSesi'])->name('sesi.join');
});
// });

<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DosenController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KerjaPraktekController;
use App\Http\Controllers\Admin\MahasiswaController;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\Landing\LandingController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// ===== Landings Route ===== //
Route::resource('/', LandingController::class)->only([
    'index'
]);

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::prefix('data-user')->middleware('can:admin-only')->group(function () {
        Route::get('/', [UserAdminController::class, 'index'])->name('data-user.index');
        Route::post('/store', [UserAdminController::class, 'store'])->name('data-user.store');
        Route::get('/edit/{id}', [UserAdminController::class, 'edit'])->name('data-user.edit');
        Route::put('/update/{id}', [UserAdminController::class, 'update'])->name('data-user.update');
        Route::delete('/destroy/{id}', [UserAdminController::class, 'destroy'])->name('data-user.destroy');
    });

    Route::prefix('data-dosen')->middleware('can:admin-only')->group(function () {
        Route::get('/', [DosenController::class, 'index'])->name('data-dosen.index');
        Route::post('/store', [DosenController::class, 'store'])->name('data-dosen.store');
        Route::get('/edit/{id}', [DosenController::class, 'edit'])->name('data-dosen.edit');
        Route::put('/update/{id}', [DosenController::class, 'update'])->name('data-dosen.update');
        Route::delete('/destroy/{id}', [DosenController::class, 'destroy'])->name('data-dosen.destroy');
    });

    Route::prefix('data-mahasiswa')->middleware('can:admin-only')->group(function () {
        Route::get('/', [MahasiswaController::class, 'index'])->name('data-mahasiswa.index');
        // Route::post('/store', [MahasiswaController::class, 'store'])->name('data-mahasiswa.store');
        Route::get('/show/{id}', [MahasiswaController::class, 'show'])->name('data-mahasiswa.show');
        Route::get('/edit/{id}', [MahasiswaController::class, 'edit'])->name('data-mahasiswa.edit');
        Route::put('/update/{id}', [MahasiswaController::class, 'update'])->name('data-mahasiswa.update');
        Route::delete('/destroy/{id}', [MahasiswaController::class, 'destroy'])->name('data-mahasiswa.destroy');
        Route::get('/get-dosen', [MahasiswaController::class, 'getDosen'])->name('get-dosen');
    });

    Route::prefix('data-kp')->middleware('can:all-access')->group(function () {
        Route::get('/', [KerjaPraktekController::class, 'index'])->name('data-kp.index');
        Route::get('/show/{id}', [KerjaPraktekController::class, 'show'])->name('data-kp.show');
        Route::post('/store', [KerjaPraktekController::class, 'store'])->name('data-kp.store');
        Route::get('/create', [KerjaPraktekController::class, 'create'])->name('data-kp.create');
        Route::get('/edit/{id}', [KerjaPraktekController::class, 'edit'])->name('data-kp.edit');
        Route::put('/update/{id}', [KerjaPraktekController::class, 'update'])->name('data-kp.update');
        Route::delete('/destroy/{id}', [KerjaPraktekController::class, 'destroy'])->name('data-kp.destroy');
    });
});

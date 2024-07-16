<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DosenController;
use App\Http\Controllers\Admin\DashboardController;
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
});

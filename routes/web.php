<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\vendor\VendorController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth','role:admin'])->group(function() {
    Route::get('/admin/dashboard',[AdminController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('admin/logout', [AdminController::class, 'adminLogout'])->name('admin.logout');
    Route::get('admin/profile', [AdminController::class, 'adminProfile'])->name('admin.profile');
    Route::post('admin/profile/store', [AdminController::class, 'adminProfileStore'])->name('admin.profile.store');
});

Route::middleware(['auth', 'role:vendor'])->group(function() {
    Route::get('/vendor/dashboard',[VendorController::class, 'vendorDashboard'])->name('vendor.dashboard');
});

Route::get('admin/login', [AdminController::class, 'adminLogin']);


require __DIR__.'/auth.php';

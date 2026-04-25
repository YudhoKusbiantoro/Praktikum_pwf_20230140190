<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NamaController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController; 

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/about', [NamaController::class, 'about'])
    ->middleware(['auth'])
    ->name('about');

Route::middleware('auth')->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Product Page
    Route::get('/product/export', [ProductController::class, 'export'])->name('product.export')->middleware('can:export-product');
    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::post('/product', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
    Route::put('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::get('/product/edit/{product}', [ProductController::class, 'edit'])->name('product.edit');
    Route::delete('/product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');

    // Category Page
    // UCP 1 Penjelasan Detail:
    // 1. Route::middleware(...) : Mengaplikasikan sebuah fungsi penengah (penjaga gerbang) sebelum rute diakses.
    // 2. 'can:manage-category'  : Menjalankan aturan keamanan bernama 'manage-category' (yang di-setting di AppServiceProvider). Jika user yang sedang buka website tidak lulus aturan ini, ia akan ditolak masuk (Akses 403 Forbidden).
    // 3. ->group(function() {}) : Membungkus rute-rute di dalamnya agar semuanya secara kolektif terlindungi oleh aturan middleware tersebut.
    Route::middleware('can:manage-category')->group(function () {
        // UCP 1 Penjelasan Detail:
        // 1. Route::resource(...) : Baris kode sakti yang otomatis menciptakan 7 buah rute standar untuk operasi CRUD data (index, create, store, show, edit, update, destroy) untuk awalan '/category'.
        // 2. CategoryController::class: Mengarahkan ketujuh rute yang otomatis terbuat tadi ke logika fungsi yang ada di dalam controller CategoryController.
        Route::resource('category', CategoryController::class);
    });

});

require __DIR__ . '/auth.php';
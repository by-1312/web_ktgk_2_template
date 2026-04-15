<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductManagerController;
// Trang chủ
Route::get('/', [HomeController::class, 'index'])->name('home');

// Lọc theo thể loại (Khớp với href trong layout của bạn)
Route::get('caycanh/theloai/{category_id}', [HomeController::class, 'index']);

// Tìm kiếm (Layout của bạn dùng method post cho form tìm kiếm)
Route::post('/timkiem', [HomeController::class, 'index']);
Route::get('caycanh/chi_tiet/{id}', [HomeController::class, 'chiTiet'])->name('product.detail');
// 4. Dashboard mặc định
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
Route::prefix('admin/products')->group(function () {
    Route::get('/', [ProductManagerController::class, 'index'])->name('product.index');
    Route::get('/create', [ProductManagerController::class, 'create'])->name('product.create');
    Route::post('/store', [ProductManagerController::class, 'store'])->name('product.store');
    Route::get('/{id}', [ProductManagerController::class, 'show'])->name('product.show');
    Route::delete('/{id}', [ProductManagerController::class, 'destroy'])->name('product.destroy');
});
<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Trang chủ
Route::get('/', [HomeController::class, 'index'])->name('home');

// Lọc theo thể loại (Khớp với href trong layout của bạn)
Route::get('caycanh/theloai/{category_id}', [HomeController::class, 'index']);

// Tìm kiếm (Layout của bạn dùng method post cho form tìm kiếm)
Route::post('/timkiem', [HomeController::class, 'index']);
// 4. Dashboard mặc định
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
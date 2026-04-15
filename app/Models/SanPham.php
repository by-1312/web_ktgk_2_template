<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    // Chỉ định đúng tên bảng trong database [cite: 3, 21]
    protected $table = 'san_pham';
    
    // Vì bảng san_pham không có c  ột created_at và updated_at
    public $timestamps = false;

    // Thiết lập mối quan hệ với Danh mục nếu cần lọc [cite: 6]
    public function danhmucs()
    {
        return $this->belongsToMany(DanhMuc::class, 'sanpham_danhmuc', 'id_san_pham', 'id_danh_muc');
    }
}
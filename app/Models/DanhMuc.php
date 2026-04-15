<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DanhMuc extends Model
{
    // Chỉ định tên bảng chính xác trong file SQL của bạn 
    protected $table = 'danh_muc';

    // Bảng này không có các cột timestamps (created_at, updated_at) 
    public $timestamps = false;
}
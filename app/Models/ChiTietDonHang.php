<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChiTietDonHang extends Model
{
    protected $table = 'chi_tiet_don_hang';
public $timestamps = false;
protected $fillable = ['ma_don_hang', 'id_san_pham', 'so_luong', 'don_gia'];
}
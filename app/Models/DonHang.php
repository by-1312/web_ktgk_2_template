<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonHang extends Model
{
    protected $table = 'don_hang';
    protected $primaryKey = 'ma_don_hang'; // Rất quan trọng!
    public $timestamps = false;
    protected $fillable = ['ngay_dat_hang', 'tinh_trang', 'hinh_thuc_thanh_toan', 'user_id'];
}
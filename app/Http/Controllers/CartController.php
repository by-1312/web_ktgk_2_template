<?php

namespace App\Http\Controllers;

use App\Models\SanPham;
use App\Models\DanhMuc;
use App\Models\DonHang;
use App\Models\ChiTietDonHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\OrderSuccessNotification;
use Illuminate\Support\Facades\Notification;

class CartController extends Controller
{

    public function index()
    {
        $cart = session()->get('cart', []);
        $categories = DanhMuc::all();
        $title = "Giỏ hàng của bạn";
        return view('caycanh.gio_hang', compact('cart', 'categories', 'title'));
    }

    public function add(Request $request, $id)
    {
        $sanPham = SanPham::findOrFail($id);
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['so_luong'] += $request->so_luong;
        } else {
            $cart[$id] = [
                "ten_san_pham" => $sanPham->ten_san_pham,
                "so_luong" => $request->so_luong,
                "gia_ban" => $sanPham->gia_ban,
                "hinh_anh" => $sanPham->hinh_anh
            ];
        }

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'cart_count' => count(session('cart'))
        ]);
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);
        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->back();
    }

    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);
        
        // Nếu giỏ hàng trống thì quay lại
        if(!$cart) {
            return redirect()->back()->with('error', 'Giỏ hàng của bạn đang trống!');
        }

        // 1. Tạo đơn hàng mới
        $donHang = new DonHang();
        $donHang->ngay_dat_hang = now();
        $donHang->tinh_trang = 1; // Trạng thái: Mới đặt
        
        // Ép kiểu int để tránh lỗi SQL Incorrect integer value
        $donHang->hinh_thuc_thanh_toan = (int)$request->hinh_thuc_thanh_toan;
        $donHang->user_id = Auth::id(); 
        $donHang->save();

        // 2. Lưu chi tiết từng sản phẩm trong đơn hàng
        foreach($cart as $id => $details) {
            ChiTietDonHang::create([
                'ma_don_hang' => $donHang->ma_don_hang,
                'id_san_pham' => $id,
                'so_luong'    => $details['so_luong'],
                'don_gia'     => $details['gia_ban']
            ]);
        }
        $user = Auth::user();
        if ($user) {
            Notification::send($user, new OrderSuccessNotification($donHang));
        }

        session()->forget('cart');

        return redirect()->route('home')->with('success', 'Chúc mừng! Đơn hàng của bạn đã được đặt thành công. Vui lòng kiểm tra email để xem chi tiết.');
    }
}
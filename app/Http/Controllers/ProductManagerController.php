<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductManagerController extends Controller
{
    // Hiển thị danh sách sản phẩm có status = 1
    public function index()
    {
        $products = DB::table('san_pham')->where('status', 1)->get();
        
        return view('layouts.product_manager', [
            'products' => $products,
            'title'    => 'Quản lý sản phẩm cây cảnh'
        ]);
    }

    // Xem chi tiết sản phẩm
    // Xem chi tiết sản phẩm
// app\Http\Controllers\ProductManagerController.php

public function show($id)
{
    // 1. Lấy dữ liệu và đặt tên biến là $sanPham cho khớp với View
    $sanPham = DB::table('san_pham')->where('id', $id)->first();
    
    if (!$sanPham) abort(404);

    $categories = DB::table('danh_muc')->get(); 

    // 2. Truyền biến $sanPham sang View
    return view('caycanh.chi_tiet', [
        'sanPham'    => $sanPham, // Đổi tên ở đây
        'categories' => $categories,
        'title'      => 'Chi tiết cây ' . $sanPham->ten_san_pham
    ]);
}

    // Xóa mềm: Cập nhật status về 0
    public function destroy($id)
{
    // Tìm và cập nhật status về 0 trong bảng san_pham
    $check = DB::table('san_pham')
              ->where('id', $id)
              ->update(['status' => 0]);

    // Nếu cập nhật thành công, quay lại trang trước với thông báo
    if ($check) {
        return redirect()->back()->with('msg', 'Đã xóa thành công!');
    }
    
    // Nếu không cập nhật được (sai ID hoặc sai tên cột), báo lỗi
    return redirect()->back()->with('error', 'Lỗi: Không thể cập nhật database!');
}
    public function create()
{
    return view('layouts.product_create'); 
}

// Xử lý lưu dữ liệu
public function store(Request $request)
{
    // Validate dữ liệu
    $request->validate([
        'ten_san_pham' => 'required',
        'gia_ban' => 'required|numeric',
        'hinh_anh' => 'image|mimes:jpeg,png,jpg|max:2048'
    ]);

    $data = [
        'code' => 'SP' . time(),
        'ten_san_pham' => $request->ten_san_pham,
        'ten_khoa_hoc' => $request->ten_khoa_hoc,
        'ten_thong_thuong' => $request->ten_thong_thuong,
        'mo_ta' => $request->mo_ta,
        'do_kho' => $request->do_kho,
        'yeu_cau_anh_sang' => $request->yeu_cau_anh_sang,
        'nhu_cau_nuoc' => $request->nhu_cau_nuoc,
        'gia_ban' => $request->gia_ban,
        'status' => 1, // Mặc định là 1 khi thêm mới
    ];

    // Xử lý upload ảnh nếu có
    if ($request->hasFile('hinh_anh')) {
        $file = $request->file('hinh_anh');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('storage/image'), $fileName);
        $data['hinh_anh'] = $fileName;
    }

    DB::table('san_pham')->insert($data);

    return redirect()->route('product.index')->with('msg', 'Thêm sản phẩm thành công!');
}
}
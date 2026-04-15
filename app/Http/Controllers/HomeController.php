<?php
namespace App\Http\Controllers;

use App\Models\SanPham;
use App\Models\DanhMuc;
use Illuminate\Http\Request;

class HomeController extends Controller {
    public function index(Request $request, $category_id = null) {
        $query = SanPham::query();

        // 1. Lọc theo danh mục (Menu)
        if ($category_id) {
            $query->whereHas('danhmucs', function($q) use ($category_id) {
                $q->where('id', $category_id);
            });
        }

        // 2. Tìm kiếm (Keyword)
        if ($request->filled('keyword')) {
            $query->where('ten_san_pham', 'like', '%' . $request->keyword . '%');
        }

        // 3. Lọc đặc biệt
        if ($request->filter == 'de-cham-soc') $query->where('do_kho', 'Dễ chăm sóc');
        if ($request->filter == 'bong-ram') $query->where('yeu_cau_anh_sang', 'like', '%bóng râm%');

        // 4. Sắp xếp giá
        if ($request->sort == 'asc') $query->orderBy('gia_ban', 'asc');
        if ($request->sort == 'desc') $query->orderBy('gia_ban', 'desc');

        // Hiển thị mặc định 20 sản phẩm
        $sanPhams = $query->take(20)->get();
        $categories = DanhMuc::all();

        return view('caycanh.index', [
            'sanPhams' => $sanPhams,
            'categories' => $categories,
            'title' => 'Trang chủ Cây Cảnh' // Truyền biến title để layout không bị lỗi
        ]);
    }
        public function chiTiet($id)
    {
        // Tìm sản phẩm theo ID, nếu không thấy sẽ báo lỗi 404
        $sanPham = SanPham::findOrFail($id);
        
        // Lấy danh sách danh mục để hiển thị trên menu của layout
        $categories = DanhMuc::all();

        return view('caycanh.chi-tiet', [
            'sanPham' => $sanPham,
            'categories' => $categories,
            'title' => 'Chi tiết: ' . $sanPham->ten_san_pham
        ]);
    }
}
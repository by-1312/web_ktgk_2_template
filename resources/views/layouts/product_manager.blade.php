<x-cay-canh-layout title="Quản lý sản phẩm">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">

    <style>
        .page-title { 
            text-align: center; font-size: 24px; font-weight: bold; 
            margin: 15px 0; color: #007bff; text-transform: uppercase; 
        }

        #product-table {
            font-size: 13px; /* Đặt tất cả chữ bằng nhau 13px */
            table-layout: fixed; 
            width: 100% !important;
            border-collapse: collapse;
        }

        #product-table thead th { 
            background-color: #f8f9fa !important; color: #333 !important; 
            padding: 8px 2px !important; text-align: center;
            vertical-align: middle; border: 1px solid #dee2e6 !important;
            font-size: 13px; /* Tiêu đề cũng bằng 13px */
        }

        #product-table tbody td { 
            padding: 5px 2px !important; vertical-align: middle; 
            text-align: center; word-wrap: break-word;
            font-size: 13px; /* Nội dung bằng 13px */
        }

        /* Nút Xem và Xóa trên cùng 1 hàng sát nhau */
        .btn-group-custom { 
            display: flex; 
            justify-content: center; 
            gap: 2px; 
            white-space: nowrap; 
        }
        
        .btn-view, .btn-delete { 
            padding: 4px 8px; 
            font-size: 12px; 
            border-radius: 3px; 
            color: white !important; 
            text-decoration: none;
            display: inline-block;
        }
        .btn-view { background-color: #007bff; }
        .btn-delete { background-color: #dc3545; border: none; }

        /* Ảnh to rõ nét */
        .product-img { 
            width: 65px; 
            height: 65px; 
            object-fit: cover; 
            border-radius: 4px; 
            border: 1px solid #ddd;
        }

        .col-gia { font-weight: bold }
        .table-responsive { overflow-x: hidden !important; }

        /* Chỉnh nút Thêm về bên trái */
        .header-action {
            display: flex;
            justify-content: flex-start; /* Sát lề trái */
            margin-bottom: 10px;
        }
    </style>

    <div class="container-fluid px-3">
        <h2 class="page-title">QUẢN LÝ SẢN PHẨM</h2>
        
        <div class="card shadow-sm border-0">
            <div class="card-body p-2 bg-white">
                <div class="header-action">
                    <a href="{{ url('/admin/products/create') }}" class="btn btn-success btn-sm px-3">
                        <i class="fa fa-plus"></i> Thêm mới
                    </a>
                </div>

                <table id="product-table" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th style="width: 14%;">Tên sản phẩm</th>
                            <th style="width: 11%;">Tên khoa học</th>
                            <th style="width: 11%;">Tên thường</th>
                            <th style="width: 7%;">Độ khó</th>
                            <th style="width: 11%;">Ánh sáng</th>
                            <th style="width: 8%;">Nước</th>
                            <th style="width: 11%;">Giá bán</th>
                            <th style="width: 12%;">Ảnh</th>
                            <th style="width: 15%;">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $item)
                        <tr>
                            <td class="text-left" style="font-weight: 500;">{{ $item->ten_san_pham }}</td>
                            <td class="italic">{{ $item->ten_khoa_hoc ?? '-' }}</td>
                            <td>{{ $item->ten_thong_thuong ?? '-' }}</td>
                            <td>{{ $item->do_kho }}</td>
                            <td>{{ $item->yeu_cau_anh_sang }}</td>
                            <td>{{ $item->nhu_cau_nuoc }}</td>
                            <td class="col-gia">{{ number_format($item->gia_ban, 0, ',', '.') }}</td>
                            <td>
                                <img src="{{ asset('storage/image/'.$item->hinh_anh) }}" class="product-img" onerror="this.src='{{ asset('image/default.png') }}'">
                            </td>
                            <td>
                                <div class="btn-group-custom">
                                    <a href="{{ url('/admin/products/'.$item->id) }}" class="btn-view">Xem</a>
                                    <form action="{{ url('/admin/products/'.$item->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">
    @csrf 
    @method('DELETE') <button type="submit" class="btn-delete">Xóa</button>
</form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            if ( ! $.fn.DataTable.isDataTable( '#product-table' ) ) {
                $('#product-table').DataTable({
                    "responsive": false, 
                    "autoWidth": false,
                    "pageLength": 10,
                    "language": {
                        "search": "Tìm kiếm:",
                        "lengthMenu": "Hiện _MENU_ dòng",
                        "info": "Đang hiện _START_ đến _END_ của _TOTAL_ sản phẩm",
                        "paginate": { "next": "›", "previous": "‹" }
                    }
                });
            }
        });
    </script>
</x-cay-canh-layout>
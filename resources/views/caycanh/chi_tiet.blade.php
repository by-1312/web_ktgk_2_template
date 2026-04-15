<x-cay-canh-layout :categories="$categories" :title="$title">
    <div class="row mt-4 mb-5">
        <div class="col-md-5">
            <img src="{{ asset('storage/image/' . $sanPham->hinh_anh) }}" 
                 class="img-fluid border rounded shadow-sm" 
                 alt="{{ $sanPham->ten_san_pham }}" 
                 style="width: 100%; aspect-ratio: 1/1; object-cover: cover;">
        </div>

        <div class="col-md-7">
            <h2 class="fw-bold mb-3">{{ $sanPham->ten_san_pham }}</h2>
            
            <div class="product-info" style="line-height: 1.8;">
                <p><strong>Tên khoa học:</strong> {{ $sanPham->ten_khoa_hoc }}</p>
                <p><strong>Tên thông thường:</strong> {{ $sanPham->ten_thong_thuong }}</p>
                <p><strong>Mô tả:</strong> {{ $sanPham->mo_ta }}</p>
                <p><strong>Quy cách sản phẩm:</strong> {{ $sanPham->quy_cach_san_pham }}</p>
                <p><strong>Độ khó:</strong> {{ $sanPham->do_kho }}</p>
                <p><strong>Yêu cầu ánh sáng:</strong> {{ $sanPham->yeu_cau_anh_sang }}</p>
                <p><strong>Nhu cầu nước:</strong> {{ $sanPham->nhu_cau_nuoc }}</p>
                <p><strong>Giá:</strong> <span class="text-danger fw-bold fs-5 italic"><i>{{ number_format($sanPham->gia_ban, 0, ',', '.') }} VNĐ</i></span></p>
            </div>

            <form id="add-to-cart-form" class="mt-4">
                @csrf
                <input type="hidden" id="product-id" value="{{ $sanPham->id }}">
                <div class="d-flex align-items-center gap-3">
                    <div class="d-flex align-items-center">
                        <span class="me-2">Số lượng mua:</span>
                        <input type="number" id="so-luong" name="so_luong" value="1" min="1" class="form-control" style="width: 80px;">
                    </div>
                    <button type="button" id="btn-add-cart" class="btn btn-primary px-4">Thêm vào giỏ hàng</button>
                </div>
            </form>

            <script>
            $(document).ready(function() {
                $('#btn-add-cart').click(function() {
                    let id = $('#product-id').val();
                    let so_luong = $('#so-luong').val();
                    let _token = $('input[name="_token"]').val();

                    $.ajax({
                        url: "{{ url('/add-to-cart') }}/" + id, // Đường dẫn tới route xử lý
                        method: "POST",
                        data: {
                            id: id,
                            so_luong: so_luong,
                            _token: _token
                        },
                        success: function(response) {
                            // 1. Cập nhật con số trên icon giỏ hàng (ID này nằm ở Layout)
                            $('#cart-number-product').text(response.cart_count);

                            // 2. Thông báo cho người dùng
                            alert("Đã thêm sản phẩm vào giỏ hàng thành công!");
                        },
                        error: function() {
                            alert("Có lỗi xảy ra, vui lòng thử lại!");
                        }
                    });
                });
            });
            </script>
        </div>
    </div>
</x-cay-canh-layout>
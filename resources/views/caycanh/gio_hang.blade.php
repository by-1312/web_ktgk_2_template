<x-cay-canh-layout :categories="$categories" :title="$title">
    <div class="container mt-5">

        <h3 class="text-center text-primary fw-bold mb-4">DANH SÁCH SẢN PHẨM</h3>
        
        <table class="table table-bordered shadow-sm">

            <thead class="bg-light text-center">
                <tr>
                    <th>STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody class="text-center align-middle">
                @php $total = 0; $stt = 1; @endphp
                @forelse($cart as $id => $details)
                    @php $total += $details['gia_ban'] * $details['so_luong'] @endphp
                    <tr>
                        <td>{{ $stt++ }}</td>
                        {{-- Căn lề trái cho tên sản phẩm --}}
                        <td class="text-start">{{ $details['ten_san_pham'] }}</td>
                        <td>{{ $details['so_luong'] }}</td>
                        <td>{{ number_format($details['gia_ban']) }}đ</td>
                        <td>
                            {{-- Đổi nút xóa thành btn-outline-dark và chữ nhỏ (btn-xs) --}}
                            <a href="{{ route('cart.remove', $id) }}" class="btn btn-sm btn-outline-dark btn-xs text-danger" style="padding: 2px 6px;">Xóa</a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center">Giỏ hàng trống</td></tr>
                @endforelse
                
                @if(count($cart) > 0)
                    <tr>
                        <td colspan="4" class="text-end fw-bold">Tổng cộng:</td>
                        <td class="fw-bold text-danger fs-5" style="border: 2px solid green; background-color: #fff3f3;">
                            {{ number_format($total) }}đ
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>

        @if(count($cart) > 0)
            {{-- Căn giữa form đặt hàng --}}
            <div class="text-center mt-5 mb-5">
                <form action="{{ route('cart.checkout') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        {{-- Nhãn in đậm --}}
                        <label class="fw-bold fs-5 mb-2 d-block">Hình thức thanh toán</label>
                        {{-- Select menu nằm trên dòng riêng --}}
                        <select name="hinh_thuc_thanh_toan" class="form-select d-inline-block w-auto">
                            <option value="1">Tiền mặt</option>
                            <option value="2">Chuyển khoản</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg px-5 fw-bold">ĐẶT HÀNG</button>
                </form>
            </div>
        @endif
    </div>
</x-cay-canh-layout>
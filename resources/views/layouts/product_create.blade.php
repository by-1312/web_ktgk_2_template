<x-cay-canh-layout>
    <x-slot name="title">Thêm sản phẩm mới</x-slot>

    <div class="container mt-4">
        <div class="row">
            <div class="col-12 text-center">
                <h5 style="color: #007bff; font-weight: bold; margin-bottom: 25px; text-transform: uppercase;">THÊM</h5>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger" style="border-radius: 5px;">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-group mb-3">
                        <label class="font-weight-bold">Tên sản phẩm</label>
                        <input type="text" name="ten_san_pham" class="form-control" value="{{ old('ten_san_pham') }}">
                    </div>

                    <div class="form-group mb-3">
                        <label class="font-weight-bold">Tên khoa học</label>
                        <input type="text" name="ten_khoa_hoc" class="form-control" value="{{ old('ten_khoa_hoc') }}">
                    </div>

                    <div class="form-group mb-3">
                        <label class="font-weight-bold">Tên thông thường</label>
                        <input type="text" name="ten_thong_thuong" class="form-control" value="{{ old('ten_thong_thuong') }}">
                    </div>

                    <div class="form-group mb-3">
                        <label class="font-weight-bold">Mô tả</label>
                        <textarea name="mo_ta" class="form-control" rows="4">{{ old('mo_ta') }}</textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label class="font-weight-bold">Độ khó</label>
                        <input type="text" name="do_kho" class="form-control" value="{{ old('do_kho') }}">
                    </div>

                    <div class="form-group mb-3">
                        <label class="font-weight-bold">Yêu cầu ánh sáng</label>
                        <input type="text" name="yeu_cau_anh_sang" class="form-control" value="{{ old('yeu_cau_anh_sang') }}">
                    </div>

                    <div class="form-group mb-3">
                        <label class="font-weight-bold">Nhu cầu nước</label>
                        <input type="text" name="nhu_cau_nuoc" class="form-control" value="{{ old('nhu_cau_nuoc') }}">
                    </div>

                    <div class="form-group mb-3">
                        <label class="font-weight-bold">Giá bán</label>
                        <input type="number" name="gia_ban" class="form-control" value="{{ old('gia_ban') }}">
                    </div>

                    <div class="form-group mb-4">
                        <label class="font-weight-bold">Ảnh sản phẩm</label>
                        <input type="file" name="hinh_anh" class="form-control">
                    </div>

                    <div class="text-center mb-5">
                        <button type="submit" class="btn btn-primary shadow-sm" style="background-color: #007bff; border: none; padding: 8px 40px; border-radius: 4px; font-weight: bold;">
                            Lưu
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-cay-canh-layout>
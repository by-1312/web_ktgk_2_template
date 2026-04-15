<x-cay-canh-layout :categories="$categories" :title="$title">
    <div class="d-flex justify-content-center align-items-center gap-2 my-3 py-2 bg-light">
        <span class="text-secondary">Tìm kiếm theo:</span>
        <a href="{{ request()->fullUrlWithQuery(['sort' => 'asc']) }}" class="btn btn-sm btn-outline-secondary">Giá tăng dần</a>
        <a href="{{ request()->fullUrlWithQuery(['sort' => 'desc']) }}" class="btn btn-sm btn-outline-secondary">Giá giảm dần</a>
        <a href="{{ request()->fullUrlWithQuery(['filter' => 'de-cham-soc']) }}" class="btn btn-sm btn-outline-secondary">Dễ chăm sóc</a>
        <a href="{{ request()->fullUrlWithQuery(['filter' => 'bong-ram']) }}" class="btn btn-sm btn-outline-secondary">Chịu được bóng râm</a>
    </div>

    <div class="list-cay-canh">
        @foreach($sanPhams as $sp)
            <div class="cay-canh">
                <a href="{{ url('caycanh/chitiet/'.$sp->id) }}">
                    <img src="{{ asset('storage/image/'.$sp->hinh_anh) }}" width="100%" height="180px" style="object-fit: cover;">
                    <div class="p-2">
                        <p style="font-weight:bold; height: 40px; overflow: hidden; margin-bottom: 5px;">
                            {{ $sp->ten_san_pham }}
                        </p>
                        <p style="color:#f53003; font-weight: bold; font-style: italic;">
                            {{ number_format($sp->gia_ban, 0, ',', '.') }} VNĐ
                        </p>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</x-cay-canh-layout>
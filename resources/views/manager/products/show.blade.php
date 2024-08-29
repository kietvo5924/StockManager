@extends('layouts.main')

@section('title', 'Chi Tiết Sản Phẩm')

@section('content')
    <div class="container">
        <h1>Chi Tiết Sản Phẩm</h1>
        <div class="card">
            <div class="card-header">
                <h3>{{ $product->name }}</h3>
            </div>
            <div class="card-body">
                <p><strong>ID:</strong> {{ $product->id }}</p>
                <div class="mt-3">
                    <strong>Hình Ảnh:</strong><br>
                    @if ($product->image)
                        <img src="{{ asset($product->image) }}" alt="Product Image" class="img-fluid"
                            style="max-width: 200px; height: auto;">
                    @else
                        <span>Không có ảnh</span>
                    @endif
                </div>
                <p><strong>Tên:</strong> {{ $product->name }}</p>
                <p><strong>Mô Tả:</strong> {{ $product->description }}</p>
                <p><strong>Số Lượng:</strong> {{ $product->quantity }}</p>
                <p><strong>Giá:</strong> {{ $product->price }}</p>
                <p><strong>Danh Mục:</strong> {{ $product->category->name }}</p>
                <p><strong>Thương Hiệu:</strong> {{ $product->brand->name }}</p>
                <p><strong>Nhà Cung Cấp:</strong> {{ $product->supplier->name }}</p>

                <div class="mt-3">
                    <strong>Mã QR:</strong><br>
                    @php
                        $qrCodePath = 'images/qrcodes/' . $product->id . '-qrcode.svg';
                    @endphp

                    @if (file_exists(public_path($qrCodePath)))
                        <img src="{{ asset($qrCodePath) }}" alt="QR Code" class="img-fluid"
                            style="max-width: 200px; height: auto;">
                    @else
                        <span>Không có mã QR. Đường dẫn: {{ $qrCodePath }}</span>
                    @endif
                </div>
            </div>
        </div>
        <a href="{{ route('products.list') }}" class="btn btn-secondary mt-3">Quay lại danh sách</a>
    </div>
@endsection

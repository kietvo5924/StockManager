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
                <p><strong>Tên:</strong> {{ $product->name }}</p>
                <p><strong>Mô Tả:</strong> {{ $product->description }}</p>
                <p><strong>Số Lượng:</strong> {{ $product->quantity }}</p>
                <p><strong>Giá:</strong> {{ $product->price }}</p>
                <p><strong>Danh Mục:</strong> {{ $product->category->name }}</p>
                <p><strong>Thương Hiệu:</strong> {{ $product->brand->name }}</p>
                <p><strong>Nhà Cung Cấp:</strong> {{ $product->supplier->name }}</p>
            </div>
        </div>
        <a href="{{ route('products.list') }}" class="btn btn-secondary mt-3">Quay lại danh sách</a>
    </div>
@endsection

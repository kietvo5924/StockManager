@extends('layouts.main')

@section('title', $product->name)

@section('content')
    <div class="container mt-4">
        <div class="row">
            <!-- Phần hình ảnh sản phẩm -->
            <div class="col-md-6 d-flex justify-content-center align-items-center">
                <div class="border p-3" style="width: 400px; max-width: 400px;">
                    @if ($product->image)
                        <img src="{{ asset($product->image) }}" class="img-fluid rounded border" alt="{{ $product->name }}"
                            style="width: 400px; height: 400px; object-fit: cover; background-color: #fff;">
                    @else
                        <img src="https://via.placeholder.com/600x600" class="img-fluid rounded border"
                            alt="Placeholder image"
                            style="width: 400px; height: 400px; object-fit: cover; background-color: #fff;">
                    @endif
                </div>
            </div>
            <!-- Thông tin sản phẩm -->
            <div class="col-md-6">
                <h2>{{ $product->name }}</h2>
                <p><strong>Nhà cung cấp:</strong> {{ $product->supplier->name }}</p>
                <p><strong>Hiệu:</strong> {{ $product->brand->name }}</p>
                <p><strong>Danh mục:</strong> {{ $product->category->name }}</p>
                <p>{{ $product->description }}</p>
                <h3>Giá: {{ $product->price }}$</h3>
                <form action="{{ route('checkout') }}" method="GET">
                    <div class="form-group">
                        <label for="quantity">Số lượng:</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" value="1"
                            min="1">
                    </div>
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button type="submit" class="btn btn-primary mt-2">Mua ngay</button>
                </form>
            </div>
        </div>
    </div>
@endsection

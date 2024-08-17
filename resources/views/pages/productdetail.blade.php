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
                <p><strong>Mô tả:</strong> {{ $product->description }}</p>
                <p><strong>Số lượng:</strong> {{ $product->quantity }}</p>
                <h4>Giá: {{ $product->price }}$</h4>

                <p><strong>Đánh giá:</strong>
                    <span class="rating-stars" style="font-size: 1.2rem; color: #f39c12; margin-left: 0.5rem;">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($averageRating >= $i)
                                <i class="fas fa-star"></i>
                            @elseif ($averageRating >= $i - 0.5)
                                <i class="fas fa-star-half-alt"></i>
                            @else
                                <i class="far fa-star"></i>
                            @endif
                        @endfor
                    </span>
                </p>

                <form action="{{ route('checkout') }}" method="GET">
                    <div class="form-group">
                        <label for="quantity">Số lượng:</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" value="1"
                            min="1">
                    </div>
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    @if ($product->quantity <= 0)
                        <a href="#" class="btn btn-danger mt-2">Hết hàng</a>
                    @else
                        <button type="submit" class="btn btn-primary mt-2">Mua ngay</button>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection

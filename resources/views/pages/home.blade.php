@extends('layouts.main')

@section('title', 'Home')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Danh sách sản phẩm</h2>
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-3 mb-4">
                    <div class="card">
                        @if ($product->image)
                            <img src="{{ asset($product->image) }}" class="card-img-top" alt="{{ $product->name }}"
                                style="width: 100%; height: 250px; object-fit: cover;">
                        @else
                            <img src="https://via.placeholder.com/150" class="card-img-top" alt="Placeholder image">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <p class="card-text">Giá: {{ $product->price }}</p>
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

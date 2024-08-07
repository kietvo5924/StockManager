@extends('layouts.main')

@section('title', 'Home')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Danh sách sản phẩm</h2>
        <div class="row">
            @foreach ($products as $product)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <a href="{{ route('home.products.detail', $product->id) }}" class="text-decoration-none text-dark">
                        <div class="card">
                            @if ($product->image)
                                <img src="{{ asset($product->image) }}" class="card-img-top fixed-img"
                                    alt="{{ $product->name }}">
                            @else
                                <img src="https://via.placeholder.com/150" class="card-img-top fixed-img"
                                    alt="Placeholder image">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">{{ Str::limit($product->description, 100, '...') }}</p>
                                <p class="card-text">Giá: {{ $product->price }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection

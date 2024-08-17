@extends('layouts.main')

@section('title', 'Đánh giá sản phẩm')

@section('content')
    <div class="container mt-4">
        <h2>Đánh giá sản phẩm</h2>

        @if (session('error'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('reviews.store') }}" method="POST">
            @csrf
            <input type="hidden" name="order_id" value="{{ $order->id }}">
            <input type="hidden" name="product_id" value="{{ $product->id }}">

            <div class="form-group">
                <label for="rating">Đánh giá:</label>
                <div class="stars">
                    <input type="radio" id="star5" name="rating" value="5"><label for="star5"
                        title="5 sao">&#9733;</label>
                    <input type="radio" id="star4" name="rating" value="4"><label for="star4"
                        title="4 sao">&#9733;</label>
                    <input type="radio" id="star3" name="rating" value="3"><label for="star3"
                        title="3 sao">&#9733;</label>
                    <input type="radio" id="star2" name="rating" value="2"><label for="star2"
                        title="2 sao">&#9733;</label>
                    <input type="radio" id="star1" name="rating" value="1"><label for="star1"
                        title="1 sao">&#9733;</label>
                </div>
            </div>

            <div class="form-group mt-3">
                <label for="comment">Nhận xét:</label>
                <textarea name="comment" id="comment" class="form-control" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-primary mt-3"
                onclick="return confirm('Bạn có chắc chắn với đánh giá này không?')">Gửi đánh giá</button>
        </form>
    </div>
@endsection

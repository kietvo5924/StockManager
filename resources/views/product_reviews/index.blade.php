@php
    // Sắp xếp các đánh giá theo trạng thái và thời gian tạo
    $sortedReviews = $reviews->sort(function ($a, $b) {
        if ($a->status == 'pending' && $b->status != 'pending') {
            return -1;
        } elseif ($a->status != 'pending' && $b->status == 'pending') {
            return 1;
        } else {
            return $b->created_at <=> $a->created_at;
        }
    });
@endphp

@extends('layouts.main')

@section('title', 'Đánh giá sản phẩm')

@section('content')
    <div class="container">
        <h1>Danh sách đánh giá sản phẩm</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Product</th>
                    <th>Rating</th>
                    <th>Liked</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sortedReviews as $review)
                    <tr>
                        <td>{{ $review->user->name }}</td>
                        <td>{{ $review->product->name }}</td>
                        <td>{{ $review->rating }}</td>
                        <td>{{ $review->liked ? 'Yes' : 'No' }}</td>
                        <td>{{ ucfirst($review->status) }}</td>
                        <td>
                            <!-- Nút Đánh giá hoặc Đã đánh giá -->
                            @if ($review->status == 'pending')
                                <a href="{{ route('reviews.create', ['order_id' => $review->order_id, 'product_id' => $review->product_id]) }}"
                                    class="btn btn-success btn-sm">Đánh giá</a>
                            @else
                                <span class="btn btn-secondary btn-sm">Đã đánh giá</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

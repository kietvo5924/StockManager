@extends('layouts.main')

@section('title', 'Chi tiết đơn hàng')

@section('content')
    <div class="container mt-4">
        <h2>Chi tiết đơn hàng</h2>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row">
            <div class="col-md-6">
                <p><strong>Mã đơn hàng:</strong> {{ $order->id }}</p>
                <p><strong>Tên sản phẩm:</strong> {{ $order->product->name }}</p>
                <p><strong>Số lượng:</strong> {{ $order->quantity }}</p>
                <p><strong>Tổng tiền:</strong> {{ $order->total_price }}$</p>
                <p><strong>Trạng thái:</strong> {{ $order->status }}</p>
                <p><strong>Trạng thái thanh toán:</strong> {{ $order->payment_status }}</p>
                <p><strong>Hình thức thanh toán:</strong> {{ $order->payment_type }}</p>
                <p><strong>Danh mục:</strong> {{ $order->product->category->name }}</p>
                <p><strong>Hãng:</strong> {{ $order->product->brand->name }}</p>
                <p><strong>Nhà cung cấp:</strong> {{ $order->product->supplier->name }}</p>
            </div>
            <div class="col-md-6">
                @if ($order->product->image)
                    <img src="{{ asset($order->product->image) }}" class="img-fluid rounded border"
                        alt="{{ $order->product->name }}"
                        style="width: 400px; height: 400px; object-fit: cover; background-color: #fff;">
                @else
                    <img src="https://via.placeholder.com/600x600" class="img-fluid rounded border" alt="Placeholder image"
                        style="width: 400px; height: 400px; object-fit: cover; background-color: #fff;">
                @endif
            </div>
        </div>
        <a href="{{ route('orders.index') }}" class="btn btn-primary mt-2 btn-sm">Danh Sách Đơn Hàng</a>
        <a href="{{ route('home') }}" class="btn btn-info mt-2 btn-sm">Mua Thêm Sản Phẩm</a>
    </div>
@endsection

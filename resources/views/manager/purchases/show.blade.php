@extends('layouts.main')

@section('title', 'Chi Tiết Nhập Hàng')

@section('content')
    <div class="container">
        <h1>Chi Tiết Nhập Hàng</h1>
        <div class="card">
            <div class="card-header">
                <h3>{{ $purchase->supplier->name }}</h3>
            </div>
            <div class="card-body">
                <p><strong>ID:</strong> {{ $purchase->id }}</p>
                <p><strong>Nhà Cung Cấp:</strong> {{ $purchase->supplier->name }}</p>
                <p><strong>Tổng Tiền:</strong> {{ $purchase->total_price }}</p>
                <p><strong>Ngày Đặt:</strong> {{ $purchase->purchase_date }}</p>
                <p><strong>Trạng Thái:</strong> {{ $purchase->status }}</p>

                <h4 class="mb-3">Danh sách sản phẩm</h4>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Tên Sản Phẩm</th>
                            <th>Số Lượng</th>
                            <th>Giá Tổng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($purchase->products as $purchaseProduct)
                            <tr>
                                <td>{{ $purchaseProduct->product->name }}</td>
                                <td>{{ $purchaseProduct->quantity }}</td>
                                <td>{{ $purchaseProduct->total_price }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <a href="{{ route('purchases.index') }}" class="btn btn-secondary mt-3">Quay lại danh sách</a>
    </div>
@endsection

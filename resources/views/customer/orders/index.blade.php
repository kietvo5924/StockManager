@extends('layouts.main')

@section('title', 'Danh sách đơn hàng')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Danh sách đơn hàng</h2>
            <a href="{{ route('product-reviews.index') }}" class="btn btn-info">Xem đánh giá sản phẩm</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" id="orderTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="pending-orders-tab" data-bs-toggle="tab" href="#pending-orders"
                    role="tab" aria-controls="pending-orders" aria-selected="true">Đơn hàng đang chờ</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="completed-orders-tab" data-bs-toggle="tab" href="#completed-orders" role="tab"
                    aria-controls="completed-orders" aria-selected="false">Đơn đã thanh toán</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="cancel-orders-tab" data-bs-toggle="tab" href="#cancel-orders" role="tab"
                    aria-controls="cancel-orders" aria-selected="false">Đơn hàng đã hủy</a>
            </li>
        </ul>

        <!-- Tab content -->
        <div class="tab-content" id="orderContent">
            <!-- Pending Orders -->
            <div class="tab-pane fade show active" id="pending-orders" role="tabpanel" aria-labelledby="pending-orders-tab">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Mã đơn hàng</th>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái thanh toán</th>
                            <th>Hình thức thanh toán</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pendingOrders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->product->name }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>{{ $order->total_price }}$</td>
                                <td>{{ $order->payment_status }}</td>
                                <td>{{ $order->payment_type }}</td>
                                <td>
                                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info btn-sm">Xem chi
                                        tiết</a>
                                    <form action="{{ route('orders.cancel', $order->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này không?')">Hủy
                                            đơn</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Completed Orders -->
            <div class="tab-pane fade" id="completed-orders" role="tabpanel" aria-labelledby="completed-orders-tab">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Mã đơn hàng</th>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Tổng tiền</th>
                            <th>Hình thức thanh toán</th>
                            <th>Ngày đặt hàng</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($completedOrders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->product->name }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>{{ $order->total_price }}$</td>
                                <td>{{ $order->payment_type }}</td>
                                <td>{{ $order->order_date }}</td>
                                <td>
                                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info btn-sm">Xem chi
                                        tiết</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Cancelled Orders -->
            <div class="tab-pane fade" id="cancel-orders" role="tabpanel" aria-labelledby="cancel-orders-tab">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Mã đơn hàng</th>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Tổng tiền</th>
                            <th>Hình thức thanh toán</th>
                            <th>Ngày đặt hàng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cancelOrders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->product->name }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>{{ $order->total_price }}$</td>
                                <td>{{ $order->payment_type }}</td>
                                <td>{{ $order->order_date }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.main')

@section('title', 'Danh Sách Đơn Hàng')

@section('content')
    <div class="container">
        <h2>Danh sách đơn hàng</h2>

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

        <ul class="nav nav-tabs" id="orderTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="pending-orders-cod-tab" data-bs-toggle="tab" href="#pending-orders-cod"
                    role="tab" aria-controls="pending-orders-cod" aria-selected="true">Thanh toán khi nhận hàng
                    (COD)</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="pending-orders-card-tab" data-bs-toggle="tab" href="#pending-orders-card"
                    role="tab" aria-controls="pending-orders-card" aria-selected="false">Thanh toán qua thẻ (Card)</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="completed-orders-cod-tab" data-bs-toggle="tab" href="#completed-orders-cod"
                    role="tab" aria-controls="completed-orders-cod" aria-selected="false">Đơn đã thanh toán (COD)</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="completed-orders-card-tab" data-bs-toggle="tab" href="#completed-orders-card"
                    role="tab" aria-controls="completed-orders-card" aria-selected="false">Đơn đã thanh toán (Card)</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="cancel-orders-tab" data-bs-toggle="tab" href="#cancel-orders" role="tab"
                    aria-controls="cancel-orders" aria-selected="false">Đơn hàng đã hủy</a>
            </li>
        </ul>

        <div class="tab-content" id="orderContent">
            <!-- Thanh toán khi nhận hàng (COD) -->
            <div class="tab-pane fade show active" id="pending-orders-cod" role="tabpanel"
                aria-labelledby="pending-orders-cod-tab">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Customer</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Order Date</th>
                            <th>Status</th>
                            <th>Payment Status</th>
                            <th>Payment Type</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pendingOrdersCOD as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->customer->name }}</td>
                                <td>{{ $order->product->name }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>${{ $order->total_price }}</td>
                                <td>{{ $order->order_date }}</td>
                                <td>{{ $order->status }}</td>
                                <td>{{ $order->payment_status }}</td>
                                <td>{{ $order->payment_type }}</td>
                                <td>
                                    <a href="{{ route('staff.orders.edit', $order->id) }}" class="btn btn-warning">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Thanh toán qua thẻ (Card) -->
            <div class="tab-pane fade" id="pending-orders-card" role="tabpanel" aria-labelledby="pending-orders-card-tab">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Customer</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Order Date</th>
                            <th>Status</th>
                            <th>Payment Status</th>
                            <th>Payment Type</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pendingOrdersCard as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->customer->name }}</td>
                                <td>{{ $order->product->name }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>${{ $order->total_price }}</td>
                                <td>{{ $order->order_date }}</td>
                                <td>{{ $order->status }}</td>
                                <td>{{ $order->payment_status }}</td>
                                <td>{{ $order->payment_type }}</td>
                                <td>
                                    <a href="{{ route('staff.orders.edit', $order->id) }}" class="btn btn-warning">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Đơn đã thanh toán (COD) -->
            <div class="tab-pane fade" id="completed-orders-cod" role="tabpanel" aria-labelledby="completed-orders-cod-tab">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Customer</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Order Date</th>
                            <th>Status</th>
                            <th>Payment Status</th>
                            <th>Payment Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($completedOrdersCOD as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->customer->name }}</td>
                                <td>{{ $order->product->name }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>${{ $order->total_price }}</td>
                                <td>{{ $order->order_date }}</td>
                                <td>{{ $order->status }}</td>
                                <td>{{ $order->payment_status }}</td>
                                <td>{{ $order->payment_type }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Đơn đã thanh toán (Card) -->
            <div class="tab-pane fade" id="completed-orders-card" role="tabpanel"
                aria-labelledby="completed-orders-card-tab">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Customer</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Order Date</th>
                            <th>Status</th>
                            <th>Payment Status</th>
                            <th>Payment Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($completedOrdersCard as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->customer->name }}</td>
                                <td>{{ $order->product->name }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>${{ $order->total_price }}</td>
                                <td>{{ $order->order_date }}</td>
                                <td>{{ $order->status }}</td>
                                <td>{{ $order->payment_status }}</td>
                                <td>{{ $order->payment_type }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Đơn hàng đã hủy -->
            <div class="tab-pane fade" id="cancel-orders" role="tabpanel" aria-labelledby="cancel-orders-tab">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Customer</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Order Date</th>
                            <th>Status</th>
                            <th>Payment Status</th>
                            <th>Payment Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cancelOrders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->customer->name }}</td>
                                <td>{{ $order->product->name }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>${{ $order->total_price }}</td>
                                <td>{{ $order->order_date }}</td>
                                <td>{{ $order->status }}</td>
                                <td>{{ $order->payment_status }}</td>
                                <td>{{ $order->payment_type }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

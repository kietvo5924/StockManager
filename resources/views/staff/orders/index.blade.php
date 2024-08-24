@extends('layouts.main')

@section('title', 'Danh Sách Đơn Hàng')

@section('content')
    <div class="container mt-2">
        <h2 class="text-center mb-3">Danh sách đơn hàng</h2>

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

        <!-- Form tìm kiếm -->
        <form method="GET" action="{{ route('staff.orders.index') }}" class="mb-4">
            <div class="input-group mb-3 mx-auto" style="max-width: 600px;">
                <input type="text" name="search" class="form-control" placeholder="Tìm kiếm đơn hàng..."
                    value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit">Tìm kiếm</button>
            </div>
        </form>

        <div class="tabs-container">
            <ul class="nav nav-tabs" id="orderTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="pending-orders-cod-tab" data-bs-toggle="tab" href="#pending-orders-cod"
                        role="tab" aria-controls="pending-orders-cod" aria-selected="true">
                        Thanh toán khi nhận hàng (COD)
                        <span id="pending-orders-cod-count" class="badge bg-danger d-none">0</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="pending-orders-card-tab" data-bs-toggle="tab" href="#pending-orders-card"
                        role="tab" aria-controls="pending-orders-card" aria-selected="false">
                        Thanh toán qua thẻ (Card)
                        <span id="pending-orders-card-count" class="badge bg-danger d-none">0</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="completed-orders-cod-tab" data-bs-toggle="tab" href="#completed-orders-cod"
                        role="tab" aria-controls="completed-orders-cod" aria-selected="false">Đơn đã thanh toán
                        (COD)</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="completed-orders-card-tab" data-bs-toggle="tab" href="#completed-orders-card"
                        role="tab" aria-controls="completed-orders-card" aria-selected="false">Đơn đã thanh toán
                        (Card)</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="cancel-orders-tab" data-bs-toggle="tab" href="#cancel-orders" role="tab"
                        aria-controls="cancel-orders" aria-selected="false">Đơn hàng đã hủy</a>
                </li>
            </ul>
        </div>

        <div class="tab-content" id="orderContent">
            <!-- Thanh toán khi nhận hàng (COD) -->
            <div class="tab-pane fade show active" id="pending-orders-cod" role="tabpanel"
                aria-labelledby="pending-orders-cod-tab">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
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
                                    <td>${{ number_format($order->total_price, 2) }}</td>
                                    <td>{{ $order->order_date }}</td>
                                    <td>{{ $order->status }}</td>
                                    <td>{{ $order->payment_status }}</td>
                                    <td>{{ $order->payment_type }}</td>
                                    <td>
                                        <a href="{{ route('staff.orders.edit', $order->id) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Phân trang -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $pendingOrdersCOD->links('pagination::bootstrap-4') }}
                </div>
            </div>

            <!-- Thanh toán qua thẻ (Card) -->
            <div class="tab-pane fade" id="pending-orders-card" role="tabpanel" aria-labelledby="pending-orders-card-tab">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
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
                                    <td>${{ number_format($order->total_price, 2) }}</td>
                                    <td>{{ $order->order_date }}</td>
                                    <td>{{ $order->status }}</td>
                                    <td>{{ $order->payment_status }}</td>
                                    <td>{{ $order->payment_type }}</td>
                                    <td>
                                        <a href="{{ route('staff.orders.edit', $order->id) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Phân trang -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $pendingOrdersCard->links('pagination::bootstrap-4') }}
                </div>
            </div>

            <!-- Đơn đã thanh toán (COD) -->
            <div class="tab-pane fade" id="completed-orders-cod" role="tabpanel"
                aria-labelledby="completed-orders-cod-tab">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
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
                                    <td>${{ number_format($order->total_price, 2) }}</td>
                                    <td>{{ $order->order_date }}</td>
                                    <td>{{ $order->status }}</td>
                                    <td>{{ $order->payment_status }}</td>
                                    <td>{{ $order->payment_type }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Phân trang -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $completedOrdersCOD->links('pagination::bootstrap-4') }}
                </div>
            </div>

            <!-- Đơn đã thanh toán (Card) -->
            <div class="tab-pane fade" id="completed-orders-card" role="tabpanel"
                aria-labelledby="completed-orders-card-tab">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
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
                                    <td>${{ number_format($order->total_price, 2) }}</td>
                                    <td>{{ $order->order_date }}</td>
                                    <td>{{ $order->status }}</td>
                                    <td>{{ $order->payment_status }}</td>
                                    <td>{{ $order->payment_type }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Phân trang -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $completedOrdersCard->links('pagination::bootstrap-4') }}
                </div>
            </div>

            <!-- Đơn hàng đã hủy -->
            <div class="tab-pane fade" id="cancel-orders" role="tabpanel" aria-labelledby="cancel-orders-tab">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
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
                                    <td>${{ number_format($order->total_price, 2) }}</td>
                                    <td>{{ $order->order_date }}</td>
                                    <td>{{ $order->status }}</td>
                                    <td>{{ $order->payment_status }}</td>
                                    <td>{{ $order->payment_type }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Phân trang -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $cancelOrders->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>

        <style>
            /* Đảm bảo chứa các tab không bị ngắt quãng và cuộn nếu cần */
            .tabs-container {
                overflow-x: auto;
                white-space: nowrap;
            }

            .nav-tabs {
                display: flex;
                flex-wrap: nowrap;
            }

            .nav-tabs .nav-item {
                flex: 0 0 auto;
            }

            .nav-tabs .nav-link {
                white-space: nowrap;
            }
        </style>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Khôi phục tab đã chọn từ localStorage
                const activeTab = localStorage.getItem('activeTab') || 'pending-orders-cod';
                const tab = document.querySelector(`#${activeTab}-tab`);
                if (tab) {
                    new bootstrap.Tab(tab).show();
                }

                // Lưu trạng thái tab khi người dùng thay đổi
                const tabs = document.querySelectorAll('#orderTabs .nav-link');
                tabs.forEach(tab => {
                    tab.addEventListener('shown.bs.tab', function() {
                        localStorage.setItem('activeTab', this.getAttribute('aria-controls'));
                    });
                });
            });
        </script>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const codCountElement = document.getElementById('pending-orders-cod-count');
            const cardCountElement = document.getElementById('pending-orders-card-count');

            if (codCountElement && cardCountElement) {
                fetch('/api/pending-orders-count')
                    .then(response => response.json())
                    .then(data => {
                        if (data.cash_on_delivery > 0) {
                            codCountElement.textContent = data.cash_on_delivery;
                            codCountElement.classList.remove('d-none');
                        } else {
                            codCountElement.classList.add('d-none');
                        }

                        if (data.prepaid_by_card > 0) {
                            cardCountElement.textContent = data.prepaid_by_card;
                            cardCountElement.classList.remove('d-none');
                        } else {
                            cardCountElement.classList.add('d-none');
                        }
                    });
            }
        });
    </script>
@endsection

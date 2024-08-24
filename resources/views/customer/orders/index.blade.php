@extends('layouts.main')

@section('title', 'Danh sách đơn hàng')

@section('content')
    <div class="container mt-2">
        <form method="GET" action="{{ route('orders.index') }}" class="mb-4">
            <div class="input-group mb-3 mx-auto" style="max-width: 600px;">
                <input type="text" name="search" class="form-control" placeholder="Tìm kiếm đơn hàng..."
                    value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit">Tìm kiếm</button>
            </div>
        </form>

        <div class="d-flex justify-content-between align-items-center">
            <h2>Danh sách đơn hàng</h2>
            <a href="{{ route('product-reviews.index') }}" class="btn btn-info position-relative">Xem đánh giá sản phẩm
                @if ($pendingReviewsCount > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{ $pendingReviewsCount }}
                        <span class="visually-hidden">Số lượng đánh giá chưa thực hiện</span>
                    </span>
                @endif
            </a>
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
        <div class="tabs-container">
            <ul class="nav nav-tabs" id="orderTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="pending-orders-tab" data-bs-toggle="tab" href="#pending-orders"
                        role="tab" aria-controls="pending-orders" aria-selected="true">
                        Đơn hàng đang chờ
                        <span id="count-pending-orders" class="badge bg-danger d-none">0</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="completed-orders-tab" data-bs-toggle="tab" href="#completed-orders"
                        role="tab" aria-controls="completed-orders" aria-selected="false">
                        Đơn đã thanh toán
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="cancel-orders-tab" data-bs-toggle="tab" href="#cancel-orders" role="tab"
                        aria-controls="cancel-orders" aria-selected="false">
                        Đơn hàng đã hủy
                    </a>
                </li>
            </ul>
        </div>

        <!-- Tab content -->
        <div class="tab-content" id="orderContent">
            <!-- Pending Orders -->
            <div class="tab-pane fade show active" id="pending-orders" role="tabpanel" aria-labelledby="pending-orders-tab">
                <div class="table-responsive">
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
                                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info btn-sm">Xem
                                            chi
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
                <div class="d-flex justify-content-center mt-4">
                    {{ $pendingOrders->links('pagination::bootstrap-4') }}
                </div>
            </div>

            <!-- Completed Orders -->
            <div class="tab-pane fade" id="completed-orders" role="tabpanel" aria-labelledby="completed-orders-tab">
                <div class="table-responsive">
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
                                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info btn-sm">Xem
                                            chi
                                            tiết</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    {{ $completedOrders->links('pagination::bootstrap-4') }}
                </div>
            </div>

            <!-- Cancelled Orders -->
            <div class="tab-pane fade" id="cancel-orders" role="tabpanel" aria-labelledby="cancel-orders-tab">
                <div class="table-responsive">
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
                <div class="d-flex justify-content-center mt-4">
                    {{ $cancelOrders->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Khôi phục tab đã chọn từ localStorage
                const activeTab = localStorage.getItem('activeTab') || 'pending-orders';
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

                // Cập nhật số lượng thông báo
                const countElement = document.getElementById('count-pending-orders');
                if (countElement) {
                    fetch('/api/customer-pending-count')
                        .then(response => response.json())
                        .then(data => {
                            const totalCount = data.pending_count; // Trường dữ liệu phù hợp với phản hồi từ API
                            if (totalCount > 0) {
                                countElement.classList.remove('d-none');
                                countElement.textContent = totalCount;
                            } else {
                                countElement.classList.add('d-none');
                            }
                        })
                        .catch(error => {
                            console.error('Error fetching pending count:', error);
                        });
                }
            });
        </script>
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
    </style>
@endsection

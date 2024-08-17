@extends('layouts.main')

@section('title', 'dashboard')

@section('content')
    <div class="container">
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

        @if (Auth::user()->role == 'admin')
            <h1>Chào mừng Admin!</h1>
            <p>Quản lý hệ thống và người dùng.</p>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Quản lý Người Dùng</h5>
                            <p class="card-text">Xem và quản lý tất cả người dùng trong hệ thống.</p>
                            <a href="{{ route('admin.users') }}" class="btn btn-primary">Xem Người Dùng</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Quản lý Hàng Hóa</h5>
                            <p class="card-text">Quản lý các sản phẩm và đơn hàng.</p>
                            <a href="{{ route('products.list') }}" class="btn btn-primary">Xem Hàng Hóa</a>
                        </div>
                    </div>
                </div>
            </div>
        @elseif (Auth::user()->role == 'manager')
            <h1>Chào mừng Quản Lý!</h1>
            <p>Quản lý các đơn hàng và hàng hóa của bạn.</p>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Quản lý Đơn Hàng</h5>
                            <p class="card-text">Xem và quản lý các đơn hàng của bạn.</p>
                            <a href="{{ route('purchases.index') }}" class="btn btn-primary">Xem Đơn Hàng</a>
                        </div>
                    </div>
                </div>
                <!-- Thêm các widget khác cho Manager -->
            </div>
        @elseif (Auth::user()->role == 'staff')
            <h1>Chào mừng Nhân Viên!</h1>
            <p>Theo dõi và xử lý các đơn hàng.</p>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Theo Dõi Đơn Hàng</h5>
                            <p class="card-text">Xem và xử lý các đơn hàng đang chờ xử lý.</p>
                            <a href="{{ route('staff.orders.index') }}" class="btn btn-primary">Xem Đơn Hàng</a>
                        </div>
                    </div>
                </div>
                <!-- Thêm các widget khác cho Staff -->
            </div>
        @elseif (Auth::user()->role == 'customer')
            <h1>Chào mừng Khách Hàng!</h1>
            <p>Quản lý đơn hàng và thông tin cá nhân của bạn.</p>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Thông Tin Cá Nhân</h5>
                            <p class="card-text">Xem và chỉnh sửa thông tin cá nhân của bạn.</p>
                            <a href="{{ route('customer.profile') }}" class="btn btn-primary">Xem Hồ Sơ</a>
                        </div>
                    </div>
                </div>
                <!-- Thêm các widget khác cho Customer -->
            </div>
        @endif
    </div>
@endsection

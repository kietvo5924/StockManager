<header class="bg-primary text-white py-4">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <a class="navbar-brand" href="/" style="font-size: 1.5rem; font-weight: bold;">StockManager</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/" style="font-size: 1.1rem;">Trang Chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about') }}" style="font-size: 1.1rem;">Giới Thiệu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('services') }}" style="font-size: 1.1rem;">Dịch Vụ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact') }}" style="font-size: 1.1rem;">Liên Hệ</a>
                    </li>
                    @auth
                        @if (Auth::user()->role == 'staff')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('staff.orders.index') }}" style="font-size: 1.1rem;">Đơn
                                    đặt hàng</a>
                            </li>
                        @endif
                    @endauth

                    @auth
                        @if (Auth::user()->role == 'customer')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('orders.index') }}" style="font-size: 1.1rem;">Đơn
                                    hàng của bạn</a>
                            </li>
                        @endif
                    @endauth

                    @auth
                        @if (Auth::user()->role == 'manager')
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 1.1rem;">
                                    Quản Lý Dịch Vụ
                                </a>
                                <ul class="dropdown-menu dropdown-menu-center" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="{{ route('categories.index') }}">Danh Mục</a></li>
                                    <li><a class="dropdown-item" href="{{ route('brands.index') }}">Thương Hiệu</a></li>
                                    <li><a class="dropdown-item" href="{{ route('suppliers.index') }}">Nhà Cung Cấp</a></li>
                                    <li><a class="dropdown-item" href="{{ route('products.list') }}">Sản Phẩm</a></li>
                                    <li><a class="dropdown-item" href="{{ route('purchases.index') }}">Nhập Hàng</a></li>
                                </ul>
                            </li>
                        @endif
                    @endauth
                </ul>

                <!-- Đẩy phần tử sang bên phải màn hình -->
                <ul class="navbar-nav ms-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}" style="font-size: 1.1rem;">Đăng Nhập</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}" style="font-size: 1.1rem;">Đăng Ký</a>
                        </li>
                    @endguest
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 1.1rem;">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="{{ route('dashboard') }}">Trang Cá Nhân</a></li>

                                @if (Auth::user()->role == 'customer')
                                    <li><a class="dropdown-item" href="{{ route('orders.index') }}">Đơn Đã Đặt</a></li>
                                @endif

                                @if (Auth::user()->role == 'admin')
                                    <li><a class="dropdown-item" href="{{ route('admin.users') }}">Quản Lý Người Dùng</a>
                                    </li>
                                @endif

                                <li><a class="dropdown-item" href="#">Cài Đặt</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Đăng Xuất</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endauth
                </ul>
            </div>
        </nav>
    </div>
</header>

<!-- Thêm CSS tùy chỉnh -->
<style>
    .navbar-nav .nav-link {
        font-weight: bold;
    }

    .dropdown-menu {
        min-width: 150px;
    }
</style>

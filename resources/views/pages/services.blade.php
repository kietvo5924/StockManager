@extends('layouts.main')

@section('title', 'Dịch Vụ')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Dịch Vụ Của Chúng Tôi</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title">Quản Lý Tồn Kho</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            Hệ thống quản lý tồn kho của chúng tôi giúp bạn theo dõi số lượng hàng hóa, nhận thông báo khi
                            mức tồn kho giảm thấp và quản lý nhập/xuất hàng hiệu quả.
                        </p>
                        <a href="#" class="btn btn-primary">Tìm Hiểu Thêm</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h5 class="card-title">Quản Lý Đơn Hàng</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            Quản lý đơn hàng dễ dàng với tính năng xử lý đơn hàng nhanh chóng, theo dõi trạng thái và tạo
                            báo cáo chi tiết.
                        </p>
                        <a href="#" class="btn btn-success">Tìm Hiểu Thêm</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-header bg-warning text-white">
                        <h5 class="card-title">Báo Cáo và Phân Tích</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            Cung cấp các báo cáo chi tiết về doanh số bán hàng, lợi nhuận và hiệu quả của các sản phẩm để
                            bạn có thể đưa ra quyết định kinh doanh chính xác.
                        </p>
                        <a href="#" class="btn btn-warning">Tìm Hiểu Thêm</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

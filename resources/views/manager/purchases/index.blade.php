@extends('layouts.main')

@section('title', 'Purchase')

@section('content')
    <div class="container">
        <h1>Nhập Hàng</h1>

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

        <a href="{{ route('purchases.create') }}" class="btn btn-success mb-3">Nhập Hàng Mới</a>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nhà Cung Cấp</th>
                    <th>Tổng Tiền</th>
                    <th>Ngày Mua</th>
                    <th>Trạng Thái</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($purchases->sortByDesc('created_at') as $purchase)
                    <tr>
                        <td>{{ $purchase->id }}</td>
                        <td>{{ $purchase->supplier->name }}</td>
                        <td>{{ $purchase->total_price }}</td>
                        <td>{{ $purchase->purchase_date }}</td>
                        <td>
                            <form action="{{ route('purchases.updateStatus', $purchase->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <select name="status" class="form-control" onchange="this.form.submit()">
                                    <option value="pending" {{ $purchase->status == 'pending' ? 'selected' : '' }}>Đang chờ
                                    </option>
                                    <option value="completed" {{ $purchase->status == 'completed' ? 'selected' : '' }}>Hoàn
                                        thành</option>
                                    <option value="cancelled" {{ $purchase->status == 'cancelled' ? 'selected' : '' }}>Đã
                                        hủy</option>
                                </select>
                            </form>
                        </td>
                        <td>
                            <a href="{{ route('purchases.show', $purchase->id) }}" class="btn btn-info btn-sm">Xem</a>
                            <a href="{{ route('purchases.edit', $purchase->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                            <form action="{{ route('purchases.destroy', $purchase->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Bạn có chắc muốn xóa thương hiệu này không?')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

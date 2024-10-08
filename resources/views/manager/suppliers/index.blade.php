@extends('layouts.main')

@section('title', 'Supplier')

@section('content')
    <div class="container">
        <h1>Nhà Cung Cấp</h1>

        <form method="GET" action="{{ route('suppliers.index') }}" class="mb-4">
            <div class="input-group mb-3 mx-auto" style="max-width: 600px;">
                <input type="text" name="search" class="form-control" placeholder="Tìm kiếm nhà cung cấp..."
                    value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit">Tìm kiếm</button>
            </div>
        </form>

        <a href="{{ route('suppliers.create') }}" class="btn btn-success mb-3">Thêm nhà cung cấp</a>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Email</th>
                        <th>Số Điện Thoại</th>
                        <th>Địa Chỉ</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($suppliers as $supplier)
                        <tr>
                            <td>{{ $supplier->id }}</td>
                            <td>{{ $supplier->name }}</td>
                            <td>{{ $supplier->email }}</td>
                            <td>{{ $supplier->phone }}</td>
                            <td>{{ $supplier->address }}</td>
                            <td>
                                <a href="{{ route('suppliers.show', $supplier->id) }}" class="btn btn-info btn-sm">Xem</a>
                                <a href="{{ route('suppliers.edit', $supplier->id) }}"
                                    class="btn btn-warning btn-sm">Sửa</a>
                                <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Bạn có chắc muốn xóa nhà cung cấp này không?')">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-center mt-4">
                {{ $suppliers->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection

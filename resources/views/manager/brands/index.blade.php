@extends('layouts.main')

@section('title', 'Brand')

@section('content')
    <div class="container">
        <h1>Thương Hiệu</h1>

        <form method="GET" action="{{ route('brands.index') }}" class="mb-4">
            <div class="input-group mb-3 mx-auto" style="max-width: 600px;">
                <input type="text" name="search" class="form-control" placeholder="Tìm kiếm thương hiệu..."
                    value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit">Tìm kiếm</button>
            </div>
        </form>

        <a href="{{ route('brands.create') }}" class="btn btn-success mb-3">Thêm thương hiệu</a>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Mô Tả</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($brands as $brand)
                        <tr>
                            <td>{{ $brand->id }}</td>
                            <td>{{ $brand->name }}</td>
                            <td>{{ $brand->description }}</td>
                            <td>
                                <a href="{{ route('brands.show', $brand->id) }}" class="btn btn-info btn-sm">Xem</a>
                                <a href="{{ route('brands.edit', $brand->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                                <form action="{{ route('brands.destroy', $brand->id) }}" method="POST"
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

            <div class="d-flex justify-content-center mt-4">
                {{ $brands->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection

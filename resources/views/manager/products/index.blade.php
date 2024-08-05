@extends('layouts.main')

@section('title', 'Product')

@section('content')
    <div class="container">
        <h1>Sản Phẩm</h1>
        <a href="{{ route('products.create') }}" class="btn btn-success mb-3">Thêm sản phẩm</a>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Mô Tả</th>
                        <th>Số Lượng</th>
                        <th>Giá</th>
                        <th>Danh Mục</th>
                        <th>Thương Hiệu</th>
                        <th>Nhà Cung Cấp</th>
                        <th>Hình Ảnh</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>{{ $product->brand->name }}</td>
                            <td>{{ $product->supplier->name }}</td>
                            <td>
                                @if ($product->image)
                                    <img src="{{ asset($product->image) }}" alt="Product Image" width="100" height="100">
                                @else
                                    <span>Không có ảnh</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-info btn-sm">Xem</a>
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này không?')">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

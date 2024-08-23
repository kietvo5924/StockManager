@extends('layouts.main')

@section('title', 'Chỉnh Sửa Thương Hiệu')

@section('content')
    <div class="container">
        <h1>Chỉnh Sửa Thương Hiệu</h1>
        <form action="{{ route('brands.update', $brand->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Tên</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $brand->name }}" required>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Mô tả</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{ $brand->description }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary"
                onclick="return confirm('Bạn có chắc muốn lưu thay đổi sản phẩm này không?')">Cập Nhật</button>
            <a href="{{ route('brands.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
@endsection

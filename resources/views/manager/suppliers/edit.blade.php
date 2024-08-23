@extends('layouts.main')

@section('title', 'Chỉnh Sửa Nhà Cung Cấp')

@section('content')
    <div class="container">
        <h1>Tạo Nhà Cung Cấp</h1>
        <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Tên</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $supplier->name }}" required>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $supplier->email }}"
                    required>
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Số Điện Thoại</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ $supplier->phone }}"
                    required>
                @error('phone')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Địa Chỉ</label>
                <textarea class="form-control" id="address" name="address" rows="3">{{ $supplier->address }}</textarea>
                @error('address')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary"
                onclick="return confirm('Bạn có chắc muốn lưu thay đổi sản phẩm này không?')">Cập Nhật</button>
            <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
@endsection

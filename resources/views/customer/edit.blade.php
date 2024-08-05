@extends('layouts.main')

@section('title', 'Chỉnh Sửa Hồ Sơ')

@section('content')
    <div class="container">
        <h1>Chỉnh Sửa Hồ Sơ</h1>

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('customer.updateProfile') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Tên</label>
                <input type="text" id="name" name="name" class="form-control"
                    value="{{ old('name', $customer->name) }}" required>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Điện Thoại</label>
                <input type="text" id="phone" name="phone" class="form-control"
                    value="{{ old('phone', $customer->phone) }}" required>
                @error('phone')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Địa Chỉ</label>
                <input type="text" id="address" name="address" class="form-control"
                    value="{{ old('address', $customer->address) }}">
                @error('address')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Cập Nhật Hồ Sơ</button>
            <a href="{{ route('admin.users') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
@endsection

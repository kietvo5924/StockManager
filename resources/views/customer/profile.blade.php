@extends('layouts.main')

@section('title', 'Hồ Sơ Khách Hàng')

@section('content')
    <div class="container">
        <h1>Hồ Sơ Khách Hàng</h1>

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

        <div class="card">
            <div class="card-header">
                Thông tin cá nhân
            </div>
            <div class="card-body">
                <p><strong>Tên:</strong> {{ $customer->name }}</p>
                <p><strong>Email:</strong> {{ $customer->email }}</p>
                <p><strong>Số điện thoại:</strong> {{ $customer->phone }}</p>
                <p><strong>Địa chỉ:</strong> {{ $customer->address }}</p>
            </div>
            <div class="card-footer">
                <a href="{{ route('customer.profile.edit') }}" class="btn btn-warning">Chỉnh Sửa Hồ Sơ</a>
            </div>
        </div>
    </div>
@endsection

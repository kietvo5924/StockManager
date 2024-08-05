@extends('layouts.main')

@section('title', 'Chi Tiết Nhà Cung Cấp')

@section('content')
    <div class="container">
        <h1>Chi Tiết Nhà Cung Cấp</h1>
        <div class="card">
            <div class="card-header">
                <h3>{{ $supplier->name }}</h3>
            </div>
            <div class="card-body">
                <p><strong>ID:</strong> {{ $supplier->id }}</p>
                <p><strong>Tên:</strong> {{ $supplier->name }}</p>
                <p><strong>Email:</strong> {{ $supplier->email }}</p>
                <p><strong>Số Điện Thoại:</strong> {{ $supplier->phone }}</p>
                <p><strong>Địa chỉ:</strong> {{ $supplier->address }}</p>
            </div>
        </div>
        <a href="{{ route('suppliers.index') }}" class="btn btn-secondary mt-3">Quay lại danh sách</a>
    </div>
@endsection

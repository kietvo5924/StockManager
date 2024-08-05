@extends('layouts.main')

@section('title', 'Chi Tiết Thương Hiệu')

@section('content')
    <div class="container">
        <h1>Chi Tiết Thương Hiệu</h1>
        <div class="card">
            <div class="card-header">
                <h3>{{ $brand->name }}</h3>
            </div>
            <div class="card-body">
                <p><strong>ID:</strong> {{ $brand->id }}</p>
                <p><strong>Tên:</strong> {{ $brand->name }}</p>
                <p><strong>Mô Tả:</strong> {{ $brand->description }}</p>
            </div>
        </div>
        <a href="{{ route('brands.index') }}" class="btn btn-secondary mt-3">Quay lại danh sách</a>
    </div>
@endsection

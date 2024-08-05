@extends('layouts.main')

@section('title', 'Chi Tiết Danh Mục')

@section('content')
    <div class="container">
        <h1>Chi Tiết Danh Mục</h1>
        <div class="card">
            <div class="card-header">
                <h3>{{ $category->name }}</h3>
            </div>
            <div class="card-body">
                <p><strong>ID:</strong> {{ $category->id }}</p>
                <p><strong>Tên:</strong> {{ $category->name }}</p>
                <p><strong>Mô Tả:</strong> {{ $category->description }}</p>
            </div>
        </div>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary mt-3">Quay lại danh sách</a>
    </div>
@endsection

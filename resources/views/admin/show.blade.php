@extends('layouts.main')

@section('title', 'Chi tiết người dùng')

@section('content')
    <div class="container">
        <h1>Chi tiết người dùng</h1>
        <table class="table">
            <tr>
                <th>Tên:</th>
                <td>{{ $user->name }}</td>
            </tr>
            <tr>
                <th>Email:</th>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <th>Vai trò:</th>
                <td>{{ $user->role }}</td>
            </tr>
        </table>
        <a href="{{ route('admin.users') }}" class="btn btn-primary">Quay lại</a>
    </div>
@endsection

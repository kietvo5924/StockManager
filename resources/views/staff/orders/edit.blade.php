@extends('layouts.main')

@section('title', 'Sửa Đơn Hàng')

@section('content')
    <div class="container">
        <h1>Edit Order</h1>

        <form action="{{ route('staff.orders.update', $order->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="customer_id" class="form-label">Customer</label>
                <input type="text" name="customer_id" id="customer_id" class="form-control"
                    value="{{ $order->customer->name }}" readonly>
                <input type="hidden" name="customer_id" value="{{ $order->customer_id }}">
            </div>

            <div class="mb-3">
                <label for="product_id" class="form-label">Product</label>
                <select name="product_id" id="product_id" class="form-select" required>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" {{ $order->product_id == $product->id ? 'selected' : '' }}>
                            {{ $product->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" name="quantity" id="quantity" class="form-control" required
                    value="{{ $order->quantity }}" min="1">
            </div>

            <div class="mb-3">
                <label for="total_price" class="form-label">Total Price</label>
                <input type="number" name="total_price" id="total_price" class="form-control" required
                    value="{{ $order->total_price }}" step="0.01">
            </div>

            <div class="mb-3">
                <label for="order_date" class="form-label">Order Date</label>
                <input type="date" name="order_date" id="order_date" class="form-control" required
                    value="{{ $order->order_date }}">
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select" required>
                    <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="payment_status" class="form-label">Payment Status</label>
                <select name="payment_status" id="payment_status" class="form-select" required>
                    <option value="pending" {{ $order->payment_status === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="paid" {{ $order->payment_status === 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="failed" {{ $order->payment_status === 'failed' ? 'selected' : '' }}>Failed</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="payment_type" class="form-label">Payment Type</label>
                <input type="text" name="payment_type" id="payment_type" class="form-control"
                    value="{{ $order->payment_type }}" readonly>
                <input type="hidden" name="payment_type" value="{{ $order->payment_type }}">
            </div>

            <button type="submit" class="btn btn-primary"
                onclick="return confirm('Bạn có chắc chắn với thay đổi này không?')">Update</button>
            <a href="{{ route('staff.orders.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection

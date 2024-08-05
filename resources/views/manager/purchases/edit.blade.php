@extends('layouts.main')

@section('title', 'Chỉnh Sửa Đơn Mua')
@section('content')
    <div class="container">
        <h1>Chỉnh Sửa Đơn Mua</h1>
        <form action="{{ route('purchases.update', $purchase->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="supplier_id" class="form-label">Nhà Cung Cấp</label>
                <select name="supplier_id" id="supplier_id" class="form-control" required>
                    <option value="">Chọn Nhà Cung Cấp</option>
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}" {{ $supplier->id == $purchase->supplier_id ? 'selected' : '' }}>
                            {{ $supplier->name }}
                        </option>
                    @endforeach
                </select>
                @error('supplier_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div id="product-table">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Sản Phẩm</th>
                            <th>Số Lượng</th>
                            <th>Giá</th>
                            <th>Tổng Tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $index => $product)
                            <tr>
                                <td>{{ $product->name }}
                                    <input type="hidden" name="products[{{ $index }}][product_id]"
                                        value="{{ $product->id }}">
                                </td>
                                <td>
                                    <input type="number" name="products[{{ $index }}][quantity]"
                                        class="form-control quantity"
                                        value="{{ $purchase->products->firstWhere('product_id', $product->id)->quantity ?? '' }}"
                                        data-price="{{ $product->price }}">
                                </td>
                                <td>{{ $product->price }}</td>
                                <td><input type="text" class="form-control total-price"
                                        value="{{ ($purchase->products->firstWhere('product_id', $product->id)->quantity ?? 0) * $product->price }}"
                                        readonly></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mb-3">
                <label for="total_amount">Tổng Tiền</label>
                <input type="text" name="total_amount" id="total_amount" class="form-control"
                    value="{{ $purchase->total_price }}" readonly>
            </div>

            <div class="mb-3">
                <label for="purchase_date">Ngày Mua</label>
                <input type="date" name="purchase_date" id="purchase_date" class="form-control"
                    value="{{ $purchase->purchase_date }}">
            </div>

            <button type="submit" class="btn btn-primary">Cấp Nhật</button>
            <a href="{{ route('purchases.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>

    <script>
        document.querySelectorAll('.quantity').forEach(input => {
            input.addEventListener('input', updateTotals);
        });

        function updateTotals() {
            let totalAmount = 0;
            document.querySelectorAll('#product-table .total-price').forEach(td => {
                const row = td.closest('tr');
                const quantity = row.querySelector('.quantity').value || 0;
                const price = row.querySelector('.quantity').dataset.price;
                const totalPrice = quantity * price;
                td.value = totalPrice.toFixed(2);
                totalAmount += totalPrice;
            });
            document.getElementById('total_amount').value = totalAmount.toFixed(2);
        }

        document.querySelector('form').addEventListener('submit', function(event) {
            document.querySelectorAll('.quantity').forEach(input => {
                if (input.value == 0 || input.value == '') {
                    const productRow = input.closest('tr');
                    productRow.remove(); // Xóa hàng sản phẩm không có số lượng
                }
            });
        });
    </script>
@endsection

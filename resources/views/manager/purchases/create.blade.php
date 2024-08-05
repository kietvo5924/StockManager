@extends('layouts.main')

@section('title', 'Tạo Đơn Mua Mới')

@section('content')
    <div class="container">
        <h1>Tạo Đơn Mua Mới</h1>
        <form action="{{ route('purchases.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="supplier_id" class="form-label">Nhà Cung Cấp</label>
                <select name="supplier_id" id="supplier_id" class="form-control" required>
                    <option value="">Chọn Nhà Cung Cấp</option>
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                    @endforeach
                </select>
                @error('supplier_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div id="product-table">
                <!-- Bảng sản phẩm sẽ được hiển thị ở đây sau khi chọn nhà cung cấp -->
            </div>

            <button type="submit" class="btn btn-primary">Tạo Mới</button>
            <a href="{{ route('purchases.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>

    <script>
        document.getElementById('supplier_id').addEventListener('change', function() {
            const supplierId = this.value;
            const products = @json($products);
            const productTable = document.getElementById('product-table');

            // Lọc sản phẩm theo nhà cung cấp đã chọn
            const filteredProducts = products.filter(product => product.supplier_id == supplierId);

            if (filteredProducts.length > 0) {
                let tableHtml = `
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
                `;

                filteredProducts.forEach((product, index) => {
                    tableHtml += `
                        <tr>
                            <td>${product.name}
                                <input type="hidden" name="products[${index}][product_id]" value="${product.id}">
                            </td>
                            <td><input type="number" name="products[${index}][quantity]" class="form-control quantity" data-price="${product.price}"></td>
                            <td>${product.price}</td>
                            <td><input type="text" class="form-control total-price" readonly></td>
                        </tr>
                    `;
                });

                tableHtml += `
                        </tbody>
                    </table>
                    <div class="mb-3">
                        <label for="total_amount">Tổng Tiền</label>
                        <input type="text" name="total_amount" id="total_amount" class="form-control" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="purchase_date">Ngày Mua</label>
                        <input type="date" name="purchase_date" id="purchase_date" class="form-control" value="${new Date().toISOString().split('T')[0]}">
                    </div>
                `;

                productTable.innerHTML = tableHtml;

                // Cập nhật tổng tiền khi số lượng thay đổi
                document.querySelectorAll('.quantity').forEach(input => {
                    input.addEventListener('input', updateTotals);
                });

                updateTotals(); // Cập nhật tổng tiền ngay khi bảng được hiển thị
            } else {
                productTable.innerHTML = '<p>Không có sản phẩm nào cho nhà cung cấp này.</p>';
            }
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

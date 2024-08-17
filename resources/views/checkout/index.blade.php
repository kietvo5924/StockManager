@extends('layouts.main')

@section('title', 'Thanh Toán')

@section('content')
    <div class="container mt-4">
        <h2>Thanh Toán</h2>
        <div class="row">
            <!-- Chính sách vận chuyển -->
            <div class="col-md-12">
                <h3>Chính Sách Vận Chuyển</h3>
                <p><strong>Thời Gian Giao Hàng:</strong></p>
                <ul>
                    <li>Đơn hàng sẽ được xử lý và giao hàng trong vòng 1-2 ngày làm việc kể từ khi nhận được đơn hàng.</li>
                    <li>Thời gian giao hàng tùy thuộc vào địa chỉ của bạn và loại dịch vụ vận chuyển chọn lựa. Thông thường,
                        thời gian giao hàng nội thành là 2-4 ngày làm việc, và thời gian giao hàng ngoại thành là 4-7 ngày
                        làm việc.</li>
                </ul>

                <p><strong>Chi Phí Giao Hàng:</strong></p>
                <ul>
                    <li>Chi phí giao hàng sẽ được tính dựa trên trọng lượng của đơn hàng và địa chỉ giao hàng. Bạn sẽ thấy
                        chi phí giao hàng khi thanh toán.</li>
                </ul>

                <p><strong>Địa Chỉ Giao Hàng:</strong></p>
                <ul>
                    <li>Vui lòng cung cấp địa chỉ giao hàng chính xác để đảm bảo đơn hàng của bạn được giao đến đúng nơi.
                        Chúng tôi không chịu trách nhiệm nếu đơn hàng bị giao sai địa chỉ do thông tin không chính xác.</li>
                </ul>

                <p><strong>Theo Dõi Đơn Hàng:</strong></p>
                <ul>
                    <li>Sau khi đơn hàng được gửi đi, bạn sẽ nhận được số theo dõi qua email để bạn có thể theo dõi tình
                        trạng đơn hàng của mình.</li>
                </ul>
            </div>
        </div>

        <div class="row mt-4">
            <!-- Thông tin sản phẩm -->
            <div class="col-md-6">
                <h3>Thông Tin Sản Phẩm</h3>
                <p><strong>Tên sản phẩm:</strong> {{ $product->name }}</p>
                <p><strong>Số lượng:</strong> {{ $quantity }}</p>
                <p><strong>Giá:</strong> {{ $product->price }}$</p>
                <h4>Tổng tiền: {{ $totalPrice }}$</h4>
            </div>

            <!-- Chọn cách thanh toán -->
            <div class="col-md-6">
                <form action="{{ route('processPayment') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" value="{{ $quantity }}">
                    <input type="hidden" name="total_price" value="{{ $totalPrice }}">

                    <div class="form-group">
                        <label for="payment_type">Hình thức thanh toán:</label>
                        <select class="form-control" id="payment_type" name="payment_type">
                            <option value="cash_on_delivery">Thanh toán khi nhận hàng</option>
                            <option value="prepaid_by_card">Thanh toán bằng thẻ</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2"
                        onclick="return confirm('Bạn có chắc chắn muốn mua sản phẩm này không?')">Xác nhận thanh
                        toán</button>
                    <a href="javascript:history.back()" class="btn btn-secondary ml-2 mt-2">Trở lại</a>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Lưu trang chủ vào localStorage để sử dụng sau
            if (!localStorage.getItem('previousPage')) {
                localStorage.setItem('previousPage', '{{ route('home') }}');
            }

            document.querySelector('a[href="javascript:history.back()"]').addEventListener('click', function() {
                localStorage.setItem('previousPage', '{{ url()->previous() }}');
            });
        });
    </script>
@endsection

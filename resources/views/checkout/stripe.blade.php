@extends('layouts.main')

@section('title', 'Thanh Toán Bằng Thẻ')

@section('content')
    <div class="container mt-4">
        <h2 class="text-center">Thanh Toán Bằng Thẻ</h2>

        @if (session('error'))
            <div class="alert alert-danger text-center">
                {{ session('error') }}
            </div>
        @endif

        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Chi Tiết Đơn Hàng</h5>
                <p><strong>Sản phẩm:</strong> {{ $order->product->name }}</p>
                <p><strong>Giá:</strong> {{ number_format($order->product->price) }} VND</p>
                <p><strong>Số lượng:</strong> {{ $order->quantity }}</p>
                <p><strong>Tổng cộng:</strong> {{ number_format($order->product->price * $order->quantity) }} VND</p>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="{{ route('payment.gateway', ['order' => $order->id]) }}" method="POST" id="payment-form">
                    @csrf
                    <div class="form-group">
                        <label for="card-element" class="font-weight-bold">Thông tin thẻ tín dụng hoặc ghi nợ:</label>
                        <div id="card-element" class="form-control">
                            <!-- Stripe Element sẽ được nhúng ở đây -->
                        </div>
                        <div id="card-errors" role="alert" class="text-danger mt-2"></div>
                    </div>

                    <button class="btn btn-primary btn-block mt-3">Thanh Toán</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        var stripe = Stripe('{{ env('STRIPE_KEY') }}');
        var elements = stripe.elements();

        var style = {
            base: {
                color: '#32325d',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                },
                padding: '10px 12px',
                border: '1px solid #ced4da',
                borderRadius: '4px',
                backgroundColor: '#fff',
                boxShadow: 'inset 0 1px 1px rgba(0,0,0,0.075)',
                transition: 'border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out'
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };

        var card = elements.create('card', {
            style: style,
            hidePostalCode: true
        });
        card.mount('#card-element');

        card.on('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    var hiddenInput = document.createElement('input');
                    hiddenInput.setAttribute('type', 'hidden');
                    hiddenInput.setAttribute('name', 'stripeToken');
                    hiddenInput.setAttribute('value', result.token.id);
                    form.appendChild(hiddenInput);

                    form.submit();
                }
            });
        });
    </script>
@endsection

@extends('layouts.main')

@section('title', 'Home')

@section('content')
    <div class="container mt-4">
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <h2 class="mb-4">Danh sách sản phẩm</h2>
        <div class="row">
            @foreach ($products as $product)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <a href="{{ route('home.products.detail', $product->id) }}" class="text-decoration-none text-dark">
                        <div class="card">
                            @if ($product->image)
                                <img src="{{ asset($product->image) }}" class="card-img-top fixed-img"
                                    alt="{{ $product->name }}">
                            @else
                                <img src="https://via.placeholder.com/150" class="card-img-top fixed-img"
                                    alt="Placeholder image">
                            @endif
                            @if ($product->quantity <= 0)
                                <div class="overlay">
                                    <span class="text">Hết hàng</span>
                                </div>
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">{{ Str::limit($product->description, 100, '...') }}</p>
                                <p class="card-text">Giá: {{ $product->price }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Chatbot -->
    <style>
        df-messenger {
            --df-messenger-button-titlebar-color: #0066cc;
            --df-messenger-chat-background-color: #f7f7f7;
            --df-messenger-font-color: #333;
            --df-messenger-send-icon: #0066cc;
            --df-messenger-width: 300px;
            --df-messenger-height: 400px;
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 9999;
        }

        df-messenger * {
            border-radius: 10px;
        }

        /* Hide default dialogflow icon */
        df-messenger .df-messenger-wrapper {
            max-width: 300px;
            max-height: 400px;
            border-radius: 10px;
        }

        .card.position-relative {
            overflow: hidden;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .overlay .text {
            color: red;
            font-size: 1.5rem;
            font-weight: bold;
            text-transform: uppercase;
            background-color: rgba(255, 255, 255, 0.9);
            /* Nền trắng với độ mờ */
            padding: 5px 10px;
            border-radius: 5px;
        }
    </style>

    <script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>
    <df-messenger chat-title="Chat Bot" agent-id="b348fe55-24ed-423e-874d-e7c1ad9c544f" language-code="vi"></df-messenger>
@endsection

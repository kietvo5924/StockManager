<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Stripe\Charge;
use Stripe\Stripe;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        Log::info('Request Method:', ['method' => $request->method()]);

        // Lấy dữ liệu từ request nếu có
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        // Kiểm tra nếu có productId và quantity
        if (!$productId || !$quantity) {
            return view('checkout.index')->with('error', 'Sản phẩm hoặc số lượng không hợp lệ.');
        }

        // Lấy sản phẩm từ database
        $product = Product::find($productId);

        if (!$product) {
            return view('checkout.index')->with('error', 'Sản phẩm không tồn tại.');
        }

        // Tính tổng tiền
        $totalPrice = $product->price * $quantity;

        return view('checkout.index', compact('product', 'quantity', 'totalPrice'));
    }

    public function processPayment(Request $request)
    {
        // Validate user role
        $user = Auth::user();
        if ($user->role !== 'customer') {
            return redirect()->route('home')->with('error', 'Bạn phải là khách hàng để thực hiện thanh toán.');
        }

        // Validate request data
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:0',
            'payment_type' => 'required|in:cash_on_delivery,prepaid_by_card',
        ]);

        // Retrieve the data from the request
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');
        $totalPrice = $request->input('total_price');
        $paymentType = $request->input('payment_type');

        // Find the product and update its quantity
        $product = Product::find($productId);
        if ($product->quantity < $quantity) {
            return redirect()->route('home')->with('error', 'Số lượng sản phẩm không đủ để đặt hàng.');
        }
        $product->quantity -= $quantity;
        $product->save();

        // Create order
        $order = new Order();
        $order->customer_id = $user->id;
        $order->product_id = $productId;
        $order->quantity = $quantity;
        $order->total_price = $totalPrice;
        $order->order_date = Carbon::now();
        $order->status = 'pending';
        $order->payment_status = 'pending';
        $order->payment_type = $paymentType;
        $order->save();

        if ($paymentType === 'cash_on_delivery') {
            return redirect()->route('orders.show', ['order' => $order->id])
                ->with('success', 'Đơn hàng đã được đặt thành công. Đơn hàng của bạn sẽ được giao trong thời gian sớm nhất.');
        } elseif ($paymentType === 'prepaid_by_card') {
            return view('checkout.stripe', compact('order'));
        }
    }

    public function paymentGateway(Request $request, Order $order)
    {
        $request->validate([
            'stripeToken' => 'required',
        ]);

        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            // Charge the customer
            $charge = Charge::create([
                'amount' => $order->total_price * 100, // Stripe uses cents
                'currency' => 'usd',
                'description' => 'Order ID: ' . $order->id,
                'source' => $request->stripeToken,
            ]);

            $order->status = 'completed';
            $order->payment_status = 'paid';
            $order->save();

            return redirect()->route('orders.show', ['order' => $order->id])
                ->with('success', 'Thanh toán thành công. Đơn hàng của bạn đã được xác nhận.');
        } catch (\Exception $e) {
            return redirect()->route('payment.gateway', ['order' => $order->id])
                ->with('error', 'Có lỗi xảy ra khi thanh toán. Vui lòng thử lại sau.');
        }
    }
}

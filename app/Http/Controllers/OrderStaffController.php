<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderStaffController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Tạo truy vấn cơ bản
        $ordersQuery = Order::with('product', 'customer');

        if ($search) {
            $ordersQuery->where(function ($query) use ($search) {
                $query->whereHas('product', function ($q) use ($search) {
                    $q->where('name', 'like', "%$search%");
                })
                    ->orWhereHas('customer', function ($q) use ($search) {
                        $q->where('name', 'like', "%$search%");
                    })
                    ->orWhere('id', 'like', "%$search%");
            });
        }

        // Thực hiện phân trang cho từng loại đơn hàng với tham số phân trang khác nhau
        $pendingOrdersCOD = $ordersQuery->clone()->where('status', 'pending')->where('payment_type', 'cash_on_delivery')->paginate(10, ['*'], 'pending_cod_page');
        $pendingOrdersCard = $ordersQuery->clone()->where('status', 'pending')->where('payment_type', 'prepaid_by_card')->paginate(10, ['*'], 'pending_card_page');
        $completedOrdersCOD = $ordersQuery->clone()->where('status', 'completed')->where('payment_type', 'cash_on_delivery')->paginate(10, ['*'], 'completed_cod_page');
        $completedOrdersCard = $ordersQuery->clone()->where('status', 'completed')->where('payment_type', 'prepaid_by_card')->paginate(10, ['*'], 'completed_card_page');
        $cancelOrders = $ordersQuery->clone()->where('status', 'cancelled')->paginate(10, ['*'], 'cancel_page');

        return view('staff.orders.index', compact('pendingOrdersCOD', 'pendingOrdersCard', 'completedOrdersCOD', 'completedOrdersCard', 'cancelOrders'));
    }

    public function edit(Order $order)
    {
        $products = Product::all();
        $customers = Customer::all();
        return view('staff.orders.edit', compact('order', 'products', 'customers'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'total_price' => 'required|numeric',
            'order_date' => 'required|date',
            'status' => 'required|string',
            'payment_status' => 'required|string',
            'payment_type' => 'required|string',
        ]);

        $order->status = $request->input('status');

        if ($order->status === 'completed') {
            $order->payment_status = 'paid';

            // Create a new review with empty comment and rating
            ProductReview::create([
                'user_id' => $order->customer->id,
                'product_id' => $order->product_id,
                'order_id' => $order->id,
                'rating' => 0,
                'liked' => false,
                'comment' => '',
            ]);
        } elseif ($order->status === 'cancelled') {
            $order->payment_status = 'failed';
        }

        $order->update($request->except(['status', 'payment_status']));

        return redirect()->route('staff.orders.index')->with('success', 'Order updated successfully.');
    }
}

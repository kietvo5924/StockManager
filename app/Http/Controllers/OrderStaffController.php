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
    public function index()
    {
        $orders = Order::with('product', 'customer')->where('status', 'pending')->get();

        $pendingOrdersCOD = Order::with('product', 'customer')->where('status', 'pending')->where('payment_type', 'cash_on_delivery')->get();
        $pendingOrdersCard = Order::with('product', 'customer')->where('status', 'pending')->where('payment_type', 'prepaid_by_card')->get();
        $completedOrdersCOD = Order::with('product', 'customer')->where('status', 'completed')->where('payment_type', 'cash_on_delivery')->get();
        $completedOrdersCard = Order::with('product', 'customer')->where('status', 'completed')->where('payment_type', 'prepaid_by_card')->get();
        $cancelOrders = Order::with('product', 'customer')->where('status', 'cancelled')->get();

        return view('staff.orders.index', compact('orders', 'pendingOrdersCOD', 'pendingOrdersCard', 'completedOrdersCOD', 'completedOrdersCard', 'cancelOrders'));
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

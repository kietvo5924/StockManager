<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Lấy danh sách đơn hàng của người dùng hiện tại
        $orders = Order::with('product')->where('customer_id', Auth::id())->get();

        // Truyền danh sách đơn hàng vào view
        return view('customer.orders.index', compact('orders'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        // Kiểm tra xem người dùng có quyền truy cập vào đơn hàng này hay không
        if (Auth::id() !== $order->customer_id) {
            return redirect()->route('home')->with('error', 'Bạn không có quyền truy cập vào đơn hàng này.');
        }

        // Hiển thị chi tiết đơn hàng
        return view('customer.orders.show', compact('order'));
    }

    public function cancel(Order $order)
    {
        // Kiểm tra xem người dùng có quyền hủy đơn hàng này không
        if (Auth::id() !== $order->customer_id) {
            return redirect()->route('orders.index')->with('error', 'Bạn không có quyền hủy đơn hàng này.');
        }

        // Cập nhật trạng thái đơn hàng thành 'cancelled'
        $order->status = 'cancelled';
        $order->save();

        return redirect()->route('orders.index')->with('success', 'Đơn hàng đã được hủy thành công.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

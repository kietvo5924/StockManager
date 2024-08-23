<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $ordersQuery = Order::with('product')->orderBy('created_at', 'desc');

        if ($search) {
            $ordersQuery->where(function ($query) use ($search) {
                $query->whereHas('product', function ($q) use ($search) {
                    $q->where('name', 'like', "%$search%");
                })
                    ->orWhere('id', 'like', "%$search%");
            });
        }

        // Truy xuất số lượng đánh giá chưa thực hiện
        $user = Auth::user();
        $pendingReviewsCount = $user->reviews->where('status', 'pending')->count();

        // Lấy danh sách đơn hàng của người dùng hiện tại
        $pendingOrders = $ordersQuery->clone()->where('customer_id', Auth::id())->where('status', 'pending')->paginate(10, ['*'], 'pending_orders');
        $completedOrders = $ordersQuery->clone()->where('customer_id', Auth::id())->where('status', 'completed')->paginate(10, ['*'], 'completed_orders');
        $cancelOrders = $ordersQuery->clone()->where('customer_id', Auth::id())->where('status', 'cancelled')->paginate(10, ['*'], 'cancel_orders');

        // Truyền danh sách đơn hàng vào view
        return view('customer.orders.index', compact('pendingOrders', 'completedOrders', 'cancelOrders', 'pendingReviewsCount'));
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

        if ($order->status === 'completed') {
            return redirect()->route('orders.index')->with('error', 'Đơn hàng đã hoàn tất không thể hủy.');
        }

        // Tăng số lượng sản phẩm trở lại
        $product = Product::find($order->product_id);
        if ($product) {
            $product->quantity += $order->quantity;
            $product->save();
        }

        // Cập nhật trạng thái đơn hàng thành 'cancelled'
        $order->status = 'cancelled';
        $order->save();

        return redirect()->route('orders.index')->with('success', 'Đơn hàng đã được hủy thành công.');
    }
}

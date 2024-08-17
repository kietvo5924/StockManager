<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductReviewController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $reviews = ProductReview::with('product', 'user')
            ->where('user_id', $userId) // Chỉ lấy đánh giá của người dùng hiện tại
            ->get();

        return view('product_reviews.index', compact('reviews'));
    }

    public function createReview($order_id, $product_id)
    {
        $order = Order::find($order_id);
        $product = Product::find($product_id);

        if (!$order || !$product) {
            return redirect()->back()->withErrors(['error' => 'Order or Product not found.']);
        }

        return view('product_reviews.reviews', compact('order', 'product'));
    }

    public function storeReview(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'liked' => 'nullable|boolean',
            'comment' => 'nullable|string',
        ]);

        // Tạo và lưu đánh giá sản phẩm
        try {
            // Kiểm tra nếu đã có đánh giá cho đơn hàng và sản phẩm này
            $existingReview = ProductReview::where('user_id', Auth::id())
                ->where('order_id', $request->order_id)
                ->where('product_id', $request->product_id)
                ->first();

            if ($existingReview) {
                // Cập nhật đánh giá nếu đã tồn tại
                $existingReview->rating = $request->rating;
                $existingReview->liked = $request->has('liked');
                $existingReview->comment = $request->comment;
                $existingReview->status = 'completed'; // Cập nhật trạng thái
                $existingReview->save();
            } else {
                // Tạo đánh giá mới nếu chưa tồn tại
                $review = new ProductReview();
                $review->user_id = Auth::id();
                $review->product_id = $request->product_id;
                $review->order_id = $request->order_id;
                $review->rating = $request->rating;
                $review->liked = $request->has('liked');
                $review->comment = $request->comment;
                $review->status = 'completed'; // Cập nhật trạng thái
                $review->save();
            }

            return redirect()->route('product-reviews.index')->with('success', 'Đánh giá đã được gửi thành công!');
        } catch (\Exception $e) {
            // Xử lý lỗi và hiển thị thông báo lỗi
            return redirect()->back()->withErrors(['error' => 'Đã xảy ra lỗi khi gửi đánh giá.'])->withInput();
        }
    }
}

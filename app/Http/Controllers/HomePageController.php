<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function HomeIndex(Request $request)
    {
        $search = $request->input('search');

        // Bắt đầu với một query builder
        $query = Product::query()->orderBy('created_at', 'desc');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('id', 'like', "%$search%");
            });
        }

        // Thực hiện query và lấy kết quả
        $products = $query->paginate(36, ['*'], 'page');

        return view('pages/home', compact('products'));
    }

    public function productdetail($id)
    {
        $product = Product::with('category', 'brand', 'supplier', 'reviews.user')->findOrFail($id);

        $averageRating = ProductReview::where('product_id', $product->id)->avg('rating');

        return view('pages.productdetail', compact('product', 'averageRating'));
    }

    public function About()
    {
        return view('pages/about');
    }

    public function Contact()
    {
        return view('pages/contact');
    }

    public function Service()
    {
        return view('pages/services');
    }
}

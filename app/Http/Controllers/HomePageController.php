<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function HomeIndex()
    {
        $products = Product::all();

        return view('welcome', compact('products'));
    }
}

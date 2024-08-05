<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function HomeIndex()
    {
        $products = Product::all();

        return view('pages/home', compact('products'));
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

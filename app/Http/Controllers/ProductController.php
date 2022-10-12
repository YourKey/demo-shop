<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'meals'])
            ->paginate(30);
        return view('layouts.app', compact('products'));
    }
}

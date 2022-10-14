<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        return Product::query()
            ->with(['category', 'meals'])
            ->filtered()
            ->paginate(100);
    }
}

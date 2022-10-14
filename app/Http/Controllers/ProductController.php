<?php

namespace App\Http\Controllers;

use App\Filters\Filters;
use Illuminate\Contracts\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $filters = app(Filters::class)->all();

        return view('products.index', compact('filters'));
    }
}

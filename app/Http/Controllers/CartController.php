<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public CartService $service;

    public function __construct(CartService $cartService)
    {
        $this->service = $cartService;
    }

    public function index(Request $request): View
    {
        $grouped_products = $this->service->getRequestProducts($request);
        $boxes = $this->service->putIntoBoxes($grouped_products);

        return view('cart.index', compact(['boxes']));
    }
}

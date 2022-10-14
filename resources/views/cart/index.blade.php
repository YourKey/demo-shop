@extends('layouts.without_sidebar')

@section('content')
    <h1>Оформить заказ</h1>
    <div class="grid grid-col-1 lg:grid-cols-12">
        <div class="lg:col-span-8 mt-4">
            @foreach($boxes as $material => $meal_group)
                @foreach($meal_group as $meal => $products)
                    <div class="card bg-base-200 px-6 py-6 mb-10">
                        <div class="card-title mb-4">Коробка ({{ $products->max('width') }}×{{ $products->max('length') }} мм, {{ $products->first()->box_weight }} кг): {{ $material }}, {{ $meal }}</div>
                        @foreach($products as $product)
                            @include('cart.card')
                        @endforeach
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>

@endsection

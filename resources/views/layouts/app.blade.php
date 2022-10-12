<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('partials.head')
<body>
<div id="app">
    @include('partials.header')
    <div class="drawer drawer-mobile">
        <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content container mx-auto pt-6 pb-10 px-6">
            <h1>Магазин посуды</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-x-10 gap-y-14 mt-4">
                @foreach($products as $product)
                    <div class="card bg-base-100 shadow-xl">
                        <figure class="px-4"><img src="/images/{{ $product->name }}.jpg" alt="{{ $product->name }}" /></figure>
                        <div class="card-body">
                            <h2 class="card-title">
                                {{ $product->name }}
                            </h2>
                            <div class="card-actions">
                                <div class="badge badge-secondary">{{ $product->material }}</div>
                            </div>
                            <div class="card-actions justify-start">
                                @foreach($product->meals as $meal)
                                <div class="badge badge-outline">{{ $meal->name }}</div>
                                @endforeach
                            </div>
                            <div class="flex justify-between mt-2">
                                <div class="self-center text-gray-300 text-sm">{{ $product->weight }} кг, {{ $product->dimensions['width'] }}×{{ $product->dimensions['length'] }} мм</div>
                                <div class="">
                                    <button class="btn btn-primary">Купить</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @include('partials.sidebar')
    </div>
    @include('partials.footer')
</div>
</body>
<script src="{{ asset('js/app.js') }}"></script>
</html>

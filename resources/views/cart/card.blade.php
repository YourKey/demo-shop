<div class="card lg:card-side bg-base-100 shadow mb-4">
    <figure class="px-4 w-48 h-48"><img src="/images/{{ $product->name }}.jpg" alt="{{ $product->name }}" /></figure>
    <div class="card-body">
        <h2 class="card-title">
            {{ $product->name }} – {{ $product->amount }} шт
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
            <div class="self-center text-gray-300 text-sm">{{ $product->weight }} кг, {{ $product->width }}×{{ $product->length }} мм</div>
        </div>
    </div>
</div>

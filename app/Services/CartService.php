<?php
namespace App\Services;

use App\Models\Product;
use Illuminate\Http\Request;

class CartService {

    public function getRequestProducts(Request $request): array|\Illuminate\Support\Collection
    {
        $products = json_decode($request->cart);

        $ids = $this->extractIds($products);

        return Product::query()
            ->whereIn('id', $ids['all'])
            ->with('meals')
            ->get()
            ->each(function ($product) use ($ids) {
                $product->amount = $ids['with_amount'][$product->id];
            })
            ->groupBy(['material', 'meals.*.name']);
    }

    private function extractIds($products): array
    {
        $ids['with_amount'] = collect($products)->pluck('amount', 'id')->map(function($value, $key) {
            return intval($value, $key);
        });
        $ids['all'] = $ids['with_amount']->keys()->map(function($value) {
            return intval($value);
        });
        return $ids;
    }

    public function putIntoBoxes($grouped_products)
    {
        $processed_products = [];

        foreach ($grouped_products as $material => $meal_group) {
            foreach ($meal_group as $meal => $products) {
                foreach ($products as $index => $product) {
                    if (in_array($product->id, $processed_products)) unset($grouped_products[$material][$meal][$index]);
                    $processed_products[] = $product->id;
                }
            }
        }
        $boxes = $this->filterEmptyBox($grouped_products);
        return $this->sumWeight($boxes);
    }

    private function filterEmptyBox($boxes)
    {
        foreach ($boxes as $material => $meal_group) {
            foreach ($meal_group as $meal => $products) {
                if ($products->count() == 0) unset($boxes[$material][$meal]);
            }
        }

        return $boxes;
    }

    private function sumWeight($boxes)
    {
        foreach ($boxes as $meal_group) {
            foreach ($meal_group as $products) {
                $products->first()->box_weight = $products->sum(function($product) {
                    return $product->amount * $product->weight;
                });
            }
        }

        return $boxes;
    }
}

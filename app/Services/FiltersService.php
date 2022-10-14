<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Meal;
use App\Models\Product;

class FiltersService
{

    public function getFilterData(): array
    {
        $ranges = $this->getRanges();
        $data['categories'] = $this->categories();
        $data['materials'] = $this->materials();
        $data['meals'] = $this->meals();
        $data['weight'] = $this->getRangeByName($ranges, 'weight');
        $data['width'] = $this->getRangeByName($ranges, 'width');
        $data['length'] = $this->getRangeByName($ranges, 'length');
        return $data;
    }

    public function categories(): array
    {
        $categories = Category::all()->pluck('name', 'id');
        $categories = $categories->prepend('Любая категория');
        return $categories->toArray();
    }

    public function materials(): array
    {
        $materials = Product::query()
            ->select('material')
            ->distinct()
            ->get()
            ->pluck('material', 'material');
        $materials = $materials->prepend('Любой материал');
        
        return $materials->toArray();
    }

    public function meals(): array
    {
        return Meal::select('id', 'name')
            ->get()
            ->pluck('name', 'id')
            ->toArray();
    }

    public function getRanges()
    {
        $ranges = Product::query()->
        selectRaw(
            "
            min(weight) as weight_min,
            max(weight) as weight_max,
            min(width) as width_min,
            max(width) as width_max,
            min(length) as length_min,
            max(length) as length_max
        "
        )->first();

        $ranges->weight_step = 0.01;
        $ranges->width_step = 1;
        $ranges->length_step = 1;

        return $ranges;
    }

    public function getRangeByName($ranges, string $name): array
    {
        return [
            'min' => $ranges["{$name}_min"],
            'max' => $ranges["{$name}_max"],
            'step' => $ranges["{$name}_step"],
        ];
    }
}

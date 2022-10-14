<?php

namespace App\Providers;

use App\Filters\CheckboxFilter;
use App\Filters\Filters;
use App\Filters\InputFilter;
use App\Filters\InputRangeFilter;
use App\Filters\RadioFilter;
use App\Services\FiltersService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Filters::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $data = (new FiltersService())->getFilterData();
        extract($data); // create $categories, $materials, $weight, $width, $length, $meals

        app(Filters::class)->registerFilters([
             InputFilter::make('Название', 'search', 'name')
                 ->customQuery(function (Builder $q) {
                     $param = request("filters.search");
                     return $q->where('name', 'LIKE', "%$param%");
                 })
                 ->attributes(['placeholder' => 'Название товара']),

             RadioFilter::make('Категория', 'category', 'id', $categories),

             RadioFilter::make('Материал', 'material', null, $materials),

             InputRangeFilter::make('Вес, кг', 'weight', null, $weight)
                 ->attributes($weight),

             InputRangeFilter::make('Ширина, мм', 'width', null, $width)
                 ->attributes($width),

             InputRangeFilter::make('Длина, мм', 'length', null, $length)
                 ->attributes($length),

             CheckboxFilter::make('Подходит для', 'meals', 'id', $meals)
                 ->multiply(),
         ]);
    }
}

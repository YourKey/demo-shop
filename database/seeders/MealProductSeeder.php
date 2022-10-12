<?php

namespace Database\Seeders;

use App\Models\Meal;
use App\Models\Product;
use Illuminate\Database\Seeder;

class MealProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::all();
        $meals = Meal::all();

        $products->each(function($product) use ($meals) {
            $product->meals()->attach(
                $meals->random(rand(1,4))->pluck('id')->toArray()
            );
        });
    }
}

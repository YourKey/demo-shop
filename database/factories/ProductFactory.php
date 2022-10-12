<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $products = [
          ['name' => 'Тарелка керамическая', 'material' => 'Керамика'],
          ['name' => 'Тарелка алюминиевая', 'material' => 'Алюминий'],
          ['name' => 'Ложка стальная', 'material' => 'Сталь'],
          ['name' => 'Чашка керамическая', 'material' => 'Керамика'],
        ];
        $random_product = $products[array_rand($products)];
        return [
            'name' => $random_product['name'],
            'category_id' => Category::inRandomOrder()->first()->id,
            'material' => $random_product['material'],
            'weight' => $this->faker->randomFloat('3', '0.01', '1'),
            'dimensions' => [
                'length' => $this->faker->numberBetween('10', '100'),
                'width' => $this->faker->numberBetween('10', '100'),
            ],
        ];
    }
}

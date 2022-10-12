<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $categories = ['Тарелки', 'Чашки', 'Столовые приборы'];
        return [
            'name' => $categories[array_rand($categories)],
        ];
    }
}

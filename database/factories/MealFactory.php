<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MealFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $meals = ['Суп', 'Второе', 'Завтрак', 'Десерт'];
        return [
            'name' => $meals[array_rand($meals)],
        ];
    }
}

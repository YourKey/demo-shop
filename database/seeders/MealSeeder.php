<?php

namespace Database\Seeders;

use App\Models\Meal;
use Illuminate\Database\Seeder;

class MealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $meals = ['Суп', 'Второе', 'Завтрак', 'Десерт'];
        foreach ($meals as $meal) {
            Meal::factory()->create(['name' => $meal]);
        }
    }
}

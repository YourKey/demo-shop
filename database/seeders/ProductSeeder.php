<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            ['name' => 'Тарелка керамическая', 'material' => 'Керамика'],
            ['name' => 'Тарелка алюминиевая', 'material' => 'Алюминий'],
            ['name' => 'Ложка стальная', 'material' => 'Сталь'],
            ['name' => 'Чашка керамическая', 'material' => 'Керамика'],
        ];
        for ($i = 0; $i <100; $i++) {
            Product::factory()->create($products[array_rand($products)]);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use Faker\Factory as Faker;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $categories = Category::all();

        foreach ($categories as $category) {
            for ($i = 1; $i <= 3; $i++) {
                Product::create([
                    'title' => $faker->sentence,
                    'price' => $faker->randomNumber(2),
                    'image' => $faker->imageUrl(),
                    'category_id' => $category->id,
                    'onSale'=> $faker->boolean
                ]);
            }
        }
    }
}

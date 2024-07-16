<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Products;
use Faker\Factory as Faker;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        
        $faker = Faker::create();

        // Product attributes
        $genders = ['male', 'female'];
        $seasons = ['summer', 'winter'];
        $categories = ['casual', 'formal'];

        foreach ($genders as $gender) {
            foreach ($seasons as $season) {
                foreach ($categories as $category) {
                    for ($i = 0; $i < 5; $i++) {
                        Products::create([
                            'name' => $faker->word,
                            'description' => $faker->sentence,
                            'price' => $faker->randomFloat(2, 10, 100),
                            'quantity' => $faker->numberBetween(1, 100),
                            'image' => $faker->imageUrl(640, 480, 'fashion', true),
                            'gender' => $gender,
                            'size' => $faker->randomElement(['S', 'M', 'L', 'XL']),
                            'season' => $season,
                            'category' => $category,
                        ]);
                    }
                }
            }
        }
    }
}

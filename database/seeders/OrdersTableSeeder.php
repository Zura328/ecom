<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Products;

class OrdersTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Possible sizes
        $sizes = ['small', 'medium', 'large', 'xlarge'];

        // Seed 100 orders
        for ($i = 0; $i < 100; $i++) {
            $product_id = $faker->numberBetween(1, 40);
            $product = Products::find($product_id);
            $quantity = $faker->numberBetween(1, 10);
            $total_price = $product->price * $quantity;

            DB::table('orders')->insert([
                'customer_id' => $faker->numberBetween(64, 113),
                'product_id' => $product_id,
                'quantity' => $quantity,
                'total_price' => $total_price,
                'status' => $faker->randomElement(['pending', 'checked out']),
                'size' => $faker->randomElement($sizes),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
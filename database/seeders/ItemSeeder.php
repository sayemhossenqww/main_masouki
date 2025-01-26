<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 20) as $index) {
            $name = $faker->unique()->word();
            Item::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'price' => $faker->randomDigit,
                'discount' => rand(0, 10),
                'des' => $faker->sentence(),
                'category_id' => rand(1, 5),
                'active' => true,
            ]);
        }
    }
}

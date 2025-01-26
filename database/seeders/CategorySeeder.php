<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class CategorySeeder extends Seeder
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
            Category::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'sort_order' => $faker->randomNumber(1),
                'active' => true,
            ]);
        }
    }
}

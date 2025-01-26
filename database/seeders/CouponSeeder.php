<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        Coupon::create([
            'code' => 123456,
            'percentage' => rand(0, 100),
            'des' => $faker->sentence(),
            'active' => true,
        ]);
        Coupon::create([
            'code' => 654321,
            'percentage' => rand(0, 100),
            'des' => $faker->sentence(),
            'active' => true,
        ]);
        foreach (range(1, 20) as $index) {
            Coupon::create([
                'code' => $faker->randomNumber(6),
                'percentage' => rand(0, 100),
                'des' => $faker->sentence(),
                'active' => true,
            ]);
        }
    }
}

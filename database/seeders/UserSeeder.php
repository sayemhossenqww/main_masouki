<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!User::find(1)) {
            User::Create([
                'id' => 1,
                'name' => 'Hussein Mazloum',
                'email' => 'mazloum.hussein@hotmail.com',
                'password' => Hash::make('bruvs&*(582'),
            ]);
        }
    }
}

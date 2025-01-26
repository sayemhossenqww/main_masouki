<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Setting::$settings as $key => $value) {
            Setting::firstOrCreate([
                'id' => $key,
                'name' => $value,
                'value' => Setting::$settings_value[$key],
            ]);
        }
    }
}

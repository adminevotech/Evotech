<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            "phone" =>  "xxxxxxxxxxxx",
            "email" =>  "xxxxxxxxxxxx",
            "facebook" =>  "xxxxxxxxxxxx",
            "linkedin" =>  "xxxxxxxxxxxx",
            "address" =>  "xxxxxxxxxxxx",
            "twitter" =>  "xxxxxxxxxxxx",
            "instagram" =>  "xxxxxxxxxxxx",
            "youtube" =>  "xxxxxxxxxxxx",
        ];
        
        foreach ($settings as $key => $value) {
            Setting::firstOrCreate(["key"=> $key], ["key"=> $key, "value" => $value]);
        }
    }
}

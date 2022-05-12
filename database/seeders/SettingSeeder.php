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
            "footer" => [
                "footerdesc" => "footerdesc",
                "footermenu" => "footermenu",
                "footernewsletters" => "footernewsletters",
            ],
            "home" => [
                "aboutsection1text1" => "aboutsection1text1",
                "aboutsection1text2" => "aboutsection1text2",
            ]
        ];

        foreach ($settings as $group => $items) {
            foreach ($items as $key => $value) {
                Setting::firstOrCreate(["key"=> $key], ["key"=> $key, "group" => $group, "value" => $value]);
            }
        }
    }
}

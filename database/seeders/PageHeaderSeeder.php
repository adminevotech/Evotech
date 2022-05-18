<?php

namespace Database\Seeders;

use App\Models\PageHeader;
use Illuminate\Database\Seeder;

class PageHeaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pageHeaderKeys = ["about_us", "services_1", "services_2", "services_3", "services_4", "services_5", "blogs", "contactus"];

        foreach ($pageHeaderKeys as $pageHeaderKey) {
            PageHeader::firstOrCreate(["key"=> $pageHeaderKey], ["key"=> $pageHeaderKey]);
        }
    }
}

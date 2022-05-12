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
        $pageHeaderKeys = ["about_us", "news", "blogs", "contact_us", "partners", "management_board"];

        foreach ($pageHeaderKeys as $pageHeaderKey) {
            PageHeader::firstOrCreate(["key"=> $pageHeaderKey], ["key"=> $pageHeaderKey]);
        }
    }
}

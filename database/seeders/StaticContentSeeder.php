<?php

namespace Database\Seeders;

use App\Models\StaticContent;
use Illuminate\Database\Seeder;

class StaticContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $staticContent = [
            "navbar" => [
                "navbarhome" => [
                    "en" => "navbarhome",
                    "ar" => "navbarhome"
                ],
                "navbarservices" => [
                    "en" => "navbarservices",
                    "ar" => "navbarservices"
                ],
                "navbarabout" => [
                    "en" => "navbarabout",
                    "ar" => "navbarabout"
                ],
                "navbarblog" => [
                    "en" => "navbarblog",
                    "ar" => "navbarblog"
                ],
                "navbarcontactus" => [
                    "en" => "navbarcontactus",
                    "ar" => "navbarcontactus"
                ],
                "navbarproposal" => [
                    "en" => "navbarproposal",
                    "ar" => "navbarproposal"
                ],
            ],
            "aboutsection" =>[
                "aboutsectiontitlesub" =>[
                    "en" => "aboutsectiontitlesub",
                    "ar" => "aboutsectiontitlesub"
                ],
                "aboutsectiontitle" =>[
                    "en" => "aboutsectiontitle",
                    "ar" => "aboutsectiontitle"
                ],
                "aboutsectiondescriptionsub" =>[
                    "en" => "descriptionsub",
                    "ar" => "descriptionsub"
                ],
                "aboutsectiondescription" =>[
                    "en" => "aboutsectiondescription",
                    "ar" => "aboutsectiondescription"
                ],
                "aboutsectionimg" =>[
                    "img" => "aboutsectionimg",
                ],
                "aboutsectionbutton" =>[
                    "en" => "aboutsectionbutton",
                    "ar" => "aboutsectionbutton"
                ],
            ],
            "servicessection" =>[
                "servicessectiontitlesub" =>[
                    "en" => "servicessectiontitlesub",
                    "ar" => "servicessectiontitlesub"
                ],
                "servicessectiontitle" =>[
                    "en" => "servicessectiontitle",
                    "ar" => "servicessectiontitle"
                ],
                "servicessectiondescription" =>[
                    "en" => "servicessectiondescription",
                    "ar" => "servicessectiondescription"
                ],

            ],
            "proposalsection" =>[
                "proposalsectiontitlesub" =>[
                    "en" => "proposalsectiontitlesub",
                    "ar" => "proposalsectiontitlesub"
                ],
                "proposalsectiontitle" =>[
                    "en" => "proposalsectiontitle",
                    "ar" => "proposalsectiontitle"
                ],
                "proposalsectiondescription" =>[
                    "en" => "proposalsectiondescription",
                    "ar" => "proposalsectiondescription"
                ],

            ],
            "teamsection" => [
                "teamsectiontitlesub" =>[
                    "en" => "teamsectiontitlesub",
                    "ar" => "teamsectiontitlesub"
                ],
                "teamsectiontitle" =>[
                    "en" => "teamsectiontitle",
                    "ar" => "teamsectionntitle"
                ],
                "teamsectiondescription" =>[
                    "en" => "teamsectiondescription",
                    "ar" => "teamsectiondescription"
                ],
            ],
            "clientssection" =>[
                "clientssectiontitlesub" =>[
                    "en" => "clientssectiontitlesub",
                    "ar" => "clientssectiontitlesub"
                ],
                "clientssectiontitle" =>[
                    "en" => "clientssectiontitle",
                    "ar" => "clientssectiontitle"
                ],
                "clientssectiondescription" =>[
                    "en" => "clientssectiondescription",
                    "ar" => "clientssectiondescription"
                ],
            ],
            "footer" => [
                "footerimg" => "footerimg",
                "footerdescription" =>[
                    "en" => "footerdescription",
                    "ar" => "footerdescription"
                ],
                "footerhome" => [
                    "en" => "footerhome",
                    "ar" => "footerhome"
                ],
                "footerabout" => [
                    "en" => "footerabout",
                    "ar" => "footerabout"
                ],
                "footerblog" => [
                    "en" => "footerblog",
                    "ar" => "footerblog"
                ],
                "footercontactus" => [
                    "en" => "footercontactus",
                    "ar" => "footercontactus"
                ],

                "footerservices" => [
                    "footerservicestitle" => [
                        "en" => "footerservicestitle",
                        "ar" => "footerservicestitle"
                    ],
                ],
            ]
        ];

        foreach ($staticContent as $group => $items) {
            foreach ($items as $key => $value) {
                StaticContent::firstOrCreate(["key"=> $key], ["key"=> $key, "group" => $group, "text" => $value]);
            }
        }
    }
}

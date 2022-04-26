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
                "navbarourclient" => [
                    "en" => "navbarourclient",
                    "ar" => "navbarourclient"
                ],
                "navbarcontactus" => [
                    "en" => "navbarcontactus",
                    "ar" => "navbarcontactus"
                ],
            ],
            "buttons" => [
                "buttonsreadmore" => [
                    "en" => "buttonsreadmore",
                    "ar" => "buttonsreadmore"
                ],
                "buttonsgetstarted" => [
                    "en" => "buttonsgetstarted",
                    "ar" => "buttonsgetstarted"
                ],
                "buttonssubscribe" => [
                    "en" => "buttonssubscribe",
                    "ar" => "buttonssubscribe"
                ],
                "buttonssendmessage" => [
                    "en" => "buttonssendmessage",
                    "ar" => "buttonssendmessage"
                ],
                "buttonsmore" => [
                    "en" => "buttonsmore",
                    "ar" => "buttonsmore"
                ],
            ],

            "footer" => [
                "footerdesc" => [
                    "en" => "footerdesc",
                    "ar" => "footerdesc"
                ],
                "footermenu" => [
                    "en" => "footermenu",
                    "ar" => "footermenu"
                ],
                "footernewsletters" => [
                    "en" => "footernewsletters",
                    "ar" => "footernewsletters"
                ],
                "footerdescnewsletter" => [
                    "en" => "footerdescnewsletter",
                    "ar" => "footerdescnewsletter"
                ],
            ],

            "clients" => [
                "clientsbusiness" => [
                    "en" => "clientsbusiness",
                    "ar" => "clientsbusiness"
                ],
                "clientseducation" => [
                    "en" => "clientseducation",
                    "ar" => "clientseducation"
                ],
                "clientscosmetics" => [
                    "en" => "clientscosmetics",
                    "ar" => "clientscosmetics"
                ],
            ],

            "contacts" => [
                "contactsaddresstext" => [
                    "en" => "contactsaddresstext",
                    "ar" => "contactsaddresstext"
                ],
                "contactsemailtext" => [
                    "en" => "contactsemailtext",
                    "ar" => "contactsemailtext"
                ],
                "contactscalltext" => [
                    "en" => "contactscalltext",
                    "ar" => "contactscalltext"
                ],
                "contactstitleform" => [
                    "en" => "contactstitleform",
                    "ar" => "contactstitleform"
                ],
                "contactsdescform" => [
                    "en" => "contactsdescform",
                    "ar" => "contactsdescform"
                ],
                "contactsname" => [
                    "en" => "contactsname",
                    "ar" => "contactsname"
                ],
                "contactsemail" => [
                    "en" => "contactsemail",
                    "ar" => "contactsemail"
                ],
                "contactssubject" => [
                    "en" => "contactssubject",
                    "ar" => "contactssubject"
                ],
                "contactsmessage" => [
                    "en" => "contactsmessage",
                    "ar" => "contactsmessage"
                ],
                "contactstitle" => [
                    "en" => "contactstitle",
                    "ar" => "contactstitle"
                ],
                "contactsinfo" => [
                    "en" => "contactsinfo",
                    "ar" => "contactsinfo"
                ],
            ],

            "settings" => [
                "settingsaddress" => [
                    "en" => "settingsaddress",
                    "ar" => "settingsaddress"
                ],
                "settingsphone" => [
                    "en" => "settingsphone",
                    "ar" => "settingsphone"
                ],
                "settingsemail" => [
                    "en" => "settingsemail",
                    "ar" => "settingsemail"
                ],
            ],

            "services" => [
                "servicestitle" => [
                    "en" => "servicestitle",
                    "ar" => "servicestitle"
                ],
                "servicesdesc" => [
                    "en" => "servicesdesc",
                    "ar" => "servicesdesc"
                ],
            ],

            "about" => [
                "abouttitle" => [
                    "en" => "abouttitle",
                    "ar" => "abouttitle"
                ],
                "aboutdesc" => [
                    "en" => "aboutdesc",
                    "ar" => "aboutdesc"
                ],
                "aboutmission" => [
                    "en" => "aboutmission",
                    "ar" => "aboutmission"
                ],
                "aboutdescmission" => [
                    "en" => "aboutdescmission",
                    "ar" => "aboutdescmission"
                ],
                "aboutvision" => [
                    "en" => "aboutvision",
                    "ar" => "aboutvision"
                ],
                "aboutdescvision" => [
                    "en" => "aboutdescvision",
                    "ar" => "aboutdescvision"
                ],
                "aboutsection1text1" => [
                    "en" => "aboutsection1text1",
                    "ar" => "aboutsection1text1"
                ],
                "aboutsection1text2" => [
                    "en" => "aboutsection1text2",
                    "ar" => "aboutsection1text2"
                ],
                "aboutsection1point1" => [
                    "en" => "aboutsection1point1",
                    "ar" => "aboutsection1point1"
                ],
                "aboutsection1point2" => [
                    "en" => "aboutsection1point2",
                    "ar" => "aboutsection1point2"
                ],
                "aboutsection1point3" => [
                    "en" => "aboutsection1point3",
                    "ar" => "aboutsection1point3"
                ],
                "aboutsection1point4" => [
                    "en" => "aboutsection1point4",
                    "ar" => "aboutsection1point4"
                ],
                "aboutsection1point5" => [
                    "en" => "aboutsection1point5",
                    "ar" => "aboutsection1point5"
                ],
                "aboutsection1point6" => [
                    "en" => "aboutsection1point6",
                    "ar" => "aboutsection1point6"
                ],
            ],

            "home" => [
                "aboutsection1text1" => [
                    "en" => "aboutsection1text1",
                    "ar" => "aboutsection1text1"
                ],
                "aboutsection1text2" => [
                    "en" => "aboutsection1text2",
                    "ar" => "aboutsection1text2"
                ],
                "aboutsection1text3" => [
                    "en" => "aboutsection1text3",
                    "ar" => "aboutsection1text3"
                ],
                "aboutsection1text4" => [
                    "en" => "aboutsection1text4",
                    "ar" => "aboutsection1text4"
                ],
                "aboutsection1text5" => [
                    "en" => "aboutsection1text5",
                    "ar" => "aboutsection1text5"
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

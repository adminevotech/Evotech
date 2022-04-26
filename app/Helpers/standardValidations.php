<?php
use App\Models\SystemPermission as Permission;

define("valid_name", ['string', 'max:255']);
define("valid_email", ['string','email','max:255', "regex:/^[a-zA-Z0-9.!#$%&’*+=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:.[a-zA-Z0-9-]+)*$/"]);
define("valid_password", ["string", "min:8", "regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/"]);
define("valid_phone", ['numeric']);

define("valid_active", ['integer', 'in:0,1']);

define("valid_otp", ['integer', 'required']);

define("valid_comment", ['string', "min:5", "max:500"]);
define("valid_short_description", ['string', "min:5", "max:100"]);
define("valid_description", ['string', "min:5", "max:500"]);

define("max_image_size", "5000");
define("valid_image_mimes", ["jpeg", "jpg", "png"]);
define("valid_media_mimes", [...constant("valid_image_mimes")]);
define("valid_image", ["file", 'mimes:'.valid_inputs(constant("valid_image_mimes")), "max:".constant("max_image_size")]);


 if(!function_exists("translatable_locales_are_allowed")){
    function translatable_locales_are_allowed($translatable){
        return $translatable == array_filter($translatable, function($item) { return in_array($item, main_locales()); }, ARRAY_FILTER_USE_KEY);
    }
 }

 if(!function_exists("validate_translatable_locales")){
    function validate_translatable_locales($validator, $translatable){
        if(!translatable_locales_are_allowed(request()->$translatable)){
            validate_single(
                $validator, $translatable,
                sprintf("Allowed (%s) Languages are (%s)", $translatable, valid_inputs(main_locales()))
            );
        }
    }
 }

 if(!function_exists("translatable_is_array")){
    function translatable_is_array($validator, $translatable){
         if(is_array(request()->$translatable)){
             return true;
         };
         validate_single($validator, $translatable, "($translatable) must be in Json Format");
         return false;
    }
 }

 if(!function_exists("translatable_first_character_is_Letter")){
    function translatable_first_character_is_Letter($validator, $translatable){
        foreach (request()->$translatable as $key => $value) {
            if(!preg_match("/^[a-zA-Z]/", $value)){
                validate_single($validator, $translatable, "($translatable) ($key) is Invalid");
                return false;
            }
        }
        return true;
    }
 }


 if(!function_exists("validate_translatables")){
    function validate_translatables($validator, $translatables){
        foreach ($translatables as $translatable) {
            if(request()->$translatable && translatable_is_array($validator, $translatable)){
                validate_translatable_locales($validator, $translatable);
            }
        }
    }
 }


if(!function_exists("validate_permission_ids")){
    function validate_permission_ids($validator, $permission_ids){
        if($permission_ids && Permission::whereIn('id', $permission_ids)->count() != count($permission_ids)){
            validate_single($validator, 'permission_ids', "Permission Ids Are Incorrent");
        }
    }
}

if(!function_exists("validate_single")){
    function validate_single($validator, $item, $message){
        $validator->errors()->add($item, $message);
    }
 }

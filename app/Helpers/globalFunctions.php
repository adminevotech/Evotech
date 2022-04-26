<?php

use App\Models\StaticContent;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redis;

//collections
if(!function_exists("collectionFormat")){
    function collectionFormat($collection, $data) {
        return $collection::collection($data);
    }
}

if(!function_exists("paginatedCollectionFormat")){
    function paginatedCollectionFormat($collection, $data) {
        return $collection::collection($data)->response()->getData(true);
    }
}

  //cache functions
  if(!function_exists("cacheAndLocalizeArray")){
    function cacheAndLocalizeArray($item, $key_name, $locale, $expiration_time = 0) {
        $expiration_time = $expiration_time === 0 ? constant("default_cache_expiration_time") : $expiration_time;
        if(is_array($item) && count($item)){
            Redis::set($key_name."_".$locale, json_encode($item), "EX", $expiration_time);
        }
    }
 }

 if(!function_exists("cachedLocalizedArray")){
    function cachedLocalizedArray($key_name) {
        $array = Redis::get($key_name."_".current_locale());
        if($array){
            return json_decode($array);
        }
    }
 }

//string functions
 if(!function_exists("extractModelName")){
    function extractModelName($modelPath){
        $pieces = explode("\\", $modelPath);
        return array_pop($pieces);
    }
 }

 if(!function_exists("cleanString")){
    function cleanString($string) {
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
        return strtolower($string); // return string in lower case
    }
 }

//config
if(!function_exists("localizedFunction")){
    function localizedFunction($closure, $params) {
        $tempLocale = current_locale();
        $args = [];
        foreach (main_locales() as $locale) {
            App::setLocale($locale);
            $args = $params;
            $args[] = $locale;
            $closure(...$args);
        }
        App::setLocale($tempLocale);
    }
 }

 if(!function_exists("main_locales")){
    function main_locales() {
        return array_keys(config('laravellocalization.supportedLocales'));
    }
 }

 if(!function_exists("current_locale")){
    function current_locale() {
        return App::currentLocale();
    }
 }

 if(!function_exists("get_default_reset_password_link_expiration_time")){
    function get_default_reset_password_link_expiration_time(){
        return optional(StaticContent::where("group", "settings")->where('key', 'reset_password_link_expiration_time')->first())
        ->text ?? constant("default_reset_password_link_expiration_time");
    }
 }

  //media
  if(!function_exists("add_media_item")){
    function add_media_item($model, $item, $collection) {
        if($item){
            try {
                $model->addMedia($item)->toMediaCollection($collection);
            } catch (Throwable $th) {
                dd($th);
                throw new HttpResponseException(internal_server_error_response());
            }
        }
    }
 }


 if(!function_exists("valid_inputs")){
    function valid_inputs($inputs){
        return substr(array_reduce($inputs, function($a, $b) { return "$a,$b"; }), 1);
    }
 }


